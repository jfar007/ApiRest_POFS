<?php
namespace App\BL;

use App\Category;
use App\Enums\SaveResult;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Unit;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class BLProduct
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public static function store(ProductRequest $request)
    {
      $filename = '';
        try {
            if ($request->hasFile('picture_url')) {

                $picture = $request->file('picture_url');
                $filename = $request->cod_fs . '.' . $picture->getClientOriginalExtension();
                Image::make($picture)->resize(60, 60)->save(public_path('images/products/' . $filename));
            }



            $product = new Product();

            $product->cod_fs = $request->cod_fs;
            $product->item = $request->item;
            $product->name = $request->name;
            $product->pronunciation_in_english = $request->pronunciation_in_english;
            $product->description = $request->description;
            $product->packsize = $request->packsize;
            $product->packsize = $request->packsize;
            $product->picture_url = $filename;
            $product->category_id = $request->category_id;
            $product->unit_id = $request->unit_id;
            $product->active = $request->active;
            $product->save();

            return SaveResult::SUCCESS;
        } catch (HttpException $ex) {

            return SaveResult:: INTERNAL_ERROR;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        /*  $product = Product::where('id', $id)->first();
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
          return response()->json($response,200);*/
        return true;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request, $id)
    {
        /*
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

                    valideRelations($product);

                }  catch (Exception $e) {
                    $response['message'] = 'error';
                    $response['values'] = ['error details' => $e->getMessage()];
                    $response['user_id'] = 'PD';
                    return response()->json($response,415);
                }

                $response['message'] = 'ok';
                $response['values'] = $product;
                $response['user_id'] = 'PD';
                return response()->json($response,200);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* $product=Product::where('id', $id)->first();
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
         return response()->json($response,200);*/
    }

    public static function valideRelations(Product $product)
    {
        if (isset($product['category_id']) && !$product['category_id'] == null) {
            $category = Category::query()->find($product->category_id);
            $product->category()->associate($category);
        }
        if (isset($product['unit_id']) && !$product['unit_id'] == null) {
            $unit = Unit::query()->find($product->unit_id);
            $product->unit()->associate($unit);
        }
    }

}