<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

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

		return redirect()->route('patients.index')->with('info', "El Pasiente " . $request->name1 . " " . $request->surname1 . "se registró a en el sistema con exito");
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
		return view('patients.edit', compact('now', 'id')); 

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
