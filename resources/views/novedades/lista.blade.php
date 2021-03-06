@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Novedades: </span>
          {{-- Agregar --}}
          <a href="{{route('novedades.create')}}" class="btn btn-primary btn-sm btn-icon">
            Agregar Novedad
          </a>
        </div>
        <div class="card-body"> 
          
          {{--Exito--}}
          @if ( session('mensaje') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
          @endif
          @if(count($novedades) == 0)
            No existen novedades cargadas en el sistema.
          @else
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Descripción</th>
                <th scope="col">Archivo</th>
                <th scope="col">Publicación</th>
                <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($novedades as $item)
                <tr>
                  {{-- ID --}}
                  <th scope="row">{{ $item->id }}</th>
                  {{-- Titulo y link --}}
                  <td>
                    <a href="{{route('novedades.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                        {{ $item->titulo }}
                    </a>
                  </td>
                  {{-- Cuerpo --}}
                  <td>{{ $item->descripcion }}</td>
                  {{-- imagen/video --}}
                  <td>
                  @if ($item -> es_video)
                    <video style="height: 70px; border-radius: 10%;" src="{{url($item -> archivo)}}"></video>
                  @else
                    @if ($item -> archivo != 'noFile')
                      <img style="height: 70px; border-radius: 10%;" src="{{url($item -> archivo)}}"> <!--aca deberia mostrar archivo-->
                    @else
                      {{$item->archivo}}
                    @endif
                  @endif
                  </td>
                  {{-- Publicación --}}
                  <td>{{$item->fecha_de_publicacion}}</td>
                  {{-- Acciones --}}
                  <td>
                    {{-- Edit --}}
                    <a href="{{route('novedades.edit', $item)}}" class="btn btn-primary btn-sm">
                      editar
                    </a>
                    {{-- Delete --}}
                    <form action="{{route('novedades.destroy', $item)}}" class="d-inline" method="POST"
                    onclick="return confirm('Estas seguro que queres eliminar la novedad?')">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                          eliminar
                        </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row d-flex justify-content-center">
              {{$novedades->links()}}
            </div>
          @endif
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
<a href="{{route('editar333')}}">
  editar333
</a>
@endsection