@extends('layouts.auth')

@isset($libro) {{$libro_id = $libro->id}} @else {{$libro_id = "no_book"}}{{ $libro = "no_book"}} @endisset

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Agregar Tráiler @if(!$libro_id=="no_book")para libro  {{$libro -> titulo}} @endif</span>
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
          <form method="POST" action="{{route('trailers.store')}}" enctype="multipart/form-data">
            @csrf

            <!-- Titulo -->
            <input
              type="text"
              name="titulo"
              placeholder="Ingrese el título"
              class="form-control mb-2"
              value="{{old('titulo')}}"
            />

            <!-- PDF -->
            <input 
              type="file" 
              name="pdf" 
              accept="application/pdf,application/vnd.ms-excel" 
              class="form-group"
            >

            <input id="searchBook" class="form-control mb-2">
            <script>
            $(document).ready(function() {
                $('#searchBook').typeahead({
                    minLength: 1,
                    delay: 400,
                    autoSelect: false,
                    source(query, process) {
                        $.ajax({
                            url: '{{ url("libros/user/search") }}',
                            data: {q: query, limit: 8},
                            dataType: 'json'
                        })
                        .done(function(response) {
                            return process(response);
                        });
                    },
                    displayText: (item) => item.titulo,
                    matcher() { return true },
                    afterSelect(item) {
                        $libro_id = `{{url('libros/user')}}/${item.id}`
                    }
                });
            });
            </script>
            <!-- Titulo -->
            Libro:
            <input
              type="text"
              name="libro"
              placeholder="Ingrese el libro"
              class="form-control mb-2"
              value="{{old('libro')}}"
            />

            <div class="text-right"> 
              <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                Cancelar
              </a>
              <button class="btn btn-primary btn-sm" type="submit">
                Agregar Trailer
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection