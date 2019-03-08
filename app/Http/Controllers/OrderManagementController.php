<?php

namespace App\Http\Controllers;

use App\OrderManagement;
use Illuminate\Http\Request;
use App\Task;
use App\Customer;
use App\BranchOffice;
use App\PurchaseOrder;
use App\ListCustomerProduct;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use \Symfony\Component\HttpFoundation\ParameterBag;



class OrderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try{
            $orderManagements = OrderManagement::all();
            foreach($orderManagements as $orderManagement){
                $orderManagement = $this->valideRelations($orderManagement);
            }
        }catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $orderManagements;
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $task = Task::where('name', 'Gestionar Pedido')->first();
            $request['task_id'] = $task->id;
            $orderManagement = OrderManagement::create($request->all());
            $this->valideRelations($orderManagement);
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $orderManagement;
        $response['user_id'] = 'PD';
        return response()->json($response,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderManagement  $orderManagement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderManagement = OrderManagement::where('id', $id)->fist();
        if(! $orderManagement){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }
        $this->valideRelations($orderManagement);

        $response['message'] = 'ok';
        $response['values'] = $orderManagement;
        $response['user_id'] = 'PD';
        return response()->json($response,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderManagement  $orderManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderManagement $orderManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderManagement  $orderManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $task = Task::where('name', 'Gestionar Pedido')->first();
            $request['task_id'] = $task->id;
            $orderManagement = OrderManagement::where('id', $id)->fist();
            if(! $orderManagement){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = null;
                return response()->json($response,404);
            }
            $orderManagement->fill($request->all())->save();
            $this->valideRelations($orderManagement);
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $orderManagement;
        $response['user_id'] = 'PD';
        return response()->json($response,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderManagement  $orderManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderManagement = OrderManagement::where('id', $id)->fist();
        if(! $orderManagement){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }
        $orderManagement->delete();

        $response['message'] = 'ok';
        $response['values'] = $orderManagement;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }

    public function valideRelations(OrderManagement $orderManagement)
    {
        if(isset($orderManagement['customer_id']) && !$orderManagement['customer_id'] == null) {
            $customer = Customer::find($orderManagement->customer_id);
            $orderManagement->customer()->associate($customer);
        } 
        if(isset($orderManagement['task_id']) && !$orderManagement['task_id'] == null) {
            $task = Task::find($orderManagement->task_id);
            $orderManagement->task()->associate($task);
        } 
    }

    
    public function orderManagement(){
            
        try{
            Log::info('---------------------------------------------');
            $orders = OrderManagement::where('active', '1')->get();
            foreach($orders as $order){
                Log::info('Veces' );
                $customer = DB::table('customer')
                ->where('id', '=', $order->customer_id )
                ->where(function ($query) {
                    $query->where('active', '=', '1');
                })
                ->first(); 
                if($customer){

                    $datefrom = $order->from . ' ' . $order->hour_of_day;
                    $datefrom = date_create($datefrom);
                    $CutDate = $this->getCutDate($order);
                    Log::info('date_create: '. $datefrom->format('d-m-Y H:i:s'));
                    Log::info('getCutDate::: '. $CutDate);

                    // $branchOffices = BranchOffice::where('customer_id', $order->customer_id, 'active', '1')->get();
                    $branchOffices = DB::table('branch_office')
                    ->where('customer_id', '=', $order->customer_id )
                    ->where(function ($query) {
                        $query->where('active', '=', '1');
                    })
                    ->get(); 
                    Log::info('$branchOffices: '. $branchOffices);
                    $statusIdCreated= 1;
                    $statusIdCNoConfirmed = 2;

                    if($branchOffices){

                        foreach($branchOffices as $branchOffice ){
                            // $purchaseOrder =  PurchaseOrder::where('customer_id',$order->customer_id);
                            $filter = [
                                'branch_office_id' => $branchOffice->id
                                ,'status_id' => $statusIdCreated
                            ];
                            // Log::info('$filter: '. $filter);
                            $purchaseOrder =  DB::table('purchase_order')
                                        ->where('customer_id', '=', $order->customer_id )
                                        ->when( $filter,function ($query, $filter) {

                                            $query->where(
                                                'branch_office_id', '=', $filter['branch_office_id'] )
                                                  ->where(
                                                      'status_id', '=',  $filter['status_id']
                                                    );
                                        })
                                        ->first(); 

                                      
                            if($purchaseOrder){
                                Log::info(   $purchaseOrder->cut_date . ' - ' .  $CutDate );
                                $purchaseOrderDt = date_create($purchaseOrder->cut_date);
                                $dCutDate = date_create($CutDate);
                            }
                            $createPedio = false;
                            if(! $purchaseOrder){
                                //crea el pedido
                                $createPedio = true;
                            }else if($purchaseOrderDt <>  $dCutDate){
                                //Actualiza el estado del primero y crea el pedido
                                $purchaseOrder->status_id = $statusIdCNoConfirmed;
                                $purchaseOrder = 
                                DB::table('purchase_order')
                                ->where('id', $purchaseOrder->id)
                                ->update(['status_id' => $statusIdCNoConfirmed]);

                                // $purchaseOrder->save();
                                $createPedio = true;
                                Log::info('orderUPD: '. $order);
                            }else{
                                Log::info('$order: '. $order);
                            }

                            $useridAdmin = 1;
                            //'customer_id','branch_office_id','description','total_quantity','purchase_order_number','purchase_order_url'
                            // ,'cut_date','status_id','users_create_id','users_lm_id')
                            if($createPedio){

                                $lcp = DB::table('list_customer_product')
                                        ->select(DB::raw('count(*) as listprod'))
                                        ->leftJoin('list_customer_product_details', 'list_customer_product.id', '=', 'list_customer_product_details.list_customer_product_id')
                                        ->where('list_customer_product.customer_id',  $order->customer_id)
                                        ->when( $filter,function ($query, $filter) {
                                            $query->where(
                                                'list_customer_product.active', '=', '1')
                                                ->where(
                                                    'list_customer_product_details.active', '=',  '1'
                                                  )
                                                ->where(
                                                'list_customer_product_details.suggest', '=',  '0'
                                                );
                                        })
                                        ->get();
                                Log::info('list_customer_product:: '. json_encode($lcp));
                                $lcp = $lcp[0];
                                Log::info('list_customer_product:: '. json_encode($lcp));
                                if($lcp->listprod > 0) {
                                        $parameters =  [
                                            'customer_id' =>   $order->customer_id
                                            ,'branch_office_id' => $branchOffice->id
                                            ,'description'=> ''
                                            ,'total_quantity' => '0'
                                            ,'purchase_order_number' => ''
                                            ,'purchase_order_url' =>  ''
                                            ,'cut_date' =>  $CutDate
                                            ,'status_id' => $statusIdCreated
                                            ,'users_create_id' => $useridAdmin
                                            ,'users_lm_id' => $useridAdmin
                                        ];
                                        $purCt = PurchaseOrder::create($parameters);
                                        
                                        $model = new ListCustomerProduct();
                                        $id = 1;
                                        $result = 0;
                                        Log::info('data necesary: '. 'purCt->id ' . $purCt->id . ' purCt->customer_id '. $purCt->customer_id . ' customer->profile_id ' . $customer->profile_id . ' date' .  date_create($CutDate)->format('d-m-Y') );
                                        
                                        $dateparam = date_create($CutDate)->format('Y-m-d');
                                        if ($customer->profile_id == 2){
                                            $ordmtmp = new OrderManagement();
                                            $ordmtmp->name_of_day = 'Lunes';
                                            $ordmtmp->hour_of_day =  $order->hour_of_day;
                                            $ordmtmp->from = date_create($CutDate)->format('Y-m-d');
                                           
                                            $newDate = $this->getCutDate( $ordmtmp);
                                            Log::info('newDate:: '. $newDate);
                                            $dateparam = date_create($newDate)->format('Y-m-d');
                                        }
                                        $paramst =  [ $purCt->id ,
                                        $purCt->customer_id ,
                                        $customer->profile_id,
                                        $dateparam,
                                        ]; 
                                        Log::info( json_encode($paramst) . var_dump($paramst));
                                        $data = DB::select(
                                            'CALL create_list_customer_product_details(?, ?, ?, ?)',
                                            $paramst
                                        );
                                    }
                                           
                                        
                                // Log::info('$data: '.json_encode($data));

                             //   $param = new ParameterBag($parameters);
                              
                            //    $param->add($parameters);
                                //Encabezado y luego Detalle
                                // Log::info('$param: '. json_encode($param));
                               // return json_encode($parameters);
                            }
                            
                        }
                    }
                }
                
                //Debo buscar primero las sucursales de este cliente y mirar si existe pedido en estado creado. 
                    //Sino existe pedido, construyo la fecha de corte y verifico si existe
                        //Sino existe creo el pedido 
                            //- Determino perfil del cliente
                            //- Fecha de corte
                            //- Estado
                            //- Se construye pedido encabezado y detalle 
                // $fecha_entrada = strtotime("19-11-2008 21:00:00");
                // return $this->getCutDate();
               
            }
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
    } 



    public function getCutDate(OrderManagement $OrderManagement){
        $datefrom = $OrderManagement->from . ' ' . $OrderManagement->hour_of_day;
        $hoy = date("Y-m-d H:i");

        $datetime1 = date_create($datefrom)->format('d-m-Y H:i');
        $datetime1 = date_create($datetime1);
        $datetime2 = date_create($hoy);
        
        if($datetime1 < $datetime2 || $datetime1 == $datetime2) {
                  
                return  $this->determiteCut($datetime2, $OrderManagement);

        } else {
                
                return  $this->determiteCut($datetime1, $OrderManagement);
        }


    }

function determiteCut( $datetime, OrderManagement $OrderManagement ){

    $lenWeekDays = 6;
    $WeekDays = 7;
    $pDateCut = $this->getPositionDay($this->know_day( $datetime->format('Y-m-d')));
    $pDateToday = $this->getPositionDay($OrderManagement->name_of_day);
    
    $pDateCut = $lenWeekDays - $pDateCut;
    $pDateToday = $lenWeekDays - $pDateToday;
    $dif = $pDateCut - $pDateToday;

    if($dif <= 0){
        $daysadd = ' + '. ( $dif ) .' days';
        $cutDate = date('Y-m-d', strtotime($datetime->format('Y-m-d') . $daysadd ));
        $cutDate = $cutDate  . ' ' . $OrderManagement->hour_of_day;
        $cutDateDt = date_create($cutDate)->format('d-m-Y H:i');

        $min = $this->dateDifference($cutDateDt,$datetime->format('d-m-Y H:i'));
      
        if($min < 0){

            $dif = $WeekDays+ $dif;
        }

    }
    $dif = $dif > 0 ? $dif : $WeekDays+ $dif;
    
    // Log::info('DifF1: '.( $dif ) . 'daysadd: '.( $daysadd ) 
    // .' Date F: ' .  $cutDate);

    $daysadd = ' + '. ( $dif ) .' days';
    $cutDate = date('Y-m-d', strtotime($datetime->format('Y-m-d') . $daysadd ));
    $cutDateF = $cutDate . ' ' . $OrderManagement->hour_of_day;

    return  $cutDateF;
}


    function dateDifference($date_1 , $date_2 , $differenceFormat = '%i' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    Log::info('dateDifference: '.( $datetime1->format('d-m-Y H:i:s') ) . 'datetime2: '.( $datetime2 )->format('d-m-Y H:i:s'));

    $interval = date_diff($datetime1, $datetime2);
    $minute = 0;
    
    // $ays = $interval->format( '%h');
    // if($ays > 0)
    
    $hour = $interval->format( '%h');
    
    if($hour > 0)
        $minute= $hour * 60;    

    $minute += $interval->format( '%i');

    if($datetime1 <= $datetime2)
        $minute = $minute *-1;

    return   $minute;
    
}

    public function determineCutDate($date){

    }

    function know_day($dateinput) {
        $days = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
        $dateout = $days[date('N', strtotime($dateinput))];
        //echo $fecha;
        return $dateout;
    }

    function getPositionDay($day){
        $days = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
        $position = array_search( $day ,$days);
        return $position;
    }
}
