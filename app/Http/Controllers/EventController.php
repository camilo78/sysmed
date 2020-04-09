<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
    	$events= Event::all()->where('user_id', auth()->user()->id);
    	//dd($events);
        return view('events.index', compact('events'));
    }
}
