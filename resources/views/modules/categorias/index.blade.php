@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Categorias</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Administrar Categorias</h5>
            <p>
              Admnistrar las categorias de nuestros productos.
            </p>
            <!-- Table with stripped rows -->
            <a href="{{ route("categorias.create") }}" class="btn btn-primary">
              <i class="fa-solid fa-circle-plus"></i> Agregar nueva categoria
            </a>
            <hr>
            <table class="table datatable">
              <thead>
                <tr>
                  <th class="text-center">Nombre Categoria</th>
                  <th class="text-center">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($items as $item)
                  <tr class="text-center">
                    <td>{{ $item->nombre }}</td>
                    <td>
                      <a href="{{ route("categorias.edit", $item->id) }}" class="btn btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a href="{{ route("categorias.show", $item->id) }}" class="btn btn-danger">
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

