<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::paginate();
       // dd($role);
        return view('roles.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        $permissions = Permission::get();
        return view('roles.create', compact('role','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Role $role)
    {
       // Editar rol
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'slug.unique' => 'El campo Url es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
        ]);

        $role = Role::create($request->all());

        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')->with('info', "Se registró el rol $role->name en el sistema con exito");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view('roles.show', ['role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        return view('roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // Editar Usuario
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'slug.unique' => 'El campo Url es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
        ]);

        $role->update($request->all());

        //Asignar rol

        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')->with('info', "Los datos del Rol $request->name se editaron con exito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
       $role->delete();
        return back()->with('info', "El rol $role->name fue eliminado correctamente");
    }
}
