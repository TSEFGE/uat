<div class="row">	
	<div id="extra-fis">
		<div class="col-12">
			<div class="row">
				@if(!empty($idCarpeta))
				{!! Form::hidden('idCarpeta', $idCarpeta) !!}
				@endif
			{{-- <div class="col-3">
				<div class="form-group">
					{!! Form::label('idPuesto', 'Puesto', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idPuesto', $puestos, null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Seleccione un puesto', 'required']) !!}
				</div>
			</div> --}}
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('alias', 'Alias', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('alias', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese el alias', 'data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('personasBajoSuGuarda', 'Personas bajo su guardia', ['class' => 'col-form-label-sm']) !!}
					{!! Form::number('personasBajoSuGuarda', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese el número de personas bajo su guardia', 'min' => 0,'data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('ingreso', 'Ingreso', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('ingreso', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese el ingreso',  'data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('periodoIngreso', 'Periodo de ingreso', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('periodoIngreso', ['DIARIO' => 'DIARIO', 'SEMANAL' => 'SEMANAL', 'QUINCENAL' => 'QUINCENAL', 'MENSUAL' => 'MENSUAL', 'SIN INFORMACION' => 'SIN INFORMACION'], null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Seleccione un periodo',  'data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('residenciaAnterior', 'Residencia anterior', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('residenciaAnterior', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese la  residencia anterior',  'data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					<label class="col-form-label col-form-label-sm" for="perseguidoPenalment">¿Perseguido penalmente?</label>
					<div class="clearfix"></div>
					<div class="form-check form-check-inline">
						<label class="form-check-label col-form-label col-form-label-sm">
							<input class="form-check-input" type="radio" id="perseguidoPenalmente1" name="perseguidoPenalmente" value="1" required> Sí
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label col-form-label col-form-label-sm">
							<input class="form-check-input" type="radio" id="perseguidoPenalmente2" name="perseguidoPenalmente" value="0"> No
						</label>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('vestimenta', 'Vestimenta', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('vestimenta', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese la vestimenta','data-validation'=>'length', 'data-validation-length'=>'min5']) !!}
				</div>
			</div>
		</div>
		</div>
	</div>	
	<div class="col-12">
		<div class="form-group">
			{!! Form::label('senasPartic', 'Señas particulares', ['class' => 'col-form-label-sm']) !!}
			{!! Form::textarea('senasPartic', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese las señas particulares','rows' => '3', 'data-validation'=>'length', 'data-validation-length'=>'min10']) !!}
		</div>
	</div>
	<div class="col-12">
		<div class="form-group">
			{!! Form::label('narracion', 'Narración', ['class' => 'col-form-label-sm']) !!}
			{!! Form::textarea('narracion', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese la narración de los hechos', 'rows' => '5','data-validation'=>'length', 'data-validation-length'=>'min10']) !!}
		</div>
	</div>	
</div>