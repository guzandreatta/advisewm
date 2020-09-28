<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Informe;
use App\InformeMultimedia;
use App\Idioma;
use Validator;
use Auth;
use Uuid;
use App;

class InformeController extends Controller
{

	public function nuevoInforme(Request $request)
    {
		$languageselected = $request->input('languageselected');
						
		$lang = Idioma::where('abreviacion',$languageselected)->where('activo', '1') -> first();
		
		$informe = new Informe;
		
        $informe->activo = 1;
		$informe->idiomaid = $lang -> Id;
		$informe->titulo = $request->title;
		$informe->usuariocreacion = session('usuario') -> Id;
				
		$this->validate($request, [
			'title' => 'required|min:3|max:50',
			'report' => 'required|mimes:pdf|max:5000'
		]);
		
        $informe->save();		
		
		$currentDate = date("Y-m-d");
		
		$extension = $request->file('report')->getClientOriginalExtension(); // getting extension
		$fileName = trim (str_replace(" ", "_", $informe->titulo)) . '_' . $currentDate . '.' . $extension;

		$request->file('report')->move(public_path() . '/img/reports', $fileName); // uploading file to given path
		
		$informemultimedia = new InformeMultimedia;
		$informemultimedia -> informeid = $informe->id;
		$informemultimedia -> multimediaruta = 'img/reports/' . $fileName;
		$informemultimedia -> tipomultimediaid = 3; //pdf
		$informemultimedia -> activo = 1;
		
		$informemultimedia->save();
		
		$sessionMessage = 'message_' . $languageselected;
		return redirect()->back()->with($sessionMessage, __('messages.article_saved', ['Title' => $informe->titulo, 'LANGUAGE' => $languageselected]));
    }
	
	public function descargar(){
		$currentLang = App::getLocale();
		$idioma =  Idioma::where('abreviacion', $currentLang)-> first();
		$informe = Informe::where('idiomaid', $idioma->Id)->where('activo', 1)->orderBy('id', 'desc')->first();
		
		$informemultimedia = InformeMultimedia::where('informeid', $informe->Id)->where('activo', 1)->first();
		$titulo = $informe->Titulo . "." . pathinfo($informemultimedia->MultimediaRuta, PATHINFO_EXTENSION);

		return response()->download($informemultimedia->MultimediaRuta, $titulo);		
	}
	
}
