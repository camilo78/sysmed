<?php
namespace App\Http\Controllers;
use App\Event;
use App\Patient;
use App\Setting;
use Illuminate\Http\Request;
use Redirect, Response;
class EventController extends Controller
{
    public function index()
    {
        $data = Event::where('user_id', auth()->user()->id)->get()->toJson();
        $patients = Patient::where('user_id', auth()->user()->id)->orderBy('surname1', 'ASC')->get();
        $settings = Setting::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        
        return view('events/index',compact('patients','settings'))->with('data', $data);
    }
    public function create(Request $request)
    {
        $insertArr = ['title' => $request->title, 'description' => $request->description, 'start' => $request->start, 'end' => $request->end, 'user_id' => auth()->user()->id, 'patient_id' => $request->patient_id, 'color' => $request->color, 'created_at' => now()];
        $event = Event::insert($insertArr);
        $eve = Event::where('user_id', auth()->user()->id)->get()->last();
        return Response::json($eve);
    }
    public function update(Request $request)
    {
        $where = array(
            'id' => $request->id
        );
        $updateArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end];
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