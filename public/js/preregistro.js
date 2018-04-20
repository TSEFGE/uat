
$(document).ready(function(){
    mostrar();
    //Para el tipo de persona(Moral/Física)
    // $("#esEmpresa1").prop("checked", false);
    // $("#esEmpresa2").prop("checked", false);
    
   
    //Si es empresa
    $("#esEmpresa1").change(function(event){
        if ($('#esEmpresa1').is(':checked') ) {
            $('#collapsePersonales2').show();
            $('#collapsePersonales1').hide();
            $('#tipodeActa1').hide();
            mostrarmoral();
            paraActadeHechos1();
        }
    });


    //No es empresa
    $("#esEmpresa2").change(function(event){
        if ($('#esEmpresa2').is(':checked') ) {
            $('#collapsePersonales1').show();
            $('#collapsePersonales2').hide();
            $('#tipodeActa').hide();
            mostrarpersonal()
            paraActadeHechos2();
        }
    });



});
//empresa
function paraActadeHechos1(){
    //var select = document.getElementById('idRazon1');
    //var select = $("#idRazon1");
    $("#idRazon1").change(function(){
        valor = $(this).val();
        if(valor==4){
            console.log('es 4');
            $('#tipodeActa1').show();
            $('#tipoActa1').prop('disabled', false);
           
        }
        else{
            $('#tipodeActa1').hide();
            $('#tipoActa1').prop('disabled', true);
        }
    })
    // select.addEventListener('change',function(){
    //     //$("#idRazon1").change(function(event){ 
    //     var selectedOption1 = this.options[select.selectedIndex];
        
    // 	if(selectedOption1.value==4){
    // 		console.log('es 4');
    // 		$('#tipodeActa1').show();
    // 		$('#tipoActa1').prop('disabled', false);
    // 		$('#tipoActa1').prop('disabled', false);
    // 		$('#estadoCivilActa1').prop('disabled', false);
    // 		$('#escActa1').prop('disabled', false);
    // 		$('#ocupActa1').prop('disabled', false);
    // 	}
    // 	else{
    // 		$('#tipodeActa1').hide();
    // 		$('#tipoActa1').prop('disabled', true);
    // 		$('#estadoCivilActa1').prop('disabled', true);
    // 		$('#escActa1').prop('disabled', true);
    // 		$('#ocupActa1').prop('disabled', true);
    // 	}
      
    
    // }); 
}
//persona
function paraActadeHechos2(){

        $("#idRazon2").change(function(){
            valor = $(this).val();
        if(valor==4){
            console.log('es 4');
            $('#tipodeActa').show();
            $('#tipoActa').prop('disabled', false);
            $('#tipoActa').prop('disabled', false);
            $('#estadoCivilActa').prop('disabled', false);
            $('#escActa').prop('disabled', false);
            $('#ocupActa').prop('disabled', false);
        }
        else{
            $('#tipodeActa').hide();
            $('#tipoActa').prop('disabled', true);
            $('#estadoCivilActa').prop('disabled', true);
            $('#escActa').prop('disabled', true);
            $('#ocupActa').prop('disabled', true);
        }
      
    
    }); 
}

function mostrar(){
    if ($('#esEmpresa2').is(':checked') ) {
        $('#collapsePersonales1').show();
        $('#collapsePersonales2').hide();
        mostrarpersonal();
    }
    else if($('#esEmpresa1').is(':checked')){
        $('#collapsePersonales2').show();
        $('#collapsePersonales1').hide();
        mostrarmoral();
    }
    else{
        $('#collapsePersonales1').hide();
        $('#collapsePersonales2').hide();
    }
}

function mostrarpersonal(){
    //Datos personales no requeridos de Persona Moral o Empresa
    $('#nombre1').prop('disabled', true);
    $('#rfc1').prop('disabled', true);
    $('#repLegal').prop('disabled', true);
    $('#telefono1').prop('disabled', true);
    $("#idEstado1").prop('disabled', true);   
    $("#idMunicipio1").prop('disabled', true);   
    $("#idLocalidad1").prop('disabled', true);   
    $("#cp1").prop('disabled', true);   
    $("#idColonia1").prop('disabled', true);   
    $("#numInterno1").prop('disabled', true);   
    $("#calle1").prop('disabled', true);   
    $("#numExterno1").prop('disabled', true); 
    $("#idRazon1").prop('disabled',true);  
    
    //Datos personales requeridos de Persona Física
    $("#nombre2").prop('disabled', false);   
    $("#primerAp").prop('disabled', false);   
    $("#segundoAp").prop('disabled', false);   
    $("#rfc2").prop('disabled', false);   
    $("#fechaNacimiento").prop('disabled', false);   
    $("#edad").prop('disabled', false);   
    $("#idEstado2").prop('disabled', false);   
    $("#idMunicipio2").prop('disabled', false);   
    $("#idLocalidad2").prop('disabled', false);   
    $("#cp2").prop('disabled', false);   
    $("#idColonia2").prop('disabled', false);   
    $("#numInterno2").prop('disabled', false);   
    $("#calle2").prop('disabled', false);   
    $("#numExterno2").prop('disabled', false);   
    $("#sexo").prop('disabled', false);   
    $("#curp").prop('disabled', false);    
    $("#telefono2").prop('disabled', false);   
    $("#docIdentificacion").prop('disabled', false);   
    $("#numDocIdentificacion").prop('disabled', false);
    $("#idRazon2").prop('disabled',false); 
}
    
function mostrarmoral(){
    //Datos personales requeridos de Persona Moral o Empresa
    $('#nombre1').prop('disabled', false);
    $('#rfc1').prop('disabled', false);
    $('#repLegal').prop('disabled', false);
    $('#telefono1').prop('disabled', false);
    $("#idEstado1").prop('disabled', false);   
    $("#idMunicipio1").prop('disabled', false);   
    $("#idLocalidad1").prop('disabled', false);   
    $("#cp1").prop('disabled', false);   
    $("#idColonia1").prop('disabled', false);   
    $("#numInterno1").prop('disabled', false);   
    $("#calle1").prop('disabled', false);   
    $("#numExterno1").prop('disabled', false); 
     $("#idRazon1").prop('disabled', false); 

    
    //Datos personales no requeridos de Persona Física
    $("#nombre2").prop('disabled', true);   
    $("#primerAp").prop('disabled', true);   
    $("#segundoAp").prop('disabled', true);   
    $("#rfc2").prop('disabled', true);   
    $("#fechaNacimiento").prop('disabled', true);   
    $("#edad").prop('disabled', true);   
    $("#idEstado2").prop('disabled', true);   
    $("#idMunicipio2").prop('disabled', true);   
    $("#idLocalidad2").prop('disabled', true);   
    $("#cp2").prop('disabled', true);   
    $("#idColonia2").prop('disabled', true);   
    $("#numInterno2").prop('disabled', true);   
    $("#calle2").prop('disabled', true);   
    $("#numExterno2").prop('disabled', true);   
    $("#sexo").prop('disabled', true);   
    $("#curp").prop('disabled', true);    
    $("#telefono2").prop('disabled', true);   
    $("#docIdentificacion").prop('disabled', true);   
    $("#numDocIdentificacion").prop('disabled', true);
    $("#idRazon2").prop('disabled', true); 
}


