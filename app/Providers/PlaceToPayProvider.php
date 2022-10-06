<?php

namespace App\Providers;

use App\Enums\StatusEnum;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class PlaceToPayProvider extends ServiceProvider
{
  private $login;
  private $secret;
  private $nonce;
  private $date;
  private $seed;

  public function __construct()
  {
    $this->login = config('services.place2pay.login');
    $this->secret = config('services.place2pay.secret');
    $this->nonce = Str::random(10);
    $this->date = Carbon::now('America/Bogota');
    $this->seed = $this->date->format('Y-m-d\TH:i:sP');
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

  public function getDate()
  {
    return $this->date;
  }

  private function getTranKey()
  {
    return base64_encode(sha1($this->nonce . $this->seed . $this->secret, true));
  }

  public function generateSession(StoreOrderRequest $request)
  {
    $order = Order::create([
      'customer_name' => $request->name,
      'customer_email' => $request->email,
      'customer_mobile' => $request->phone,
      'status' => StatusEnum::CREATED
    ]);

    $reference = $order->id;

    $request = [
      'locale' => 'es_CO',
      'auth' => $this->getAuth(),
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
      'expiration' => $this->getDate()->addMinutes(5)->format('Y-m-d\TH:i:sP'),
      'returnUrl' => url("/verify/{$reference}"),
      'userAgent' => $request->header('User-Agent')
    ];

    $response = Http::post(config('services.place2pay.url'), $request);

    if ($response->status() == 200) {
      $data = $response->json();

      $order->requestId = $data['requestId'];
      $order->processUrl = $data['processUrl'];
      $order->save();

      return Redirect::to(url("/status/{$reference}"));
    } else {
      return $response->body();
    }
  }

  public function verifyStatusUpdate(int $ref)
  {
    $order = Order::findOrFail($ref);

    $request = [
      'auth' => $this->getAuth()
    ];

    $response = Http::post(config('services.place2pay.url') . '/' . $order->requestId, $request);

    if ($response->status() == 200) {
      $data = $response->json();
      if ($data['status']['status'] == StatusEnum::APPROVED->name) {
        $order->status = StatusEnum::PAYED;
        $order->save();
      }
      if ($data['status']['status'] == StatusEnum::REJECTED->name) {
        if ($data['status']['message'] == "La petición ha expirado") {
          $order->status = StatusEnum::EXPIRED;
          $order->save();
        } else {
          $order->status = StatusEnum::REJECTED;
          $order->save();
        }
      }
    }

    return Redirect::to(url("/status/{$ref}"));
  }

  public function regenerateSession($ref)
  {
    $order = Order::find($ref);

    $reference = $ref;

    $request = [
      'locale' => 'es_CO',
      'auth' => $this->getAuth(),
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
      'expiration' => $this->getDate()->addMinutes(5)->format('Y-m-d\TH:i:sP'),
      'returnUrl' => url("/verify/{$reference}"),
      'userAgent' => request()->header('User-Agent')
    ];

    $response = Http::post(config('services.place2pay.url'), $request);

    if ($response->status() == 200) {
      $data = $response->json();

      $order->requestId = $data['requestId'];
      $order->processUrl = $data['processUrl'];
      $order->status = StatusEnum::CREATED;
      $order->save();

      return Redirect::to(url("/status/{$reference}"));
    } else {
      return $response->body();
    }
  }
}
