<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Articulo;
use App\ArticuloMultimedia;
use App\Idioma;
use Validator;
use Auth;
use Uuid;
use App;

class ArticuloController extends Controller
{

	public function editar(){		
		$articulos = $this->getArticulos(1);
		
        return view('admin.editArticulo')->with('articulos', $articulos);
	}
	
	private function getArticulos($language){
		$articulos = Articulo::where('idiomaid', $language)->orderBy('orden')->get();
		$options="";
		$options.="<option value='0' disabled='disabled' selected='selected'>".__('messages.article_select'). "</option>";
		  for($i=0;$i<sizeof($articulos);$i++) {
			  $id = $articulos[$i]->Id;
			  $idiomaId = $articulos[$i]->IdiomaId;
			  $idioma =  Idioma::where('id', $idiomaId)-> first();
				$options.="<option value=".$id.">".__('messages.title') . ': ' . $articulos[$i]->Titulo; 
			if ($articulos[$i]->FechaEdicion != null){
				$options .= ' | '  . __('messages.edition_date') . ': '. $articulos[$i]->FechaEdicion;
			} else {
				 $options .= ' | '  . __('messages.creation_date') . ': '. $articulos[$i]->FechaCreacion;
			}
			$options .= "</option>";
		  }
		  return $options;
	}
	
	public function verArticulo($id, Request $request){
		$currentLang = App::getLocale();
		$idioma =  Idioma::where('abreviacion', $currentLang)-> first();
		$articulo = Articulo::where('id', $id)->where('idiomaid', $idioma->Id)->first();
		
		if ($articulo){
			return view('articulo')->with('articulo', $articulo);
		}else{			 
			return redirect()->action('HomeController@index');
		}
	}
	
	public function getArticlesByOrder(Request $request){
		$languageselected = json_decode($request->getContent());
		if ($languageselected == null)
			$languageselected = 'esp';
		$lang = Idioma::where('abreviacion',$languageselected)->where('activo', '1') -> first();		
		$articulos = $this->getArticulos($lang->Id);
		return with(compact('articulos'));		
	}
	
	private function getArticlesByOrderAndLanguage($language){
		$articulos = Articulo::where(['idiomaid' => $language, 'activo' => '1'])->orderBy('orden')->get();
		$options="";
		  for($i=0;$i<sizeof($articulos);$i++) {
			  $id = $articulos[$i]->Id;
				$options.="<option value=".$id.">". ($i+1) . '- ' . __('messages.title') . ': ' . $articulos[$i]->Titulo; 
			if ($articulos[$i]->FechaEdicion != null){
				$options .= ' | '  . __('messages.edition_date') . ': '. $articulos[$i]->FechaEdicion;
			} else {
				 $options .= ' | '  . __('messages.creation_date') . ': '. $articulos[$i]->FechaCreacion;
			}
			$options .= "</option>";
		  }
		  return $options;
	}
	
	
	public function upArticleOrder(Request $request){
		$id = json_decode($request->getContent());
		//echo 'console.log('. json_encode( $id ) . ')';
		$articulo =  Articulo::where('id', $id)-> first();
		$lastOrderArticulo = $articulo -> Orden;
		$newOrder = $lastOrderArticulo - 1;
		
		$currentDateTime = new \DateTime();
		
		\DB::table('articulo')
            ->where('Orden', '=', $newOrder)
			->where('IdiomaId', '=', $articulo->IdiomaId)
			->increment('Orden');	
					
		\DB::table('articulo')
            ->where('id', $id)
            ->update(['Orden' => $newOrder, 'UsuarioEdicion' => session('usuario') -> Id, 'FechaEdicion' => $currentDateTime->format('Y-m-d H:i:s')]);
		
		$articulos = $this->getArticulos($articulo->IdiomaId);
		return with(compact('articulos'));	
	}
	
	public function downArticleOrder(Request $request){
		$id = json_decode($request->getContent());
		//echo 'console.log('. json_encode( $id ) . ')';
		$articulo =  Articulo::where('id', $id)-> first();
		$lastOrderArticulo = $articulo -> Orden;
		$newOrder = $lastOrderArticulo + 1;
		
		$currentDateTime = new \DateTime();
		
		\DB::table('articulo')
            ->where('Orden', '=', $newOrder)
			->where('IdiomaId', '=', $articulo->IdiomaId)
			->decrement('Orden');
			
		\DB::table('articulo')
            ->where('id', $id)
            ->update(['Orden' => $newOrder, 'UsuarioEdicion' => session('usuario') -> Id, 'FechaEdicion' => $currentDateTime->format('Y-m-d H:i:s')]);
		
		$articulos = $this->getArticulos($articulo->IdiomaId);
		return with(compact('articulos'));	
	}
	
	public function nuevoArticulo(Request $request)
    {
		$languageselected = $request->input('languageselected');
		//echo $languageselected;
		//echo 'console.log('. json_encode( $languageselected . ' | ' . $title . ' | ' . $desc . ' | ' . $homeimage . ' | ' . $coverimage . ' | ' . $article . ' | ' . $order . ' | ' . $startdate . ' | ' . $enddate) .')';
		
		\DB::table('articulo')
			->increment('Orden');	
			
		$lang = Idioma::where('abreviacion',$languageselected)->where('activo', '1') -> first();
		
		$articulo = new Articulo;
		
        $articulo->activo = 1;
		$articulo->descripcion = $request->desc;
		$articulo->fechainicio = $request->startdate;
		$articulo->fechafin = $request->enddate;
		$articulo->idiomaid = $lang -> Id;
		$articulo->orden = 1;
		$articulo->texto = $request->article;
		$articulo->titulo = $request->title;
		$articulo->usuariocreacion = session('usuario') -> Id;
				
		$this->validate($request, [
			'desc' => 'required|min:3|max:2000',
			'article' => 'required|min:3|max:60000',
			'title' => 'required|min:3|max:200',
			'homeimage' => 'required|image|max:1000',
			'coverimage' => 'required|image|max:1000'
		]);
		
        $articulo->save();		
		
		$extension = $request->file('homeimage')->getClientOriginalExtension(); // getting image extension
		$fileNameHomeImage = Uuid::generate(4)->string . '.' . $extension;

		$extension = $request->file('coverimage')->getClientOriginalExtension(); // getting image extension
		$fileNameCoverImage = Uuid::generate(4)->string . '.' . $extension;
		
		$request->file('homeimage')->move(public_path() . '/img/articles/home', $fileNameHomeImage); // uploading file to given path
		
		$articulomultimedia = new ArticuloMultimedia;
		$articulomultimedia -> articuloid = $articulo->id;
		$articulomultimedia -> multimediaruta = 'img/articles/home/' . $fileNameHomeImage;
		$articulomultimedia -> tipomultimediaid = 2; //home
		$articulomultimedia -> activo = 1;
		
		$articulomultimedia->save();
		
		$request->file('coverimage')->move(public_path() . '/img/articles/cover', $fileNameCoverImage); // uploading file to given path
		
		$articulomultimedia = new ArticuloMultimedia;
		$articulomultimedia -> articuloid = $articulo->id;
		$articulomultimedia -> multimediaruta = 'img/articles/cover/' .$fileNameCoverImage;
		$articulomultimedia -> tipomultimediaid = 1; //cover
		$articulomultimedia -> activo = 1;
		
		$articulomultimedia->save();
		$sessionMessage = 'message_' . $languageselected;
		return redirect()->back()->with($sessionMessage, __('messages.article_saved', ['Title' => $articulo->titulo, 'LANGUAGE' => $languageselected]));
    }
	
	public function getById(Request $request){
		$id = json_decode($request->getContent());
		$articulo = Articulo::where('id', $id)->get();
		$multimedia = ArticuloMultimedia::where(['articuloid' => $id, 'activo' => '1'])->get();
		
		return with(compact('articulo', 'multimedia'));		
	}
	
	public function subirArticuloEditado(Request $request)
    {

		$id = $request -> id;

		//echo 'console.log('. json_encode( $id ). ')'; 
				
		$this->validate($request, [
			'desc' => 'required|min:3|max:2000',
			'article' => 'required|min:3|max:60000',
			'title' => 'required|min:3|max:200'
		]);
		
		 $currentDateTime = new \DateTime();
		
		\DB::table('articulo')
            ->where('id', $id)
            ->update(['Descripcion' => $request->desc, 'FechaInicio' => $request->startdate, 'FechaFin' => $request->enddate, 'IdiomaId' => $request -> idiomaid, 'Texto' => $request->article, 'Titulo' => $request->title, 'UsuarioEdicion' => session('usuario') -> Id, 'FechaEdicion' => $currentDateTime->format('Y-m-d H:i:s'), 'Activo' => $request -> active]);
					
		$idioma =  Idioma::where('id', $request -> idiomaid)-> first();
		
		$languageselected = $idioma->Abreviacion;
		
		if ($request->file('homeimage') != null){
		
			ArticuloMultimedia::where('articuloid', $id)
			  ->where('tipomultimediaid', '2')
			  ->update(['activo' => 0]);
			  
			$extension = $request->file('homeimage')->getClientOriginalExtension(); // getting image extension
			$fileNameHomeImage = Uuid::generate(4)->string . '.' . $extension;
			
			$articulomultimedia = new ArticuloMultimedia;
			$articulomultimedia -> articuloid = $id;
			$articulomultimedia -> multimediaruta = 'img/articles/home/' .$fileNameHomeImage;
			$articulomultimedia -> tipomultimediaid = 2; //home
			$articulomultimedia -> activo = 1;
			
			$articulomultimedia->save();
			
			$request->file('homeimage')->move(public_path() . '/img/articles/home', $fileNameHomeImage); // uploading file to given path
		
		}
		
		if ($request->file('coverimage') != null){
		
			ArticuloMultimedia::where('articuloid', $id)
			  ->where('tipomultimediaid', '1')
			  ->update(['activo' => 0]);
			  
			$extension = $request->file('coverimage')->getClientOriginalExtension(); // getting image extension
			$fileNameCoverImage = Uuid::generate(4)->string . '.' . $extension;
			
			$articulomultimedia = new ArticuloMultimedia;
			$articulomultimedia -> articuloid = $id;
			$articulomultimedia -> multimediaruta = 'img/articles/cover/' .$fileNameCoverImage;
			$articulomultimedia -> tipomultimediaid = 1; //cover
			$articulomultimedia -> activo = 1;
			
			$articulomultimedia->save();
		
			$request->file('coverimage')->move(public_path() . '/img/articles/cover', $fileNameCoverImage); // uploading file to given path
		}
		
		$sessionMessage = 'message_' . $languageselected;
		return redirect()->back()->with($sessionMessage, __('messages.article_changes_saved', ['Title' => $request->title, 'LANGUAGE' => $languageselected]));
    }
}
