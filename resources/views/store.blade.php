@extends('layout')

@section('content')
<section id="pricing-2" class="bg-snow pb-60 inner-page-hero pricing-section division">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-8">
        <div class="section-title title-01 mb-40">
          <h2 class="h2-md">{{config('app.name')}}</h2>
        </div>
      </div>
    </div>
    <div class="pricing-2-row pc-25">
      <div class="row row-cols-1 row-cols-md-3">
        <div class="col-md-4 offset-md-4">
          <div class="pricing-2-table bg-white mb-40 wow fadeInUp">
            <div class="pricing-plan">
              <div class="row">
                <div class="col">
                  <img src="images/pc.png" class="img-fluid">
                </div>
              </div>
              <div class="pricing-plan-title">
                <h5 class="h5-xs">PC</h5>
                <h6 class="h6-sm bg-lightgrey">Save 30%</h6>
              </div>
              <sup class="dark-color">$</sup>
              <span class="dark-color">2</span>
              <sup class="validity dark-color"><span>.000.000</span></sup>
            </div>
            <button type="button" class="btn btn-sm btn-tra-grey tra-skyblue-hover" data-bs-toggle="modal" data-bs-target="#client">Comprar</button>
          </div>
        </div>
        <div class="toast-container position-static">
          @if ($errors->any())
          @foreach ($errors->all() as $error)
          <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <strong class="me-auto">Información incorrecta</strong>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">{{ $error }}</div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<div id="client" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="post" id="client-form">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ingrese sus datos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input class="form-control" type="text" id="name" name="name" required placeholder="Nombre" value="{{ Faker\Factory::create()->name }}">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Correo electrónico</label>
            <input class="form-control" type="email" id="email" name="email" required placeholder="Correo electrónico" value="{{ Faker\Factory::create()->email }}">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label"># de celular</label>
            <input class="form-control" type="phone" id="phone" name="phone" required placeholder="# de celular" value="{{ Faker\Factory::create()->numerify('##########') }}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Ir a pagar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection