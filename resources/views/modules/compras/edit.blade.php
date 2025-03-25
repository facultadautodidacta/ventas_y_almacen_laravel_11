@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Editar una compra</h1>
    
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edicion de : {{ $item->nombre_producto }}</h5>
            
            <form action="{{ route('compras.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="producto_id" name="producto_id" value="{{ $item->producto_id }}" hidden>
                <label for="cantidad">Cantidad del producto</label>
                <input type="text" class="form-control" required 
                name="cantidad" id="cantidad" value="{{ $item->cantidad }}">
                <label for="precio_compra">Precio de compra</label>
                <input type="text" id="precio_compra" name="precio_compra" 
                class="form-control" required value="{{ $item->precio_compra }}">
                <button class="btn btn-warning mt-3">Actualizar</button>
                <a href="{{ route("compras") }}" class="btn btn-info mt-3">
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

