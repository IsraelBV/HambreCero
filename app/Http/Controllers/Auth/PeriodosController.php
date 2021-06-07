<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\C_Periodo;
use App\Models\C_CentroDeEntrega;
use Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;


class PeriodosController extends Controller
{
    public function managePeriodos()
    {
        if (Auth::check()) {
            if (session()->has('periodo') && session()->has('periodo')) {
                return redirect('/');
            } else {
                $centrosdeentrega  = DB::table('c_centrosdeentrega') 
                    ->leftJoin('c_colonias', 'c_centrosdeentrega.id', '=', 'c_colonias.CentroEntregaId')
                    ->leftJoin('c_localidades', 'c_localidades.id', '=', 'c_colonias.LocalidadId')
                    ->leftJoin('c_municipios', 'c_municipios.id', '=', 'c_localidades.MunicipioId')
                    ->select('c_centrosdeentrega.id','c_centrosdeentrega.Descripcion','c_municipios.Descripcion as municipio')
                    ->groupBy('c_centrosdeentrega.id','c_centrosdeentrega.Descripcion','c_municipios.Descripcion')
                    ->get();

                    // dd($centrosdeentrega);

                return view('auth.periodos',['periodos'=> C_Periodo::all()],['centros'=> $centrosdeentrega]);
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
