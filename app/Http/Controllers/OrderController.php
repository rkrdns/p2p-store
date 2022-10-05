<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Carbon\Carbon;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

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
      'customer_mobile' => $request->phone
    ]);

    $date = Carbon::now('America/Bogota');

    $login = config('services.place2pay.login');
    $secret = config('services.place2pay.secret');
    $nonce = Str::random(10);
    $seed = $date->format('Y-m-d\TH:i:sP');
    $tranKey = base64_encode(sha1($nonce . $seed . $secret, true));

    $reference = $order->id;

    $request = [
      'locale' => 'es_CO',
      'auth' => [
        'login' => $login,
        'tranKey' => $tranKey,
        'nonce' => base64_encode($nonce),
        'seed' => $seed
      ],
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
      'expiration' => $date->addDays(30)->format('Y-m-d\TH:i:sP'),
      'returnUrl' => url('/verify'),
      'userAgent' => $request->header('User-Agent')
    ];

    $response = Http::post('https://checkout-co.placetopay.dev/api/session', $request);

    if ($response->status() == 200) {
      $data = $response->json();
      
      $order->requestId = $data['requestId'];
      $order->processUrl = $data['processUrl'];
      $order->save();

      return Redirect::to($data['processUrl']);
    }
  }

  public function verify(Request $request)
  {
    dd($request->all());
  }
}
