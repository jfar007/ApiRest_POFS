<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Profile;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::all();

        foreach ( $customers as $customer)
        {
            $customer= $this->valideRelations($customer);   
        }
        return $customers;
  
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
        $customer = Customer::create($request->all());

        $this->valideRelations($customer);

        
        return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer=Customer::where('id', $id)->first();
        if(! $customer)
            return abort(404, 'Not Found');
    

        $this->valideRelations($customer);
     
        
        return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $customer=Customer::where('id', $id)->first();
        if(! $customer)
            return abort(404, 'Not Found');

        $customer->fill($request->all())->save();

        $this->valideRelations($customer);
  
        

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer=Customer::where('id', $id)->first();
        if(! $customer)
            return abort(404, 'Not Found');
    
        $customer->delete();
        return $customer;
    }


    
    public function valideRelations(Customer $customer)
    {
        if(isset($customer['profile_id']) && !$customer['profile_id'] == null) {
            $profile = Profile::find($customer->profile_id);
            $customer->profile()->associate($profile);
        } 
    }
}
