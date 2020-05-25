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
use Yajra\DataTables\DataTables;
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
        
         if ($request->ajax()) {
            $patients = patient::where('user_id', $id_U)->get();
            $count = patient::where('user_id', $id_U)->count();

            if ($count == 0) {
                $data = array();
                $obj = json_decode(json_encode($data), FALSE);
                return DataTables::of($obj)->addIndexColumn()
                    ->rawColumns(['action'])->make(true);
            } else {
                foreach ($patients as $patient) {

                    if(\Carbon\Carbon::parse($patient->birth)->age === 0)
                    { 
                        $date = \Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m m + %d d');
                    }elseif(\Carbon\Carbon::parse($patient->date)->age < 3){
                        $date = \Carbon\Carbon::parse($patient->birth)->age .' A '.\Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m m');
                    }

                    $nestedData['id'] = $patient->id;
                    $nestedData['name'] = ucwords($patient->name1.' '.$patient->name2.' '.$patient->surname1. ' ' .$patient->surname2);
                    $nestedData['gender'] = $patient->gender;
                    $nestedData['document'] = __($patient->document_type) .' '. $patient->document;
                    $nestedData['age'] = $date;
                    $nestedData['status'] = $patient->status;
                    $nestedData['phone1'] = $patient->phone1;
                    $nestedData['email'] = $patient->email;
                    $nestedData['phone2'] = $patient->phone2;
                    $nestedData['patient_code'] = $patient->patient_code;
                    $data[] = $nestedData;
                    $obj = json_decode(json_encode($data), FALSE);
                }
                // dd($obj);

                return DataTables::of($obj)->addIndexColumn()
                        ->addColumn('email', function ($row) {
                        $btn = (!empty($row->email)) ? '<a class="text-decoration-none" href="mailto:"'.$row->email.'">'.$row->email .'</a>' : 'Sin Email';
                        return $btn;
                        })
                        ->addColumn('status', function ($row) {
                        $btn = ($row->status === "Active") ? '<spam class="font-weight-bold" style="color: #1cc88a" >Activo</spam>' : 'Inactivo';
                        return $btn;
                        })
                        ->addColumn('phone', function ($row) {
                        $btn = (!empty($row->phone1 or $row->phone2)) ? '<a class="text-decoration-none" href="tel:"'.$row->phone1.'">'.$row->phone1 .'</a></br><a class="text-decoration-none" href="tel:"'.$row->phone2.'">'.$row->phone2 .'</a>' : 'Sin Teléfonos';
                        return $btn;
                        })
                        ->addColumn('patient_code', function ($row) {
                        $btn = '<a href="' . route('patients.show', $row->id) . '" data-toggle="tooltip"  title="Codigo paciente" class="text-warning text-decoration-none"><i class="fas fa-folder-open"></i> '.$row->patient_code .'</a> ';
                        return $btn;
                        })
                        ->addColumn('action', function ($row) {
                        $btn = '<form class="form-delete" id="' . $row->id . '" action="' . route("patients.destroy", $row->id) . '" method="POST">'. csrf_field() . method_field('DELETE') . '<div class="btn-group"><a href="' . route('patients.show', $row->id) . '" data-toggle="tooltip"  title="Editar" class="edit btn btn-outline-info btn-sm"><i class="fas fa-list"></i></a>';
                        $btn = $btn . '<a href="' . route('patients.edit', $row->id) . '" data-toggle="tooltip"  title="Editar" class="edit btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> <button class="btn btn-outline-danger btn-sm submit" data-id="' . $row->id . '" data-msj="¿Realmente quiere eliminar la consulta de ' . $row->name  . '?"><i class="fas fa-trash-alt"></i></button></div> </form>';
                        return $btn;
                        })
                        ->rawColumns(['phone','email','status','patient_code','action'])->make(true);
            }

        }
        return view('patients.index');
    }

    public function trash(Request $request)
    {
        if (!auth()->user()->boss_id == 0) {
            $id_U = auth()->user()->boss_id;
        } else {
            $id_U = auth()->user()->id;
        }
        
        if ($request->ajax()) {
            $patients = patient::where('user_id', $id_U)->onlyTrashed()->get();
            $count = patient::where('user_id', $id_U)->onlyTrashed()->count();

            if ($count == 0) {
                $data = array();
                $obj = json_decode(json_encode($data), FALSE);
                return DataTables::of($obj)->addIndexColumn()
                    ->rawColumns(['action'])->make(true);
            } else {
                foreach ($patients as $patient) {

                    if(\Carbon\Carbon::parse($patient->birth)->age === 0)
                    { 
                        $date = \Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m m + %d d');
                    }elseif(\Carbon\Carbon::parse($patient->date)->age < 3){
                        $date = \Carbon\Carbon::parse($patient->birth)->age .' A '.\Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m m');
                    }

                    $nestedData['id'] = $patient->id;
                    $nestedData['name'] = ucwords($patient->name1.' '.$patient->name2.' '.$patient->surname1. ' ' .$patient->surname2);
                    $nestedData['gender'] = $patient->gender;
                    $nestedData['document'] = __($patient->document_type) .' '. $patient->document;
                    $nestedData['age'] = $date;
                    $nestedData['status'] = $patient->status;
                    $nestedData['phone1'] = $patient->phone1;
                    $nestedData['email'] = $patient->email;
                    $nestedData['phone2'] = $patient->phone2;
                    $nestedData['patient_code'] = $patient->patient_code;
                    $data[] = $nestedData;
                    $obj = json_decode(json_encode($data), FALSE);
                }
                // dd($obj);

                return DataTables::of($obj)->addIndexColumn()
                        ->addColumn('email', function ($row) {
                        $btn = (!empty($row->email)) ? '<a class="text-decoration-none" href="mailto:"'.$row->email.'">'.$row->email .'</a>' : 'Sin Email';
                        return $btn;
                        })
                        ->addColumn('status', function ($row) {
                        $btn = ($row->status === "Active") ? '<spam class="font-weight-bold" style="color: #1cc88a" >Activo</spam>' : 'Inactivo';
                        return $btn;
                        })
                        ->addColumn('phone', function ($row) {
                        $btn = (!empty($row->phone1 or $row->phone2)) ? '<a class="text-decoration-none" href="tel:"'.$row->phone1.'">'.$row->phone1 .'</a></br><a class="text-decoration-none" href="tel:"'.$row->phone2.'">'.$row->phone2 .'</a>' : 'Sin Teléfonos';
                        return $btn;
                        })
                        ->addColumn('patient_code', function ($row) {
                        $btn = '<a href="' . route('patients.show', $row->id) . '" data-toggle="tooltip"  title="Codigo paciente" class="text-warning text-decoration-none"><i class="fas fa-folder-open"></i> '.$row->patient_code .'</a> ';
                        return $btn;
                        })
                        ->addColumn('action', function ($row) {
                        $btn = '<form class="form-delete" id="' . $row->id . '" action="' . route('patients.restore', $row->id) . '" method="GET">'.csrf_field();
                        $btn = $btn . '<button class="btn btn-outline-warning btn-sm submit" data-id="' . $row->id . '" data-msj="¿Realmente quiere restaurar los datos de ' . $row->name . '?"><i class="fas fa-trash-restore-alt"></i></button></div></form>';
                        return $btn;
                        })
                        ->rawColumns(['phone','email','status','patient_code','action'])->make(true);
            }

        }
        return view('patients.trash');
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
            'civil'        => 'in:Single,Married',
            'birth'        => 'required|before_or_equal:now',
            'patient_code' => 'max:25',
            'document_type'=> 'in:No document,ID number,Passport',
            'document'     => 'max:25',
            'status'       => 'in:active,disabled',
            'name_relation'=> 'max:50',
            'kinship'      => 'in:No responsible,Spouse,Mother,Father,Partner,Son or Daughter, Aunt or Uncle,Cousin,Other',
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
            'civil'        => 'required|in:Single,Married',
            'birth'        => 'required|before_or_equal:now',
            'patient_code' => 'max:25',
            'document_type'=> 'required|in:No document,ID number,Passport',
            'document'     => 'max:25',
            'status'       => 'required|in:active,disabled',
            'name_relation'=> 'max:50',
            'kinship'      => 'required|in:No responsible,Spouse,Mother,Father,Partner,Son or Daughter,Aunt or Uncle,Cousin,Other',
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
