<?php

namespace App\Http\Controllers;

use App\Models\C_Periodo;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return redirect('/admin/entrega');
        return redirect('/');
        //return view('home');
    }

    public function managePeriodos()
    {
        if (Auth::check()) {
            if (session()->has('periodo')) {
                return redirect('/');
            } else {
                return view('layouts.periodos',['periodos'=> C_Periodo::all()]);
            }
        } else {
            return redirect('/');
        }
    }

    public function redirectPeriodos(Request $request)
    {
        $periodo = C_Periodo::where('id',$request->get('periodo'))->first();
        session(['periodo' => $request->get('periodo'), 'periodoNombre' =>$periodo->Descripcion]);

        return redirect('/');
    }
}
