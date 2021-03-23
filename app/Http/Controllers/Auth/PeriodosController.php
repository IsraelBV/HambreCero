<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\C_Periodo;
use Auth;


class PeriodosController extends Controller
{
    public function managePeriodos()
    {
        if (Auth::check()) {
            if (session()->has('periodo')) {
                return redirect('/');
            } else {
                return view('auth.periodos',['periodos'=> C_Periodo::all()]);
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
