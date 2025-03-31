@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Editar Producto</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Editar Producto</h5>
            
            <form action="{{ route('productos.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="categoria_id">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-select" required>
                    <option value="">Selecciona una categoria</option>
                    @foreach ($categorias as $categoria)
                        @if ($item->categoria_id == $categoria->id)
                            <option selected value="{{ $categoria->id }}"> {{ $categoria->nombre }} </option>
                        @else
                            <option value="{{ $categoria->id }}"> {{ $categoria->nombre }} </option>
                        @endif
                    @endforeach
                </select>

                <label for="proveedor_id">Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-select" required>
                    <option value="">Selecciona un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        @if ($item->proveedor_id == $proveedor->id)
                            <option selected value="{{ $proveedor->id }}"> {{ $proveedor->nombre }} </option>
                        @else
                            <option value="{{ $proveedor->id }}"> {{ $proveedor->nombre }} </option>
                        @endif
                    @endforeach
                </select>
                <label for="codigo">Codigo</label>
                <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $item->codigo }}">

                <label for="nombre">Nombre del producto</label>
                <input type="text" class="form-control" required name="nombre" id="nombre" value="{{ $item->nombre }}">
                
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" 
                cols="20" rows="5" class="form-control">{{ $item->descripcion }}</textarea>

                <label for="precio_venta">Precio de venta</label>
                <input type="text" id="precio_venta" name="precio_venta" 
                class="form-control" value="{{ $item->precio_venta }}" required>

                <button class="btn btn-warning mt-3">Actualizar</button>
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

