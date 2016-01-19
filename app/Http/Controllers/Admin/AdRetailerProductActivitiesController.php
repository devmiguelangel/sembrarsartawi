<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sibas\Entities\AdRetailerProductActivities;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use DB;

class AdRetailerProductActivitiesController extends BaseController {

    public $adActivities;
    public $adRetailerProducts;

    public function __construct() {
        $this->adActivities = DB::table('ad_activities')->get();
        $this->adRetailerProducts = DB::table('ad_retailer_products')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $nav = 'adRetailerProductActivities';
        $action = 'list';
        $main_menu = $this->menu_principal();
        
        $adActivities = $this->adActivities;
        $activities = array();
        foreach ($adActivities as $key => $value) {
            $activities[$value->id]=$value;
        }
        
        $entities = DB::table('ad_retailer_product_activities')
                ->join('ad_retailer_products','ad_retailer_product_activities.ad_retailer_product_id','=','ad_retailer_products.id')
                ->join('ad_company_products','ad_retailer_products.ad_company_product_id','=','ad_company_products.id')
                ->join('ad_products','ad_company_products.ad_product_id','=','ad_products.id')
                ->groupBy('ad_retailer_product_activities.ad_retailer_product_id')
                ->get();
        $activiyProduct = DB::table('ad_retailer_product_activities')
                ->join('ad_activities','ad_retailer_product_activities.ad_activity_id','=','ad_activities.id')
                ->get();
        
        $selection = array();
        foreach ($activiyProduct as $key => $value) {
            $selection[$value->ad_retailer_product_id][] = $value->category;
        }
        
        
        //edw-->$entities = AdRetailerProductActivities::groupBy('ad_retailer_product_id')->get();
        
        return view('admin.adRetailerProductActivities.list', compact('nav', 'action', 'entities', 'activities','main_menu','selection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }
    /**
     * funcion genera formulario nuevo registro
     * @return type
     */
    public function formNew() {
        $nav = 'adRetailerProductActivities';
        $action = 'new';
        $main_menu = $this->menu_principal();
        
        $activities = $this->adActivities;
        $retailerProducts = $this->adRetailerProducts;
        
        return view('admin.adRetailerProductActivities.new', compact('nav', 'action', 'activities', 'retailerProducts','main_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (count($request->get('adActivities')) > 0) {
            foreach ($request->get('adActivities') as $key => $value) {
                $activities = DB::table('ad_retailer_product_activities')->insert(
                    ['ad_retailer_product_id' => $request->get('adRetailerProductActivities'), 'ad_activity_id' => $value]
                );
            }
            return redirect()->route('adRetailerProductActivities')->with('new','message');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
        $nav = 'adRetailerProductActivities';
        $action = 'edit';
        $main_menu = $this->menu_principal();
        
        $adRetailerProductId = $id;
        
        $arrSelect = DB::table('ad_retailer_product_activities')->where('ad_retailer_product_id',$id)->get();
        $activity = array();
        foreach ($arrSelect as $key => $value) {
            $activity[] = $value->ad_activity_id;
        }
        $activities = $this->adActivities;
        foreach ($activities as $key => $value) {
            if (in_array($value->id, $activity)) {
                $activities[$key]->selected = 1;
            }else{
                $activities[$key]->selected = 0;
            }
        }
        $retailerProducts = $this->adRetailerProducts;
        
        return view('admin.adRetailerProductActivities.edit', compact('nav', 'action', 'activities', 'retailerProducts','arrSelect','main_menu', 'adRetailerProductId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        if(count($request->get('adActivities'))>0){
            AdRetailerProductActivities::where('ad_retailer_product_id', $id)->delete();
            foreach ($request->get('adActivities') as $key => $value) {
                $activities = DB::table('ad_retailer_product_activities')->insert(
                    ['ad_retailer_product_id' => $id, 'ad_activity_id' => $value]
                );
            }
            
            return redirect()->route('adRetailerProductActivities')->with('edit','message');
        }
        //edw-->
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        AdRetailerProductActivities::where('ad_retailer_product_id', $id)->delete();
        return redirect()->route('adRetailerProductActivities')->with('delete','message');
    }

}
