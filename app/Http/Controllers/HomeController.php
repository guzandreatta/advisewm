<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Articulo;
use App\ArticuloMultimedia;
use App\Noticia;
use App\NoticiaMultimedia;
use App\Idioma;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
		$languageselected = 'es';
		if ($request->session()->has('applocale')) {
			$languageselected = $request->session()->get('applocale');
		}		
		$currentDate = date('Y-m-d');
		
		$lang = Idioma::where('abreviacion',$languageselected)->where('activo', '1') -> first();	
		
		//Artículos
		$articulos = Articulo::where('idiomaid', $lang->Id)->orderBy('orden')->where('activo', '1')->where(function ($articulos) {
            $articulos->where('fechainicio', '<=', date('Y-m-d'))
                  ->orWhereNull('fechainicio');
            })->where(function ($articulos) {
            $articulos->where('fechafin', '>=', date('Y-m-d'))
                  ->orWhereNull('fechafin');
            })->take(4)->get();

		$articulosIds = array();
		foreach ($articulos as &$value) {
			array_push($articulosIds, $value -> Id);
		}
		
		$articulosmultimedias = ArticuloMultimedia::where('activo', '1')->whereIn('articuloid', $articulosIds)->where('tipomultimediaid', '2')->get();
				
		//Noticias
		$noticias = Noticia::where('idiomaid', $lang->Id)->orderBy('orden')->where('activo', '1')->where(function ($noticias) {
            $noticias->where('fechainicio', '<=', date('Y-m-d'))
                  ->orWhereNull('fechainicio');
            })->where(function ($noticias) {
            $noticias->where('fechafin', '>=', date('Y-m-d'))
                  ->orWhereNull('fechafin');
            })->take(3)->get();

		$noticiasIds = array();
		foreach ($noticias as &$value) {
			array_push($noticiasIds, $value -> Id);
		}
		
		$noticiasmultimedias = NoticiaMultimedia::where('activo', '1')->whereIn('noticiaid', $noticiasIds)->where('tipomultimediaid', '2')->get();
		
		return view('inicio')->with('articulos', $articulos)->with('articulosmultimedias', $articulosmultimedias)->with('noticias', $noticias)->with('noticiasmultimedias', $noticiasmultimedias);
    }
	
	public function changeLanguage(Request $request){
		$lang = json_decode($request->getContent());
		App::setLocale('en');
		return redirect()->back();
	}
}
