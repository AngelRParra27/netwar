<?php

namespace App\Http\Controllers;
use App\contactos;
use App\estados;
use Illuminate\Http\Request;

class contactosController extends Controller
{
    
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$estados = estados::all();
    	$contactos = contactos::with('ciudad', 'estado')->get();
        return view('contactos.index', compact('contactos', 'estados'));
    }

    public function getCiudades(Request $request)
    {
    	$estado = estados::find($request->id);
    	return $estado->ciudades;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contactos= contactos::create($request->all());
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $contacto = contactos::with('ciudad', 'estado')
        ->where('id', '=', $id)
        ->first();
        return $contacto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contacto = contactos::findorfail($id);
        $contacto->nombre = $request->nombre;
        $contacto->apellido_paterno = $request->apellido_paterno;
        $contacto->apellido_materno = $request->apellido_materno;
        $contacto->telefono = $request->telefono;
        $contacto->ciudad =$request->ciudad;
        $contacto->estado = $request->estado;
        $contacto->direccion =  $request->direccion;
        $contacto->save();
        return $contacto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
