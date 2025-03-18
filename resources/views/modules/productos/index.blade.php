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
            <p>
              <a href="" class="btn btn-primary">Productos con stock minimo</a>
            </p>
            <hr>
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
                 
                  <tr class="text-center">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <a href="#" class="btn btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a href="#" class="btn btn-danger">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                    </td>
                  </tr>
                  
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

