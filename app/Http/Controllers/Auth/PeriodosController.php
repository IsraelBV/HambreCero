<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\C_Periodo;
use App\Models\C_CentroDeEntrega;
use Auth;
use Illuminate\Support\Facades\Validator;


class PeriodosController extends Controller
{
    public function managePeriodos()
    {
        if (Auth::check()) {
            if (session()->has('periodo') && session()->has('periodo')) {
                return redirect('/');
            } else {
                return view('auth.periodos',['periodos'=> C_Periodo::all()],['centros'=> C_CentroDeEntrega::all()]);
            }
        } else {
            return redirect('/');
        }
    }

    public function redirectPeriodos(Request $request)
    {

       Validator::make($request->all(), [
            'periodo' => 'required',
            'centroe' => 'required',
        ])->validate();

        $periodo = C_Periodo::where('id',$request->get('periodo'))->first();
        $centroEntrega = C_CentroDeEntrega::where('id',$request->get('centroe'))->first();
        session(['periodo' => $request->get('periodo'), 'periodoNombre' =>$periodo->Descripcion, 'centroEntrega' =>$request->get('centroe'), 'centroEntregaNombre' =>$centroEntrega->Descripcion]);

        return redirect('/');
    }
}
