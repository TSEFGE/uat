@extends('template.form')
@section('content') 
@section('title','Medidas de Protección')
{!!Form::open([])!!}
<div class="card-body boxone">

        <DIV class="row">
            <div class="col-12">
                <div class="form-group">
                    {!! Form::label('tipoProvidencia', 'Tipo de providencia precautoria', ['class' => 'col-form-label-sm']) !!}
                    {!! Form::select('tipoProvidencia', ['' => ''],null,['class' => 'form-control form-control-sm', 'data-validation'=>'required']) !!}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('fechaInicio', 'Fecha Inicio', ['class' => 'col-form-label-sm']) !!}
                    <div class="input-group date" id="fechaInicio" data-target-input="nearest">
                        {!! Form::text('fechaInicio', null, ['class' => 'form-control form-control-sm datetimepicker-input', 'data-target' => '#fechaInicio','data-validation'=>'required', 'placeholder' => 'DD/MM/AAAA']) !!}
                        <div class="input-group-append" data-target="#fechaInicio" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('fechaFinal', 'Fecha Final', ['class' => 'col-form-label-sm']) !!}
                    <div class="input-group date" id="fechaFinal" data-target-input="nearest">
                        {!! Form::text('fechaFinal', null, ['class' => 'form-control form-control-sm datetimepicker-input', 'data-target' => '#fechaFinal','data-validation'=>'required', 'placeholder' => 'DD/MM/AAAA']) !!}
                        <div class="input-group-append" data-target="#fechaFinal" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('quienEjecuta', 'Quién ejecuta', ['class' => 'col-form-label-sm']) !!}
                        {!! Form::select('tipoProvidencia', ['' => 'Seleccione quién ejecuta'],null,['class' => 'form-control form-control-sm', 'data-validation'=>'required']) !!}
                    </div>
            </div>
            <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('victima', 'Victima', ['class' => 'col-form-label-sm']) !!}
                        {!! Form::select('victima', ['' => 'Seleccione una victima'],null,['class' => 'form-control form-control-sm', 'data-validation'=>'required']) !!}
                    </div>
            </div>
            <div class="col-12">
            <div class="form-group">
                    {!! Form::label('ObservacionesM', 'Observaciones', ['class' => 'col-form-label-sm']) !!}		
                    <textarea name="ObservacionesM" id="ObservacionesM" cols="15" rows="5" class="form-control form-control-sm"></textarea>
                </div>
                <div class="col text-right">
                        {!!Form::submit('Guardar',array('class' => 'btn button1','id'=>'guardarMedidas'))!!}
                </div>
            </div>
        </div>
    </div>
    
    <!--tabla providencias precautorias y/o protección-->
        @include('tables.medidasP')

@endsection

@section('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('scripts')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
	<script>
		$(function () {
			$('#fechaInicio').datetimepicker({
				format: 'YYYY-MM-DD',
            	minDate: moment().subtract(150, 'years').format('YYYY-MM-DD'),
            	maxDate: moment().subtract(18, 'years').format('YYYY-MM-DD')
			});
        });
        // $(function () {
		// 	$('#fechaFinal').datetimepicker({
		// 		format: 'YYYY-MM-DD',
        //     	minDate: moment().subtract(150, 'years').format('YYYY-MM-DD'),
        //     	maxDate: moment().subtract(18, 'years').format('YYYY-MM-DD')
		// 	});
        // });
    </script>
@endsection