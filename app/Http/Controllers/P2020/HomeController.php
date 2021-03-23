<?php

namespace App\Http\Controllers\P2020;

use App\Http\Controllers\Controller;

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
}
