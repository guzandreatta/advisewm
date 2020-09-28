<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\UsuarioContrasenia;
use Validator;
use Auth;
use Uuid;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
      /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getAllUsers()
    {
        $users = User::all();

        return view('admin/index')->with(['users' => $users]);
    }
		
	public function login(Request $request)
    {
		$email = $request->input('correoelectronico');
		$password = $request->input('contrasena');
		
		$this->validate($request, [
        'correoelectronico' => 'required',
        'contrasena' => 'required',
		]);
		
		$usuario = Usuario::where('correoelectronico',$email)->where('activo', '1') -> first();
		if ($usuario->Contrasena == md5($password)){
			session(['usuario' => $usuario]);
			//echo 'console.log('. json_encode( "OK" ) .')';
			
			$currentDateTime = new \DateTime();
									
			\DB::table('usuario')
            ->where('Id', $usuario->Id)
            ->update(['UltimoAcceso' => $currentDateTime->format('Y-m-d H:i:s')]);
			
			return view('admin.inicio')->with(['usuario' => $usuario]);
			
		}else{
			//echo 'console.log('. json_encode( "Error" ) .')';
			return view('admin.login')->with(['errorLogin' => __('messages.login_error')]);
		}
		//echo 'console.log('. json_encode( $usuario ) .')';
    }
	
	public function logoff(Request $request)
    {
		$request->session()->forget('usuario');
		return redirect('/admin');
		
    }
	
	public function olvidoClave(Request $request)
	{
		$email = json_decode($request->getContent());
		$newGuid = Uuid::generate(4)->string;
		
		$currentDateTime = new \DateTime();
		
		$usuarioContrasenia = new UsuarioContrasenia;
		
		$usuario = Usuario::where('correoelectronico',$email)->where('activo', '1') -> first();
		
		if (!$usuario){
			$email_error = __('messages.email_error');
			return with(compact('email_error'));	
		}
		
        $usuarioContrasenia->usuarioid = $usuario -> Id;
		$usuarioContrasenia->guid = $newGuid;
		$usuarioContrasenia->fecha = $currentDateTime->format('Y-m-d H:i:s');
		
		$usuarioContrasenia->save();
		
		$contactName = 'Advise Wealth Management';
		$contactEmail = 'info@advisewm.com';
		$to = $usuario->CorreoElectronico;
		$body = __('messages.email_body_opening') . $usuario->Nombre . __('messages.email_body') . url('/') . "/admin/nuevaclave/" .  $newGuid . '<br>' .__('messages.email_body_closing') . '<br>' . __('messages.email_signature');
		$subject = __('messages.email_subject');
		
		$data = array('name'=>$contactName, 'email'=>$contactEmail, 'body'=>$body, 'subject'=>$subject, 'to'=>$to);
		Mail::send([], $data, function($message) use ($contactEmail, $contactName, $subject, $body, $to)
		{   
			$message->from($contactEmail, $contactName);
			$message->to($to)->subject($subject)
			->setBody($body, 'text/html'); // for HTML rich messages;
		});		
		$email_sent = __('messages.email_sent');
		
		return with(compact('email_sent'));	

	}
	
	public function nuevaClave($guid){
		return view('admin.nuevaClave')->with('guid', $guid);
	}
	
	public function cambiarClave(Request $request){
		
		$guid = $request->guid;
		$usuariocontrasenia = UsuarioContrasenia::where('guid',$guid)-> first();
			
		if (!$usuariocontrasenia){
			return redirect()->back()->withErrors([__('messages.new_password_error_guid_not_found')]);
		}
		if ($usuariocontrasenia){
			$dateInDB = $usuariocontrasenia->Fecha;
			 if(strtotime($dateInDB) < strtotime('-1 days')) {
				 
				 return redirect()->back()->withErrors([__('messages.new_password_error_guid_old')]);
			}
					
			
			if ($usuariocontrasenia->FechaDeUso){
				return redirect()->back()->withErrors([__('messages.new_password_error_guid_used')]);
			}
			
			$this->validate($request, [
			'password' => 'required|min:8|max:50|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/|confirmed'
               
			]);
		
			$currentDateTime = new \DateTime();
			
			\DB::table('usuariocontrasenia')
            ->where('id', $usuariocontrasenia->Id)
            ->update(['FechaDeUso' => $currentDateTime->format('Y-m-d H:i:s')]);
			
			$contrasenaNueva = md5($request->password);
						
			\DB::table('usuario')
            ->where('Id', $usuariocontrasenia->UsuarioId)
            ->update(['FechaEdicion' => $currentDateTime->format('Y-m-d H:i:s'), 'UsuarioEdicion' => $usuariocontrasenia->UsuarioId, 'Contrasena' => $contrasenaNueva]);
		}
		 return redirect('/admin');
	}
}
