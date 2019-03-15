<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Unit;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
// use Symfony\Component\HttpFoundation\;
// use Symfony\Component\HttpFoundation\UploadedFile;
use Validator;
use Illuminate\Support\Facades\URL;


class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = Product::all();
            foreach($products as $product){
                $product = $this->valideRelations($product);
            }
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        $response['message'] = 'ok';
        $response['values'] = $products;
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
        try{    
            $validator = Validator::make($request->all(), [
                'picture' => 'image|mimes:jpg,jpeg,png,gif|max:2048']);            

            if ($validator->fails()) {
                $response['message'] = 'error';
                $response['values'] = ['error details' => $validator->errors()];
                $response['user_id'] = 'PD';
                return response()->json($response,415);
            }
            if(isset($request['picture'])){
                $image = $request->file('picture');
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $input['imagename']);
                $request['picture_url'] =  url("/images/{$input['imagename']}");
            }

            $product= Product::create($request->all());
            $this->valideRelations($product);
        }  catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

            
        $response['message'] = 'ok';
        $response['values'] = $product;
        $response['user_id'] = 'PD';
        return response()->json($response,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        if(! $product){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }
        $this->valideRelations($product);
        
        $response['message'] = 'ok';
        $response['values'] = $product;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

     try{
        $product=Product::where('id', $id)->first();
        if(! $product){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }

        $validator = Validator::make($request->all(), [
            'picture' => 'image|mimes:jpg,jpeg,png,gif|max:2048']);            

        if ($validator->fails()) {         
            $response['message'] = 'error';
            $response['values'] = ['error details' => $validator->errors()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        if(isset($request['picture'])){
            $image = $request->file('picture');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            $request['picture_url'] =  url("/images/{$input['imagename']}");
        }

        $product->fill($request->all())->save();

        $this->valideRelations($product);

    }  catch (Exception $e) {
        $response['message'] = 'error';
        $response['values'] = ['error details' => $e->getMessage()];
        $response['user_id'] = 'PD';
        return response()->json($response,415);
    }

        $response['message'] = 'ok';
        $response['values'] = $product;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::where('id', $id)->first();
        if(! $product){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }

        $product->delete();

        $response['message'] = 'ok';
        $response['values'] = $product;
        $response['user_id'] = 'PD';
        return response()->json($response,200);             
    }

    public function valideRelations(Product $product)
    {
        if(isset($product['category_id']) && !$product['category_id'] == null) {
            $category = Category::find($product->category_id);
            $product->category()->associate($category);
        } 
        if(isset($product['unit_id']) && !$product['unit_id'] == null) {
            $unit = Unit::find($product->unit_id);
            $product->unit()->associate($unit);
        } 
    }
}
