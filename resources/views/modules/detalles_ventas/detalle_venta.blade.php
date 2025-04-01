@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Detalle de la venta</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Detalle de la venta</h5>
            
            <p><strong>Usuario que hizo la venta: </strong> {{ $venta->nombre_usuario }} </p>
            <p><strong>Total de venta</strong> ${{ $venta->total_venta }}</p>
            <p><strong>Fecha</strong>{{ $venta->created_at }}</p>
            <hr>
            <table class="table datatable">
              <thead>
                <tr>
                  <th class="text-center">Producto</th>
                  <th class="text-center">Cantidad</th>
                  <th class="text-center">Precio Unitario</th>
                  <th class="text-center">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($detalles as $item)
                  <tr class="text-center">
                    <td class="text-center">{{ $item->nombre_producto }}</td>
                    <td class="text-center">{{ $item->cantidad }}</td>
                    <td class="text-center">${{ $item->precio_unitario }}</td>
                    <td class="text-center">${{ $item->sub_total }}</td>
                   
                  </tr>
                  @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
            <hr>
            <a href="{{ route('detalle-venta') }}" class="btn btn-info">Cancelar</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection

