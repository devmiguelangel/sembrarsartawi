<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Sibas\Entities\RetailerUser;
use Sibas\Entities\User;
use Sibas\Http\Requests;

use Sibas\Repositories\Admin\UserAdminRepository;

class UserAdminController extends BaseController
{
    /**
     * @var UserAdminRepository
     */
    private $repository;

    public function __construct(UserAdminRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Guard $auth, $nav, $action)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list'){
            if($this->repository->listUser($auth->user()->type->code)){
                $users = $this->repository->getModel() ;
            }else{
                $users = null;
            }
            return view('admin.user.list', compact('nav', 'action', 'users', 'main_menu', 'array_data'));
        }elseif($action=='new'){
            $retailer = \DB::table('ad_retailers')
                            ->where('active', true)
                            ->get();

            $cities = \DB::table('ad_retailer_cities')
                        ->join('ad_cities','ad_retailer_cities.ad_city_id', '=', 'ad_cities.id')
                        ->select('ad_retailer_cities.id as id_retailer_city', 'ad_cities.name', 'ad_cities.abbreviation', 'ad_cities.id as id_city')
                        ->where('ad_retailer_cities.active', '=', 1)
                        ->get();
            //dd($cities);
            $query_type_user = \DB::table('ad_user_types')
                                    ->where('code','<>','ADT')
                                    ->get();

            if($auth->user()->type->code=='ADT'){
                $permissions_list = \DB::table('ad_permissions')
                    ->get();
            }else{
                $permissions_list = \DB::table('ad_permissions')
                    ->where('slug','like','R%')
                    ->get();
            }

            return view('admin.user.new', compact('nav','action', 'cities', 'main_menu', 'query_type_user', 'retailer', 'permissions_list', 'array_data'));
        }

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
    public function store(Guard $auth, Request $request)
    {
        if($auth->user()->type->code=='ADT'){
            $contrasenia = Hash::make($request->input('contrasenia'));
        }else{
            $contrasenia = Hash::make('Sartawi123');
        }

        if($request->get('agencia')!=0){
            $agency = $request->get('agencia');
        }else{
            $agency = null;
        }
        try{
            $arrProfile = explode('|',$request->input('id_profile'));
            $array = explode('|',$request->input('tipo_usuario'));
            $arrCity = explode('|', $request->input('depto'));
            $ad_company_id = null;
            if($array[1]=='UST'){
                if($arrProfile[1]=='COP'){
                    $ad_company_id = $request->get('id_company');
                }
            }

            $user_new = new User();
            $user_new->id=date('U');
            $user_new->username=$request->input('txtIdusuario');
            $user_new->password=$contrasenia;
            $user_new->full_name=$request->input('txtNombre');
            $user_new->email=$request->input('txtEmail');
            $user_new->phone_number=$request->input('txtTelefono');
            $user_new->ad_city_id=$arrCity[1];
            $user_new->ad_agency_id=$agency;
            $user_new->ad_user_type_id=$array[0];
            $user_new->active=true;
            if($user_new->save()) {
                $query_retailer_user = new RetailerUser();
                $query_retailer_user->ad_retailer_id=$request->input('id_retailer');
                $query_retailer_user->ad_user_id=$user_new->id;
                $query_retailer_user->ad_company_id=$ad_company_id;
                $query_retailer_user->active=true;
                /*
                $query_retailer_user = \DB::table('ad_retailer_users')
                    ->insert(
                        [
                            'ad_retailer_id'=>$request->input('id_retailer'),
                            'ad_user_id'=>$user_new->id,
                            'ad_company_id'=>$ad_company_id,
                            'active' => true,
                            'created_at'=>date("Y-m-d H:i:s"),
                            'updated_at'=>date("Y-m-d H:i:s")
                        ]
                    );
                */
                if($query_retailer_user->save()){
                    if($array[1]=='UST' || $array[1]=='OPT'){
                        try {
                            if($array[1]=='UST'){

                                $query_insert = \DB::table('ad_user_profiles')->insert(
                                    [
                                        'ad_user_id'=>$user_new->id,
                                        'ad_profile_id'=>$arrProfile[0],
                                        'active'=>true,
                                        'created_at'=>date("Y-m-d H:i:s"),
                                        'updated_at'=>date("Y-m-d H:i:s")
                                    ]
                                );
                                if($arrProfile[1]=='SEP'){
                                    if(count($request->get('product'))>0){
                                        foreach($request->get('product') as $key => $value){
                                            $query_products = \DB::table('ad_retailer_user_products')->insert(
                                                [
                                                    'ad_retailer_user_id' => $query_retailer_user->id,
                                                    'ad_product_id' => $value,
                                                    'created_at' => date("Y-m-d H:i:s"),
                                                    'updated_at' => date("Y-m-d H:i:s")
                                                ]
                                            );
                                        }
                                    }
                                }
                            }

                            if(count($request->get('permiso'))>0){
                                foreach ($request->get('permiso') as $key => $value) {
                                    $query_permissions = \DB::table('ad_user_permissions')->insert(
                                        [
                                            'ad_user_id' => $user_new->id,
                                            'ad_permission_id' => $value,
                                            'active' => true,
                                            'created_at'=>date("Y-m-d H:i:s"),
                                            'updated_at'=>date("Y-m-d H:i:s")
                                        ]
                                    );
                                }
                            }

                            return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list'])->with(array('ok'=>'Se agrego correctamente los datos del formulario'));

                        } catch(QueryException $e) {
                            return redirect()->back()->with(array('error'=>$e->getMessage()));
                        }

                    }else{
                        return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list'])->with(array('ok'=>'Se agrego correctamente los datos del formulario'));
                    }
                }

            }
        }catch(QueryException $e) {
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }
        //dd($request->all());
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
    public function edit(Guard $auth, $nav, $action, $id_user, $id_retailer)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='edit'){
            try {
                $user_find = \DB::table('ad_users as au')
                    ->join('ad_user_types as aut', 'aut.id', '=', 'au.ad_user_type_id')
                    ->join('ad_retailer_users as aru', 'aru.ad_user_id', '=', 'au.id')
                    ->select('au.id as id_user', 'au.ad_user_type_id', 'aut.code', 'au.ad_city_id',
                        'au.ad_agency_id', 'au.username', 'au.full_name', 'au.phone_number', 'au.email',
                        'aru.ad_company_id', 'aru.id as id_retailer_user')
                    ->where('au.id', '=', $id_user)
                    ->first();

                $user_permission = \DB::table('ad_user_permissions')
                    ->where('ad_user_id', $user_find->id_user)
                    ->get();

                $profile_find = \DB::table('ad_user_profiles as aup')
                    ->join('ad_profiles as ap', 'ap.id', '=', 'aup.ad_profile_id')
                    ->select('aup.ad_profile_id', 'ap.slug as profile')
                    ->where('ad_user_id', '=', $user_find->id_user)
                    ->first();

                if($auth->user()->type->code=='ADT'){
                    $query_prof = \DB::table('ad_profiles')
                        ->get();
                }else{
                    $query_prof = \DB::table('ad_profiles')
                                        ->where('slug','<>','SUP')
                                        ->where('slug','<>','REP')
                                        ->where('slug','<>','TEP')
                                        ->get();
                }


                $cities = \DB::table('ad_retailer_cities')
                    ->join('ad_cities', 'ad_retailer_cities.ad_city_id', '=', 'ad_cities.id')
                    ->select('ad_retailer_cities.id as id_retailer_city', 'ad_cities.name', 'ad_cities.abbreviation', 'ad_cities.id as id_city')
                    ->where('ad_retailer_cities.active', '=', 1)
                    ->get();
                //dd($cities);

                $retailer = \DB::table('ad_retailers')
                    ->where('active', true)
                    ->where('id', $id_retailer)
                    ->first();

                //dd($user_find->ad_city_id);
                if (!empty($user_find->ad_city_id)) {
                    $query_find_city = \DB::table('ad_retailer_cities')
                        ->where('ad_city_id', $user_find->ad_city_id)
                        ->first();

                    $agencies = \DB::table('ad_retailer_city_agencies')
                        ->join('ad_agencies', 'ad_retailer_city_agencies.ad_agency_id', '=', 'ad_agencies.id')
                        ->select('ad_agencies.id', 'ad_agencies.name')
                        ->where('ad_retailer_city_agencies.ad_retailer_city_id', '=', $query_find_city->id)
                        ->get();
                    //dd($agencies);
                } else {
                    $agencies = null;
                }

                $query_type_user = \DB::table('ad_user_types')
                                        ->where('code','<>','ADT')
                                        ->get();

                if($auth->user()->type->code=='ADT'){
                    if($user_find->code=='UST'){
                        $permissions_list = \DB::table('ad_permissions')
                            ->where('slug','like','R%')
                            ->get();
                    }elseif($user_find->code=='OPT'){
                        $permissions_list = \DB::table('ad_permissions')
                            ->where('slug','like','A%')
                            ->get();
                    }
                }else{
                    $permissions_list = \DB::table('ad_permissions')
                        ->where('slug', 'LIKE', 'R%')
                        ->get();
                }

                $query_company = \DB::table('ad_companies')
                    ->get();

                $query_product = \DB::table('ad_products')
                    ->get();

                $query_user_product = \DB::table('ad_retailer_user_products')
                    ->where('ad_retailer_user_id', '=', $user_find->id_retailer_user)
                    ->get();


                //dd($permissions);
                return view('admin.user.edit', compact('nav', 'action', 'user_find', 'cities',
                    'agencies', 'main_menu', 'query_type_user', 'profile_find', 'query_prof',
                    'retailer', 'permissions_list', 'user_permission', 'array_data', 'query_company',
                    'query_product', 'query_user_product'));
            }catch(QueryException $e){
                return redirect()->back()->with(array('error'=>$e->getMessage()));
            }
        }elseif($action=='changepass'){
            $user_find = \DB::table('ad_users')
                            ->where('id', '=', $id_user)
                            ->first();

            return view('admin.user.change-password', compact('nav', 'action', 'user_find', 'main_menu', 'array_data'));
        }elseif($action=='resetpass'){
            $user_find = \DB::table('ad_users')
                ->where('id', '=', $id_user)
                ->first();
            return view('admin.user.reset-password', compact('nav', 'action', 'user_find', 'main_menu', 'array_data'));
        }


        /*
        $cities = \DB::table('ad_retailer_cities')
            ->join('ad_cities','ad_retailer_cities.ad_city_id', '=', 'ad_cities.id')
            ->select('ad_cities.id', 'ad_cities.name', 'ad_cities.abbreviation')
            ->where('ad_cities.abbreviation', '<>', 'PE')
            ->where('ad_retailer_cities.active', '=', 1)
            ->get();
        dd($cities);
        */
        //return view('admin.user.edit', compact('nav', 'action', 'user_find', 'cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * EDIT PROFILE
     */
    public function profile_edit(Guard $auth, $nav){
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query = \DB::table('ad_users')
            ->where('id',$auth->user()->id)
            ->first();
        //dd($query);
        return view('admin.user.profile', compact('nav', 'main_menu', 'array_data', 'query'));
    }

    public function account_setting_edit($nav){
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        return view('admin.user.account-setting', compact('nav', 'main_menu', 'array_data'));
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
        if($request->get('agencia')!=0){
            $agency = $request->get('agencia');
        }else{
            $agency = null;
        }

        try{
            $array = explode('|',$request->get('tipo_usuario'));
            $array_city = explode('|', $request->get('depto'));
            $id_company = null;
            if(!is_null($request->get('id_profile'))) {
                $id_profile =  explode('|', $request->get('id_profile'));
                if($id_profile[1]=='COP'){
                    $id_company = $request->get('id_company');
                }
            }

            $user_update = User::where('id', $request->input('id_user'))->first();
            $user_update->full_name=$request->input('txtNombre');
            $user_update->email=$request->input('txtEmail');
            $user_update->phone_number=$request->input('txtTelefono');
            $user_update->ad_city_id=$array_city[1];
            $user_update->ad_agency_id=$agency;
            $user_update->ad_user_type_id=$array[0];
            if($user_update->save()) {
                $query_update_retailer_user = \DB::table('ad_retailer_users')
                    ->where('ad_user_id',$request->get('id_user'))
                    ->update(
                        [
                            'ad_company_id' => $id_company,
                            'updated_at'=>date("Y-m-d H:i:s")
                        ]
                    );
                if($query_update_retailer_user){
                    if($array[1]=='UST' || $array[1]=='OPT'){
                        try{
                            if($array[1]=='UST'){
                                $quest_user_profile = \DB::table('ad_user_profiles')
                                    ->where('ad_user_id',$request->input('id_user'))
                                    ->first();
                                if(count($quest_user_profile)>0){
                                    $query_update_profile = \DB::table('ad_user_profiles')
                                        ->where('ad_user_id', $request->input('id_user'))
                                        ->update(
                                            [
                                                'ad_profile_id' => $id_profile[0],
                                                'updated_at'=>date("Y-m-d H:i:s"),
                                                'active'=>true
                                            ]
                                        );
                                }else{
                                    $query_insert = \DB::table('ad_user_profiles')->insert(
                                        [
                                            'ad_user_id'=>$request->get('id_user'),
                                            'ad_profile_id'=>$id_profile[0],
                                            'active'=>true,
                                            'created_at'=>date("Y-m-d H:i:s"),
                                            'updated_at'=>date("Y-m-d H:i:s")
                                        ]
                                    );
                                }

                                if($id_profile[1] == 'SEP'){
                                    $query_del_register = \DB::table('ad_retailer_user_products')
                                        ->where('ad_retailer_user_id',$request->get('id_retailer_user'))
                                        ->delete();
                                    if(count($request->get('product'))>0){
                                        foreach($request->get('product') as $key => $value){
                                            $query_products = \DB::table('ad_retailer_user_products')->insert(
                                                [
                                                    'ad_retailer_user_id' => $request->get('id_retailer_user'),
                                                    'ad_product_id' => $value,
                                                    'created_at' => date("Y-m-d H:i:s"),
                                                    'updated_at' => date("Y-m-d H:i:s")
                                                ]
                                            );
                                        }
                                    }
                                }
                            }

                            $query_del = \DB::table('ad_user_permissions')
                                ->where('ad_user_id', $request->input('id_user'))->delete();

                            if(count($request->get('permiso'))>0){
                                foreach ($request->get('permiso') as $key => $value) {
                                    $query_permissions = \DB::table('ad_user_permissions')->insert(
                                        [
                                            'ad_user_id' => $request->input('id_user'),
                                            'ad_permission_id' => $value,
                                            'active' => true,
                                            'created_at'=>date("Y-m-d H:i:s"),
                                            'updated_at'=>date("Y-m-d H:i:s")
                                        ]
                                    );
                                }
                            }

                            return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list'])->with(array('ok'=>'Se edito correctamente los datos del formulario'));

                        } catch(QueryException $e){
                            return redirect()->back()->with(array('error'=>$e->getMessage()));
                        }
                    }else{

                        try{
                            $query_update_profile = \DB::table('ad_user_profiles')
                                ->where('ad_user_id', $request->input('id_user'))
                                ->update(['active'=>false]);
                            if(count($query_update_profile)>0){
                                return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list'])->with(array('ok'=>'Se actualizo correctamente los datos del formulario'));
                            }else{
                                return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list'])->with(array('ok'=>'Se actualizo correctamente los datos del formulario'));
                            }
                        } catch(QueryException $e){
                            return redirect()->back()->with(array('error'=>$e->getMessage()));
                        }
                    }
                }else{

                }
            }
        }catch(QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * UPDATE PROFILE
     */
    public function profile_update(Request $request){
        try{
            $query_update = \DB::table('ad_users')
                ->where('id', $request->get('id_user'))->update(
                    [
                        'full_name' => $request->get('txtNombre'),
                        'email' => $request->get('txtEmail'),
                        'phone_number' => $request->get('txtTelefono'),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]
                );
            return redirect()->route('admin.home', ['nav' => 'begin']);
        }catch(QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }
    }

    public function account_setting_update(Request $request){
        $user_update = User::find($request->get('id_user'));
        $user_update->password=Hash::make($request->get('contrasenia'));
        if($user_update->save()) {
            return redirect()->route('admin.home', ['nav' => 'begin']);
        }
    }

    /*-------------------------------------*/

    public function change(Request $request){
        $user_update = User::find($request->input('id_user'));
        $user_update->password=Hash::make($request->input('contrasenia'));
        if($user_update->save()) {
            return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list']);
        }
    }

    public function reset(Request $request){
        $user_update = User::find($request->input('id_user'));
        $user_update->password=Hash::make($request->input('contrasenia'));
        if($user_update->save()) {
            return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list']);
        }
    }

    public function upload_file($nav, $action)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query_city = \DB::table('ad_retailer_cities as arc')
                    ->join('ad_cities as ac', 'ac.id', '=', 'arc.ad_city_id')
                    ->select('arc.id as id_retailer_city', 'ac.name as city', 'ac.id as id_city')
                    ->where('arc.active',true)
                    ->get();

        $retailer = \DB::table('ad_retailers')
            ->where('active', true)
            ->get();
        return view('admin.user.import-file', compact('nav', 'action', 'main_menu', 'query_city', 'retailer', 'array_data'));
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
     * Upload file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload_file_data_user(Request $request)
    {
        //dd($request->file('FileInput'));

        if (Input::hasFile('FileInput')){
            $file = $request->file('FileInput');

            $destinationPath = 'assets/files/'; // upload path
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'_'.$name; // renameing image
            $file->move($destinationPath, $fileName); // loading file to given path
            echo '¡Éxito! Archivo subido.'; echo'<br>';
            $dat_select = $request->get('id_retailer_city');
            $arr = explode('|',$dat_select);
            $aux_agency='';
            $id_retailer = $request->get('id_retailer');

            Excel::load('assets/files/'.$fileName, function($reader) use ($arr,$aux_agency,$id_retailer) {
                // Getting all results
                $results = $reader->get();
                $list = array();
                $id_agency = 0;
                //dd('['+$id_retailer+'] ['+$aux_agency+']');

                foreach($results as $data){
                    if($data->agencia==$aux_agency){

                    }else{
                        try {
                            $quest_agency=\DB::table('ad_agencies')
                                             ->where('name',$data->agencia)
                                             ->first();
                            if(count($quest_agency)==0){
                                $id_agency = \DB::table('ad_agencies')->insertGetId(
                                    [
                                        'name' => $data->agencia,
                                        'slug' => Str::slug($data->agencia),
                                        'created_at' => date("Y-m-d H:i:s"),
                                        'updated_at' => date("Y-m-d H:i:s")
                                    ]
                                );

                                $id_retailer_city_agency = \DB::table('ad_retailer_city_agencies')->insert(
                                    [
                                        'ad_retailer_city_id' => $arr[0],
                                        'ad_agency_id' => $id_agency,
                                        'active' => true,
                                        'created_at' => date("Y-m-d H:i:s"),
                                        'updated_at' => date("Y-m-d H:i:s")
                                    ]
                                );
                            }else{
                                $id_agency=$quest_agency->id;
                            }
                            $aux_agency = $data->agencia;
                        }catch(QueryException $e){
                            echo$e->getMessage();
                        }
                    }

                    $list[]=array(
                        'usuario'=>$data->usuario,
                        'nombre'=>$data->nombre,
                        'email'=>$data->email,
                        'ad_agency_id'=>$id_agency,
                        'ad_city_id' => $arr[1],
                        'password' => Hash::make('Sartawi123'),
                        'ad_user_type_id' => 2
                    );
                }
                //dd($list);
                $id_user=date('U');
                $i=0;
                $repeated = array();
                foreach($list as $key => $val){
                    //BUSQUEDA DE USUARIOS/EMAILS REPETIDOS
                    $quest_user=\DB::table('ad_users')
                                    ->where('username',$val['usuario'])
                                    ->orwhere('email',$val['email'])
                                    ->get();
                    //dd($query_quest);
                    if(count($quest_user)==0){
                        $i=$i+1;
                        $id_user=$id_user+$i;
                        try {
                            $user_new = new User();
                            $user_new->id=$id_user;
                            $user_new->username=$val['usuario'];
                            $user_new->password=$val['password'];
                            $user_new->full_name=$val['nombre'];
                            $user_new->email=$val['email'];
                            $user_new->ad_city_id=$val['ad_city_id'];
                            $user_new->ad_agency_id=$val['ad_agency_id'];
                            $user_new->ad_user_type_id=$val['ad_user_type_id'];
                            $user_new->active=true;
                            //dd($user_new);
                            if($user_new->save()) {
                                $query_retailer_user = \DB::table('ad_retailer_users')
                                    ->insert(
                                        [
                                            'ad_retailer_id'=>$id_retailer,
                                            'ad_user_id'=>$user_new->id,
                                            'active' => true,
                                            'created_at'=>date("Y-m-d H:i:s"),
                                            'updated_at'=>date("Y-m-d H:i:s")
                                        ]
                                    );
                                $query_insert = \DB::table('ad_user_profiles')->insert(
                                    [
                                        'ad_user_id'=>$user_new->id,
                                        'ad_profile_id'=>3,
                                        'active'=>true,
                                        'created_at'=>date("Y-m-d H:i:s"),
                                        'updated_at'=>date("Y-m-d H:i:s")
                                    ]
                                );
                            }

                        }catch(QueryException $e){
                            echo $e->getMessage();
                        }
                    }else{
                        $repeated[]=array(
                            'usuario'=>$val['usuario'],
                            'nombre'=>$val['nombre'],
                            'email'=>$val['email']
                        );

                    }
                }

                echo 'Se importo correctamente los datos del archivo';
                if(count($repeated)>0){
                    echo'<br>';
                    echo'<strong>En la importacion del archivo se encontro usuarios/emails repetidos:</strong>';
                    echo'<br>';
                    foreach($repeated as $ind => $data){
                        echo $data['usuario'].' | '.$data['nombre'].' | '.$data['email'];echo'<br>';
                    }
                }


            });
            unlink('assets/files/'.$fileName);

        }else{
            return redirect()->back()->with(array('error'=>'Error no se subio correctamente el archivo, intente otra vez'));
        }
    }

    //FUNCIONES AJAX
    public function ajax_agency($id_retailer_city)
    {
        $agencia=\DB::table('ad_retailer_city_agencies')
                    ->join('ad_agencies', 'ad_retailer_city_agencies.ad_agency_id', '=', 'ad_agencies.id')
                    ->select('ad_agencies.id', 'ad_agencies.name')
                    ->where('ad_retailer_city_agencies.ad_retailer_city_id', '=', $id_retailer_city)
                    ->get();
        //return response()->json($agencia);
        return $agencia;
    }

    public function ajax_finduser($usuario){
        $finduser=\DB::table('ad_users')
                    ->select('username')
                    ->where('username', '=', $usuario)
                    ->get();
        return response()->json($finduser);
    }

    public function ajax_current_password($id_user,$contrasenia_actual){
        //dd(Hash::make($contrasenia_actual));
        $find_password = \DB::table('ad_users')
                            ->where('id', '=', $id_user)
                            ->first();

        if (Hash::check($contrasenia_actual, $find_password->password)) {
            // The passwords match...
            return 1;
        }else{
            return 0;
        }
    }

    public function ajax_active_inactive($id_user, $text){
        if($text=='inactive'){
            $user_update = User::find($id_user);
            $user_update->active=false;
            if($user_update->save()) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $user_update = User::find($id_user);
            $user_update->active=true;
            if($user_update->save()) {
                return 1;
            }else{
                return 0;
            }
        }
    }

    public function ajax_disabled_permissions($id_user){
        //dd($id_user);
        $query = \DB::table('ad_user_permissions')->where('ad_user_id',$id_user)->delete();
        if($query){
            return 1;
        }else{
            return 0;
        }

    }

    public function ajax_user_profiles(Guard $auth){
        if($auth->user()->type->code=='OPT'){
            $query = \DB::table('ad_profiles')
                            ->where('slug','<>','SUP')
                            ->where('slug','<>','REP')
                            ->where('slug','<>','TEP')
                            ->get();
        }else{
            $query = \DB::table('ad_profiles')->get();
        }
        //dd($query);
        if($query){
            return response()->json($query);
        }
    }

    public function ajax_find_email($email){
        $query = \DB::table('ad_users')
                        ->where('email', '=', $email)
                        ->first();
        if(count($query)>0){
            return 1;
        }else{
            return 0;
        }
    }

    public function ajax_find_email_edit($email, $id_usuario){
        $query = \DB::table('ad_users')
            ->where('email', '=', $email)
            ->where('id', '<>', $id_usuario)
            ->first();
        if(count($query)>0){
            return 1;
        }else{
            return 0;
        }
    }

    public function ajax_city($id_retailer){
        $query_city = \DB::table('ad_retailer_cities as arc')
            ->join('ad_cities as ac', 'ac.id', '=', 'arc.ad_city_id')
            ->select('arc.id as id_retailer_city', 'ac.name as city', 'ac.id as id_city')
            ->where('arc.active',true)
            ->where('arc.ad_retailer_id',$id_retailer)
            ->get();
        return response()->json($query_city);
    }

    public function ajax_permissions($user_type)
    {
        if($user_type=='UST'){
            $permissions_list = \DB::table('ad_permissions')
                ->where('slug','like','R%')
                ->get();
        }elseif($user_type=='OPT'){
            $permissions_list = \DB::table('ad_permissions')
                ->where('slug','like','A%')
                ->get();
        }
        return response()->json($permissions_list);
    }

    public function ajax_idcompany($id_profile)
    {
        $query_company = \DB::table('ad_companies')
            ->get();
        return response()->json($query_company);
    }

    public function ajax_idproduct($id_profile)
    {
        $query_product = \DB::table('ad_products')
            ->get();
        return response()->json($query_product);
    }
}
