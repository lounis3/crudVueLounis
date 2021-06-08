<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarClientes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validate($request, [
            'dni' => 'required|string|max:9|unique:clientes',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|max:9',
            'pais' => 'required|string|max:255',
        ]);
        $clienteAdd = new Cliente;
        $clienteAdd->dni = $request->dni;
        $clienteAdd->nombre = $request->nombre;
        $clienteAdd->apellidos = $request->apellidos;
        $clienteAdd->direccion = $request->direccion;
        $clienteAdd->telefono = $request->telefono;
        $clienteAdd->pais = $request->pais;
        $clienteAdd->save();
        return back()->with('agregar', 'Cliente Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $clientes = Cliente::all();
        return view('listadoClientes')->with('clientes', $clientes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validator = $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
        ]);
        $cliente->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
    }

}
