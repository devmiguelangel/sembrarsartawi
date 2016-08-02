<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Entities\Product;
use Sibas\Entities\RetailerProduct;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class TasasAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_products, $code_product, $type)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list'){
            if($code_product=='de' || $code_product=='vi' || $code_product=='td'){
                $product_query = Product::where('code',$code_product)->first();
                $query = \DB::table('ad_rates as ar')
                    ->leftjoin('ad_coverages as ac', 'ac.id', '=', 'ar.ad_coverage_id')
                    ->join('ad_retailer_products as arp', 'arp.id', '=', 'ar.ad_retailer_product_id')
                    ->join('ad_retailers as aret', 'aret.id', '=', 'arp.ad_retailer_id')
                    ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                    ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                    ->select('ar.id as id_rates', 'ar.rate_company', 'ar.rate_bank', 'ar.rate_final', 'ap.name as product', 'ac.name as coverage', 'aret.name as retailer')
                    ->where('arp.id','=',$id_retailer_products)
                    ->get();
                return view('admin.tasas.list', compact('nav', 'action', 'query', 'main_menu', 'array_data', 'id_retailer_products', 'code_product', 'product_query', 'type'));
            }elseif($code_product=='au'){
                $query = array();
                $product_query = Product::where('code',$code_product)->first();
                $query_one = \DB::table('ad_rates')
                                    ->where('ad_retailer_product_id',$id_retailer_products)
                                    ->get();
                foreach($query_one as $data_rate){
                    $b = $a = '';
                    $a = $data_rate->id.'|'.$data_rate->rate_final.'|'.$data_rate->year;
                    $query_two = \DB::table('ad_au_increments as aui')
                        ->join('ad_retailer_product_categories as arpc', 'arpc.id', '=', 'aui.ad_retailer_product_category_id')
                        ->select('aui.id', 'arpc.category', 'aui.increment')
                        ->where('ad_rate_id',$data_rate->id)
                        ->get();
                    foreach($query_two as $data_category){
                        $b .= $data_category->id.'|'.$data_category->category.'|'.$data_category->increment.'|';
                    }
                    $query[]=$a.'|'.$b;
                }

                //dd($array_category);
                //$query=null;
                return view('admin.tasas.list', compact('nav', 'action', 'id_retailer_products', 'code_product', 'product_query', 'query', 'main_menu', 'array_data', 'type'));
            }
        }elseif($action=='new'){
            $retailer = \DB::table('ad_retailers')
                            ->get();
            $product_query = Product::where('code',$code_product)->first();
            $category_query = \DB::table('ad_retailer_product_categories')
                                 ->where('ad_retailer_product_id',$id_retailer_products)
                                 ->get();

            return view('admin.tasas.new', compact('nav', 'action', 'main_menu', 'retailer', 'array_data', 'id_retailer_products', 'code_product', 'product_query', 'category_query', 'type'));
        }
    }

    public function index_product_retailer($nav, $action)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query = \DB::table('ad_retailer_products as arp')
            ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('arp.id as id_retailer_products', 'ar.name as retailer', 'ap.name as product', 'arp.type', 'arp.active', 'ap.code')
            ->orderBy('arp.type')
            ->get();
        $parameter = config('base.retailer_product_types');
        return view('admin.tasas.list-product-retailer', compact('nav', 'action', 'main_menu', 'array_data', 'query', 'parameter'));
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
        $arr = explode('|', $request->get('id_producto_retailer'));
        $rate_company = 0;
        $rate_bank = 0;
        $ad_coverage_id = null;

        if ($arr[1] == 'de') {
            $rate_company = $request->get('rate_company');
            $rate_bank = $request->get('rate_bank');
            $rate_final = $request->get('rate_final');
            if($request->get('id_coverage')!=0){
                $ad_coverage_id = $request->get('id_coverage');
            }

        }elseif($arr[1] == 'au'){
            $rate_final = $request->get('rate_end');
            $cont = $request->get('cont');
        }else{
            $rate_final = $request->get('rate_final');
        }
        try{
            if($arr[1] == 'de' || $arr[1] == 'vi' || $arr[1] == 'td'){
                $query_insert = \DB::table('ad_rates')->insert(
                    [
                        'rate_company' => $rate_company,
                        'rate_bank' => $rate_bank,
                        'rate_final' => $rate_final,
                        'ad_retailer_product_id' => $arr[0],
                        'ad_credit_product_id' => null,
                        'ad_coverage_id' => $ad_coverage_id,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ]
                );
            }elseif($arr[1] == 'au'){
                $num_data = \DB::table('ad_rates')
                                ->where('ad_retailer_product_id', $arr[0])
                                ->get();
                $year = count($num_data)+1;
                $id = \DB::table('ad_rates')->insertGetId(
                    [
                        'rate_company' => $rate_company,
                        'rate_bank' => $rate_bank,
                        'rate_final' => $rate_final,
                        'year' => $year,
                        'ad_retailer_product_id' => $arr[0],
                        'ad_credit_product_id' => null,
                        'ad_coverage_id' => $ad_coverage_id,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ]
                );
                for($i=1;$i<=$cont;$i++){
                    $query_category = \DB::table('ad_au_increments')->insert(
                        [
                            'ad_rate_id' => $id,
                            'ad_retailer_product_category_id' => $request->get('category-'.$i),
                            'increment' => $request->get('rate_category_'.$i),
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ]
                    );
                }
            }
            return redirect()->route('admin.tasas.list', ['nav' => 'rate', 'action' => 'list', 'id_retailer_products'=>$request->get('id_retailer_products'), 'code_product'=>$request->get('code_product'), 'type'=>$request->get('type')])->with(array('ok' => 'Se registro correctamente los datos del formulario'));
        }catch(QueryException $e) {
            return redirect()->back()->with(array('error'=>$e->getMessage()));
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
    public function edit($nav, $action, $id_rates, $id_retailer_products, $code_product, $type)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($code_product=='de' || $code_product=='vi' || $code_product=='td'){
            $query = \DB::table('ad_rates as ar')
                ->leftjoin('ad_coverages as ac', 'ac.id', '=', 'ar.ad_coverage_id')
                ->join('ad_retailer_products as arp', 'arp.id', '=', 'ar.ad_retailer_product_id')
                ->join('ad_retailers as aret', 'aret.id', '=', 'arp.ad_retailer_id')
                ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                ->select('ar.id as id_rates', 'ar.rate_company', 'ar.rate_bank', 'ar.rate_final', 'ap.name as product', 'ac.name as coverage', 'aret.name as retailer', 'ap.code as code_product')
                ->where('ar.id', '=', $id_rates)
                ->first();
        }elseif($code_product=='au'){
            $retailer_product = RetailerProduct::with('retailer','companyProduct.product')->where('id',$id_retailer_products)->first();

            $query_rate = \DB::table('ad_rates')
                ->where('id',$id_rates)
                ->first();
            $category_query = \DB::table('ad_au_increments as aui')
                ->join('ad_retailer_product_categories as arpc', 'arpc.id', '=', 'aui.ad_retailer_product_category_id')
                ->select('aui.id as id_increment', 'arpc.category', 'aui.increment')
                ->where('ad_rate_id',$query_rate->id)
                ->where('arpc.ad_retailer_product_id',$id_retailer_products)
                ->get();
            //dd($category_query);
        }

        return view('admin.tasas.edit', compact('nav', 'action', 'query', 'main_menu', 'id_rates', 'array_data', 'id_retailer_products', 'code_product', 'query_rate', 'category_query', 'retailer_product', 'type'));
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
        $rate_company = 0;
        $rate_bank = 0;
        $rate_final = 0;
        if($request->get('code_product')=='de' || $request->get('code_product')=='td' || $request->get('code_product')=='vi'){
            $rate_company = $request->get('rate_company');
            $rate_bank = $request->get('rate_bank');
            $rate_final = $request->get('rate_final');
        }elseif($request->get('code_product')=='au'){
            $rate_final = $request->get('rate_end');
            $cont = $request->get('cont');
        }
        try {
            $query_update = \DB::table('ad_rates')
                ->where('id', $request->get('id_rates'))
                ->update(
                    [
                        'rate_company' => $rate_company,
                        'rate_bank' => $rate_bank,
                        'rate_final' => $rate_final,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]
                );
            if($request->get('code_product')=='au'){
                for($i=1;$i<=$cont;$i++){
                    $update_increment = \DB::table('ad_au_increments')
                        ->where('id', $request->get('id-increment-'.$i))
                        ->where('ad_rate_id',$request->get('id_rates'))
                        ->update(
                            [
                                'increment' => $request->get('rate_category_'.$i),
                                'updated_at' => date("Y-m-d H:i:s")
                            ]
                        );
                }
            }
            return redirect()->route('admin.tasas.list', ['nav' => 'rate', 'action' => 'list', 'id_retailer_products'=>$request->get('id_retailer_products'), 'code_product'=>$request->get('code_product'), 'type'=>$request->get('type')])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
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

    //FUNCIONES AJAX
    public function ajax_product_retailer($id_retailer,$id_retailer_product)
    {
        $product_retailer=\DB::table('ad_retailer_products as arp')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('arp.id as id_retailer_product', 'ap.name as product', 'ap.code')
            ->where('arp.ad_retailer_id', '=', $id_retailer)
            ->where('arp.id',$id_retailer_product)
            ->get();
        return response()->json($product_retailer);
    }

    public function ajax_cobertura($id_retailer_product)
    {
        $coverage = \DB::table('ad_retailer_product_coverages as arpc')
            ->join('ad_coverages as ac', 'ac.id', '=', 'arpc.ad_coverage_id')
            ->select('ac.id as id_coverage', 'ac.name as coverage')
            ->where('arpc.ad_retailer_product_id', '=', $id_retailer_product)
            ->whereNotExists(function ($query_two) use ($id_retailer_product){
                $query_two->select(\DB::raw(1))
                    ->from('ad_rates as ar')
                    ->whereRaw('ar.ad_coverage_id = ac.id')
                    ->whereRaw('ar.ad_retailer_product_id = '.$id_retailer_product);
            })->get();
        //dd($coverage);
        return response()->json($coverage);
    }

    public function ajax_delete($id_rates,$code_product)
    {
        try{
            if($code_product=='au'){
                $query_del = \DB::table('ad_au_increments')
                    ->where('ad_rate_id', $id_rates)->delete();
            }
            $query_del = \DB::table('ad_rates')
                ->where('id', $id_rates)->delete();
            //return '1|Se elimino correctamente el registro';
            return response()->json(['response'=>'ok', 'detail'=>'Se elimino correctamente el registro']);
        }catch (QueryException $e){
            //return '0|'.$e->getMessage();
            return response()->json(['response'=>'error', 'detail'=>$e->getMessage()]);
        }
    }

    public function ajax_quest_rate($id_retailer_product)
    {
        $query = \DB::table('ad_rates')
                        ->where('ad_retailer_product_id', $id_retailer_product)
                        ->first();
        if(count($query)>0){
          return 1;
        }else{
          return 0;
        }
    }
}
