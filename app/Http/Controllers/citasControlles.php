<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\citas;
class citasControlles extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
     
        $hoy_citas = citas::with('contacto')->whereDate('fecha', '=', date('Y-m-d'))->orderBy('hora')->get();
        $citas = citas::with('contacto')->orderBy('contacto_id')->get();
        return view('citas.index', compact('citas', 'hoy_citas', 'now'));
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
        $cita = citas::create($request->all());
        return $cita;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $cita = citas::with('contacto')
        ->where('id', '=', $id)
        ->first();
        return $cita;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reporteCitas()
    {
        $canceladas = citas::onlyTrashed()->count();
        $citasTotales= DB::table("citas")
             ->whereMonth('fecha', '=', date('m'))
             ->count();
         $citas= DB::table("citas")
             ->join('contactos', 'citas.contacto_id',  'contactos.id')
             ->whereMonth('fecha', '=', date('m'))
             ->get();    
        return view('citas.reporte', compact('canceladas', 'citasTotales', 'citas'));
    }
    public function reporteCitasMes(Request $request)
    {
        $canceladas= DB::table("citas")
             ->whereMonth('fecha', '=',  $request->mes)
             ->where('status', '=', 2)
             ->count();
        $citasTotales= DB::table("citas")
             ->whereMonth('fecha', '=',  $request->mes)
             ->count();
        $citas= DB::table("citas")
             ->join('contactos', 'citas.contacto_id',  'contactos.id')
             ->whereMonth('fecha', '=', $request->mes)
             ->get();    
      
        return response()->json(["canceladas" => $canceladas, "citasTotales" => $citasTotales, "citas" => $citas]);
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
        $cita = citas::find($id);
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->save();
        return $cita;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = citas::find($id);
        $cita->status = 2;
        $cita->save();
        citas::find($id)->delete();
        return $id;
    }
}
