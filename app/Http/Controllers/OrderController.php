<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Providers\PlaceToPayProvider;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  /**
   * Display a view for buy product
   */
  public function index(Request $request)
  {
    return view('store')->with('data', $request->session());
  }

  /**
   * generate checkout session
   */
  public function store(StoreOrderRequest $request)
  {
    $placeToPay = new PlaceToPayProvider($this);
    return $placeToPay->generateSession($request);
  }

  /**
   * verify status update
   */
  public function verify($ref)
  {
    $placeToPay = new PlaceToPayProvider($this);
    return $placeToPay->verifyStatusUpdate($ref);
  }

  /**
   * show current status
   */
  public function status($ref)
  {
    return view('status')->with('order', Order::find($ref));
  }

  /**
   * show orders
   */
  public function orders()
  {
    return view('orders')->with('orders', Order::all());
  }
}
