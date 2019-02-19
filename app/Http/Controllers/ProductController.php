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
        $products = Product::all();
        foreach($products as $product){
            $product = $this->valideRelations($product);
        }
        return $products;
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

            $validator = Validator::make($request->all(), [
                'picture' => 'image|mimes:jpg,jpeg,png,gif|max:2048']);            

            if ($validator->fails()) {
                return  response()->json(['error' => $validator->errors()]);
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

            return  $product;
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
        $this->valideRelations($product);
        return $product;
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
        $product=Product::where('id', $id)->first();
        if(! $product)
            return abort(404);

        $validator = Validator::make($request->all(), [
            'picture' => 'image|mimes:jpg,jpeg,png,gif|max:2048']);            

        if ($validator->fails()) {
            return  response()->json(['error' => $validator->errors()]);
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

        return  $product;
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
        if(! $product)
            return abort(404);

        $product->delete();
        return $product;
             
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
