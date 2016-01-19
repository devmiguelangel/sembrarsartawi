<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Sibas\Entities\Product;
use Sibas\Http\Requests;


class ProductAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
            $query = Product::get();
            //dd($query);
            $parameter = config('base.product_types');

            return view('admin.product.list', compact('nav', 'action', 'query', 'main_menu', 'parameter'));
        }elseif($action=='new'){
            //dd($parameter);
            return view('admin.product.new', compact('nav', 'action', 'main_menu'));
        }
        //
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
        $query_int = new Product();
        $query_int->type=$request->input('id_tipo');
        $query_int->name=$request->input('txtProducto');
        $query_int->slug=strtolower($request->input('txtProducto'));
        $query_int->code=strtolower($request->input('txtCodigo'));
        if($query_int->save()) {
            return redirect()->route('admin.product.list', ['nav'=>'product', 'action'=>'list']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nav, $action, $id_product)
    {
        $main_menu = $this->menu_principal();
        $query = Product::where('id', $id_product)
                        ->first();
        //dd($query);
        return view('admin.product.edit', compact('nav', 'action', 'query', 'main_menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $query_update = Product::where('id', $request->input('id_product'))->first();
        $query_update->name=$request->input('txtProducto');
        $query_update->code=$request->input('txtCodigo');
        $query_update->type=$request->input('id_tipo');
        $query_update->slug=strtolower($request->input('txtProducto'));
        if($query_update->save()) {
            return redirect()->route('admin.product.list', ['nav'=>'product', 'action'=>'list']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
