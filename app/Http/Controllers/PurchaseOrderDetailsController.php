<?php

namespace App\Http\Controllers;

use App\PurchaseOrderDetails;
use App\Product;
use App\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseOrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        try{
            $bofid = null;
            Log::info('index ' . json_encode($request->session()->get('user')));
            if ($request->session()->exists('user')) {
                
                $user = $request->session()->get('user');
                $bofid =  $user->branch_office_cf_id;

                Log::info('index :'  . $user->branch_office_cf_id) .  ' 2: ' . $bofid ;
            }else if ($request->user()){
                $user = $request->$request->user();
                $bofid =  $user->branch_office_cf_id;
            }

            Log::info('index ' . $bofid);
            $podt= '';
            if(! $bofid == null ){
                $filter = [];
                Log::info('ix' . 3);
                $podt = new PurchaseOrderDetails();
                $podt = DB::table('purchase_order')
                ->select('purchase_order_details.*')
                ->leftJoin('purchase_order_details', 'purchase_order.id', '=', 'purchase_order_details.purchase_order_id')
                ->where('purchase_order.branch_office_id',   $bofid)
                ->when( $filter,function ($query, $filter) {
                    $query->where('purchase_order.status_id', '=', '1');        
                })
                ->get()[0];
                
           

                if(!$podt){
                    $response['message'] = 'error';
                    $response['values'] = ['error details' => 'Respuesta a una petición exitosa que no devuelve datos.'];
                    $response['user_id'] = null;
                    return response()->json($response,204);
                }
            
                foreach($podt as $po){
                    $this->valideRelations($po);
                }
            }

        } catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }



        $response['message'] = 'ok';
        $response['values'] = $podt;
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

    }

    /**
     * Store a newly created resource in storage.
     * Agrega productos sugeridos al pedido ya en curso
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{
            $podetails = PurchaseOrderDetails::create($request->all());
            $this->valideRelations($podetails);
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        
        $response['message'] = 'ok';
        $response['values'] = $podetails;
        $response['user_id'] = 'PD';
        return response()->json($response,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrderDetails  $purchaseOrderDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $podt = PurchaseOrderDetails::where('purchase_order_id', $id)->get();

        foreach($podt as $po){
            $this->valideRelations($po);
        }
        if(! $podt){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }
     

        $response['message'] = 'ok';
        $response['values'] = $podt;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrderDetails  $purchaseOrderDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrderDetails $purchaseOrderDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrderDetails  $purchaseOrderDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrderDetails $purchaseOrderDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrderDetails  $purchaseOrderDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrderDetails $purchaseOrderDetails)
    {
        //
    }

    public function valideRelations(PurchaseOrderDetails $purchaseOrderdt)
    {
        if(isset($purchaseOrderdt['product_id']) && !$purchaseOrderdt['product_id'] == null) {
            $product = Product::find($purchaseOrderdt->product_id);
            $purchaseOrderdt->product()->associate($product);
        } 
        if(isset($purchaseOrderdt['purchase_order_id']) && !$purchaseOrderdt['purchase_order_id'] == null) {
            $purchaseOrder = PurchaseOrder::find($purchaseOrderdt->purchase_order_id);
            $purchaseOrderdt->purchase_order()->associate($purchaseOrder);
        } 
    }



    


}
