<?php

namespace App\Http\Controllers\P2022\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function index(){
        if (Auth::user()->tipoUsuarioId != 0){
            return redirect('home');
        }
        // dd(User::all());
        return view('2022.usuarios.index',['users'=>User::where('status',1)->get()]);
    }

    public function deshabilitarUsuario($id){
        $usuario = User::where('id',$id)->first();

        $usuario->status = 0;
        $usuario->save();
    }

    public function editarUsuario($id){
        return view('2022.usuarios.editarUsuario',[
            'usuario'=>  $usuario = User::where('id',$id)->first()
            ]);
    }

    public function actualizarUsuario(Request $request, $id){
        $val = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],//valida que el email no exita pero a ecepcion del email de el mismo usuario
        ])->validate();

        $usuario = User::where('id',$id)->first();

        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->tipoUsuarioId = $request->get('usertype');
        $usuario->save();
        return view('auth.registersuccess',[
            'msg'=> 'Se han actualizado los datos del usuario'
            ]);
    }

    public function editarContraseña($id){

        return view('2022.usuarios.editarPassword',[
            'usuario'=>  $usuario = User::where('id',$id)->first()
            ]);
    }

    public function actualizarContraseña(Request $request, $id){
        Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        $usuario = User::where('id',$id)->first();

        $usuario->password =  Hash::make($request->get('password'));

        $usuario->save();
        return view('auth.registersuccess',[
            'msg'=>  'Se ha cambiado la contraseña del usuario'
            ]);
    }
}
