@extends('layout')

@section('content')
<section id="team-1" class="wide-50 inner-page-hero team-section division">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <div class="section-title title-02 mb-75">
          <span class="section-id txt-upcase">Estado de pago</span>
          <h3 class="h2-xs">De: PC</h3>
          <h3 class="h2-xs">Por: $ 2.000.000</h3>
        </div>
      </div>
    </div>
    <div class="team-members-wrapper text-center">
      <div class="row">
        <div class="col-md-4 offset-md-4">
          <div class="team-member wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div class="team-member-photo">
              <img class="img-fluid" src="{{ asset('images/pc.png') }}" alt="team-member-foto">
            </div>
            <div class="team-member-data">
              <h5 class="h5-sm">PC</h5>
              <p class="p-lg">Nombre: {{ $order->customer_name }}</p>
              <p class="p-lg"><a href="#" class="text-secondary">Correo electrónico: {{ $order->customer_email }}</a></p>
              <p class="p-lg mb-3"><a href="#" class="text-secondary">Número celular: {{ $order->customer_mobile }}</a></p>
              <p class="p-lg">Estado de pago: <strong>{{ $order->status }}</strong></p>
              @if($order->status==App\Enums\StatusEnum::CREATED->value)
              <a class="btn btn-sm btn-tra-grey tra-skyblue-hover mt-4" href="{{ $order->processUrl }}">Pagar</a>
              @endif
              @if($order->status==App\Enums\StatusEnum::EXPIRED->value)
              <a class="btn btn-sm btn-tra-grey tra-skyblue-hover mt-4" href="{{ url('regenerate') . "/{$order->id}" }}">Reintentar pago</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection