@extends('template.form')
@section('title', 'Libro de gobierno')
@section('content')
@include('fields.errores')

<div id="page-content-wrapper">
    <div class="col-md-12">
        <h6 style="text-align:center">UNIDAD DE ATENCIÓN TEMPRANA DEL DISTRITO JUDICIAL</h6>
            <div class="table  table-hover table-responsive">
                <div class="">
                        {{ Form::open(['route' => ['libro.filtro'], 'method' => 'POST']) }}
                        <div class="input-group mb-3 col-2">
                            {{ Form::text('search', old('search'), array('class'=>'form-control', 'placeholder'=>'Buscar..')) }}
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    <br>
                    <table id="tablaprovidencias" class="table-sm">
                        <thead class="table-active">
                            <th >N.</th>
                            <th >Fecha</th>
                            <th >Victima/Querellante</th>
                            <th >Ofensor/Q.R.R</th>
                            <th >Carpeta de investigación</th>
                            <th >Delito</th>
                            <th>Forma de comisión</th>
                            <th>Fecha de turno</th>
                            <th>Facilitador</th>
                            <th>Estatus</th>
                            <th>Resultado final</th>
                            <th>Oficio turno a fiscal de distrito</th>
                            <th >Nuevo número de carpeta UIPJ</th>
                        </thead>
                        <tbody>
                                @if(count($carpterminadas)==0)
                                <tr><td colspan="13" class="text-center">Sin Registros</td></tr>
                            @else
                                @foreach($carpterminadas as $carpterminada)
                                <tr>
                                  <td>{{ $carpterminada->id}}</td> 
                                  <td>{{ $carpterminada->fechaInicio}}</td>
                                  <td>{{ $carpterminada->nombres." ".$carpterminada->primerAp." ".$carpterminada->segundoAp}}</td>
                                  <td>{{ $carpterminada->nombres2." ".$carpterminada->primerAp2." ".$carpterminada->segundoAp2 }}</td> 
                                  <td>{{ $carpterminada->numCarpeta}}</td>
                                  <td>{{ $carpterminada->delito}}</td>
                                  <td>{{ $carpterminada->formaComision}}</td> 
                                  <td>sin datos</td>
                                  <td>sin datos</td>
                                  <td>{{ $carpterminada->idEstadoCarpeta}}</td>
                                  <td>sin datos</td>
                                  <td>sin datos</td>
                                  <td>sin datos</td>
                                  
                                </tr>
                                @endforeach
                                @endif
                    </table>
                    <div class="mt-2 mx-auto">
                            {{ $carpterminadas->links() }}
                    </div>
               
                    <br>
                </div>
             </div>
        </div>
</div>

    </div>
</div>

@endsection
        
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection
@push('scripts')
<script>
</script>
@endpush