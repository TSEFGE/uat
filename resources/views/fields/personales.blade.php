<div class="row">
	<div class="col-12" id="personaFisica">
		<div class="row">
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('nombres', 'Nombre', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('nombres', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese el nombre','data-validation'=>'custom, required' ,'data-validation-regexp'=>'^([A-ZÁÉÑÍÓÚ][\s]*){2,100}$', 'data-validation-error-msg'=>'Nombre debe contener al menos dos letras']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('primerAp', 'Primer apellido', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('primerAp', null, ['class' => 'persona form-control form-control-sm personales', 'placeholder' => 'Ingrese el primer apellido','data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('segundoAp', 'Segundo apellido', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('segundoAp', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese el segundo apellido','data-validation'=>'required']) !!}
				</div>
			</div>
		<div class="col-3">
			<div class="form-group">
				{!! Form::label('fechaNacimiento', 'Fecha de nacimiento', ['class' => 'col-form-label-sm']) !!}
				<input type="date" id="fechaNacimiento" name="fechaNacimiento" class="persona form-control form-control-sm", data-validation="birthdate, required">
					{{-- {!! Form::text('fechaNacimiento', null, ['class' => 'form-control form-control-sm datetimepicker-input', 'data-target' => '#fechanac', 'required', 'placeholder' => 'AAAA-MM-DD']) !!} --}}
					
			</div>
		</div>
		<div class="col-3">
				<div class="form-group">
					{!! Form::label('idEstadoOrigen', 'Estado de origen', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idEstadoOrigen', $estados, null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Seleccione una entidad federativa','data-validation'=>'required','required']) !!}
				</div>
			</div>
			
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('idMunicipioOrigen', 'Municipio de origen', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idMunicipioOrigen', [''=>'Seleccione un municipio'], null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Seleccione una entidad federativa','data-validation'=>'required','required']) !!}
				</div>
			</div>

				
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('sexo', 'Sexo', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('sexo', ['SIN INFORMACION' => 'SIN INFORMACION', 'HOMBRE' => 'HOMBRE', 'MUJER' => 'MUJER'], null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Seleccione el sexo','data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('curp', 'C.U.R.P.', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('curp', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese el C.U.R.P.','data-validation'=>'custom' ,'data-validation-regexp'=>'^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$','data-validation-error-msg'=>'CURP inválido','required']) !!}
				</div>
			</div>
			<div class="col-3">
					<div class="form-group">
							<div class="row">
						<div class="col">
					{!! Form::label('rfc', 'R.F.C.', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('rfc', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese el R.F.C.','data-validation'=>'required' ,'data-validation-length'=>'8','data-validation-error-msg'=>'RFC inválido' ,'required']) !!}
						</div>
					<div class="col">
							{!! Form::label('homo', 'Homo', ['class' => 'col-form-label-sm']) !!}
						{!! Form::text('homo', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese el R.F.C.','data-validation'=>'required' ,'data-validation-length'=>'8','data-validation-error-msg'=>'RFC inválido' ,'required']) !!}
					</div>
				</div>
			</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('idNacionalidad', 'Nacionalidad', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idNacionalidad', $nacionalidades, 1, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Seleccione la nacionalidad','data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('idEtnia', 'Etnia', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idEtnia', $etnias, 1, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Seleccione la etnia']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('idLengua', 'Lengua', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idLengua', $lenguas, 70, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Seleccione la lengua']) !!}
				</div>
			</div>
			
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('telefono', 'Teléfono', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('telefono', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese el teléfono', 'data-validation'=>'number' ]) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('motivoEstancia', 'Motivo de estancia', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('motivoEstancia', 'SIN INFORMACION', ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese el motivo de estancia', 'data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('idOcupacion', 'Ocupación', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idOcupacion', $ocupaciones, null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Seleccione la ocupación','data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('idEstadoCivil', 'Estado civil', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idEstadoCivil', $estadoscivil, null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Seleccione el estado civil','data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('idReligion', 'Religión', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idReligion', $religiones, 29, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Seleccione la religión','data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('idEscolaridad', 'Escolaridad', ['class' => 'col-form-label-sm']) !!}
					{!! Form::select('idEscolaridad', $escolaridades, null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Seleccione la escolaridad','data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('docIdentificacion', 'Documento de identificación', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('docIdentificacion', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese el docto. de identificación','data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					{!! Form::label('numDocIdentificacion', 'Núm. de documento de identificación', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('numDocIdentificacion', null, ['class' => 'persona form-control form-control-sm', 'placeholder' => 'Ingrese el núm. del docto. de identificación']) !!}
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-12" id="personaMoral">
		<div class="row">
			<div class="col-4">
				<div class="form-group">
					{!! Form::label('nombres2', 'Nombre', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('nombres2', null, ['class' => 'empresa form-control form-control-sm personales', 'placeholder' => 'Ingrese el nombre','data-validation'=>'required']) !!}
				</div>
			</div>
			<div class="col-4">
					<div class="form-group">
						{!! Form::label('fechaAltaEmpresa', 'Fecha de alta de la empresa', ['class' => 'col-form-label-sm']) !!}
						<input type="date" id="fechaAltaEmpresa" name="fechaAltaEmpresa" class="form-control form-control-sm">
							{{-- {!! Form::text('fechaNacimiento', null, ['class' => 'form-control form-control-sm datetimepicker-input', 'data-target' => '#fechanac','data-validation'=>'birthdate', 'data-validation-format'=>'dd/mm/yyyy', 'data-validation'=>'required', 'placeholder' => 'DD/MM/AAAA']) !!} --}}
						<div class="help-block with-errors"></div>	
					</div>
				</div>
		
			<div class="col-4">
					<div class="form-group">
							<div class="row">
						<div class="col">
					{!! Form::label('rfc2', 'R.F.C.', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('rfc2', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese el R.F.C.','data-validation'=>'required' ,'data-validation-length'=>'8','data-validation-error-msg'=>'RFC inválido' ,'required']) !!}
						</div>
					<div class="col">
							{!! Form::label('homo2', 'Homo', ['class' => 'col-form-label-sm']) !!}
						{!! Form::text('homo2', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese el R.F.C.','data-validation'=>'required' ,'data-validation-length'=>'8','data-validation-error-msg'=>'RFC inválido' ,'required']) !!}
					</div>
				</div>
			</div>
			</div>
			<div class="col-4">
				<div class="form-group">
					{!! Form::label('representanteLegal', 'Representante legal', ['class' => 'col-form-label-sm']) !!}
					{!! Form::text('representanteLegal', null, ['class' => 'empresa form-control form-control-sm', 'placeholder' => 'Ingrese el nombre del representante legal','data-validation'=>'required']) !!}
				</div>
			</div>
		</div>
	</div>
</div>

{{--<div id="accordion" role="tablist">
	<div class="card">
		<div class="card-header" role="tab" id="headingGenerales">
			<h5 class="mb-0">
				<a data-toggle="collapse" href="#collapseGen" aria-expanded="true" aria-controls="collapseGen">
					Datos personales
				</a>
			</h5>
		</div>
		<div id="collapseGen" class="collapse show boxcollapse" role="tabpanel" aria-labelledby="headingGenerales" data-parent="#accordion">
			<div class="boxtwo">
				@include('fields.personales')
			</div>
		</div>
	</div>
</div>--}}