<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Providers\PlaceToPayProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Enums\StatusEnum;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    return view('store')->with('data', $request->session());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreOrderRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreOrderRequest $request)
  {
    $order = Order::create([
      'customer_name' => $request->name,
      'customer_email' => $request->email,
      'customer_mobile' => $request->phone,
      'status' => StatusEnum::CREATED
    ]);

    $reference = $order->id;

    $placeToPay = new PlaceToPayProvider($this);

    $request = [
      'locale' => 'es_CO',
      'auth' => $placeToPay->getAuth(),
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
      'expiration' => $placeToPay->getDate()->addDays(30)->format('Y-m-d\TH:i:sP'),
      'returnUrl' => url("/verify/{$reference}"),
      'userAgent' => $request->header('User-Agent')
    ];

    $response = Http::post('https://checkout-co.placetopay.dev/api/session', $request);

    if ($response->status() == 200) {
      $data = $response->json();

      $order->requestId = $data['requestId'];
      $order->processUrl = $data['processUrl'];
      $order->save();

      return Redirect::to($data['processUrl']);
    }else{
      return $response->body();
    }
  }

  public function verify($ref)
  {
    $order = Order::findOrFail($ref);

    $placeToPay = new PlaceToPayProvider($this);

    $request = [
      'auth' => $placeToPay->getAuth()
    ];

    $response = Http::post('https://checkout-co.placetopay.dev/api/session/' . $order->requestId, $request);

    if ($response->status() == 200) {
      $data = $response->json();
      if ($data['status']['status'] == StatusEnum::APPROVED->name) {
        $order->status = StatusEnum::PAYED;
        $order->save();
      }
      if ($data['status']['status'] == StatusEnum::REJECTED->name) {
        $order->status = StatusEnum::REJECTED;
        $order->save();
      }
    }

    return Redirect::to(url("/status/{$ref}"));
  }

  public function status($ref)
  {
    return view('status')->with('order', Order::find($ref));
  }
}
