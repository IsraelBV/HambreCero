<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

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
        return view('usuarios.index',['users'=>User::where('status',1)->get()]);
    }

    public function deshabilitarUsuario($id){
        $usuario = User::where('id',$id)->first();
        
        $usuario->status = 0;
        $usuario->save();
    }

    public function editarUsuario($id){
       
        return view('usuarios.editarUsuario',[
            'usuario'=>  $usuario = User::where('id',$id)->first()
            ]);
    }

    public function actualizarUsuario(Request $request, $id){
        $usuario = User::where('id',$id)->first();
        
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        if ($request->get('password') != null) {
            $usuario->password =  Hash::make($request->get('password'));
        }
        $usuario->tipoUsuarioId = $request->get('usertype');
        // $usuario->save();
        return view('auth.registersuccess');
    }
}
