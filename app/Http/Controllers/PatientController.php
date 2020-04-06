<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Setting;
use App\Exports\PatientsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Jenssegers\Date\Date; 
use PDF;

class PatientController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$patients = Patient::search($request->name)->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(5);

		return view('patients.index', compact('patients'));
	}

	public function exportPDF(Patient $patient)
    {
        $patients = Patient::all();
        $settings = Setting::all();
        \Date::setLocale('es');
        $data = Carbon::now();
        $date = Date::parse($data)->format('l j F Y');
        $pdf = PDF::loadView('pdfs.Pacientes', compact('patients', 'date', 'settings'))->setPaper('a4', 'landscape');

        return $pdf->download('Paciente.pdf');
    }

    public function exportxlsx()
    {
        return Excel::download(new PatientsExport, 'Paciente.xlsx');
    }

	public function trash(Request $request)
    {

        $patients = Patient::search($request->name)->onlyTrashed()->orderBy('id', 'DESC')->paginate(5);
        return view('patients.trash', compact('patients'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

		if (!is_null(Patient::get()->last())) {
			$id = Patient::get()->last()->id + 1;
			$now = new \DateTime();
		} else {
			$id = '1';
			$now = new \DateTime();
		}

		//dd($id);
		return view('patients.create', compact('id', 'now'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$request->validate([
			'name1' => 'required',
			'surname1' => 'required',
			'gender' => 'required',
			'birth' => 'required|before_or_equal:now',
		], [
			'birth.before_or_equal' => 'La fecha de nacimiento debe ser anterior o igual a la fecha de hoy.',
		]);

		$patient = Patient::create($request->all());

		return redirect()->route('patients.index')->with('info', "El Pasiente " . $request->name1 . " " . $request->surname1 . " se registró a en el sistema con exito");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Patient $patient) {
		return view('patients.show', compact('patient'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Patient $patient) {
		$now = new \DateTime();
		$id = $patient->id;
		//dd($patient);
		return view('patients.edit', compact('patient', 'now', 'id')); 

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Patient $patient) {
		$request->validate([
			'name1' => 'required',
			'surname1' => 'required',
			'gender' => 'required',
			'birth' => 'required|before_or_equal:now',
		], [
			'birth.before_or_equal' => 'La fecha de nacimiento debe ser anterior o igual a la fecha de hoy.',
		]);

		$patient->update($request->all());

		return redirect()->route('patients.index')->with('info', "El Pasiente " . $request->name1 . " " . $request->surname1 . " se editó con exito");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Patient $patient) {
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
