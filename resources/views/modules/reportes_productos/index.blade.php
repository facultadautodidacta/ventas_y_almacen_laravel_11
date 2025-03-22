@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Productos</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Administrar Productos y stock</h5>
            <p>
              Admnistrar el stock del sistema.
            </p>
            
           
            <!-- Table with stripped rows -->
            
            <table class="table datatable">
              <thead>
                <tr>
                  <th class="text-center">Categoria</th>
                  <th class="text-center">Proveedor</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Imagen</th>
                  <th class="text-center">Descripcion</th>
                  <th class="text-center">Cantidad</th>
                  <th class="text-center">Venta</th>
                  <th class="text-center">Compra</th>
                 
                </tr>
              </thead>
              <tbody>
                 @foreach ($items as $item)
                  <tr class="text-center">
                    <td>{{ $item->nombre_categoria }} </td>
                    <td>{{ $item->nombre_proveedor }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td></td>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->precio_compra }}</td>
                    <td>{{ $item->precio_venta }}</td>
                    
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



