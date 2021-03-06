@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Editar Tarjeta: {{ $tarjeta->id }}</span>
        </div>
        <div class="card-body">
          {{--Errores--}}
          @error('name_on_card') 
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            El nombre es obligatorio
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @enderror

          @error('card_number')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              El numero es obligatorio
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @enderror

          {{--Exito--}}
          @if ( session('mensaje') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('mensaje')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          {{-- Formulario --}}
          <form method="POST" action="{{ route('tarjetas.update', $tarjeta->id) }}">{{--mando el id de la tarjeta para editarla--}}
            @method('PUT') {{--HTML no permite el PUT, lo paso por adentro--}}
            @csrf

            <input
              type="text"
              name="name_on_card"
              placeholder="Nombre Titular"
              class="form-control mb-2"
              value="{{$tarjeta->name_on_card }}" 
            /> 
            <input
              type="text"
              name="card_number"
              placeholder="Número"
              class="form-control mb-2"
              value="{{ $tarjeta->card_number }}"
            />

            <div class="text-right"> 
              <a href="{{route('tarjetas.index')}}" class="btn btn-secondary btn-sm">
                Cancelar
              </a>
              <button class="btn btn-primary btn-sm" type="submit">
                Guardar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection