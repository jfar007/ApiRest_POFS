<?php

namespace App\Http\Controllers;

use App\Enums\LoginResult;
use App\PurchaseOrderDetails;
use App\Product;
use App\PurchaseOrder;
use App\OrderManagement;
use App\Customer;
use App\BranchOffice;
use App\User;
use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Validator;
use Illuminate\Support\Facades\URL;
use App\Status;
use PDF;
use App\Mail\PurchaseOrderNotify;
use Mail;
use App\Http\Helpers;


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
     * Muestra pedidos con filtro a partir de la sucursal (Branch Office), Fecha Inicial y Fecha Final
     *
     * @param  \App\PurchaseOrderDetails  $purchaseOrderDetails
     * @return \Illuminate\Http\Response
     */
    public function showPOrders(Request $request)
    {
        try{

        $resutl = array();      
        $validator = Validator::make($request->all(), [
            'branch_office_id' => 'required|max:255',
            'start_date' => 'required|date',
            'finish_date' => 'required|date'
            ]);

        
            if ($validator->fails()) {         
            $response['message'] = 'error';
            $response['values'] = ['error details' => $validator->errors()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $sdate = date_create($request->start_date);
        $fdate = date_create($request->finish_date);
     

        $filter = [
            'start_date' => $sdate,
            'finish_date' => $fdate
        ];
        $podt = DB::table('purchase_order')
                ->select('purchase_order_details.*')
                ->leftJoin('purchase_order_details', 'purchase_order.id', '=', 'purchase_order_details.purchase_order_id')
                ->where('purchase_order.branch_office_id', $request->branch_office_id)
                ->when( $filter,function ($query, $filter) {
                    $query->where('purchase_order_details.quantity', '>', '0')
                          ->whereBetween('purchase_order_details.purchase_order_date', [ $filter['start_date'],  $filter['finish_date']]);         
                })
                ->orderBy('purchase_order_details.purchase_order_date')
                ->get();
    
        $max = sizeof($podt);
    
        for($i = 0; $i < $max;$i++)
        {
        
            $pod= new   PurchaseOrderDetails( get_object_vars($podt[$i]));
            
            $this->valideRelations($pod);
            $resutl[] =  $pod;
        }
                


        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }


        // $podt = PurchaseOrderDetails::where('purchase_order_id', $id)->get();

        // foreach($podt as $po){
        //     $this->valideRelations($po);
        // }
    
        $response['message'] = 'ok';
        $response['values'] = $resutl;
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
                // $jspo = json_encode($lcd[$i]);

                $obpo = new PurchaseOrderDetails($lcd[$i]);
   
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
        $pohe= PurchaseOrder::where('id', $id)->first();
        if($pohe){
            $pohe->users_lm_id =   $user->id;
            $pohe->status_id = Status::$generado;
            $pohe->save();
        }
        
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
        
        //Elimar items con cantidad 0

        DB::table('purchase_order_details')
        ->where('purchase_order_id',  $id)
        ->when( $filter,function ($query, $filter) {
                $query->where('quantity','=' ,'0');
                })
        ->delete();    


        //Enviar email

    
        $this->generateandSendPDF( $pohe->id, $pohe->branch_office_id, $user, $pohe);
          


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


    

    public function generateandSendPDF($poid, $b0, $user, $pohe)
    {
        $podts = DB::table('purchase_order_details')
        ->select(
            'purchase_order_details.purchase_order_date', 
            'product.name as productname'
            , 'purchase_order_details.quantity', 'unit.name as unitname', 'product.packsize'
            )
        ->leftJoin('product', 'purchase_order_details.product_id', '=', 'product.id')
        ->leftJoin('unit', 'product.unit_id', '=', 'unit.id')
        ->where('purchase_order_details.purchase_order_id',  $poid)
        ->orderBy('purchase_order_details.purchase_order_date')
        ->get();

        $branchoffice = BranchOffice::where('id', $b0)->first();
        $customer = Customer::where('id',$branchoffice->customer_id )->first();
   
  
        $data['pedido'] = $poid;      
        $data['orders'] =  $podts;
        $data['branchoffice'] =  $branchoffice;
        $data['customer'] =  $customer;


        $pdf = PDF::loadView('OrdersPDF', $data);
        // $pdfName = 'PurchaseOrder_' . $poid . '.pdf';


        $index = 2;
        $pushOrderData = [
            'pedido' => $pohe->id
        ]; 

        $message = new PurchaseOrderNotify($user, $index, $pushOrderData );
        
        $pdfName = 'PurchaseOrder_' .  $pohe->id . '.pdf';
        $message->attachData($pdf->output(),  $pdfName);
        $message->subject('Pedido generado ' . $pohe->id . ' Food Solutions');
        Mail::to($user->email)->send($message);


        // return $pdf->download($pdfName);
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

    public function downloadOrder(Request $request, $id){
        $user = Auth::user();

        if(LoginResult::SUCCESS === $this->verifyPassword($request,   $user)){

            $pohe= PurchaseOrder::where('id',  $id)->first();

            if($pohe){
                if($pohe->status_id != Status::$creado){
                    $podts = DB::table('purchase_order_details')
                        ->select(
                            'purchase_order_details.purchase_order_date',
                            'product.name as productname'
                            , 'purchase_order_details.quantity', 'unit.name as unitname', 'product.packsize'
                        )
                        ->leftJoin('product', 'purchase_order_details.product_id', '=', 'product.id')
                        ->leftJoin('unit', 'product.unit_id', '=', 'unit.id')
                        ->where('purchase_order_details.purchase_order_id',  $id)
                        ->orderBy('purchase_order_details.purchase_order_date')
                        ->get();

                    $branchoffice = BranchOffice::where('id', $pohe->branch_office_id)->first();
                    $customer = Customer::where('id',$pohe->customer_id )->first();


                    $data['pedido'] = $id;
                    $data['orders'] =  $podts;
                    $data['branchoffice'] =  $branchoffice;
                    $data['customer'] =  $customer;
                    $pdf = PDF::loadView('OrdersPDF', $data);
                    $pdfName = 'PurchaseOrder_' . $id. '.pdf';
                    return $pdf->download($pdfName);
                }else{
                    Helpers::notifyMsg('Error','Solo puede descargar pedidos diferente a estado creado');
                }

            }else{
                Helpers::notifyMsg('Error','Pedido Ingresado no existe');
            }

        }else{
            Helpers::notifyMsg('Error','Escribio mal el password');
        }
    }
    public function verifyPassword(Request $request, $user){


        $encodedPass = base64_encode($request['password']);

        if (!password_verify($encodedPass, $user->password)) {
            if ($user->fail_attempt_count <= 5) {
                User::where('id', $user->id)
                    ->update([
                        'is_locked_out' => false,
                        'lock_start_date_time' => null,
                        'fail_attempt_count' => ($user->fail_attempt_count + 1)
                    ]);

                return LoginResult::INVALID_PASSWORD;
            }

            User::where('id', $user->id)
                ->update([
                    'fail_attempt_count' => 0,
                    'is_locked_out' => true,
                    'lock_start_date_time' => date('Y-m-d H:i:s')
                ]);

            return LoginResult::LOCKED_OUT;
        }else{
            return LoginResult::SUCCESS;
        }
    }


}
