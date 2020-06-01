@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Editar Tráiler: {{ $trailer->id }}</span>
        </div>
        <div class="card-body">
          {{--Errores--}}
          @error('titulo') 
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            El título es obligatorio
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
          <form method="POST" action="{{ route('trailers.update', $trailer->id) }}" 
            enctype="multipart/form-data" >
            @method('PUT') {{--HTML no permite el PUT, lo paso por adentro--}}
            @csrf

            <input
              type="text"
              name="titulo"
              placeholder="Ingrese el título"
              class="form-control mb-2"
              value="{{$trailer->titulo }}" 
            /> 
           
            <!-- este es el input del pdf:-->
            
              <input 
              type="file" 
              name="pdf" 
              accept="application/pdf,application/vnd.ms-excel"
              class="form-group"
            >
            
            <div class="text-right"> 
              <a href="{{route('trailers.index')}}" class="btn btn-secondary btn-sm">
                Cancelar
              </a>
              <button class="btn btn-primary btn-sm" type="submit">
                Editar Tráiler
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection