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
            <a href="{{ route('productos.create') }}" class="btn btn-primary">
              <i class="fa-solid fa-circle-plus"></i> Crear producto
            </a>
            <hr>
            <table class="table datatable">
              <thead>
                <tr>
                  <th class="text-center">Categoria</th>
                  <th class="text-center">Proveedor</th>
                  <th class="text-center">Codigo</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Imagen</th>
                  <th class="text-center">Descripcion</th>
                  <th class="text-center">Cantidad</th>
                  <th class="text-center">Venta</th>
                  <th class="text-center">Compra</th>
                  <th class="text-center">Activo</th>
                  <th class="text-center">Comprar</th>
                  <th class="text-center">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($items as $item)
                  <tr class="text-start">
                    <td>{{ $item->nombre_categoria }} </td>
                    <td>{{ $item->nombre_proveedor }}</td>
                    <td class="text-center">{{ $item->codigo }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>
                      <img src="{{ asset('storage/' . $item->imagen_producto) }}" alt="" width="60px" height="60px">
                      <a href="{{ route('productos.show.image', $item->imagen_id) }}" 
                        class="badge rounded-pill bg-warning text-dark">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                    </td>
                    <td>{{ $item->descripcion }}</td>
                    <td class="text-center">{{ $item->cantidad }}</td>
                    <td class="text-center">${{ $item->precio_venta }}</td>
                    <td class="text-center">${{ $item->precio_compra }}</td>
                    <td>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="{{ $item->id }}" 
                        {{ $item->activo ? 'checked' : '' }}  >
                    </div>
                    </td>
                    <td>
                      <a href="{{ route('compras.create', $item->id) }}" class="btn btn-info">Comprar</a>
                    </td>
                    <td>
                      <a href="{{ route('productos.edit', $item->id) }}" class="btn btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a href="{{ route('productos.show', $item->id) }}" class="btn btn-danger">
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

@push('scripts')
  <script>

      function cambiar_estado(id, estado) { 
        $.ajax({
          type: "GET",
          url : "productos/cambiar-estado/" + id + "/" + estado,
          success: function(respuesta){
            if(respuesta == 1){
              Swal.fire({
                title: 'Exito!',
                text: 'Cambio de estado exitoso!',
                icon: 'success',
                confirmButtonText:'Aceptar'
              });
              
            } else {
              Swal.fire({
                title: 'Fallo!',
                text: 'No se llevo a cabo el cambio!',
                icon: 'error',
                confirmButtonText:'Aceptar'
              });
            }
          }
        });
      }

    $(document).ready(function(){
      $('.form-check-input').on("change", function(){
        let id = $(this).attr("id");
        let estado = $(this).is(":checked") ? 1 : 0;
        cambiar_estado(id, estado);
      });
    });
  </script>
@endpush

