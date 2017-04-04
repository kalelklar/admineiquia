<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;

use sisadmineiquia\Http\Requests;

use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
use Session;
use DB;
//para usuario
use sisadmineiquia\User;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
// Validación de formularios.
use Validator;

// Hash de contraseñas.
use Hash;



class UsersController extends Controller
{
	public function __construct()
    {

    }

    public function index(Request $request){
    	
    	if ($request)
        {
            $users=User::all();
            return view('admin.users.index',["users"=>$users]);
        }
    }
 
    public function create()
    {
    	return view("admin.users.create");
    }

    public function store(Request $request)
    {
    	// Realizamos la validación de datos recibidos del formulario.
		$rules=array(
			'name'=>'required|unique:users', // Username es único en la tabla users
			'email'=>'required|email|unique:users', // Username es único en la tabla users
			'password'=>'required|min:6',
			'password_confirmation'=>'required|same:password',
			'type'=>'required|not_in:0'
			);

		$messages= array ('name.required' =>'El Nombre es requerido',
                'email.required'=>'Correo Electronico es requerido',
                'password.required'=>'Contraseña es requerido',
                'password_confirmation.required'=>'Confirmar Contraseña es requerido',
                'type.required'=>'Tipo de Usuario es requerido',
                'name.unique' =>'El Nombre ya existe',
                'email.email'=>'Correo Electronico no es valido',
                'password.min'=>'Contraseña debe contener minimo 6 caracteres',
                'password_confirmation.same'=>'Confirmar Contraseña debe concidir con la Contraseña',
                'type.not_in'=>'Tipo de Usuario debe seleccionar uno',
                'email.unique'=>'Correo Electronico ya existe',
                );

		// Llamamos a Validator pasándole las reglas de validación.
		$validator=Validator::make($request->all(),$rules,$messages);

		// Si falla la validación redireccionamos de nuevo al formulario
		// enviando la variable Input (que contendrá todos los Input recibidos)
		// y la variable errors que contendrá los mensajes de error de validator.
		if ($validator->fails())
		{
			return Redirect::to('admin/users/create')
			->withInput()
			->withErrors($validator->messages());
		}else{
			//dd($request->all());
			$user=new User($request->all());
			$user->password=bcrypt($request->password);
			$user->save();
			Session::flash('store','El usuario fue creado correctamente!!!');
			return Redirect::to('admin/users');

		}

    	
    }
        
    public function show($id)
    {

    }
        
    public function edit($id)
    {
       return view("admin.users.edit",["user"=>User::findOrFail($id)]);
    }
        
    public function update(Request $request,$id)
    {

    	// Realizamos la validación de datos recibidos del formulario.
		$rules=array(
			'password'=>'required|min:6',
			'password_confirmation'=>'required|same:password',
			'type'=>'required|not_in:0'
			);

		$messages= array (
                'password.required'=>'Contraseña es requerido',
                'password_confirmation.required'=>'Confirmar Contraseña es requerido',
                'type.required'=>'Tipo de Usuario es requerido',
                'password.min'=>'Contraseña debe contener minimo 6 caracteres',
                'password_confirmation.same'=>'Confirmar Contraseña debe concidir con la Contraseña',
                'type.not_in'=>'Tipo de Usuario debe seleccionar uno'
                );

		// Llamamos a Validator pasándole las reglas de validación.
		$validator=Validator::make($request->all(),$rules,$messages);

		// Si falla la validación redireccionamos de nuevo al formulario
		// enviando la variable Input (que contendrá todos los Input recibidos)
		// y la variable errors que contendrá los mensajes de error de validator.
		if ($validator->fails())
		{
			return Redirect::to('admin/users/'.$id.'/edit')
			->withInput()
			->withErrors($validator->messages());
		}else{
		    	$affectedRows = User::where('id','=',$id)
		        ->update([
		            'password' =>bcrypt($request->get('password')),
		            'type'=>$request->get('type')]);
		        Session::flash('update','El usuario se ha actualizado correctamente!!!');       
		        return Redirect::to('admin/users');
		    }
    }



    public function destroy($id)
    {
    	$query=trim($id);
		$affectedRows = User::where('id','=',$query)->delete();
		Session::flash('destroy','El usuario eliminado correctamente!!!');
		return Redirect::to('admin/users');

    }

    public function edituser($id)
    {
       return view("admin.users.edit",["user"=>User::findOrFail($id)]);
    }
        
    public function updateuser(Request $request,$id)
    {

    	$affectedRows = User::where('id','=',$id)
        ->update(['name'=> $request->get('name'),
            'email'=>$request->get('email'),
            'password' =>bcrypt($request->get('password')),
            'type'=>$request->get('type')]);
        Session::flash('update','El usuario se ha actualizado correctamente!!!');       
        return Redirect::to('admin/users');

        //$puesto=Puesto::findOrFail($id);
        //$puesto->iddepartamento=$request->get('iddepartamento');
        //$puesto->nombrepuesto=$request->get('nombrepuesto');
        //$puesto->descripcionpuesto=$request->get('descripcionpuesto');
        //$puesto->salariopuesto=$request->get('salariopuesto');
    	//$puesto->update();
        //return Redirect::to('admin/puesto');
    }
}
