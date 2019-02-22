<?php

namespace App\Http\Controllers;

use App\ListCustomerProduct;
use Illuminate\Http\Request;
use App\Customer;
use App\User;

class ListCustomerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $listsCustomers = ListCustomerProduct::all();

       foreach($listsCustomers as $listsCustomer){
            $listsCustomer = $this->valideRelations($listsCustomer);
       }
       return $listsCustomers;
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
            $user = $request->user();
            if(! $user){
                $request['users_lm_id'] = '1'; 
            }else{
                $request['users_lm_id'] =  $user->id;
            }
                
            $listsCustomer = ListCustomerProduct::create($request->all());
            $this->valideRelations($listsCustomer);
            return $listsCustomer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ListCustomerProduct  $listCustomerProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listsCustomer = ListCustomerProduct::where('id', $id)->first();
        if(! $listsCustomer)
            return abort(404); 
            
        $this->valideRelations($listsCustomer);
        
        return $listsCustomer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ListCustomerProduct  $listCustomerProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ListCustomerProduct $listCustomerProduct)
    {
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListCustomerProduct  $listCustomerProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $listsCustomer = ListCustomerProduct::where('id', $id)->first();
        if(! $listsCustomer)
            return abort(404);

        $listsCustomer->fill($request->all())->save();  
        return $listsCustomer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListCustomerProduct  $listCustomerProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListCustomerProduct $listCustomerProduct)
    {
        $listsCustomer = ListCustomerProduct::where('id', $id)->first();
        if(! $listsCustomer)
            return abort(404);

        $listsCustomer->delete();
        return $listsCustomer;
    }

    public function valideRelations(ListCustomerProduct $listsCustomer)
    {
        if(isset($listsCustomer['customer_id']) && !$listsCustomer['customer_id'] == null) {
            $customer = Customer::find($listsCustomer->customer_id);
            $listsCustomer->customer()->associate($customer);
        } 
        if(isset($listsCustomer['users_lm_id']) && !$listsCustomer['users_lm_id'] == null) {
            $users_lm = User::find($listsCustomer->users_lm_id);
            $listsCustomer->users_lm()->associate($users_lm);
        } 
    }
}
