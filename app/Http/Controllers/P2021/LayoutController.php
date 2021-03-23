<?php

namespace App\Http\Controllers\P2020;

use App\Http\Controllers\Controller;

use App\Models\C_Colonia;
use App\Models\C_Localidad;
use App\Models\Entrega;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;

use Auth;

class LayoutController extends Controller
{
    public function index() {
        return view('2020.layouts.base');
    }

    public function direccion(){
        if (Auth::check()) {
            if (Auth::user()->id != 1){
                return redirect('home');
            } 
        } else {
            return redirect('home');
        }

        $direcciones  = DB::table('entregas')
        ->select('entregas.id','entregas.direccion','entregas.ColoniaId','entregas.Lote','entregas.Manzana','entregas.Calle','entregas.NoExt','entregas.NoInt')
        ->where('entregas.id','<=','14082')
        ->get();


        $i = 0;
        $x = 0;
        foreach ($direcciones as $key) {
            $direccion = $key->direccion;
            $idtemporal = $key->id;
            $coloniaId =  $key->ColoniaId;
            $Manzana = $key->Manzana;
            $Lote = $key->Lote;
            $Calle = $key->Calle;
            $NoExt = $key->NoExt;
            $NoInt = $key->NoInt;


            $temporal = explode(' Mz.',$direccion);
            $coloniaconcat =  $temporal[0];
            if ($coloniaconcat != 'N/D') {
                $iddir  = DB::table('c_colonias')
                    ->select('c_colonias.id')
                    ->where('c_colonias.Descripcion',$coloniaconcat)
                    ->get();
                $iddir = $iddir[0]->id;
            } else {
                $iddir = NULL;
            } 
            $coloniaIDconcat = $iddir;

            $temporal = explode(' Lt.',$temporal[1]);
            $Manzanaconcat = $temporal[0] == 'N/D'?NULL: $temporal[0];

            $temporal = explode(' Calle: ',$temporal[1]);
            $Loteconcat = $temporal[0] == 'N/D'?NULL: $temporal[0];

            $temporal = explode(' NoExt: ',$temporal[1]);
            $Calleconcat = $temporal[0] == 'N/D'?NULL: $temporal[0];

            $temporal = explode(' NoInt: ',$temporal[1]);
            $NoExtconcat = $temporal[0] == 'N/D'?NULL: $temporal[0];

            $NoIntconcat = $temporal[1] == 'N/D'?NULL: $temporal[1];
            
             
            if ($coloniaId == $coloniaIDconcat && $Manzanaconcat == $Manzana && $Loteconcat == $Lote && $Calleconcat == $Calle && $NoExtconcat == $NoExt && $NoIntconcat == $NoInt) {
                $i++;
                // echo '<pre>';
                // echo '----<br>';
                // echo 'ITERACION: '.$i;
                // echo '<br>';
                // echo 'ID ENTREGA: '.$idtemporal;
                // echo '----<br><br>'; 
                // echo'</pre>';
            } else {
                $x ++;
                $entrega = Entrega::find($idtemporal);
                
                $entrega->ColoniaId = $coloniaIDconcat;
                $entrega->Manzana = $Manzanaconcat;
                $entrega->Lote = $Loteconcat;
                $entrega->Calle = $Calleconcat;
                $entrega->NoExt = $NoExtconcat;
                $entrega->NoInt = $NoIntconcat;
                $entrega->save();

                echo 'ID ENTREGA: '.$idtemporal;
                echo '<br>';
                var_dump(' COLONIA ID: '.$coloniaIDconcat.' / '.$coloniaId);
                echo '<br>';
                var_dump('MZ: '.$Manzanaconcat.' / '.$Manzana);
                echo '<br>';
                var_dump('LT: '.$Loteconcat.' / '.$Lote);
                echo '<br>';
                var_dump('CALLE: '.$Calleconcat.' / '.$Calle);
                echo '<br>';
                var_dump('NOEXT: '.$NoExtconcat.' / '.$NoExt);
                echo '<br>';
                var_dump('NOINT: '.$NoIntconcat.' / '.$NoInt);
                echo '<br>';
                echo '----------------------------<br>';
                echo '<br>';
            }
        }
        echo 'Cambiados:'.$x;
            echo '<br/>';
            echo 'iguales:'.$i;
    }

    // public function LectorExel(Request $request) {
    //     $file = $request->file('file');
        
    //     $theArray = Excel::toArray([], $file);
        
    //     foreach($theArray[1] as $qwer){
            
    //         // echo '<pre>';
    //         // var_dump($qwer[0]." - ".$qwer[1]);
    //         // var_dump(C_Localidad::where("Descripcion","=", $qwer[1])->first()->id);
    //         // echo '</pre>---------------';
            
    //         $report = new C_Colonia();
    //         $report->Descripcion = $qwer[0];
    //         $report->LocalidadId = C_Localidad::where("Descripcion","=", $qwer[1])->first()->id;
    //         $report->save();
    //     }
        
    //     return view();
    // }
}
