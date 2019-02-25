<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use App\Customer;
use Illuminate\Http\Request;
Use Exception;


class BranchOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $branchOffices= BranchOffice::all();
        foreach($branchOffices as $branchOffice){
            $this->valideRelations($branchOffice);
        }

        $response['message'] = 'ok';
        $response['values'] = $branchOffices;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
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

      $response['message'] = 'ok';
      $response['values'] = $branchOffice;
      $response['user_id'] = 'PD';
      return response()->json($response,201);

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
        if(! $branchOffice){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }

        $this->valideRelations($branchOffice);

        $response['message'] = 'ok';
        $response['values'] = $branchOffice;
        $response['user_id'] = 'PD';
        return response()->json($response,200);

    }


    public function showboct($id)
    {
        $branchOffices = BranchOffice::where('customer_id', $id)->get();
        if(! $branchOffices){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }

        foreach($branchOffices as $branchOffice){
            $this->valideRelations($branchOffice);
        }

        $response['message'] = 'ok';
        $response['values'] = $branchOffices;
        $response['user_id'] = 'PD';
        return response()->json($response,200);

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

        try{
            $branchOffice =   BranchOffice::where('id', $id)->first();
            if(! $branchOffice){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = null;
                return response()->json($response,404);
            }
            
            $branchOffice->fill($request->all())->save();
            $this->valideRelations($branchOffice);

        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $branchOffice;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
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
        if(! $branchOffice){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }

        $branchOffice->delete();

        $response['message'] = 'ok';
        $response['values'] = $branchOffice;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
 
    }

    public function valideRelations(BranchOffice $branchoffice)
    {
        if(isset($branchoffice['customer_id']) && !$branchoffice['customer_id'] == null) {
            $custumer = Customer::find($branchoffice->customer_id);
            $branchoffice->customer()->associate($custumer);
        } 
    }
}
