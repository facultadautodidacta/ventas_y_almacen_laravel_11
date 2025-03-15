@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Editar proveedor</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Editar Proveedor</h5>
            
            <form action="{{ route("proveedores.update", $item->id) }}" method="POST">
                @csrf
                @method("PUT")
                <label for="nombre">Nombre de proveedor</label>
                <input type="text" class="form-control" required name="nombre" id="nombre" value="{{ $item->nombre }}">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" required name="telefono" id="telefono" value="{{ $item->telefono }}">
                <label for="email">Email</label>
                <input type="email" class="form-control" required name="email" id="email" value="{{ $item->email }}">
                <label for="cp">CP</label>
                <input type="text" class="form-control" required name="cp" id="cp" value="{{ $item->cp }}">
                <label for="sitio_web">Sitio Web</label>
                <input type="text" class="form-control" required name="sitio_web" id="sitio_web" value="{{ $item->sitio_web }}">
                <label for="notas">Notas</label>
                <textarea name="notas" id="notas" cols="30" rows="10" class="form-control">{{ $item->notas }}</textarea>
                <button class="btn btn-warning mt-3">Actualizar</button>
                <a href="{{ route("proveedores") }}" class="btn btn-info mt-3">
                    Cancelar
                </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection

