@extends('template.form')
@section('title', 'Carpetas')

@section('content')
<div class="table">
        <table class="table table-hover table-striped" id="tablacarpetas">

                {{-- <form class="navbar-form navbar-left" role="search" action="{{url('carpetaNum')}}">
                    <div class="form-group">
                     <input type="text" class="form-control" name='search' placeholder="Buscar ..." />
                    </div>
                    <button type="submit" class="btn btn-default">Buscar</button>
                   </form> --}}
               
                   {{ Form::open(['url' => ['carpetaNum'], 'method' => 'POST']) }}
                    <p>{{ Form::text('search', old('search'), array('placeholder'=>'Search')) }}</p>
                    <p>{{ Form::submit('Search') }}</p>
                   
                <thead class="table-active">
                        {{-- <th >N.</th> --}}
                        <th >ID</th>
                        <th >Fecha</th>
                        <th >Hora de intervención</th>
                        {{-- <th >Victima/Querellante</th>
                        <th >Ofensor/Q.R.R</th> --}}
                        <th >Carpeta de investigación</th> 
                        {{-- <th >Delito</th>
                        <th>Forma de comisión</th>  --}}
                        {{-- <th>Fecha de turno</th>
                        <th>Facilitador</th> --}}
                        <th>Estatus de la carpeta</th>
                        {{-- <th>Resultado final</th>
                        <th>Oficio turno a fiscal de distrito</th>
                        <th >Nuevo numero de carpeta UIPJ</th> --}}
                        <th>Ver detalles</th>
                    </thead>
                    @if(count($carpetas)==0)
                    <tr><td colspan="6" class="text-center">Sin Registros</td></tr>
                @else
                    @foreach($carpetas as $carpeta)
                        <tr>
                            <td>{{ $carpeta->id}}</td> 
                            <td>{{ $carpeta->fechaInicio}}</td>
                            <td>{{ $carpeta->horaIntervencion}}</td>
                            {{-- <td>{{ $acusacion->denunciante }}</td>
                            <td>{{ $acusacion->nombres2." ".$acusacion->primerAp2." ".$acusacion->segundoAp2 }}</td>  --}}
                            <td>{{ $carpeta->numCarpeta }}</td>
                            {{-- <td>{{ $acusacion->delito }}</td> --}}
                            {{-- <td>{{ $acusacion->formaComision }}</td>  --}}
                            <td>{{ $carpeta->idEstadoCarpeta}}</td>
                            <td>
                                <a href="{{ url('buscarcarpeta/'.$carpeta->id)}}"   rel="tooltip" title="Editar Registro" class="btn btn-secondary btn-simple btn-xs">
                                <i class="fa fa-edit"></i></a>
                                <a href="{{ url('turnar/'.$carpeta->id)}}"   rel="tooltip" title="Turnar" class="btn btn-secondary btn-simple btn-xs">
                                <i class="fa fa-child"></i></a>
                              
                                   </td> 
                                
                                </tr>
                                @endforeach
                        @endif
                    </table>
                    <div class="mt-2 mx-auto">
                            {{ $carpetas->links() }}
                    </div>
                <br>
</div>
@endsection
{{ Form::close() }}
    
{{-- SECCION --}}


{{-- @section('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
@endsection

@push('scripts')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#tablacarpetas').DataTable({
                //"dom": 'rtip',
                "processing": true,
                "serverSide": true,
                "pageLength": 10,
                "language": {
                    "url": '{!! asset('/datatables/latino.json') !!}'
                } ,
                "ajax": "getCarpetas",
                "columns": [
                    { data: 'id' , name: 'id'},
                    { data: 'fechaInicio' , name: 'fechaInicio'},
                    { data: 'horaIntervencion' , name: 'horaIntervencion'},
                    { data: 'numCarpeta' , name: 'numCarpeta'},
                    { data: 'estadoCarpeta' , name: 'estadoCarpeta'},
                 
                    { data: null, "orderable": false,  render: function ( data, type, row ) {
                        return "<a href='{{ url('deleteMedida') }}/"+ data.id +"' class='btn btn-xs btn-primary' >Eliminar</button>"  }  
                    }
                ]
            });
        });
    </script>
  
@endpush --}}