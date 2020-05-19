<?php

namespace App\Http\Controllers;

use App\Event;
use App\Patient;
use App\Setting;
use Illuminate\Http\Request;
use Redirect, Response;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->boss_id == 0) {
            $id_U = auth()->user()->boss_id;
        } else {
            $id_U = auth()->user()->id;
        }

        $data = Event::where('user_id', $id_U)->get()->toJson();
        $patients = Patient::where('user_id', $id_U)->orderBy('surname1', 'ASC')->get();
        $settings = Setting::where('user_id', $id_U)->orderBy('id', 'DESC')->get();

        return view('events/index', compact('patients', 'settings'))->with('data', $data);
    }

    public function create(Request $request)
    {
        if (!auth()->user()->boss_id == 0) {
            $id_U = auth()->user()->boss_id;
        } else {
            $id_U = auth()->user()->id;
        }
        $insertArr = ['title' => $request->title, 'description' => $request->description, 'start' => $request->start, 'end' => $request->end, 'user_id' => $id_U, 'patient_id' => $request->patient_id, 'color' => $request->color, 'created_at' => now()];
        Event::insert($insertArr);
        $eve = Event::where('user_id', $id_U)->get()->last();
        return Response::json($eve);
    }

    public function update(Request $request)
    {
        $where = array(
            'id' => $request->id
        );
        $updateArr = ['start' => $request->start, 'end' => $request->end];
        $event = Event::where($where)->update($updateArr);
        return Response::json($event);
    }

    public function destroy(Request $request)
    {
        $event = Event::where('id', $request->id)
            ->delete();
        return Response::json($event);
    }
}
