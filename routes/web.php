<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*******************Rutas para probar vistas*************************** */
Route::get('/', function () {
    return redirect('home');
});
Route::get('/prueba', function () {
    return view('welcome');
});
/**********************Rutas de prueba***********************/
Route::get('/pruebas/caso','PruebasController@create');
Route::get('/pruebas/hechos','PruebasController@hechos');
Route::get('/pruebas/delitos','PruebasController@delitos');
Route::get('/pruebas/impresion','PruebasController@impresion');

Route::get('/pruebasIndex', function(){
return view('prueba-index');

});

Route::get('/pruebaMedidas', function () {
    return view('forms.medidasProteccion');
});
Route::get('/pruebasconsulta', function(){
    return view('tables.consulta-actas');
    
    });
    Route::get('/formatos-pruebas', function(){
        return view('tables.formatos');
        });
        Route::get('/turnos-pruebas', function(){
            return view('tables.consulta-turnos');
            });

        Route::get('/pruebasformatos', function(){
            return view('tables.formatos');
            });
            
        Route::get('/pruebasactas','PruebasController@actas');
        
    
/**************************************************************/
// -------------------------------------------------------------------


/**NO TOCAR***/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// ------------------------------------------------------------------


Route::middleware(['auth'])->group(function () {


    
    /************Rutas para formulario de solicitante/victima/denunciante*************/
    Route::get('/crear-caso', 'CarpetaController@crearCaso')->name('inicio');
    Route::get('cancelar-caso', 'CarpetaController@cancelarCaso')->name('cancelar.caso');
    Route::get('terminar', 'CarpetaController@terminar')->name('terminar');
    //Route::post('storecarpeta', 'CarpetaController@storeCarpeta')->name('store.carpeta');
    //Route::get('/carpeta-inicial/{id}', 'CarpetaController@index')->name('carpeta');
    
    Route::get('agregar-denunciante', 'DenuncianteController@showForm')->name('new.denunciante');
    Route::post('storedenunciante', 'DenuncianteController@storeDenunciante')->name('store.denunciante');
    Route::get('agregar-denunciante/{id}/eliminar', 'DenuncianteController@delete')->name('delete.denunciante');
    Route::get('/atender/{id}', 'PreregistroAuxController@atender');
    Route::get('/turno/{id}', 'PreregistroAuxController@turno');
    Route::get('/Traerturno', 'PreregistroAuxController@Traerturno')->name('turno.denunciante');
    Route::get('/devolver/{id}', 'PreregistroAuxController@devolverturno')->name('devolver');
    /*****************************Rutas para modulo recepción****************************************/
    
    
    //Route::resource('/preregistro','PreregistroController');
    
    
    
    Route::post('/showbyfolio', 'PreregistroAuxController@showbyfolio');
    Route::get('/showbyfolio', 'PreregistroAuxController@showbyfolio');
    Route::get('/showbymunicipio/{id}', 'PreregistroAuxController@showbymunicipio');
    Route::get('/encola', 'PreregistroAuxController@encola');
    Route::get('/urgentes', 'PreregistroAuxController@urgentes');
    Route::get('/estado/{id}/{tipo}', 'PreregistroController@estado');
    Route::post('/estado', 'PreregistroController@estadourgente');
    
    //Route::resource('/predenuncias','PreregistroAuxController');
    Route::get('/predenuncias', 'PreregistroAuxController@index')->name('predenuncias.index'); //ver formulario
    Route::get('/predenuncias/{id}/edit', 'PreregistroAuxController@edit')->name('predenuncias.edit'); //ver formulario
    Route::post('/predenuncias/{id}/update', 'PreregistroAuxController@update')->name('predenuncias.update'); //registar
    
    
    Route::get('/preregistroWeb/pre-auxiliar', 'PreregistroAuxController@create'); //ver formulario
    Route::post('/preregistroWeb', 'PreregistroAuxController@store'); //registar
    
    /*-----------------descripcion de Hechos------------------------------*/
    Route::get('descripcionHechos', 'NarracionController@descripcionHechos')->name('descripcionHechos');
    Route::post('storeDescripcionHechos', 'NarracionController@storeDescripcionHechos')->name('store.descripcionHechos');
    /*---------Rutas narración-------------*/
    Route::get('narracion', 'NarracionController@index')->name('narracion');
    Route::post('addnarracion', 'NarracionController@addNarracion');
    Route::get('getnarracion/{id}', 'NarracionController@getNarracion');
    Route::get('mostrardoc/{id}', 'NarracionController@mostrarDoc');
    /*---------Rutas denunciado-------------*/
    Route::get('agregar-denunciado', 'DenunciadoController@showForm')->name('new.denunciado');
    Route::post('storedenunciado', 'DenunciadoController@storeDenunciado')->name('store.denunciado');
    Route::get('agregar-denunciado/{id}/eliminar', 'DenunciadoController@delete')->name('delete.denunciado');
    
    /*---------Rutas de preregistro orientador-------------*/
    Route::get('preregistros', 'PreregistroAuxController@orientador');
    
	
    /*---------Rutas para las notificaciones-------------*/
    Route::get('notificaciones', 'NotificacionesController@getNotificacionesCola');
    
    /*---------Rutas Registros Orientador-------------*/
    Route::get('registros', 'RegistrosCasoController@lista');
    Route::get('registros/{id}/edit', 'RegistrosCasoController@editRegistros');
    Route::post('/buscarfolio', 'RegistrosCasoController@buscarfolio');
    Route::get('/buscarfolio', 'RegistrosCasoController@buscarfolio');
    Route::get('/buscarmunicipio/{id}', 'RegistrosCasoController@buscarmunicipio');
    Route::put('storeregistro/{id}', 'RegistrosCasoController@updateregistros')->name('put.registro');
    
    /*---------Rutas Agregar Preregistro Controller------------*/
    
    Route::get('recepcionista','PreregistroController@fiscal');
    Route::post('/recepcionista/create','PreregistroController@fiscalcreate')->name('fiscal');
    
    
    
    /*---------Atención rápida------------*/
    Route::get('atencion', 'AtencionController@index');
    Route::post('addatencion', 'AtencionController@addAtencion')->name('addatencion');
    
    /*---------Medidas de protección------------*/
    Route::get('medidas', 'MedidasProteccionController@index')->name('medidas');
    Route::post('addMedidas', 'MedidasProteccionController@addMedidas')->name('addMedidas');
    Route::get('getMedidas', 'MedidasProteccionController@getMedidas')->name('getMedidas');
    // Route::get('deleteMedida/{id}', 'MedidasProteccionController@deleteMedida')->name('deleteMedida');
    Route::get('agregar-medidas/{id}/eliminar', 'MedidasProteccionController@delete')->name('delete.medida');
    Route::post('agregar-medidas/editar', 'MedidasProteccionController@editar');
    Route::get('getMedidasAjax/{id}', 'MedidasProteccionController@getMedidasAjax');
    
    
    
    /*---------Rutas  Delitos Controller------------*/
    Route::get('agregar-delito', 'DelitoController@showForm')->name('new.delito');
    Route::post('storedelito', 'DelitoController@storeDelito')->name('store.delito');
    Route::get('delito/{id}/eliminar', 'DelitoController@delete')->name('delete.delito');
    Route::get('editar/{id}', 'DelitoController@editar');
    Route::put('delito/{id}/actualizar', 'DelitoController@actualizar')->name('actualizar.delito');
    /*---------Rutas para obtener delitos y desagregaciones------------*/
    Route::get('agrupaciones1/{id}', 'DelitoController@getAgrupaciones1');
    Route::get('agrupaciones2/{id}', 'DelitoController@getAgrupaciones2');
    
    Route::get('acusacion', 'AcusacionController@showForm')->name('new.acusacion');
    Route::post('storeacusacion', 'AcusacionController@storeAcusacion')->name('store.acusacion');
    Route::get('agregar-acusacion/{id}/eliminar', 'AcusacionController@delete')->name('delete.acusacion');
    
    /* --------Rutas para abogado----------- */
    Route::get('agregar-abogado', 'AbogadoController@showForm')->name('new.abogado');
    Route::post('storeabogado', 'AbogadoController@storeAbogado')->name('store.abogado');
    Route::get('agregar-abogado/{id}/eliminar', 'AbogadoController@delete')->name('delete.abogado');
    
    
    /* --------Rutas para defensa----------- */
    Route::get('agregar-defensa', 'AbogadoController@showForm2')->name('new.defensa');
    Route::post('storedefensa', 'AbogadoController@storeDefensa')->name('store.defensa');
    // Route::get('agregar-defensa/{id}/eliminar', 'AbogadoController@delete');
    
    
    Route::get('involucrados/{idCarpeta}/{idAbogado}', 'AbogadoController@getInvolucrados');
    /* --------Rutas para Autoridad----------- */
    Route::get('agregar-autoridad', 'AutoridadController@showForm')->name('new.autoridad');
    Route::post('storeautoridad', 'AutoridadController@storeAutoridad')->name('store.autoridad');
    Route::get('agregar-autoridad/{id}/eliminar', 'AutoridadController@delete')->name('delete.autoridad');
    
    /* --------Rutas para Turnar----------- */
    Route::get('turnar/{id}','EstadoController@index');
    Route::post('/turnar/actualizar','EstadoController@editar')->name('estado.edit');
    
    /* --------Rutas para Actas de hechos----------- */
    Route::get('actas','ActasHechosController@showform')->name('new.actahechos');
    Route::post('addactas','ActasHechosController@addActas')->name('addactas');
    Route::post('addactas2','ActasHechosController@addActas2')->name('addactas2');
    Route::get('actas-pendientes','ActasHechosController@actasPendientes')->name('actaspendientes');
    Route::get('listaActas', 'ActasHechosController@showActas');
    Route::get('atender-acta/{id}','ActasHechosController@actasPreregistro')->name('actaspreregistro');
    Route::post('/filtroactas', 'ActasHechosController@filtroactas');
    Route::get('/filtroactas', 'ActasHechosController@filtroactas');
    Route::get('/descActas/{id}', 'ActasHechosController@descActas');
    
    Route::post('/folioActa', 'ActasHechosController@filtroActasPendientes')->name('filtroactapendiente');
    
    
    /* --------Rutas para Libro de gobierno----------- */
    Route::get('libro','libroGobController@terminadas');
    Route::get('getCarpetas','libroGobController@getCarpetas');
    Route::get('carpetas','libroGobController@buscar')->name('indexcarpetas');
    route::get('buscarcarpeta/{id}','libroGobController@showForm');
    Route::post('carpetaNum','libroGobController@searchNumCarpeta')->name('filtro.carpetas');
    Route::post('libroGobierno','libroGobController@mostrarlibro')->name('libro.filtro');
    /* --------Rutas para Caratula de carpeta de investigacion----------- */
    Route::get('caratula','CaratulaCarpetaController@crearCaratula');
    
    
    /* --------Rutas para Periciales----------- */
    Route::get('periciales','pericialesController@pericialesindex');
    Route::post('periciales/agregar','pericialesController@agregar')->name('store.agregar');
    Route::post('periciales/psicologo','pericialesController@psico')->name('store.psicologo');
    Route::post('periciales/vehiculo','pericialesController@vehi')->name('store.vehiculo');
    Route::post('periciales/lesiones','pericialesController@lesiones')->name('store.lesiones');
    
    
    /* --------Ruta para obtener token oficios----------- */
    Route::get('getToken/{id}','ActasHechosController@getToken')->name('getToken');
    Route::get('oficioah/{id}','ActasHechosController@getoficioah')->name('oficioah');
    Route::post('saveOficio','ActasHechosController@saveOficio')->name('saveOficio');
});


// ///////////////////////////////////////preregistro/////////////////////////
Route::get('/preregistro', 'PreregistroController@create')->name('preregistro.create'); //ver formulario
Route::post('/preregistro/store', 'PreregistroController@store')->name('preregistro.store'); //registar

/*--------------------Rutas para generar el RFC----------------------------------*/
Route::post('rfc-moral', 'PreregistroAuxController@rfcMoral')->name('rfc.moral');
Route::post('rfc-fisico', 'PreregistroAuxController@rfcFisico')->name('rfc.fisico');

/*---------correo------------*/
Route::get('correo', 'PreregistroAuxController@boton');
//Route::post('correo/enviar', 'PreregistroAuxController@enviar')->name('correo');
Route::post('enviar/correo', 'PreregistroController@enviar')->name('envio');

/*---------Rutas para los selects dinámicos-------------*/
Route::get('municipios/{id}', 'RegisterController@getMunicipios');
Route::get('localidades/{id}', 'RegisterController@getLocalidades');
Route::get('codigos/{id}', 'RegisterController@getCodigos');
Route::get('colonias/{cp}', 'RegisterController@getColonias');
Route::get('colonias2/{id}', 'RegisterController@getColonias2');
Route::get('codigos2/{id}', 'RegisterController@getCodigos2');

/********************generar pdf**********************************/

Route::get('FormatoRegistro/{id}', 'PdfController@datos');
