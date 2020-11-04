<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\C_GrupoSocial;

class LayoutController extends Controller
{
    public function index() {
        return view('layouts.base');
    }

    // public function LectorExel(Request $request) {
    //     $file = $request->file('file');
        
    //     $theArray = Excel::toArray([], $file);
        
        
    //     foreach($theArray[10] as $qwer){
            
    //         // echo '<pre>';
    //         // var_dump($qwer[0]);
    //         // echo '</pre>---------------';
            
    //         $report = new C_GrupoSocial();
    //         $report->Descripcion = $qwer[0];
    //         $report->save();
    //     }
        
    //     return view();
    // }
}
