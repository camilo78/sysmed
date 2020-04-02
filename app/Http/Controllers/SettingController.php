<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $count = Setting::where('user_id',auth()->user()->id)->count();

        //dd($count);
        if($count < 1){
            return view('settings.create');
        }elseif($count < 2){
            $setting = Setting::get()->where('user_id',auth()->user()->id)->first();
            return view('settings.index', compact('setting'));
        }else{
            $settings = Setting::search($request->name)->where('user_id',auth()->user()->id)->paginate(5);
            return view('settings.indext', compact('settings'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Setting $setting)
    {

        return view('settings.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Setting $setting)
    {
        $this->validate($request, [
            'image' => 'mimes:jpeg,jpg,png,gif|nullable|max:500',//max 500kb
            'name' => 'required'
        ],[
            'name.required' => 'El campo nombre es obligatorio',
        ]);

            // file upload
        if($request->hasFile('image')){
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // get file name
            $filename = $request->name;
            // get extension
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'.'.$extension;
            // upload
            $path = $request->file('image')->storeAs('public', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }


        //create clínica
        $setting = new Setting;
        $setting->user_id = Auth()->user()->id;
        $setting->name = $request->input('name');
        $setting->image = $fileNameToStore;
        $setting->phone = $request->input('phone');
        $setting->web = $request->input('web');
        $setting->address = $request->input('address');
        $setting->save();

        return redirect()->route('settings.index')->with('info', "Se registró la clínica $setting->name en el sistema con exito");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
       $this->validate($request, [
            'image' => 'mimes:jpeg,jpg,png,gif|nullable|max:500',//max 500kb
            'name' => 'required'
        ],[
            'name.required' => 'El campo nombre es obligatorio',
        ]);
       // dd($request->hasFile('image'));
            // file upload
        if($request->hasFile('image')){

            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            // get file name
            $filename = $request->name;
            // get extension
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = $filename.'.'.$extension;
            // upload
            $path = $request->file('image')->storeAs('public', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //dd($setting->image);
        //create clínica
        $setting->user_id = Auth()->user()->id;
        $setting->name = $request->input('name');
        if($request->hasFile('image') == true){
           
            $setting->image = $fileNameToStore;
            
        }

        $setting->phone = $request->input('phone');
        $setting->web = $request->input('web');
        $setting->address = $request->input('address');
        $setting->update();

        return redirect()->route('settings.index')->with('info', "Se registró la clínica $setting->name en el sistema con exito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $image =  public_path('storage/').$setting->image;
        if (@getimagesize($image)) {
            unlink($image);
            $setting->delete();
            return back()->with('info', "Los datos de $setting->name fueron eliminados correctamente");
        }else{
            $setting->delete();
            return back()->with('info', "Los datos de $setting->name fueron eliminados correctamente");
        }
    }
}
