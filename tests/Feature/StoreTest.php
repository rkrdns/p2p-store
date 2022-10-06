<?php

namespace Tests\Feature;

use App\Providers\PlaceToPayProvider;
use Carbon\Carbon;
use Tests\TestCase;

class StoreTest extends TestCase
{
  const login = 'usuarioprueba';
  const tranKey = 'ABCD1234';
  const nonce = 'WmEyvut9GgvcMWrV';
  const seed = '2016-08-30T16:21:35+00:00';

  /**
   * A basic unit test example.
   *
   * @return void
   */
  public function test_example()
  {
    $placeToPay = new PlaceToPayProvider($this);
    $placeToPay->reconfigure(self::login, self::tranKey, self::nonce, Carbon::parse(self::seed));

    $generatedAuth = $placeToPay->getAuth();

    $targetAuth = [
      'login' => self::login,
      'tranKey' => 'i/RFwSHAh8d7YgtO3HME5kCnYy8=',
      'nonce' => 'V21FeXZ1dDlHZ3ZjTVdyVg==',
      'seed' => Carbon::parse(self::seed)->format('Y-m-d\TH:i:sP')
    ];

    $this->assertTrue($generatedAuth == $targetAuth);
  }
}
