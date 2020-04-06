<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Caffeinated\Shinobi\Models\Role;
use Carbon\Carbon;
use Jenssegers\Date\Date; 
use PDF;
use App\User;
use App\Setting;


class UserController extends Controller
{   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::search($request->name)->orderBy('id', 'DESC')->paginate(5);


        return view('users.index', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportxlsx()
    {
        return Excel::download(new UsersExport, 'Usuarios.xlsx');
    }

    public function exportPDF(User $user)
    {
        $users = User::all();
        $settings = Setting::all();
        \Date::setLocale('es');
        $data = Carbon::now();
        $date = Date::parse($data)->format('l j F Y');
        $pdf = PDF::loadView('pdfs.Usuarios', compact('users', 'date', 'settings'));

        return $pdf->download('Usuarios.pdf');
    }

    public function trash(Request $request)
    {

        $users = User::search($request->name)->onlyTrashed()->paginate(5);
        return view('users.trash', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::get();
        return view('users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required| min:6',
            'password_confirm' => 'required|same:password',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.unique' => 'Ya existe un usuario con este email',
            'phone.required' => 'El campo teléfono es obligatorio',
        ]);

        $user = User::create($request->all());

        $user->roles()->sync($request->get('roles'));

        return redirect()->route('users.index')->with('info', "Se registró a $user->name en el sistema con exito");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Editar Usuario
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.unique' => 'Ya existe un usuario con este email',
            'phone.required' => 'El campo teléfono es obligatorio',
        ]);

        $user->update($request->all());

        //Asignar rol

        $user->roles()->sync($request->get('roles'));

        return redirect()->route('users.index')->with('info', "Los datos de $request->name se editaron con exito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('info', "Los datos de $user->name fueron eliminados correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $restore = User::onlyTrashed()->where('id', $id);
        $restore->restore();
        $user = User::find($id);
        return back()->with('info', "Los datos de $user->name fueron restaurados correctamente");
    }
}
