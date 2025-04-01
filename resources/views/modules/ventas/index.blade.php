@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Venta de productos</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Crear una nueva venta</h5>
            <p>
              Crear ventas de los productos existentes.
            </p>
           <table class="table table-condensed" id="productos_carrito">
              <thead>
                <th class="text-center">Codigo</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Cantida</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Agregar</th>
              </thead>
              <tbody>
                @foreach ($items as $item)
                <tr>
                  <td class="text-center">{{ $item->codigo }}</td>
                  <td class="text-center">{{ $item->nombre }}</td>
                  <td class="text-center">{{ $item->cantidad }}</td>
                  <td class="text-center">${{ $item->precio_venta }}</td>
                  <td class="text-center">
                    <a href="{{ route('ventas.agregar.carrito', $item->id) }}" class="btn btn-success">Agregar</a>
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

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Carrito de compras</h5>
            
            @if (session('items_carrito'))
                <table class="table table-sm">
                  <thead>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Cantida</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Quitar</th>
                  </thead>
                  <tbody>
                    @php
                        $totalGeneral = 0;
                    @endphp

                    @foreach (session('items_carrito') as $item)
                    @php
                        $totalProducto = $item['cantidad'] * $item['precio'];
                        $totalGeneral += $totalProducto;
                    @endphp
                    <tr>
                      <td class="text-center">{{ $item['codigo'] }}</td>
                      <td class="text-center">{{ $item['nombre'] }}</td>
                      <td class="text-center">{{ $item['cantidad'] }}</td>
                      <td class="text-center">${{ $item['precio'] }}</td>
                      <td class="text-center">
                        <a href="{{ route('ventas.quitar.carrito', $item['id']) }}" class="btn btn-danger">Quitar</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td class="text-center">Total General</td>
                      <td class="text-center"><strong>${{ $totalGeneral }}</strong></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
                <hr>
                <div class="row">
                  <div class="col">
                    <form action="{{ route('ventas.vender') }}" method="post">
                      @csrf
                      <button class="btn btn-primary">Realizar Venta</button>
                    </form>
                  </div>
                  <div class="col">
                    <a href="{{ route('ventas.borrar.carrito') }}" class="btn btn-danger">Borrar carrito</a>
                  </div>
                </div>

            @else
                <p>No tengo contenido</p>
            @endif
                
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection

@push('scripts')
    <script>
      $(document).ready(function(){
        $('#productos_carrito').DataTable({
          "pageLength" : 2,
          language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
          }
        });
      })
    </script>
@endpush
