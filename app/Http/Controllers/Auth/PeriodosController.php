<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\C_Periodo;
use App\Models\C_CentroDeEntrega;
use Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PeriodosController extends Controller
{
    public function managePeriodos()
    {
        if (Auth::check()) {
            if (session()->has('periodo') && session()->has('periodo')) {
                return redirect('/');
            } else {
                 // DB::enableQueryLog();
                $centrosdeentrega  = DB::table('c_centrosdeentrega')
                    ->leftJoin('c_colonias', 'c_centrosdeentrega.id', '=', 'c_colonias.CentroEntregaId')
                    ->leftJoin('c_localidades', 'c_localidades.id', '=', 'c_colonias.LocalidadId')
                    ->leftJoin('c_municipios', 'c_municipios.id', '=', 'c_localidades.MunicipioId')
                    ->where('c_centrosdeentrega.status', 1)
                    ->select('c_centrosdeentrega.id','c_centrosdeentrega.Descripcion','c_municipios.Descripcion as municipio')
                    ->groupBy('c_centrosdeentrega.id','c_centrosdeentrega.Descripcion','c_municipios.Descripcion')
                    ->orderBy('c_centrosdeentrega.Descripcion','asc')
                    ->get();
                // dd(DB::getQueryLog());
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

        $idCentroEntrega = $request->get('centroe');
        $idPeriodo = $request->get('periodo');

        $periodo = C_Periodo::where('id',$idPeriodo)->first();
        $centroEntrega = C_CentroDeEntrega::where('id',$idCentroEntrega)->first();

        $now = Carbon::now();

        $entregas = DB::table('entregas')
        ->select('id')
        ->where('idCentroEntrega', '=',$idCentroEntrega)
        ->where('created_at','>=', $now->toDateString().' 05:00:00')
        ->get();

        session(['periodo' => $idPeriodo, 'periodoNombre' =>$periodo->Descripcion, 'centroEntrega' =>$idCentroEntrega, 'centroEntregaNombre' =>$centroEntrega->Descripcion, 'NumeroDeEntregas' => $entregas->count()]);

        return redirect('/');
    }
}
