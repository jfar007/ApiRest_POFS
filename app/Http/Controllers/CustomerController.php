<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Profile;
use App\NotificationsDays;
use \Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Database\Eloquent\Collection;
// use Illuminate\Contracts\Support\Arrayable;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::all();
        $data = ['message' =>  'Create Successfully', 'state' =>   '200' ];
        $data += ['message2' =>  'Create Successfully2'];

        foreach ( $customers as $customer)
        {
          
        //     $customer= $this->valideRelations($customer);   
            // $notificationday = new ParameterBag( $customer->all()->get($customer->id)); 
            $notification=NotificationsDays::where('customer_id', $customer->id)->first();
            $parameters =  ['notificationsdays_id' => $notification['id']];


        //     // $notificationday->add($parameters);

            $customer->forcefill($parameters);
           
        //     $customer->fill($notificationday->all());
        //     // $notificationday->notificacition_id = '3';
                        $customer= $this->valideRelations($customer);   
         }

        //  return response()->json([
        //     'message' =>  'OK'
        //     ,'values' => $notification->toArray()
        //     //  ,'notificationday' => $notificationday
      
        //      , 'customers' => $customer
        //      , 'data' => $data 
        // ],$status =210);


        $data = ['message' =>  'Create Successfully', 'state' =>   '200' ];
        $data += ['message2' =>  'Create Successfully2'];
        // return $customers;

        return response()->json([
            'message' =>  'OK'
            // ,'val' =>notification->toArray()
            //  ,'notificationday' => $notificationday
      
             , 'values' => $customers
        ],$status =210);


        return response()->json(
            $data 
            // [
            // 'message' =>  'Create Successfully'
            // ,'state' =>   '200' 
            // // ,'notificationday' => $notificationday
            //  ,'customers' => $customers
            // // , 'notification' => $notification
            // ]
        );
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

        // $notificationday = new ParameterBag($request->toArray()); 
        $customer = Customer::create($request->all());

        $this->valideRelations($customer);

        $request['customer_id'] = $customer->id;
        $notification =  NotificationsDays::create($request->all());
        return response()->json([
        'message' =>  'Create Successfully'
        ,'state' =>   '200' 
        // ,'notificationday' => $notificationday
         ,'customer' => $customer
        , 'notification' => $notification
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer=Customer::where('id', $id)->first();
        if(! $customer)
            return abort(404, 'Not Found');
    

        $this->valideRelations($customer);
        
        $notification = NotificationsDays::where('customer_id', $customer->id)->first();
        
        return response()->json([
            'message' =>  'Create Successfully'
            ,'state' =>   '200' 
            // ,'notificationday' => $notificationday
             ,'customer' => $customer
            , 'notification' => $notification
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $customer=Customer::where('id', $id)->first();
        if(! $customer)
            return abort(404, 'Not Found');

        $customer->fill($request->all())->save();

        $this->valideRelations($customer);
  
        

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer=Customer::where('id', $id)->first();
        if(! $customer)
            return abort(404, 'Not Found');
    
        $customer->delete();
        return $customer;
    }


    
    public function valideRelations(Customer $customer)
    {
        if(isset($customer['profile_id']) && !$customer['profile_id'] == null) {
            $profile = Profile::find($customer->profile_id);
            $customer->profile()->associate($profile);
        } 
        if(isset($customer['notificationsdays_id']) && !$customer['notificationsdays_id'] == null) {
            $notification = NotificationsDays::find($customer->notificationsdays_id);
            $customer->notificationsdays()->associate($notification);
        } 
    }
}
