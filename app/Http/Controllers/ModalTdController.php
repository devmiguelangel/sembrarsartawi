<?php

namespace Sibas\Http\Controllers;

use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class ModalTdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * ajax modal
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajax_modal($id_retailer_product, $id_header, $text, $type){

        //Query Builder

        if($type=='PDF'){

            $view =  \View::make('cert.base', compact('id_retailer_product', 'id_header', 'text', 'type'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('Letter');
            return $pdf->stream('certificado_slip');

        }elseif($type=='IMPR'){

            $response = view('cert.base', compact('id_retailer_product', 'id_header', 'text', 'type'));

            return response()->json([
                'payload' => $response->render()
            ]);
        }

    }
}
