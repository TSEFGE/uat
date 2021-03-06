@extends('template.form')
@section('title','Actas de hechos')

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'filtroactapendiente', 'method' => 'POST'])  !!}
        <div class="row">
            <div class="col text-left">
                <a href="{{route('new.actahechos')}}" class="btn btn-primary"> Crear nueva acta</a>
            </div>
	
            <div class="col-4 text-right">
                <div class="input-group">
                    <input type="text" id="folio" name="folio" class="form-control" placeholder="buscar">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>
            </div>
        </div>
        {!!Form::close()!!}
        <hr>
        <table class="table table-striped">
            <thead>
                <th>Folio</th>
                <th>Nombre</th>
                <th>Tipo de acta</th>
                <th>Opciones</th>                               
            </thead>
            <tbody>
                @if(count($actas)==0)
                <tr><td colspan="5" class="text-center">Sin registros</td></tr>
                @else
                @foreach($actas as $acta)
                <tr>
                    <td>{{ $acta->folio }}</td>
                    <td>{{ $acta->nombre." ".$acta->primerAp." ".$acta->segundoAp }}</td>
                    <td>{{ $acta->tipoActa }}</td>
                    <td>
                        <a href="{{ url('atender-acta/'.$acta->id.'')}}" title="Atender" class="btn btn-primary">
                            <i class="fa fa-file-text-o"></i> Atender
                        </a>
                    </td>                                  
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{$actas->links()}}
    </div>    
</div>    


@endsection
@push('scripts')
<script>
    var urloficio = "{{session('redirectoficio')}}";
	window.onload=function(){
        if(urloficio!=""){
            window.open(urloficio,'_blank');
        }
	}
	</script>
@endpush