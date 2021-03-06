<div class="row">
	<div class="col-12">
		<div class="row">
			<div class="col-4">
				<div class="form-group">
					{!! Form::label('nombres2', 'Nombre', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('nombres2', $preregistro->nombre, ['class' => 'turnoempresa form-control form-control-sm', 'placeholder' => 'Ingrese el nombre','data-validation'=>'required']) !!}
				</div>
			</div>

			<div class="col-4">
					<div class="form-group">
						{!! Form::label('fechaAltaEmpresa', 'Fecha de alta de la empresa', ['class' => 'col-form-label-sm']) !!}
						<input type="date" id="fechaAltaEmpresa" name="fechaAltaEmpresa" class="turnoempresa form-control form-control-sm">
							{{-- {!! Form::text('fechaNacimiento', null, ['class' => 'form-control form-control-sm datetimepicker-input', 'data-target' => '#fechanac','data-validation'=>'birthdate', 'data-validation-format'=>'dd/mm/yyyy', 'data-validation'=>'required', 'placeholder' => 'DD/MM/AAAA']) !!} --}}
						<div class="help-block with-errors"></div>	
					</div>
				</div>
		
			<div class="col-4">
					<div class="form-group">
							<div class="row">
						<div class="col">
					{!! Form::label('rfc2', 'R.F.C.', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('rfc2', null, ['class' => 'turnoempresa form-control form-control-sm', 'placeholder' => 'Ingrese el R.F.C.','data-validation'=>'required' ,'data-validation-length'=>'8','data-validation-error-msg'=>'RFC inválido' ,'required']) !!}
						</div>
					<div class="col">
							{!! Form::label('homo2', 'Homo', ['class' => 'col-form-label-sm']) !!}
						{!! Form::text('homo2', null, ['class' => 'turnoempresa form-control form-control-sm', 'placeholder' => 'Ingrese el R.F.C.','data-validation'=>'required' ,'data-validation-length'=>'8','data-validation-error-msg'=>'RFC inválido' ,'required']) !!}
					</div>
				</div>
			</div>
			</div>

			<div class="col-4">
				<div class="form-group">
					{!! Form::label('representanteLegal', 'Representante legal', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('representanteLegal',  $preregistro->representanteLegal, ['class' => 'turnoempresa form-control form-control-sm', 'placeholder' => 'Ingrese el nombre del representante legal','data-validation'=>'required']) !!}
				</div>
			</div>
		</div>
	</div>
</div>

