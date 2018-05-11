{!! Form::open(['route' => 'store.agregar', 'method' => 'POST'])  !!} 
<div class="row">
	
		<div class="col-4">
				<div class="form-group">
					{!! Form::label('marcat', 'Marca', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('marcat', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese marca del vehículo',  'data-validation'=>'custom' ,'data-validation-regexp'=>'^([A-ZÁÉÑÍÓÚ][\s]*){2,100}$', 'data-validation-error-msg'=>'Nombre debe contener al menos dos letras']) !!}
				</div>
			</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('lineat', 'Línea', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('lineat', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese línea del vehículo',  'data-validation'=>'custom' ,'data-validation-regexp'=>'^([A-ZÁÉÑÍÓÚ][\s]*){2,100}$', 'data-validation-error-msg'=>'La marca del teléfono debe contener al menos dos letras']) !!}
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('modelot', 'Modelo', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('modelot', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese modelo del vehículo', 'data-validation'=>'required']) !!}
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('colort', 'Color', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('colort', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese color del vehículo', 'data-validation'=>'required']) !!}
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('numeroseriet', 'Número de serie ', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('numeroseriet', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese el número de serie', 'data-validation'=>'required']) !!}
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('lugarFabt', 'Lugar de fabricacion del motor', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('lugarFabt', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese lugar de fabricación', 'data-validation'=>'required']) !!}
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('placat', 'Placas de circulación', ['class' => 'col-form-label-sm']) !!}		
			{!! Form::text('placat', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese número de placas', 'data-validation'=>'required']) !!}   
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('propietariot', 'Nombre completo del propietario', ['class' => 'col-form-label-sm']) !!}		
			{!! Form::text('propietariot', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese nombre del propietario', 'data-validation'=>'required']) !!}   
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('celulart', 'Número de celular', ['class' => 'col-form-label-sm']) !!}		
			{!! Form::text('celulart', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese su número de celular ', 'data-validation'=>'required']) !!}   
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('calle2', 'Calle', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('calle2', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese la calle', 'data-validation'=>'required']) !!}
		</div>
	</div>
	
	<div class="col-2">
		<div class="form-group">
			{!! Form::label('numExterno2', 'Número exterior', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('numExterno2', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese el n. Exterior', 'data-validation'=>'required']) !!}
		</div>
	</div>
	
	<div class="col-2">
		<div class="form-group">
			{!! Form::label('numInterno2', 'Número interior', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('numInterno2', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese el n. Interior', 'data-validation'=>'required']) !!}
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('idEstado2', 'Entidad federativa', ['class' => 'col-form-label-sm']) !!}
			{!! Form::select('idEstado2', $estados, null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Seleccione una entidad federativa','data-validation'=>'required']) !!}
		</div>
	</div>
	
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('idMunicipio2', 'Municipio', ['class' => 'col-form-label-sm']) !!}
			@if(isset($form['catMunicipios'], $form['idMunicipio2']))
			{!! Form::select('idMunicipio2',  $form['catMunicipios'], $form['idMunicipio2'], ['class' => 'form-control form-control-sm','data-validation'=>'required']) !!}
			@else
			{!! Form::select('idMunicipio2', [''=>'Seleccione un municipio'], null, ['class' => 'form-control form-control-sm','data-validation'=>'required']) !!}
			@endif
		</div>
	</div>
	
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('idLocalidad2', 'Localidad', ['class' => 'col-form-label-sm']) !!}
			@if(isset($form['catLocalidades'],$form['idLocalidad2']))
			{!! Form::select('idLocalidad2',  $form['catLocalidades'], $form['idLocalidad2'], ['class' => 'form-control form-control-sm', 'data-validation'=>'required']) !!}
			@else
			{!! Form::select('idLocalidad2', [ '' => 'Seleccione una localidad'], null, ['class' => 'form-control form-control-sm', 'data-validation'=>'required']) !!}
			@endif
		</div>
	</div>
	
	<div class="col-2">
		<div class="form-group">
			{!! Form::label('idColonia2', 'Colonia', ['class' => 'col-form-label-sm']) !!}
			@if(isset($form['catColonias'],$form['idColonia2']))
			{!! Form::select('idColonia2', $form['catColonias'], $form['idColonia2'], ['class' => 'form-control form-control-sm', 'data-validation'=>'required']) !!}
			@else
			{!! Form::select('idColonia2', ['' => 'colonia'], null, ['class' => 'form-control form-control-sm', 'data-validation'=>'required']) !!}
			@endif
		</div>
	</div>
	
	<div class="col-2">
		<div class="form-group">
			{!! Form::label('cp2', 'Código postal', ['class' => 'col-form-label-sm']) !!}
			@if(isset($form['catCodigoPostal'],$form['cp2']))
			{!! Form::select('cp2', $form['catCodigoPostal'], $form['cp2'], ['class' => 'form-control form-control-sm', 'data-validation'=>'required']) !!}
			@else
			{!! Form::select('cp2', ['' => 'Seleccione CP'], null, ['class' => 'form-control form-control-sm', 'data-validation'=>'required']) !!}
			@endif
		</div>
	</div>
	<div class="col text-right">
		{!!Form::submit('Guardar',array('class' => 'btn btn-primary','id'=>'guardarPericiales'))!!}
		
</div>
</div>
{!! Form::close() !!}