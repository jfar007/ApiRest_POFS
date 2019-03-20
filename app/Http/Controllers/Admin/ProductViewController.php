<?php

namespace App\Http\Controllers\Admin;

use App\BL\BLProduct;
use App\Category;
use App\Enums\SaveResult;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Unit;
use DB;
use Http\Client\Exception\HttpException;
use HttpRequestException;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Helpers;


class ProductViewController extends Controller
{

    //Product Routes
    public function productView()
    {
        try {
            $products = DB::table('product as A')
                ->join('category as B', 'B.id', '=', 'A.category_id')
                ->join('unit as C', 'C.id', '=', 'A.unit_id')
                ->select('A.id', 'A.cod_fs', 'A.item', 'A.name', 'A.pronunciation_in_english', 'A.description', 'A.packsize', 'A.picture_url', 'A.category_id', 'A.unit_id', 'A.active', DB::raw('B.name as categoryp'), DB::raw('C.name as unitp'))
                ->get();

            $categories = Category::all();
            $units = Unit::all();

            return view('admin.product', compact('products', 'categories', 'units'));

        } catch (HttpRequestException $ex) {

            return back()->withErrors('error', $ex);
        }
    }

    public function productStore(ProductRequest $request)
    {

        $validation = BLProduct::store($request);

        switch ($validation) {
            case SaveResult::SUCCESS:
                Helpers::notifyMsg('success', 'Los datos se cargaron correctamente');
                return redirect()->route('productos');
            case SaveResult::INTERNAL_ERROR:
                return redirect()->route('productos')->with('error', 'El producto no pudo ser guardado.');
            case SaveResult::EXISTING_DATA:
                return redirect()->route('productos')->with('error', 'El producto ya existe académico ya existe.');
        }

    }

    public function productEdit($id)
    {

        $product = Product::query()->find($id);
        $categories = Category::all();
        $units = Unit::all();

        return view('admin.update.updateproduct', compact('product', 'categories', 'units'));
    }

    public function update(ProductRequest $request, $id)
    {

        $product = Product::query()->find($id);

        $filename = '';
        try {
            if ($request->hasFile('picture_url')) {

                $picture = $request->file('picture_url');
                $filename = $request->cod_fs . '.' . $picture->getClientOriginalExtension();
                Image::make($picture)->resize(60, 60)->save(public_path('images/products/' . $filename));
            }


            $product->cod_fs = $request->cod_fs;
            $product->item = $request->item;
            $product->name = $request->name;
            $product->pronunciation_in_english = $request->pronunciation_in_english;
            $product->description = $request->description;
            $product->packsize = $request->packsize;
            $product->packsize = $request->packsize;
            if (!empty($filename)) {
                $product->picture_url = $filename;
            }
            $product->category_id = $request->category_id;
            $product->unit_id = $request->unit_id;
            $product->active = $request->active;

            $product->save();

            return redirect()->route('productos');
        } catch (HttpException $ex) {

            \Session::flash('message', 'No se pudieron actualizar correctamente');
            return redirect()->route('productos');
        }


    }

    public function deleteProduct($id)
    {


        try {
            $product = Product::query()->find($id);
            $product->delete();

            return redirect()->route('productos');

        } catch (HttpRequestException $ex) {

        }


    }


    public function categoryView()
    {
        $categories = Category::query()->select('id', 'name', 'short_name', 'active')->get();

        return view('admin.category', compact('categories'));
    }


    public function categoryEdit($id)
    {
        $categories = Category::query()->where('id', '=', $id)->get();
        return view('admin.update.updatecategory', compact('categories'));
    }


    public function categoryStore(Request $request)
    {
        try {

            Category::query()->create($request->all());

            Helpers::notifyMsg('success', 'Se guardo la categoria correctamente');
            return redirect()->route('categorias');
        } catch (HttpRequestException $ex) {

            Helpers::notifyMsg('error', 'No se guardo la categoria correctamente');
            return redirect()->route('categorias');
        }

    }


    public function categoryUpdate(Request $request, $id)
    {
        try {
            Category::query()->find($id)->update($request->all());

            Helpers::notifyMsg('success', 'Se modifico la categoria correctamente');
            return redirect()->route('categorias');
        } catch (HttpRequestException $ex) {

            Helpers::notifyMsg('error', 'No se modifio la categoria correctamente');
            return redirect()->route('categorias');
        }
    }

    public function categoryDelete($id)
    {

        try {
            Category::query()->find($id)->delete();

            Helpers::notifyMsg('success', 'Se elimino la categoria correctamente');
            return redirect()->route('categorias');
        } catch (HttpRequestException $ex) {

            Helpers::notifyMsg('error', 'No se elimino la categoria correctamente');
            return redirect()->route('categorias');
        }
    }




    public function unitView()
    {

        $units= Unit::query()->select('name', 'short_name', 'active')->get();
        return view('admin.unit',compact('units'));
    }

}
