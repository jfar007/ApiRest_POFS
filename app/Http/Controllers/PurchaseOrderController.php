<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    // Evaluar todas las sucursales de cada uno de los clientes c/u de los siguientes criterios: 
        //1. Al crear el pedido
        // 1. Determinar perfil del cliente
        // 2. Determinar fecha corte (Tener en cuenta la fecha apartir de) 1. 
        // 3. Determinar si ya existe un pedido con la fecha de corte establecida (Pendiente ver si es en memoria o peticiones a la DB)
        // 3.1 Si, si no crea pedido  
        // 3.2 No, Crea pedido y verifica si existe uno anterior en estado creado y lo cambia a estado (no confirmado) 
        // 4. Evalua si se debe cambiar estado o sirve el actual
        // 
        // 2. Al enviar email
        // 1. Evaluar apartir de 
        // 2. Enviar mail 
        

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }



        
        
}
