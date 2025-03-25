@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Compras de productos</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Administrar compras</h5>
            <p>
              Admnistrar la compra de productos.
            </p>
            
            <table class="table datatable">
              <thead>
                <tr>
                  <th class="text-center">Usuario</th>
                  <th class="text-center">Producto</th>
                  <th class="text-center">Cantidad</th>
                  <th class="text-center">Precio de compra</th>
                  <th class="text-center">Total compra</th>
                  <th class="text-center">Fecha</th>
                  <th class="text-center">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($items as $item)
                  <tr class="text-center">
                    <td>{{ $item->nombre_usuario }}</td>
                    <td>{{ $item->nombre_producto }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ $item->precio_compra }}</td>
                    <td>${{ $item->precio_compra * $item->cantidad }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                      <a href="{{ route('compras.edit', $item->id) }}" class="btn btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a href="{{ route('compras.show', $item->id) }}" class="btn btn-danger">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection



