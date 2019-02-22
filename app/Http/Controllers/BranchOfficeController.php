<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use App\Customer;
use Illuminate\Http\Request;

class BranchOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $branchOffices= BranchOffice::all();
        foreach($branchOffices as $branchOffice){
            $this->valideRelations($branchOffice);
        }

        return $branchOffices;
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
      $branchOffice =   BranchOffice::create($request->all());
      $this->valideRelations($branchOffice);
      return   $branchOffice;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branchOffice = BranchOffice::where('id', $id)->first();
        if(! $branchOffice)
            return abort(404);

        $this->valideRelations($branchOffice);
        return   $branchOffice; 
    }


    public function showboct($id)
    {
        $branchOffices = BranchOffice::where('customer_id', $id)->get();
        if(! $branchOffices)
            return abort(404);

        foreach($branchOffices as $branchOffice){
            $this->valideRelations($branchOffice);
        }

        return   $branchOffices; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function edit(BranchOffice $branchOffice)
    {
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $branchOffice =   BranchOffice::where('id', $id)->first();
        if(! $branchOffice)
            return abort(404);
        
        $branchOffice->fill($request->all())->save();
        $this->valideRelations($branchOffice);
        return   $branchOffice; 
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branchOffice =   BranchOffice::where('id', $id)->first();
        if(! $branchOffice)
            return abort(404);
        
        $branchOffice->delete();
        return $branchOffice;    
    }

    public function valideRelations(BranchOffice $branchoffice)
    {
        if(isset($branchoffice['customer_id']) && !$branchoffice['customer_id'] == null) {
            $custumer = Customer::find($branchoffice->customer_id);
            $branchoffice->customer()->associate($custumer);
        } 
    }
}
