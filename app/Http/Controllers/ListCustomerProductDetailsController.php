<?php

namespace App\Http\Controllers;

use App\ListCustomerProductDetails;
use Illuminate\Http\Request;
use App\Product;
use App\ListCustomerProduct;
use Exception;

class ListCustomerProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            
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
        try {


            $data = json_decode($request->getContent(), true);
            $first= true;
            foreach($data['values'] as $lcd){
                if($first){
                    $listcts = ListCustomerProductDetails::where('list_customer_product_id',$lcd['list_customer_product_id'])->delete();
                    $first = false;
                }
                $lcd = ListCustomerProductDetails::create($lcd);
                $lcid = $lcd->list_customer_product_id;
            }

            $listcts = ListCustomerProductDetails::where('list_customer_product_id',$lcid)->get();
            foreach($listcts as $listcd){
                $this->valideRelations($listcd);
            }

        } catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
        $response['message'] = 'ok';
         $response['values'] = $listcts;
         $response['user_id'] = 'PD';
         return response()->json($response,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ListCustomerProductDetails  $listCustomerProductDetails
     * @return \Illuminate\Http\Response
     */
    public function show($list_customer_product_id)
    {
        $listcts = ListCustomerProductDetails::where('list_customer_product_id',$list_customer_product_id)->get();
        foreach($listcts as $listcd){
            $this->valideRelations($listcd);
        }
        $response['message'] = 'ok';
        $response['values'] = $listcts;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ListCustomerProductDetails  $listCustomerProductDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ListCustomerProductDetails $listCustomerProductDetails)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListCustomerProductDetails  $listCustomerProductDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListCustomerProductDetails $listCustomerProductDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListCustomerProductDetails  $listCustomerProductDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListCustomerProductDetails $listCustomerProductDetails)
    {
        //
    }

    public function valideRelations(ListCustomerProductDetails $listsCustomerdt)
    {
        
        if(isset($listsCustomerdt['product_id']) && !$listsCustomerdt['product_id'] == null) {
            $product = Product::find($listsCustomerdt->product_id);
            $listsCustomerdt->product()->associate($product);
        } 
        if(isset($listsCustomerdt['list_customer_product_id']) && !$listsCustomerdt['list_customer_product_id'] == null) {
            $lcp = ListCustomerProduct::find($listsCustomerdt->list_customer_product_id);
            $listsCustomerdt->list_customer_product()->associate($lcp);
        }
    }
}
