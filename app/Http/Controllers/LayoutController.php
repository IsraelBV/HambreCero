<?php

namespace App\Http\Controllers;

use App\Models\C_Colonia;
use App\Models\C_Localidad;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LayoutController extends Controller
{
    public function index() {
        return view('layouts.base');
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
