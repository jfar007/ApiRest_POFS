<?php

namespace App\Http\Controllers;

use App\PurchaseOrderDetails;
use App\Product;
use App\PurchaseOrder;
use App\OrderManagement;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class PurchaseOrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    // public function index(Request $request, $profile_id)
    {

        $resutl = array();  
        $temp = array();
        try{
            $bofid = null;
            // Log::info('index ' . json_encode($request->session()->get('user')));
            // if($profile_id){
            //     if($profile_id == 1){
            //         $user = User::where('customer_id',1);  
            //     }else{
            //         $user = User::where('customer_id',2); 
            //     }                
            // }
            // else 
            if ($request->session()->exists('user')) {
                
                $user = $request->session()->get('user');
                $bofid =  $user->branch_office_cf_id;

                Log::info('index :'  . $user->branch_office_cf_id) .  ' 2: ' . $bofid ;
            }else if ($request->user()){
                $user = $request->$request->user();
                $bofid =  $user->branch_office_cf_id;
            }


            $podt= '';
            if(! $bofid == null ){
                $filter = [];
                $podt = DB::table('purchase_order')
                ->select('purchase_order_details.*')
                ->leftJoin('purchase_order_details', 'purchase_order.id', '=', 'purchase_order_details.purchase_order_id')
                ->where('purchase_order.branch_office_id',   $bofid)
                ->when( $filter,function ($query, $filter) {
                    $query->where('purchase_order.status_id', '=', '1');        
                })
                ->orderBy('purchase_order_details.purchase_order_date')
                ->get();
                
           

                if(!$podt){
                    $response['message'] = 'error';
                    $response['values'] = ['error details' => 'Respuesta a una petición exitosa que no devuelve datos.'];
                    $response['user_id'] = null;
                    return response()->json($response,204);
                }
               
               
                foreach($podt as $po){
                    $podtf = new PurchaseOrderDetails((array) $po);
                    $this->valideRelations($podtf);
                    if(isset($resutl) && array_key_exists($podtf->purchase_order_date, $resutl))
                    {
                        $temp[] = $podtf;
                        $resutl[$podtf->purchase_order_date] =  $temp;
                     }
                     else{
                        $temp = array();
                        $temp[] = $podtf;
                        $resutl[$podtf->purchase_order_date] =  $temp;
                     }
                }

            }

        } catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }



        $response['message'] = 'ok';
        $response['values'] =  $resutl ==  null ? '' : $resutl;
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

            
            $user = null;
            $statusIdCreated = 1;
                      // Log::info('$filter: '. $filter);
            if ($request->session()->exists('user')) {
       
                $user = $request->session()->get('user');
                Log::info('entro session' .  $user );
                
            }else if ($request->user()){
                $user = $request->$request->user();
                Log::info('entro request' .  $user );
            
            }

            if(! $user == null ){


                $filter = [
                    'branch_office_id' => $user->branch_office_cf_id
                    ,'status_id' => $statusIdCreated
                ];
                // Log::info('$filter: '. $filter);
                $purchaseOrder =  DB::table('purchase_order')
                            ->where('customer_id', '=', $user->customer_id )
                            ->when( $filter,function ($query, $filter) {
                                $query->where(
                                    'branch_office_id', '=', $filter['branch_office_id'] )
                                      ->where(
                                          'status_id', '=',  $filter['status_id']
                                        );
                            })
                            ->first();   
                
                Log::info( var_dump($purchaseOrder) . json_encode(  $purchaseOrder ) );

            
                            $paramst =  [ 
                            $purchaseOrder->id ,
                            $request->product_id
                        ]; 
                            $data = DB::select(
                                'CALL add_product_to_purchase_order(?, ?)',
                                $paramst
                            );

                $pohe= PurchaseOrder::where('id',  $purchaseOrder->id)->first();
                if($pohe){
                    $pohe->users_lm_id =  $user->id;
                    $pohe->save();
                }

            }


        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        return $this->index($request); 

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
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrderDetails  $purchaseOrderDetails
     * @return \Illuminate\Http\Response
     */
    public function showPurchaseOrder(Request $request)
    {
        try{

            
            $user = null;
            $statusIdCreated = 1;
                      // Log::info('$filter: '. $filter);
            if ($request->session()->exists('user')) {
       
                $user = $request->session()->get('user');
                Log::info('entro session' .  $user );
                
            }else if ($request->user()){
                $user = $request->$request->user();
                Log::info('entro request' .  $user );
            
            }

            if(! $user == null ){
                

            }

        
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }


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
    public function editJson(Request $request,$id)
    {
        try{

        
        $data = json_decode($request->getContent(), true);
        $first= true;
        $tempint=0;
        $pushOrder= 0;
        foreach($data['values'] as $lcd){

       
            $max = sizeof($lcd);
        
            for($i = 0; $i < $max;$i++)
            {
                $jspo = json_encode($lcd[$i]);
                Log::info('editJson ' . $jspo);
                $obpo = new PurchaseOrderDetails($lcd[$i]);
                Log::info('obpo ' . $obpo);
                $filter = [
                    'product_id' => $obpo->product_id
                    ,'purchase_order_date' => $obpo->purchase_order_date
                    ];
                $pushOrder = $obpo->purchase_order_id;
                $purchaseOrder = 
                DB::table('purchase_order_details')
                ->where('purchase_order_id',  $obpo->purchase_order_id)
                ->when( $filter,function ($query, $filter) {
                        $query->where('product_id', $filter['product_id'])
                                ->where('purchase_order_date', $filter['purchase_order_date']);
                        })
                ->update(['quantity' => $obpo->quantity]);                
            }
        }

            $userid = null;
            if ($request->session()->exists('user')) {
       
                $user = $request->session()->get('user');
                Log::info('entro session' .  $user );
                $userid =  $user->id;
             
            }else if ($request->user()){
                $user = $request->$request->user();
                Log::info('entro request' .  $user );
                $userid =  $user->id;
            }

            if(! $userid == null ){
                $pohe= PurchaseOrder::where('id', $pushOrder)->first();
                if($pohe){
                    $pohe->users_lm_id =  $userid;
                    $pohe->save();
                }
            }

            
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
       
        return $this->index($request);

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

    public function chageStateSucursalUser(Request $request, $id){
    try{

        $user = null;
        if ($request->session()->exists('user')) {
            $user = $request->session()->get('user');
        }else if ($request->user()){
            $user = $request->$request->user();
        }

        $stateGenerado = 2;

        $pohe= PurchaseOrder::where('id', $id)->first();
        if($pohe){
            $pohe->users_lm_id =   $user->id;
            $pohe->status_id = $stateGenerado;
            $pohe->save();
        }
        
        $orderMng = OrderManagement::where('customer_id', $user->customer_id );
        
        $filter = [
            'task_id' => 1,
            'active' => 1
            ];
        $daysadd = ' + 1 days';

        $cutDate =  date_create($pohe->cut_date)->format('Y-m-d');
        $newCutDate = date('Y-m-d',  strtotime($cutDate . $daysadd )); 
        $orderMng = 
        DB::table('order_management')
        ->where('customer_id',   $user->customer_id )
        ->when( $filter,function ($query, $filter) {
                $query->where('active', $filter['active'])
                      ->where('task_id', $filter['task_id']);
                })
        ->update(['from' => $newCutDate]);    

    }  catch (Exception $e) {
        $response['message'] = 'error';
        $response['values'] = ['error details' => $e->getMessage()];
        $response['user_id'] = 'PD';
        return response()->json($response,415);
    }

        
    $response['message'] = 'ok';
    $response['values'] = 'ok';
    $response['user_id'] = 'PD';
    return response()->json($response,200);

    }

    public function chageStateDistribuidorUser(Request $request, $id, $statusId){
        try{

            $userid = null;
            if ($request->session()->exists('user')) {
       
                $user = $request->session()->get('user');
                $userid =  $user->id;
             
            }else if ($request->user()){
                $user = $request->$request->user();
                $userid =  $user->id;
            }
    
            $pohe= PurchaseOrder::where('id', $id)->first();
    
            if($pohe){
                $pohe->users_lm_id =  $userid;
                $pohe->status_id = $statusId;
                $pohe->save();
            }
            

        }  catch (Exception $e) {
                $response['message'] = 'error';
                $response['values'] = ['error details' => $e->getMessage()];
                $response['user_id'] = 'PD';
                return response()->json($response,415);
        }
        $response['message'] = 'ok';
        $response['values'] = 'ok';
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }



    


}
