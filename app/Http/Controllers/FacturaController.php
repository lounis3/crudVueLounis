<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Factura::get();
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
        $validator = $this->validate($request, [
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:500',
            'precioTotal' => 'required|decimal'
        ]);
        $facturaAdd = new Factura;
        $facturaAdd->id_factura = $request->id_factura;
        $facturaAdd->fecha = $request->fecha;
        $facturaAdd->descripcion = $request->descripcion;
        $facturaAdd->precioTotal = $request->precioTotal;
        $facturaAdd->cliente_id = $request->cliente_id;
        $facturaAdd->save();
        return back()->with('agregar', 'Factura Agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        $facturas = Factura::all();
        return view('listadoFacturas')->with('facturas', $facturas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        $factura->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        $factura->delete();
    }
}
