<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!auth()->user()->boss_id == 0) {
            $id_U = auth()->user()->boss_id;
        } else {
            $id_U = auth()->user()->id;
        }

        $patients = Patient::where('user_id', $id_U)->orderBy('surname1', 'ASC')->get();
        \Cache::put('patients', $patients, 60);
        return view('home',compact('patients'));
    }
}
