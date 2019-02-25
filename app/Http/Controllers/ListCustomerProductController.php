<?php

namespace App\Http\Controllers;

use App\ListCustomerProduct;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
Use Exception;

class ListCustomerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            
            $listsCustomers = ListCustomerProduct::all();

            foreach($listsCustomers as $listsCustomer){
                $listsCustomer = $this->valideRelations($listsCustomer);
            }

        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $listsCustomers;
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

         
        try{
            $user = $request->user();
            if(! $user){
                $request['users_lm_id'] = '1'; 
            }else{
                $request['users_lm_id'] =  $user->id;
            }
                
            $listsCustomer = ListCustomerProduct::create($request->all());
            $this->valideRelations($listsCustomer);

        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $listsCustomer;
        $response['user_id'] = 'PD';
        return response()->json($response,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ListCustomerProduct  $listCustomerProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $listsCustomer = ListCustomerProduct::where('id', $id)->first();
            if(! $listsCustomer){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = null;
                return response()->json($response,404);
            }
                
            $this->valideRelations($listsCustomer);
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $listsCustomer;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
        
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
       try{
            $listsCustomer = ListCustomerProduct::where('id', $id)->first();
            if(! $listsCustomer){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = null;
                return response()->json($response,404);
            }

            $listsCustomer->fill($request->all())->save();  

        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
    
        $response['message'] = 'ok';
        $response['values'] = $listsCustomer;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    
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
        if(! $listsCustomer){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }

        $listsCustomer->delete();

        $response['message'] = 'ok';
        $response['values'] = $listsCustomer;
        $response['user_id'] = 'PD';
        return response()->json($response,200);

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
