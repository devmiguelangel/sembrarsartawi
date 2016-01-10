<?php

namespace Sibas\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\De\FacultativeRepository;

class HomeController extends Controller
{
    /**
     * @var FacultativeRepository
     */
    protected $facultativeDeRepository;

    public function __construct(FacultativeRepository $facultativeDeRepository)
    {
        $this->facultativeDeRepository = $facultativeDeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Guard $auth
     * @return \Illuminate\Http\Response
     */
    public function index(Guard $auth)
    {
        $user = $auth->user();

        $data = [
            'products' => [],
        ];

        if ($user->profile->first()->slug === 'SEP' || $user->profile->first()->slug === 'COP') {
            foreach ($user->retailer->first()->retailerProducts as $retailerProduct) {
                if ($retailerProduct->type === 'MP' && $retailerProduct->facultative) {
                    $product = $retailerProduct->companyProduct->product;

                    if ($product->code === 'de') {
                        $product->records = $this->facultativeDeRepository->getRecords($user);
                    }

                    array_push($data['products'], $product);
                }
            }

            // dd($data['products']);
        }

        return view('home', compact('user', 'data'));
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
}
