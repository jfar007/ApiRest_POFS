<?php

namespace App\Http\Controllers;

use App\Category;
use HttpRequestException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::all();

        $response['message'] = 'ok';
        $response['values'] = $categorys;
        $response['user_id'] = 'PD';
        return response()->json($response, 200);

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Category::query()->update($request->all());
            $response['message'] = 'ok';
            return response()->json($response, 201);

        } catch (HttpRequestException $ex) {
            $response['message'] = 'error';
            return response()->json($response, 415);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('id', $id)->first();

        if (!$category) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response, 404);
        }
        $response['message'] = 'ok';
        $response['values'] = $category;
        $response['user_id'] = 'PD';
        return response()->json($response, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $category = Category::query()->findOrFail($id)->update($request->all());


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
