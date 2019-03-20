<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Profile;
use App\NotificationsDays;
use \Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Database\Eloquent\Collection;
// use Illuminate\Contracts\Support\Arrayable;
Use Exception;
use Validator;
use Illuminate\Support\Facades\URL;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         
        try{    
            $customers=Customer::all();

            foreach ( $customers as $customer)
            {
                $notification=NotificationsDays::where('customer_id', $customer->id)->first();
                $parameters =  ['notificationsdays_id' => $notification['id']];

                $customer->forcefill($parameters);
                $customer= $this->valideRelations($customer);   
            }
        } catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }


        $response['message'] = 'ok';
        $response['values'] = $customers;
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

        $validator = Validator::make($request->all(), [
            'logo' => 'image|mimes:jpg,jpeg,png,gif|max:2048']);            

        if ($validator->fails()) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $validator->errors()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
        if(isset($request['logo'])){
            $image = $request->file('logo');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            $request['logo_url'] =  url("/images/{$input['imagename']}");
        }

        $customer = Customer::create($request->all());

        $this->valideRelations($customer);

        $request['customer_id'] = $customer->id;
        $notification =  NotificationsDays::create($request->all());

        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $customer;
        $response['user_id'] = 'PD';
        return response()->json($response,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            
            $customer=Customer::where('id', $id)->first();
            if(! $customer){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = null;
                return response()->json($response,404);
            }
            
            $this->valideRelations($customer);
            
            $notification = NotificationsDays::where('customer_id', $customer->id)->first();

        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
                
        $response['message'] = 'ok';
        $response['values'] = $customer;
        $response['user_id'] = 'PD';
        return response()->json($response,200);


     
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

        try{   
            
            
            $validator = Validator::make($request->all(), [
                'logo' => 'image|mimes:jpg,jpeg,png,gif|max:2048']);            

            if ($validator->fails()) {
                $response['message'] = 'error';
                $response['values'] = ['error details' => $validator->errors()];
                $response['user_id'] = 'PD';
                return response()->json($response,415);
            }
            if(isset($request['logo'])){
                $image = $request->file('logo');
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $input['imagename']);
                $request['logo_url'] =  url("/images/{$input['imagename']}");
            }

            
            $customer=Customer::where('id', $id)->first();
            if(! $customer){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = null;
                return response()->json($response,404);
            }

            $customer->fill($request->all())->save();

            $request['customer_id'] = $customer->id;

            $notification =  NotificationsDays::where('customer_id', $customer->id)->first();
            $notification->fill($request->all())->save();

            $this->valideRelations($customer);

          }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $customer;
        $response['user_id'] = 'PD';
        return response()->json($response,200);

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
        try{
            $customer=Customer::where('id', $id)->first();
            if(! $customer){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = null;
                return response()->json($response,404);
            }    
            $customer->delete();

        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
        $response['message'] = 'ok';
        $response['values'] = $customer;
        $response['user_id'] = 'PD';
        return response()->json($response,200);

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
