<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
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
}
