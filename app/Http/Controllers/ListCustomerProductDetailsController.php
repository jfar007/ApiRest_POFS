<?php

namespace App\Http\Controllers;

use App\ListCustomerProductDetails;
use Illuminate\Http\Request;
use App\Product;
use App\ListCustomerProduct;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

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
    public function storeJson(Request $request)
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

    public function store(Request $request)
    {
        try {

            $lcd = ListCustomerProductDetails::create($request);
            $this->valideRelations($lcd);

        } catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
        $response['message'] = 'ok';
         $response['values'] = $lcd;
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
       
        if(! $listcts){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }

        foreach($listcts as $listcd){
            $this->valideRelations($listcd);
        }
        $response['message'] = 'ok';
        $response['values'] = $listcts;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }

    public function showSuggest(Request $request)
    {
        try{
        $user = null;
          
                // Log::info('$filter: '. $filter);
        if ($request->session()->exists('user')) {

        $user = $request->session()->get('user');
       
        
        }else if ($request->user()){    
        $user = $request->$request->user();
  
        }
        if($user){

                $filter = [
                    'active' => 1,
                    'suggest' => 1
                ];
                $listcts = DB::table('list_customer_product')
                ->select('list_customer_product_details.*')
                ->leftJoin('list_customer_product_details', 'list_customer_product.id', '=', 'list_customer_product_details.list_customer_product_id')
                ->where('list_customer_product.customer_id',  $user->customer_id)
                ->when( $filter,function ($query, $filter) {
                    $query->where('list_customer_product_details.active', '=',  $filter['active'])
                        ->where('list_customer_product_details.suggest', '=',  $filter['suggest']);})
                ->orderBy('list_customer_product_details.priority')
                ->get();
                
                
                $max = sizeof($listcts);
                $resutl = array();  
                for($i = 0; $i < $max;$i++)
                {
                
                    $lcpd= new   ListCustomerProductDetails( get_object_vars($listcts[$i]));
                  
                    $this->valideRelations($lcpd);
                    $resutl[] =  $lcpd;
                }
         
        }else{
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'User no exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }

        } catch (Exception $e) {
                
                $response['message'] = 'error';
                $response['values'] = ['error details' => $e->getMessage()];
                $response['user_id'] = 'PD';
                return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] =    ($resutl) ;//? $resutl : $listcts ;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ListCustomerProductDetails  $listCustomerProductDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($request)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListCustomerProductDetails  $listCustomerProductDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        try{
            $listcts = ListCustomerProductDetails::where('id',$id)->first();
            if(! $listcts){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = 'PD';
                return response()->json($response,404);
            }
            $listcts->fill($listcts->all())->save();

        } catch (Exception $e) {
        
                $response['message'] = 'error';
                $response['values'] = ['error details' => $e->getMessage()];
                $response['user_id'] = 'PD';
                return response()->json($response,415);
        }
        
        $response['message'] = 'ok';
        $response['values'] = $listcts;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListCustomerProductDetails  $listCustomerProductDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try{
            $listcts = ListCustomerProductDetails::where('id',$id)->delete();
        } catch (Exception $e) {
            $response['message'] = 'error';
                $response['values'] = ['error details' => $e->getMessage()];
                $response['user_id'] = 'PD';
                return response()->json($response,415);
        }
                  
        $response['message'] = 'ok';
        $response['values'] = $listcts;
        $response['user_id'] = 'PD';
        return response()->json($response,200);

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
