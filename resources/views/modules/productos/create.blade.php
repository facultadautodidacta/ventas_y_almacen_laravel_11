@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Crear Producto</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Crear Nuevo Producto</h5>
            
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="categoria_id">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-select" required>
                    <option value="">Selecciona una categoria</option>
                    @foreach ($categorias as $item)
                        <option value="{{ $item->id }}"> {{ $item->nombre }} </option>
                    @endforeach
                </select>
                <label for="proveedor_id">Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-select" required>
                    <option value="">Selecciona un proveedor</option>
                    @foreach ($proveedores as $item)
                    <option value="{{ $item->id }}"> {{ $item->nombre }} </option>
                    @endforeach
                </select>
                <label for="codigo">Codigo</label>
                <input type="text" class="form-control" id="codigo" name="codigo">
                <label for="nombre">Nombre del producto</label>
                <input type="text" class="form-control" required name="nombre" id="nombre">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" cols="20" rows="5" class="form-control"></textarea>
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" class="form-control">
                <button class="btn btn-primary mt-3">Guardar</button>
                <a href="{{ route("productos") }}" class="btn btn-info mt-3">
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

