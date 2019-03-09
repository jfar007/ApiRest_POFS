<?php

namespace App\Http\Controllers;

use App\PurchaseOrderDetails;
use App\Product;
use App\PurchaseOrder;
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
               
                $resutl = array();
                $temp = array();
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
        $response['values'] =  $resutl;
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
    public function editJson(Request $request,$id)
    {
        try{

        
        $data = json_decode($request->getContent(), true);
        $first= true;
        $tempint=0;
        
        foreach($data['values'] as $lcd){
            Log::info('vardmp ' .  var_dump($lcd));
            // $jspo = json_encode($lcd[0]);
            // Log::info('editJson ' . $jspo);
            // $jspo = json_encode($lcd[1]);
            // Log::info('editJson ' . $jspo);
            $max = sizeof($lcd);
            $pushOrder= 0;
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
            Log::info('index ' . json_encode($request->session()->get('user')));
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



            // return var_dump($lcd);
            // $jspo = json_encode($lcd[$tempint]);
            // Log::info('editJson ' . $jspo);

            // $tempint2=0;
            // // foreach($jspo as $lcdd){
            //     // $jspo2 = json_encode($lcdd[$tempint2]);
            //     // Log::info('editJson2 ' . $lcdd);
            // //     Log::info(' $lcdd ' .  $lcdd);
            // Log::info('obpo ' .  json_decode($jspo ));
            //     $obpo = new PurchaseOrderDetails((array) $lcd[$tempint]->uno);
            //     $tempint2 +=1;
            //     Log::info('obpo ' .  $jspo );
                
            //     $obpo = new PurchaseOrderDetails($jspo->dos);
            //     $tempint2 +=1;
            //     Log::info('obpo ' .  json_decode($obpo));
            //     // $filter = [
            //     //     'product_id' => $obpo->product_id
            //     //     ,'purchase_order_date' => $obpo->purchase_order_date
            //     //     ];

            //     // $purchaseOrder = 
            //     // DB::table('purchase_order_details')
            //     // ->where('purchase_order_id',  $obpo->purchase_order_id)
            //     // ->when( $filter,function ($query, $filter) {
            //     //         $query->where('product_id', $filter['product_id'])
            //     //                 ->where('purchase_order_date', $filter['purchase_order_date']);
            //     //         })
            //     // ->update(['quantity' => $obpo->quantity]);

            // // }      
            // $tempint +=1;
            
        

        // return $purchaseOrder;
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

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
