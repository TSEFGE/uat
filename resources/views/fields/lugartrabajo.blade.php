<div class="row">
	<div class="col-8">
		<div class="form-group">
			{!! Form::label('lugarTrabajo', 'Lugar de trabajo', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('lugarTrabajo', null, ['class' => 'trabajo form-control form-control-sm', 'placeholder' => 'Ingrese el lugar de trabajo','data-validation'=> 'required']) !!}
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			{!! Form::label('telefonoTrabajo', 'Teléfono del trabajo', ['class' => 'col-form-label-sm']) !!}
			{!! Form::text('telefonoTrabajo', null, ['class' => 'trabajo form-control form-control-sm', 'placeholder' => 'Ingrese el teléfono del trabajo','data-validation'=>'number']) !!}
		</div>
	</div>
</div>
@include('fields.direccionestrab')