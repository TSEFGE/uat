//var URLactual = window.location;
//var municipios = URLactual.split('/');
url = window.location;

function redireccionarPagina() {
	window.location = "/urgentes";
  }
function miajax(id,inputValue){
	var parametros = {
		"preregistro" : id,
		"tipo" : 1,
		"justificacion": inputValue
	};
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: "POST",
		url: "../../estado",
		data:  parametros,
		success: function(data) {
			if(data){
				swal("Hecho", "Registro puesto en cola con éxito", "success");
				setTimeout("redireccionarPagina()", 3000);
			}			
		}
	});
}
$(".btnEnUrgente").click(function(){
	id = $(this).attr("id");
	swal({
		title: "Puesto en urgente",
		text: "¿Por qué razón se pondra en urgente?",
		type: "input",
		showCancelButton: true,
		closeOnConfirm: false,
		inputPlaceholder: "Justificación"
	  }, function (inputValue) {
		if (inputValue === false) return false;
		if (inputValue === "") {
		  swal.showInputError("Introduzca una justificación");
		
		  return false
		}
		miajax(id,inputValue);
	  });
});
$( "#filmunicipio" ).change(function() {
  	id = this.value;
  	window.location.replace('/showbymunicipio/'+id);
});

$( "#filfiscal" ).change(function() {
	id = this.value;
	window.location.replace('/buscarmunicipio/'+id);
});
$( ".rownarraciones" ).click(function() {
	area = $('#areaNarracion');
	div = $('#divText');
	id = $(this).attr("id");
	c = $(this).attr("class");
	$.ajax({
		type: "GET",
		url: "../getnarracion/"+id,
		dataType: "json",
		success: function(data) {
			if(c=='rownarraciones ultimo'){
				div.hide();
				area.text(data['narracion']['narracion']);
				area.show();
			}
			else{
				area.hide();
				div.text(data['narracion']['narracion']);
				div.show();
			}
		}
	});
});
if(url!="http://uat.oo/"){
	// $( document ).idleTimer( 5000 );
	// $( document ).on( "idle.idleTimer", function(event, elem, obj){
	// 	swal({
	// 		title:'Sesión inactiva',
	// 		text:"¿Desea continuar con su sesión?",
	// 		timer: 3000,
	// 	}, function(isConfirm){
	// 		if(!isConfirm){
	// 			window.location.href='http://uat.oo/cerrar';
	// 		}
	// 	});
	// });
}
else{
	$("#cerrarsesion").hide();
}

function getRandValue(){
	value = $('.notespera');

	$.ajax({
		type: "GET",
		url: "../notificaciones",
		dataType: "json",
		success: function(data) {
			value.text(data['espera']);
			//console.log(data['espera']);
		}
	});
}



$('.btn-modal').bind('click', function(){
	$ ('#myModal1').modal('show');
	var idr = $(this).val();
	$.ajax({
		url : "getMedidasAjax/"+idr,
		type : 'GET',
		success : function(json) {
			$("#observaciones1").val(json.observacion);
			$("#fechaInicio1").val(json.fechaInicio);
			$("#fechaFinal1").val(json.fechaFin);
			$("#tipo_medida2").val(json.nombre);
			$('#quienEjecuta1').val(json.idEjecutor).trigger('change.select2');
			$('#victima1').val(json.idPersona).trigger('change.select2');
			$('#idr').val(json.id);           
		},
		error : function(xhr, status) {
		}
	});
	});
	
//para mandar los datos ala base de datos 

	$('#guardar').bind('click', function(){
		var datos = {
			'idr' : $('#idr').val(),
			// 'tipo_medida2'  : $('#tipoProvidencia1').select2('val'),
			'fechaInicio1' : $('#fechaInicio1').val(),
			'fechaFinal1' : $('#fechaFinal1').val(),
			'quienEjecuta1'  : $('#quienEjecuta1').select2('val'),
			'victima1'  : $('#victima1').select2('val'),
			'observaciones1' : $('#observaciones1').val(),
		}
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url : "agregar-medidas/editar",
			data : datos,
			type : 'POST',
			success : function(json) {
				if(json){	
				swal("Hecho", "Registro guardado con exito", "success");
					location.reload();
				}else{
					swal("Hecho", "Error", "success");
				}            
			},
			error : function(xhr, status) {
				swal({
					title: "Error al guardar cambios",
					icon: "error",
				});
			},
			complete : function(xhr, status) {
			}
		});
});
	
	
$('.btn-modal-delito').bind('click', function(){
	$ ('#myModal-delito').modal('show');
	var IdFilaTabla = $(this).val();
	$.ajax({
		url : "editar/"+IdFilaTabla,
		type : 'GET',
		success : function(json) {
			$('#idr').val(json.id); 
            $('#idDelito2').val(json.idDelito).trigger('change.select2');
			$('#formaComision2').val(json.formaComision).trigger('change.select2');
			$("#fecha2").val(json.fecha);
			$("#hora2").val(json.hora);
			$()
			console.log(json);
			// $("#observaciones1").val(json.observacion);
			// $("#fechaInicio1").val(json.fechaInicio);
			// $("#fechaFinal1").val(json.fechaFin);
			// $("#tipo_medida2").val(json.nombre);
			// $('#quienEjecuta1').val(json.idEjecutor).trigger('change.select2');
			// $('#victima1').val(json.idPersona).trigger('change.select2');
		

		},
		error : function(xhr, status) {
		}
	});
	});
	

		
