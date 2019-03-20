<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;

use App\Http\Helpers;
use App\ListCustomerProduct;
use App\ListCustomerProductDetails;
use App\Product;
use App\User;
use Auth;
use DB;
use HttpRequestException;
use Illuminate\Http\Request;

class ProductSuggestionViewController extends Controller
{

    public function productSuggestionView()
    {

        $customers = Customer::query()->select('id', 'name', 'main_phone')->get();
        $products = Product::query()->select('id', 'name', 'description')->get();


        return view('admin.productsuggestion', compact('customers', 'products'));

    }


    public function ProductListsCustomerViewEdit($id)
    {
        $customers = Customer::query()->select('id', 'name', 'main_phone')->get();
        $products = Product::query()->select('id', 'name', 'description')->get();

        $listclient = ListCustomerProduct::query()->join('customer as B', 'list_customer_product.customer_id', '=', 'B.id')
            ->select(DB::raw('list_customer_product.id as idList '), DB::raw('list_customer_product.name as nameList'),
                DB::raw('list_customer_product.description as descriptionList'), DB::raw('list_customer_product.active as activeList'), 'B.id', 'B.name', 'B.main_phone')
            ->where('list_customer_product.id', '=', $id)
            ->get();

        $listProducts = DB::table('product as A')->join('list_customer_product_details as B', 'A.id', '=', 'B.product_id')
            ->select(DB::raw('CONCAT(A.name,"-",A.description) AS full_name'), 'B.id', 'B.product_id', 'B.suggest', 'B.priority', 'B.active')
            ->where('B.list_customer_product_id', '=', $id)
            ->get();


        return view('admin.update.updatelistproduct', compact('customers', 'products', 'listclient', 'listProducts'));
    }

    public function ProductListsCustomerViewUpdate(Request $request)
    {


       try {

            $id = $request['dataRequest']['idListProduct'];
            $list = ListCustomerProduct::query()->find( $id);

            $list->name = $request->dataRequest['name'];
            $list->description = $request->dataRequest['description'];
            $list->customer_id = $request->dataRequest['customer_id'];
            $list->users_lm_id = Auth::user()->id;
            $list->active = $request->dataRequest['active'];
            $list->save();


            //Validar datos para eliminar
            if ($request['deleteData']) {
                foreach ($request['deleteData'] as $data) {
                    ListCustomerProductDetails::query()->where('id', '=', $data)->delete();
                }
            }

            if ($request['data']) {


                foreach ($request->data as $data) {
                    if (!empty($data[0])) {

                        if ($listDetails = ListCustomerProductDetails::query()->findOrFail($data[0])) {

                            $listDetails->product_id = $data[1];
                            $listDetails->suggest = $data[2];
                            $listDetails->priority = $data[3];
                            $listDetails->active = $data[4];

                        }


                    } elseif (empty($data[0])) {

                        $listDetails = new ListCustomerProductDetails();

                        $listDetails->list_customer_product_id = $id;
                        $listDetails->product_id = $data[1];
                        $listDetails->suggest = $data[2];
                        $listDetails->priority = $data[3];
                        $listDetails->active = $data[4];

                        $listDetails->save();

                    }


                }

            }


            return json_encode("DATOS ALMACENADOS CORRECTAMENTE!, GRACIAS");


        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }


/*     return json_encode($request['dataRequest']['idListProduct']);*/
    }


    public function saveProductListsCustomerView(Request $request)
    {

        try {

            $list = new  ListCustomerProduct();

            $list->name = $request->dataRequest['name'];
            $list->description = $request->dataRequest['description'];
            $list->customer_id = $request->dataRequest['customer_id'];
            $list->users_lm_id = \Auth::user()->id;
            $list->active = $request->dataRequest['active'];
            $list->save();

            foreach ($request->data as $data) {

                $listDetails = new ListCustomerProductDetails();

                $listDetails->list_customer_product_id = $list->id;
                $listDetails->product_id = $data[0];
                $listDetails->suggest = $data[1];
                $listDetails->priority = $data[2];
                $listDetails->active = $data[3];

                $listDetails->save();
            }

            return json_encode("DATOS ALMACENADOS CORRECTAMENTE!, GRACIAS");


        } catch (HttpRequestException $ex) {
            return json_encode($ex);
        }
    }


    public function listProductSuggestions()
    {
        $lists = DB::table('list_customer_product as A')->join('customer as B', 'B.id', '=', 'A.customer_id')
           ->select(DB::raw('A.name as nameList'), DB::raw('A.description as descriptionList'), DB::raw('A.id as idList'), DB::raw('A.active as activeList') )
            ->orderBy('A.id', ' des')->get();

        return view('admin.listproductsuggestion', compact('lists'));
    }


    public function listProductsSuggestionsDetails($id)
    {

        $customerList = DB::table('customer as A')->join('list_customer_product as B', 'A.id', '=', 'B.customer_id')
            ->select(DB::raw('B.name as namelist'), DB::raw('B.description as descriptionlist'), 'A.name', 'A.main_phone')
            ->where('B.id', '=', $id)
            ->get();


        $listProducts = DB::table('product as A')->join('list_customer_product_details as B', 'A.id', '=', 'B.product_id')
            ->select(DB::raw('CONCAT(A.name," ",A.description) AS full_name'), 'A.packsize', 'B.product_id', 'B.suggest', 'B.priority', 'B.active')
            ->where('B.list_customer_product_id', '=', $id)
            ->distinct()
            ->get();

        return view('admin.details.detailslistproductscustomer', compact('listProducts', 'customerList'));

    }

    public function listProductSuggestionDelete ($id){

        try{

        ListCustomerProductDetails::query()->where('list_customer_product_id','=',$id)->delete();
        ListCustomerProduct::query()->where('id','=', $id)->delete();

        Helpers::notifyMsg('success', 'Los datos se eliminaron correctamente');

         return redirect()->route('listaProductoSugeridos');
        }catch (HttpRequestException $ex){

            Helpers::notifyMsg('error', 'Los datos no se eliminaron correctamente, vuelva a intentar');
            return redirect()->route('listaProductoSugeridos');
        }

    }

}