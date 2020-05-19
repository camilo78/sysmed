<?php

namespace App\Http\Controllers;

use App\Consultation;
use App\Patient;
use App\Setting;
use Response as Response;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ConsultationController extends Controller
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
        if ($request->ajax()) {
            $consultations = Consultation::get();
            $count = Consultation::count();
            if ($count == 0) {
                $data = array();
                $obj = json_decode(json_encode($data), FALSE);
                return DataTables::of($obj)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<form class="form-delete" id="' . $row->id . '" action="' . route("consultations.destroy", $row->id) . '" method="POST"><div class="btn-group">' . csrf_field() . method_field('DELETE') . '<a href="' . route('consultations.show', $row->id) . '" data-toggle="tooltip"  title="Editar" class="edit btn btn-outline-info btn-sm"><i class="fas fa-list"></i></a>';
                        $btn = $btn . '<a href="' . route('consultations.edit', $row->id) . '" data-toggle="tooltip"  title="Editar" class="edit btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> <button class="btn btn-outline-danger btn-sm submit" data-id="' . $row->id . '" data-msj="¿Realmente quiere eliminar la consulta de ' . $row->patient . '?"><i class="fas fa-trash-alt"></i></button></div> </form>';
                        return $btn;
                    })
                    ->rawColumns(['action'])->make(true);
            } else {
                foreach ($consultations as $consultation) {
                    $nestedData['id'] = $consultation->id;
                    $nestedData['patient'] = $consultation->patient->name1 . ' ' . $consultation->patient->name2 . ' ' . $consultation->patient->surname1 . ' ' . $consultation->patient->surname2;
                    $nestedData['settings'] = $consultation->setting->name;
                    $nestedData['date'] = date('j M Y', strtotime($consultation->date));
                    $nestedData['hour'] = date('h:i a', strtotime($consultation->date));
                    $data[] = $nestedData;
                    $obj = json_decode(json_encode($data), FALSE);
                }
                // dd($obj);

                return DataTables::of($obj)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<form class="form-delete" id="' . $row->id . '" action="' . route("consultations.destroy", $row->id) . '" method="POST"><div class="btn-group">' . csrf_field() . method_field('DELETE') . '<a href="' . route('consultations.show', $row->id) . '" data-toggle="tooltip"  title="Editar" class="edit btn btn-outline-info btn-sm"><i class="fas fa-list"></i></a>';
                        $btn = $btn . '<a href="' . route('consultations.edit', $row->id) . '" data-toggle="tooltip"  title="Editar" class="edit btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> <button class="btn btn-outline-danger btn-sm submit" data-id="' . $row->id . '" data-msj="¿Realmente quiere eliminar la consulta de ' . $row->patient . '?"><i class="fas fa-trash-alt"></i></button></div> </form>';
                        return $btn;
                    })
                    ->rawColumns(['action'])->make(true);
            }

        }
        return view('consultations.index', compact('data'));
    }

    public function trash(Request $request)
    {

        if ($request->ajax()) {
            $consultations = Consultation::onlyTrashed()->get();
            $count = Consultation::onlyTrashed()->count();
            if ($count == 0) {
                $data = array();
                $obj = json_decode(json_encode($data), FALSE);
                return DataTables::of($obj)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<form class="form-delete" id="' . $row->id . '" action="' . route("consultations.destroy", $row->id) . '" method="POST"><div class="btn-group">' . csrf_field() . method_field('DELETE') . '<a href="' . route('consultations.show', $row->id) . '" data-toggle="tooltip"  title="Editar" class="edit btn btn-outline-info btn-sm"><i class="fas fa-list"></i></a>';
                        $btn = $btn . '<a href="' . route('consultations.edit', $row->id) . '" data-toggle="tooltip"  title="Editar" class="edit btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> <button class="btn btn-outline-danger btn-sm submit" data-id="' . $row->id . '" data-msj="¿Realmente quiere eliminar la consulta de ' . $row->patient . '?"><i class="fas fa-trash-alt"></i></button></div> </form>';
                        return $btn;
                    })
                    ->rawColumns(['action'])->make(true);
            } else {
                foreach ($consultations as $consultation) {
                    $nestedData['id'] = $consultation->id;
                    $nestedData['patient'] = $consultation->patient->name1 . ' ' . $consultation->patient->name2 . ' ' . $consultation->patient->surname1 . ' ' . $consultation->patient->surname2;
                    $nestedData['settings'] = $consultation->setting->name;
                    $nestedData['date'] = date('j M Y', strtotime($consultation->date));
                    $nestedData['hour'] = date('h:i a', strtotime($consultation->date));
                    $data[] = $nestedData;
                    $obj = json_decode(json_encode($data), FALSE);
                }
                // dd($obj);

                return DataTables::of($obj)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<form class="form-delete" id="' . $row->id . '" action="' . route('consultations.restore', $row->id) . '" method="GET"><div class="btn-group">' . csrf_field();
                        $btn = $btn . '<button class="btn btn-outline-warning btn-sm submit" data-id="' . $row->id . '" data-msj="¿Realmente quiere restaurar los datos de ' . $row->patient . '?"><i class="fas fa-trash-restore-alt"></i></button></div></form>';
                        return $btn;
                    })
                    ->rawColumns(['action'])->make(true);
            }

        }
        return view('consultations.trash', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->boss_id == 0) {
            $id_U = auth()->user()->boss_id;
        } else {
            $id_U = auth()->user()->id;
        }

        $patients = Patient::where('user_id', $id_U)->orderBy('surname1', 'ASC')->get();
        $settings = Setting::where('user_id', $id_U)->orderBy('id', 'DESC')->get();
        return view('consultations.create', compact('patients', 'settings'));

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
            'date-hour' => 'required|max:25',
            'setting_id' => 'required|max:25',
            'patient_id' => 'required|max:25',
            'insurace' => 'required|in:no,yes',
            'company' => 'max:25',
            'policy' => 'max:25',
            'relation' => 'max:25',
            'height' => 'max:25',
            'height_unit' => 'max:25',
            'weight' => 'max:25',
            'weight_unit' => 'max:25',
            'temp' => 'max:25',
            'temp_unit' => 'max:50',
            'cranial' => 'max:25',
            'cranial_unit' => 'max:25',
            'waist' => 'max:25',
            'waist_unit' => 'max:25',
            'pressure' => 'max:25',
            'cardiac' => 'max:25',
            'breathing' => 'max:25',
            'breathing' => 'max:25',
        ]);

        Consultation::create($request->all());

        return redirect()->route('consultations.index')->with('info', "El Pasiente " . $request->patient_id . " " . $request->patient_id . " se registró a en el sistema con exito");

    }

    /**
     * search a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $pat = Patient::where('id', $request->id)->get()->last();
            return Response::json($pat);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Consultation $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Consultation $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        if (!auth()->user()->boss_id == 0) {
            $id_U = auth()->user()->boss_id;
        } else {
            $id_U = auth()->user()->id;
        }
        $patients = Patient::where('user_id', $id_U)->orderBy('surname1', 'ASC')->get();
        $settings = Setting::where('user_id', $id_U)->orderBy('id', 'DESC')->get();
        return view('consultations.edit', compact('patients', 'settings','consultation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Consultation $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultation $consultation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Consultation $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return back()->with('info', "Los datos de la consulta de " . $consultation->patient->name1 . " " . $consultation->patient->name2 . " " . $consultation->patient->surname1 . " " . $consultation->patient->suername2 . " fueron eliminados correctamente");
    }

    public function restore($id)
    {
        $restore = Consultation::onlyTrashed()->where('id', $id);
        $restore->restore();
        $consultation = Consultation::find($id);
        return back()->with('info', "Los datos de la consulta de ". $consultation->patient->name1 . " " . $consultation->patient->name2 . " " . $consultation->patient->surname1 . " " . $consultation->patient->suername2 . " fueron restaurados correctamente");
    }
}
