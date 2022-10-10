<?php

namespace App\Providers;

use App\Enums\StatusEnum;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class PlaceToPayProvider extends ServiceProvider
{
  private $baseUrl;
  private $login;
  private $secret;
  private $nonce;
  private $date;
  private $seed;
  private $delayToExpire;

  public function __construct()
  {
    $this->baseUrl = config('services.place2pay.baseUrl');
    $this->login = config('services.place2pay.login');
    $this->secret = config('services.place2pay.secret');
    $this->nonce = Str::random(10);
    $this->date = Carbon::now('America/Bogota');
    $this->delayToExpire = 10;
  }

  public function reconfigure($login, $secret, $nonce, $date)
  {
    $this->login = $login;
    $this->secret = $secret;
    $this->nonce = $nonce;
    $this->date = $date;
    $this->seed = $this->date->format('Y-m-d\TH:i:sP');
  }

  public function getAuth()
  {
    return [
      'login' => $this->login,
      'tranKey' => $this->getTranKey(),
      'nonce' => base64_encode($this->nonce),
      'seed' => $this->seed
    ];
  }

  private function getTranKey()
  {
    return base64_encode(sha1($this->nonce . $this->seed . $this->secret, true));
  }

  public function getInstance()
  {
    return new PlacetoPay([
      'login' => $this->login,
      'tranKey' => $this->secret,
      'baseUrl' => $this->baseUrl
    ]);
  }

  public function getDate()
  {
    return $this->date;
  }

  public function generateSession(StoreOrderRequest $request)
  {
    $placetopay = $this->getInstance();

    $order = Order::create([
      'customer_name' => $request->name,
      'customer_email' => $request->email,
      'customer_mobile' => $request->phone,
      'status' => StatusEnum::CREATED
    ]);

    $reference = $order->id;

    $request = [
      'locale' => 'es_CO',
      'payment' => [
        'reference' => $reference,
        'description' => 'PC',
        'amount' => [
          'currency' => 'COP',
          'total' => 2000000,
        ],
        'allowPartial' => false
      ],
      'ipAddress' => $request->ip(),
      'expiration' => $this->getDate()->addMinutes($this->delayToExpire)->format('Y-m-d\TH:i:sP'),
      'returnUrl' => url("/verify/{$reference}"),
      'userAgent' => $request->header('User-Agent')
    ];

    $response = $placetopay->request($request);
    if ($response->isSuccessful()) {
      $order->requestId = $response->requestId();
      $order->processUrl = $response->processUrl();
      $order->save();

      return Redirect::to(url("/status/{$reference}"));
    } else {
      return response()->json($response->status()->message());
    }
  }

  public function verifyStatusUpdate(int $ref)
  {
    $order = Order::findOrFail($ref);

    $placetopay = $this->getInstance();

    $response = $placetopay->query($order->requestId);

    if ($response->isSuccessful()) {
      if ($response->status()->isApproved()) {
        $order->status = StatusEnum::PAYED;
        $order->save();
      }
      if ($response->status()->isRejected()) {
        if ($response->status()->message() == "La petición ha expirado") {
          $order->status = StatusEnum::EXPIRED;
          $order->save();
        } else {
          $order->status = StatusEnum::REJECTED;
          $order->save();
        }
      }
    } else {
      return response()->json($response->status()->message());
    }

    return Redirect::to(url("/status/{$ref}"));
  }

  public function regenerateSession($ref)
  {
    $order = Order::find($ref);

    $reference = $ref;

    $placetopay = $this->getInstance();

    $request = [
      'locale' => 'es_CO',
      'payment' => [
        'reference' => $reference,
        'description' => 'PC',
        'amount' => [
          'currency' => 'COP',
          'total' => 2000000,
        ],
        'allowPartial' => false
      ],
      'ipAddress' => request()->ip(),
      'expiration' => $this->getDate()->addMinutes($this->delayToExpire)->format('Y-m-d\TH:i:sP'),
      'returnUrl' => url("/verify/{$reference}"),
      'userAgent' => request()->header('User-Agent')
    ];

    $response = $placetopay->request($request);
    if ($response->isSuccessful()) {
      $order->requestId = $response->requestId();
      $order->processUrl = $response->processUrl();
      $order->status = StatusEnum::CREATED;
      $order->save();

      return Redirect::to(url("/status/{$reference}"));
    } else {
      return response()->json($response->status()->message());
    }
  }
}
