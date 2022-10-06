@extends('layout')

@section('content')
<section id="team-1" class="wide-50 inner-page-hero team-section division">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section-title title-02 mb-75">
          <span class="section-id">Listado de órdenes</span>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
              <tr>
                <th scope="row" class="p-3">{{ $order->id }}</th>
                <td class="p-3">{{ $order->status }}</td>
                <td>
                  <a class="btn btn-outline-info btn-sm mt-1" href="{{ url('status/'.$order->id) }}">Visualizar</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection