<?php

namespace App\Http\Controllers;

use App\Event as Event;
use App\Patient;
use App\Setting;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PatientsExport;
use App\Imports\PatientsImport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use PDF;

class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!auth()->user()->boss_id == 0) {
            $id_U = auth()->user()->boss_id;
        } else {
            $id_U = auth()->user()->id;
        }
        $patients = Patient::where('user_id', $id_U)->orderBy('id', 'DESC')->get();
        return view('patients.index', compact('patients'));
    }

    public function trash(Request $request)
    {

        $patients = Patient::onlyTrashed()->orderBy('id', 'DESC')->paginate(5);
        return view('patients.trash', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (!is_null(Patient::get()->last())) {
            $id = Patient::get()->last()->id + 1;
            $now = new \DateTime();
        } else {
            $id = '1';
            $now = new \DateTime();
        }

        return view('patients.create', compact('id', 'now'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name1'        => 'required|max:25',
            'name2'        => 'max:25',
            'surname1'     => 'required|max:25',
            'surname2'     => 'max:25',
            'married_name' => 'max:25',
            'gender'       => 'required|in:M,F',
            'birth'        => 'required|before_or_equal:now',
            'patient_code' => 'max:25',
            'document_type'=> 'max:25',
            'document'     => 'max:25',
            'status'       => 'in:active,disabled',
            'name_relation'=> 'max:50',
            'kinship'      => 'max:25',
            'phone1'       => 'max:25',
            'phone2'       => 'max:25',
            'email'        => 'max:50',
            'city_town'    => 'max:255',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')->with('info', "El Pasiente " . $request->name1 . " " . $request->surname1 . " se registró a en el sistema con exito");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        if (!auth()->user()->boss_id == 0) {
            $id_U = auth()->user()->boss_id;
        } else {
            $id_U = auth()->user()->id;
        }
        $now = Carbon::now()->format('Y-m-d H:i:s');
        //  dd($patient->id);
        setlocale(LC_ALL, "es_ES");
        $datos = Event::where([['patient_id', '=', $patient->id], ['user_id', $id_U]])->orderBy('start', 'asc')->get();
        $dates = Event::where([['start', '>', $now], ['patient_id', '=', $patient->id], ['user_id', auth()->user()->id]])->orderBy('start', 'asc')->get();
        return view('patients.show', compact('patient', 'dates', 'datos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $now = new \DateTime();
        $id = $patient->id;
        //dd($patient);
        return view('patients.edit', compact('patient', 'now', 'id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name1'        => 'required|max:25',
            'name2'        => 'max:25',
            'surname1'     => 'required|max:25',
            'surname2'     => 'max:25',
            'married_name' => 'max:25',
            'gender'       => 'required|in:M,F',
            'birth'        => 'required|before_or_equal:now',
            'patient_code' => 'max:25',
            'document_type'=> 'max:25',
            'document'     => 'max:25',
            'status'       => 'in:active,disabled',
            'name_relation'=> 'max:50',
            'kinship'      => 'max:25',
            'phone1'       => 'max:25',
            'phone2'       => 'max:25',
            'email'        => 'max:50',
            'city_town'    => 'max:255',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')->with('info', "El Pasiente " . $request->name1 . " " . $request->surname1 . " se editó con exito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Patient $patient)
    {
        $patient->status = "disabled";
        $patient->update($request->all());
        $patient->delete();
        return back()->with('info', "Los datos de $patient->name1 $patient->surname1 fueron eliminados correctamente");
    }

    public function restore($id)
    {
        $restore = Patient::onlyTrashed()->where('id', $id);
        $restore->restore();
        $patient = Patient::find($id);
        return back()->with('info', "Los datos de $patient->name1 $patient->surname1 fueron restaurados correctamente");
    }


}
