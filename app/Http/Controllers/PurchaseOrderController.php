<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\User;
use App\Status;
use App\Rol;
use App\BranchOffice;
use App\Customer;
use Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    }

    // Evaluar todas las sucursales de cada uno de los clientes c/u de los siguientes criterios: 
        //1. Al crear el pedido
        // 1. Determinar perfil del cliente
        // 2. Determinar fecha corte (Tener en cuenta la fecha apartir de) 1. 
        // 3. Determinar si ya existe un pedido con la fecha de corte establecida (Pendiente ver si es en memoria o peticiones a la DB)
        // 3.1 Si, si no crea pedido  
        // 3.2 No, Crea pedido y verifica si existe uno anterior en estado creado y lo cambia a estado (no confirmado) 
        // 4. Evalua si se debe cambiar estado o sirve el actual
        // 
        // 2. Al enviar email
        // 1. Evaluar apartir de 
        // 2. Enviar mail 
        



       /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrderDetails  $purchaseOrderDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try{

            
            $user = null;
            $result = array();
                      // Log::info('$filter: '. $filter);
            if ($request->session()->exists('user')) {
       
                $user = $request->session()->get('user');
 
            }else if ($request->user()){    
                $user = $request->$request->user();
            }

            if(! $user == null ){
                 $rol = $user->rol_id; 
                 $purchaseOrder = null;
                if($rol == Rol::$distribuidor){
                  
                    $purchaseOrder =  DB::table('purchase_order')
                    ->orderBy('purchase_order.status_id','purchase_order.cut_date')
                    ->get(); 
             
       
                        $max = sizeof($purchaseOrder);
                    
                        for($i = 0; $i < $max;$i++)
                        {
                        
                        $por= new   PurchaseOrder( get_object_vars($purchaseOrder[$i]));
                        $this->valideRelations($por);
                        $result[] = $por;
                    }

                

                }else if($rol == Rol::$sucursal){
                    $purchaseOrder = DB::table('purchase_order')
                    ->orderBy('purchase_order.status_id','purchase_order.cut_date')
                    ->limit(2)->get();                    
                    $max = sizeof($purchaseOrder);
                
                    for($i = 0; $i < $max;$i++)
                    {
                        $por= new   PurchaseOrder( get_object_vars($purchaseOrder[$i]));
                        $this->valideRelations($por);
                        $result[] = $por;
                    }
                }else{
 
                }
                
                $response['message'] = 'ok';
                $response['values'] = $result;
                $response['user_id'] = 'PD';
                return response()->json($response,200);

               
            }else{

                $response['message'] = 'error';
                $response['values'] = ['error details' => 'User no exist'];
                $response['user_id'] = 'PD';
                return response()->json($response,200);
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
    
     

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function loadFileOrder(Request $request, $id)
    {
        try{    
            $validator = Validator::make($request->all(), [
                'order' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:2048']);            

            if ($validator->fails()) {
                $response['message'] = 'error';
                $response['values'] = ['error details' => $validator->errors()];
                $response['user_id'] = 'PD';
                return response()->json($response,415);
            }
            if(isset($request['order'])){
                $file = $request->file('order');
                $input['filename'] = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/files');
                $file->move($destinationPath, $input['filename']);
                $request['purchase_order_url'] =  url("/files/{$input['filename']}");
            }

            $pord= PurchaseOrder::where('id',$id)->first();
            $pord->fill($request->all())->save();
            $this->valideRelations($pord);
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

            
        $response['message'] = 'ok';
        $response['values'] = $pord;
        $response['user_id'] = 'PD';
        return response()->json($response,200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }


    public function valideRelations(PurchaseOrder $purchaseOrder)
    {
        if(isset($purchaseOrder['customer_id']) && !$purchaseOrder['customer_id'] == null) {
            $customer = Customer::find($purchaseOrder->customer_id);
            $purchaseOrder->customer()->associate($customer);
        } 
        if(isset($purchaseOrder['users_lm_id']) && !$purchaseOrder['users_lm_id'] == null) {
            $users_lm = User::find($purchaseOrder->users_lm_id);
            $purchaseOrder->users_lm()->associate($users_lm);
        } 

        
        if(isset($purchaseOrder['branch_office_id']) && !$purchaseOrder['branch_office_id'] == null) {
            $branch_office = BranchOffice::find($purchaseOrder->branch_office_id);
            $purchaseOrder->branch_office()->associate($branch_office);
        } 

          
        if(isset($purchaseOrder['status_id']) && !$purchaseOrder['status_id'] == null) {
            $status = Status::find($purchaseOrder->status_id);
            $purchaseOrder->status()->associate($status);
        } 

        if(isset($purchaseOrder['users_create_id']) && !$purchaseOrder['users_create_id'] == null) {
            $users_ct = User::find($purchaseOrder->users_create_id);
            $purchaseOrder->users_create()->associate($users_ct);
        } 
    }


        
        
}
