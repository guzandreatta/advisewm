<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Noticia;
use App\NoticiaMultimedia;
use App\Idioma;
use Validator;
use Auth;
use Uuid;
use App;

class NoticiaController extends Controller
{

	public function editar(){		
		$noticias = $this->getNoticias(1);
		
        return view('admin.editNoticia')->with('noticias', $noticias);
	}
	
	private function getNoticias($language){
		$noticias = Noticia::where('idiomaid', $language)->orderBy('orden')->get();
		$options="";
		$options.="<option value='0' disabled='disabled' selected='selected'>".__('messages.news_select'). "</option>";
		  for($i=0;$i<sizeof($noticias);$i++) {
			  $id = $noticias[$i]->Id;
			  $idiomaId = $noticias[$i]->IdiomaId;
			  $idioma =  Idioma::where('id', $idiomaId)-> first();
				$options.="<option value=".$id.">".__('messages.title') . ': ' . $noticias[$i]->Titulo; 
			if ($noticias[$i]->FechaEdicion != null){
				$options .= ' | '  . __('messages.edition_date') . ': '. $noticias[$i]->FechaEdicion;
			} else {
				 $options .= ' | '  . __('messages.creation_date') . ': '. $noticias[$i]->FechaCreacion;
			}
			$options .= "</option>";
		  }
		  return $options;
	}
	
	public function getNewsByOrder(Request $request){
		$languageselected = json_decode($request->getContent());
		$lang = Idioma::where('abreviacion',$languageselected)->where('activo', '1') -> first();		
		$noticias = $this->getNoticias($lang->Id);
		return with(compact('noticias'));		
	}
	
	private function getNewsByOrderAndLanguage($language){
		$noticias = Noticia::where(['idiomaid' => $language, 'activo' => '1'])->orderBy('orden')->get();
		$options="";
		  for($i=0;$i<sizeof($noticias);$i++) {
			  $id = $noticias[$i]->Id;
				$options.="<option value=".$id.">". ($i+1) . '- ' . __('messages.title') . ': ' . $noticias[$i]->Titulo; 
			if ($noticias[$i]->FechaEdicion != null){
				$options .= ' | '  . __('messages.edition_date') . ': '. $noticias[$i]->FechaEdicion;
			} else {
				 $options .= ' | '  . __('messages.creation_date') . ': '. $noticias[$i]->FechaCreacion;
			}
			$options .= "</option>";
		  }
		  return $options;
	}
	
	public function verNoticia($id, Request $request){
		$currentLang = App::getLocale();
		$idioma =  Idioma::where('abreviacion', $currentLang)-> first();
		$noticia = Noticia::where('id', $id)->where('idiomaid', $idioma->Id)->first();
		
		if ($noticia){
			return view('noticia')->with('noticia', $noticia);
		}else{			 
			return redirect()->action('HomeController@index');
		}
	}
	
	public function upNewsOrder(Request $request){
		$id = json_decode($request->getContent());
		//echo 'console.log('. json_encode( $id ) . ')';
		$noticia =  Noticia::where('id', $id)-> first();
		$lastOrderNoticia = $noticia -> Orden;
		$newOrder = $lastOrderNoticia - 1;
		
		$currentDateTime = new \DateTime();
		
		\DB::table('noticia')
            ->where('Orden', '=', $newOrder)
			->where('IdiomaId', '=', $noticia->IdiomaId)
			->increment('Orden');	
					
		\DB::table('noticia')
            ->where('id', $id)
            ->update(['Orden' => $newOrder, 'UsuarioEdicion' => session('usuario') -> Id, 'FechaEdicion' => $currentDateTime->format('Y-m-d H:i:s')]);
		
		$noticias = $this->getNoticias($noticia->IdiomaId);
		return with(compact('noticias'));	
	}
	
	public function downNewsOrder(Request $request){
		$id = json_decode($request->getContent());
		//echo 'console.log('. json_encode( $id ) . ')';
		$noticia =  Noticia::where('id', $id)-> first();
		$lastOrderNoticia = $noticia -> Orden;
		$newOrder = $lastOrderNoticia + 1;
		
		$currentDateTime = new \DateTime();
		
		\DB::table('noticia')
            ->where('Orden', '=', $newOrder)
			->where('IdiomaId', '=', $noticia->IdiomaId)
			->decrement('Orden');
			
		\DB::table('noticia')
            ->where('id', $id)
            ->update(['Orden' => $newOrder, 'UsuarioEdicion' => session('usuario') -> Id, 'FechaEdicion' => $currentDateTime->format('Y-m-d H:i:s')]);
		
		$noticias = $this->getNoticias($noticia->IdiomaId);
		return with(compact('noticias'));	
	}
	
	public function nuevaNoticia(Request $request)
    {
		$languageselected = $request->input('languageselected');
		
		//echo 'console.log('. json_encode( $languageselected . ' | ' . $title . ' | ' . $desc . ' | ' . $homeimage . ' | ' . $coverimage . ' | ' . $news . ' | ' . $order . ' | ' . $startdate . ' | ' . $enddate) .')';
		
		\DB::table('noticia')
			->increment('Orden');	
			
		$lang = Idioma::where('abreviacion',$languageselected)->where('activo', '1') -> first();
		
		$noticia = new Noticia;
		
        $noticia->activo = 1;
		$noticia->descripcion = $request->desc;
		$noticia->fechainicio = $request->startdate;
		$noticia->fechafin = $request->enddate;
		$noticia->idiomaid = $lang -> Id;
		$noticia->orden = 1;
		$noticia->texto = $request->news;
		$noticia->titulo = $request->title;
		$noticia->usuariocreacion = session('usuario') -> Id;
				
		$this->validate($request, [
			'desc' => 'required|min:3|max:2000',
			'news' => 'required|min:3|max:60000',
			'title' => 'required|min:3|max:200',
			'homeimage' => 'required|image|max:1000',
			'coverimage' => 'required|image|max:1000'
		]);
		
        $noticia->save();		
		
		$extension = $request->file('homeimage')->getClientOriginalExtension(); // getting image extension
		$fileNameHomeImage = Uuid::generate(4)->string . '.' . $extension;

		$extension = $request->file('coverimage')->getClientOriginalExtension(); // getting image extension
		$fileNameCoverImage = Uuid::generate(4)->string . '.' . $extension;
		
		$request->file('homeimage')->move(public_path() . '/img/newss/home', $fileNameHomeImage); // uploading file to given path
		
		$noticiamultimedia = new NoticiaMultimedia;
		$noticiamultimedia -> noticiaid = $noticia->id;
		$noticiamultimedia -> multimediaruta = 'img/newss/home/' . $fileNameHomeImage;
		$noticiamultimedia -> tipomultimediaid = 2; //home
		$noticiamultimedia -> activo = 1;
		
		$noticiamultimedia->save();
		
		$request->file('coverimage')->move(public_path() . '/img/newss/cover', $fileNameCoverImage); // uploading file to given path
		
		$noticiamultimedia = new NoticiaMultimedia;
		$noticiamultimedia -> noticiaid = $noticia->id;
		$noticiamultimedia -> multimediaruta = 'img/newss/cover/' .$fileNameCoverImage;
		$noticiamultimedia -> tipomultimediaid = 1; //cover
		$noticiamultimedia -> activo = 1;
		
		$noticiamultimedia->save();
		$sessionMessage = 'message_' . $languageselected;
		return redirect()->back()->with($sessionMessage, __('messages.news_saved', ['Title' => $noticia->titulo, 'LANGUAGE' => $languageselected]));
    }
	
	public function getById(Request $request){
		$id = json_decode($request->getContent());
		$noticia = Noticia::where('id', $id)->get();
		$multimedia = NoticiaMultimedia::where(['noticiaid' => $id, 'activo' => '1'])->get();
		
		return with(compact('noticia', 'multimedia'));		
	}
	
	public function subirNoticiaEditado(Request $request)
    {

		$id = $request -> id;

		//echo 'console.log('. json_encode( $id ). ')'; 

		$this->validate($request, [
			'desc' => 'required|min:3|max:2000',
			'news' => 'required|min:3|max:60000',
			'title' => 'required|min:3|max:200'
		]);
				
		 $currentDateTime = new \DateTime();
		
		\DB::table('noticia')
            ->where('id', $id)
            ->update(['Descripcion' => $request->desc, 'FechaInicio' => $request->startdate, 'FechaFin' => $request->enddate, 'IdiomaId' => $request -> idiomaid, 'Texto' => $request->news, 'Titulo' => $request->title, 'UsuarioEdicion' => session('usuario') -> Id, 'FechaEdicion' => $currentDateTime->format('Y-m-d H:i:s'), 'Activo' => $request -> active]);
					
		$idioma =  Idioma::where('id', $request -> idiomaid)-> first();
		
		$languageselected = $idioma->Abreviacion;
		
		if ($request->file('homeimage') != null){
		
			NoticiaMultimedia::where('noticiaid', $id)
			  ->where('tipomultimediaid', '2')
			  ->update(['activo' => 0]);
			  
			$extension = $request->file('homeimage')->getClientOriginalExtension(); // getting image extension
			$fileNameHomeImage = Uuid::generate(4)->string . '.' . $extension;
			
			$noticiamultimedia = new NoticiaMultimedia;
			$noticiamultimedia -> noticiaid = $id;
			$noticiamultimedia -> multimediaruta = 'img/newss/home/' .$fileNameHomeImage;
			$noticiamultimedia -> tipomultimediaid = 2; //home
			$noticiamultimedia -> activo = 1;
			
			$noticiamultimedia->save();
			
			$request->file('homeimage')->move(public_path() . '/img/newss/home', $fileNameHomeImage); // uploading file to given path
		
		}
		
		if ($request->file('coverimage') != null){
		
			NoticiaMultimedia::where('noticiaid', $id)
			  ->where('tipomultimediaid', '1')
			  ->update(['activo' => 0]);
			  
			$extension = $request->file('coverimage')->getClientOriginalExtension(); // getting image extension
			$fileNameCoverImage = Uuid::generate(4)->string . '.' . $extension;
			
			$noticiamultimedia = new NoticiaMultimedia;
			$noticiamultimedia -> noticiaid = $id;
			$noticiamultimedia -> multimediaruta = 'img/newss/cover/' .$fileNameCoverImage;
			$noticiamultimedia -> tipomultimediaid = 1; //cover
			$noticiamultimedia -> activo = 1;
			
			$noticiamultimedia->save();
		
			$request->file('coverimage')->move(public_path() . '/img/newss/cover', $fileNameCoverImage); // uploading file to given path
		}
		
		$sessionMessage = 'message_' . $languageselected;
		return redirect()->back()->with($sessionMessage, __('messages.news_changes_saved', ['Title' => $request->title, 'LANGUAGE' => $languageselected]));
    }
}
