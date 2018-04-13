@php
	if (count($denunciantes)==0){
		$registroDenunciante='btn btn-secondary';
	}else{
		$registroDenunciante='btn btn-success';
	}
	if (count($denunciados)==0){
		$registroDenunciado='btn btn-secondary';
	}else{
		$registroDenunciado='btn btn-success';
	}
	if (!isset($registroAbogado)){
		$registroAbogado='btn btn-secondary';
	}
	if (!isset($registroAutoridad)){
		$registroAutoridad='btn btn-secondary';
	}
	if (!isset($registroAcusaciones)){
		$registroAcusaciones='btn btn-secondary';
	}
	if (!isset($registroDelitos)){
		$registroDelitos='btn btn-secondary';
	}
	if (!isset($registroDefenza)){
		$registroDefenza='btn btn-secondary';
	}
	if (!isset($registroDescripcion)){
		$registroDescripcion='btn btn-secondary';
    }
    if (!isset($medidasProteccion)){
		$medidasProteccion='btn btn-secondary';
	}
	
	@endphp
	<br><br>
<div class="btn-group col">
	<a href="{{route('new.denunciante')}}" class="{{$registroDenunciante}} form-control">Denunciante</a>
	<a href="{{route('new.denunciado')}}" class="{{$registroDenunciado}} form-control">Denunciado</a>
	<a  class="{{$registroAbogado}} form-control">Abogado</a>
	<a  class="{{$registroAutoridad}} form-control">Autoridad</a>
	<a  class="{{$registroDelitos}} form-control">Delitos</a>
	<a  class="{{$registroAcusaciones}} form-control">Acusaciones</a>
	<a  class="{{$registroDefenza}} form-control">Defensa</a>
    <a href="{{route('narracion')}}" class="{{$registroDescripcion}} form-control">Descripción de hechos</a>
    <a href="{{url('medidas')}}" class="{{$medidasProteccion}} form-control">Medidas de protección</a>
</div>
  
<input type="hidden" name="idCarpeta" value="{{$idCarpeta}}"> 
