<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
  /**
   * Test home
   */
  public function test_home_returns_a_successful_response()
  {
    $response = $this->get('/')->assertStatus(200);
  }

  /**
   * Test orders
   */
  public function test_orders_returns_a_successful_response()
  {
    $response = $this->get('/orders')->assertStatus(200);
  }
}
