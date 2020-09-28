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

// Route::get('/', function () {
    // return view('inicio');
// });

Route::post('olvidoclave', 'UsuarioController@olvidoClave');

Route::post('/admin/nuevaclave/cambiar', 'UsuarioController@cambiarClave');

Route::get('/admin/nuevaclave/{guid}', 'UsuarioController@nuevaClave');

Route::get('/articulo/{id}', 'ArticuloController@verArticulo');

Route::get('/noticia/{id}', 'NoticiaController@verNoticia');

Route::get('/aboutus', function () {
    return view('sobre_nosotros');
});

Route::get('/assetmanagement', function () {
    return view('activos');
});

Route::get('/fiduciaryadvice', function () {
    return view('fiduciario');
});

Route::get('/contact', function () {
    return view('contacto');
});

Route::get('/taxadvice', function () {
    return view('tributario');
});

Route::get('/', 'HomeController@index');

Route::get('/admin', function () {
    return view('admin.login');
});

Route::get('/admin/inicio', function () {
    return view('admin.inicio');
});

Route::get('/admin/articulo/nuevo', function () {
    return view('admin.creaArticulo');
});

Route::get('editarArticulo', 'ArticuloController@editar');

Route::put('subirArticuloEditado', 'ArticuloController@subirArticuloEditado');

Route::post('obtenerArticuloPorId', 'ArticuloController@getById');

Route::post('obtenerArticulosPorOrden', 'ArticuloController@getArticlesByOrder');

Route::post('subirOrdenDeArticulo', 'ArticuloController@upArticleOrder');

Route::post('bajarOrdenDeArticulo', 'ArticuloController@downArticleOrder');

Route::get('/admin/noticia/nuevo', function () {
    return view('admin.creaNoticia');
});

Route::get('editarNoticia', 'NoticiaController@editar');

Route::put('subirNoticiaEditado', 'NoticiaController@subirNoticiaEditado');

Route::post('obtenerNoticiaPorId', 'NoticiaController@getById');

Route::post('obtenerNoticiasPorOrden', 'NoticiaController@getNewsByOrder');

Route::post('subirOrdenDeNoticia', 'NoticiaController@upNewsOrder');

Route::post('bajarOrdenDeNoticia', 'NoticiaController@downNewsOrder');

Route::get('cambiarIdiomaGeneral', 'HomeController@changeLanguage');

Route::get('/admin/unauth', function () {
    return view('errors.403');
});

Route::get('/admin/noticia/editar', function () {
    return view('admin.editNoticia');
});

Route::get('/admin/articulo/editar', function () {
    return view('admin.editArticulo');
});

Route::get('/admin/informe/nuevo', function () {
    return view('admin.creaInforme');
});

Route::get('logoff', 'UsuarioController@logoff');

//POST route
Route::post('login', 'UsuarioController@login');

Route::post('/admin/articulo/nuevoArticulo', 'ArticuloController@nuevoArticulo');

Route::post('/admin/noticia/nuevaNoticia', 'NoticiaController@nuevaNoticia');

Route::post('/admin/informe/nuevoInforme', 'InformeController@nuevoInforme');

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

Route::get('bajarInforme', 'InformeController@descargar');