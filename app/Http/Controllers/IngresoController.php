<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
        //
        $ingresos = Compra::all();
        return view('control.compras.ingresos.index', compact('ingresos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ingreso = new Compra();
        return view('control.compras.ingresos.create', compact('ingreso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            DB::beginTransaction();
            $ingreso = new Compra();
            $ingreso->fecha = $request->fecha;
            $ingreso->user_id = $request->user_id;
            $ingreso->proveedore_id = $request->proveedore->id;
            $ingreso->codComprobante = $request->codComprobante;
            $ingreso->tipoComprobante = $request->tipoComprobante;
            $ingreso->save();
            DB::commit();
        } catch (\Throwable $th){
            //throw $th;
            DB::rollBack();
            return Redirect::route('control.compras.ingresos.index')
            ->with('error','ocurrió un error al intentar guardar los datos');
        }
        return Redirect::route('control.compras.ingresos.index')
        ->with('info', 'los datos se guardaron correctamente');
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
    public function edit($id)
    {
        //
        $ingreso = Compra::findOrFail($id);
        return view('control.compras.ingresos.edit', compact('ingreso'));
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
        //
        try{
            DB::beginTransaction();
            $ingreso = Compra::findOrFaild($id);
            $ingreso->fecha = $request->fecha;
            $ingreso->user_id = $request->user_id;
            $ingreso->proveedore_id = $request->proveedore->id;
            $ingreso->codComprobante = $request->codComprobante;
            $ingreso->tipoComprobante = $request->tipoComprobante;
            $ingreso->update();
            DB::commit();
        } catch (\Throwable $th){
            //throw $th;
            DB::rollBack();
            return Redirect::route('control.compras.ingresos.index')
            ->with('error','ocurrió un error al intentar actualizar los datos');
        }
        return Redirect::route('control.compras.ingresos.index')
        ->with('info', 'los datos se actualizaron correctamente');
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
        try{
            DB::beginTransaction();
            $ingreso = Compra::findOrFaild($id);
            $ingreso -> delete();
            DB::commit();
        } catch (\Throwable $th){
            //throw $th;
            DB::rollBack();
            return Redirect::route('control.compras.ingresos.index')
            ->with('error','ocurrió un error al intentar eliminar los datos');
        }
        return Redirect::route('control.compras.ingresos.index')
        ->with('info', 'los datos se eliminaron correctamente');
    }
}
