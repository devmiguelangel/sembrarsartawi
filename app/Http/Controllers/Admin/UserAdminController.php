<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    public function index($nav, $action)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
            if($this->repository->listUser()){
                $users = $this->repository->getModel() ;
            }else{
                $users = null;
            }
            return view('admin.user.list', compact('nav', 'action', 'users', 'main_menu'));
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
            $query_type_user = \DB::table('ad_user_types')->get();

            $permissions = \DB::table('ad_permissions')
                ->get();
            return view('admin.user.new', compact('nav','action', 'cities', 'main_menu', 'query_type_user', 'retailer', 'permissions'));
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
    public function store(Request $request)
    {
        try{
            $array = explode('|',$request->input('tipo_usuario'));
            $arrCity = explode('|', $request->input('depto'));
            $user_new = new User();
            $user_new->id=date('U');
            $user_new->username=$request->input('txtIdusuario');
            $user_new->password=Hash::make($request->input('contrasenia'));
            $user_new->full_name=$request->input('txtNombre');
            $user_new->email=$request->input('txtEmail');
            $user_new->phone_number=$request->input('txtTelefono');
            $user_new->ad_city_id=$arrCity[1];
            $user_new->ad_agency_id=$request->input('agencia');
            $user_new->ad_user_type_id=$array[0];
            $user_new->active=true;
            if($user_new->save()) {
                $query_retailer_user = \DB::table('ad_retailer_users')
                    ->insert(
                        [
                            'ad_retailer_id'=>$request->input('id_retailer'),
                            'ad_user_id'=>$user_new->id,
                            'active' => true,
                            'created_at'=>date("Y-m-d H:i:s"),
                            'updated_at'=>date("Y-m-d H:i:s")
                        ]
                    );
                if($query_retailer_user){
                    if($array[1]=='UST'){
                        try {
                            $query_insert = \DB::table('ad_user_profiles')->insert(
                                [
                                    'ad_user_id'=>$user_new->id,
                                    'ad_profile_id'=>$request->input('id_profile'),
                                    'active'=>true,
                                    'created_at'=>date("Y-m-d H:i:s"),
                                    'updated_at'=>date("Y-m-d H:i:s")
                                ]
                            );

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

                            return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list']);

                        } catch(QueryException $e) {
                            return redirect()->back()->with(array('error'=>$e->getMessage()));
                        }

                    }else{
                        return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list']);
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
    public function edit($nav, $action, $id_user, $id_retailer)
    {
        $main_menu = $this->menu_principal();
        if($action=='edit'){
            $user_find = \DB::table('ad_users as au')
                            ->join('ad_user_types as aut', 'aut.id', '=', 'au.ad_user_type_id')
                            ->select('au.id as id_user', 'au.ad_user_type_id', 'aut.code', 'au.ad_city_id', 'au.ad_agency_id', 'au.username', 'au.full_name', 'au.phone_number', 'au.email')
                            ->where('au.id', '=', $id_user)
                            ->first();

            $user_permission = \DB::table('ad_user_permissions')
                                    ->where('ad_user_id', $user_find->id_user)
                                    ->get();
            //dd($user_permission);
            $profile_find = \DB::table('ad_user_profiles')
                            ->where('ad_user_id', '=', $user_find->id_user)
                            ->first();

            $query_prof = \DB::table('ad_profiles')
                               ->get();

            $cities = \DB::table('ad_retailer_cities')
                ->join('ad_cities','ad_retailer_cities.ad_city_id', '=', 'ad_cities.id')
                ->select('ad_retailer_cities.id as id_retailer_city', 'ad_cities.name', 'ad_cities.abbreviation', 'ad_cities.id as id_city')
                ->where('ad_retailer_cities.active', '=', 1)
                ->get();
            //dd($cities);

            $retailer = \DB::table('ad_retailers')
                ->where('active', true)
                ->where('id', $id_retailer)
                ->first();

            //dd($user_find->ad_city_id);
            if(!empty($user_find->ad_city_id)){
                $query_find_city = \DB::table('ad_retailer_cities')
                    ->where('ad_city_id',$user_find->ad_city_id)
                    ->first();

                $agencies = \DB::table('ad_retailer_city_agencies')
                    ->join('ad_agencies', 'ad_retailer_city_agencies.ad_agency_id', '=', 'ad_agencies.id')
                    ->select('ad_agencies.id', 'ad_agencies.name')
                    ->where('ad_retailer_city_agencies.ad_retailer_city_id', '=', $query_find_city->id)
                    ->get();
                //dd($agencies);
            }else{
                $agencies = null;
            }

            $query_type_user = \DB::table('ad_user_types')->get();

            $permissions = \DB::table('ad_permissions')
                                ->get();
            //dd($permissions);
            return view('admin.user.edit', compact('nav', 'action', 'user_find', 'cities', 'agencies', 'main_menu', 'query_type_user', 'profile_find', 'query_prof', 'retailer', 'permissions', 'user_permission'));
        }elseif($action=='changepass'){
            $user_find = \DB::table('ad_users')
                            ->where('id', '=', $id_user)
                            ->first();

            return view('admin.user.change-password', compact('nav', 'action', 'user_find', 'main_menu'));
        }elseif($action=='resetpass'){
            $user_find = \DB::table('ad_users')
                ->where('id', '=', $id_user)
                ->first();
            return view('admin.user.reset-password', compact('nav', 'action', 'user_find', 'main_menu'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $array = explode('|',$request->input('tipo_usuario'));
        $array_city = explode('|', $request->input('depto'));
        $user_update = User::where('id', $request->input('id_user'))->first();
        $user_update->full_name=$request->input('txtNombre');
        $user_update->email=$request->input('txtEmail');
        $user_update->phone_number=$request->input('txtTelefono');
        $user_update->ad_city_id=$array_city[1];
        $user_update->ad_agency_id=$request->input('agencia');
        $user_update->ad_user_type_id=$array[0];
        if($user_update->save()) {
            if($array[1]=='UST'){
                try{
                    $query_update_profile = \DB::table('ad_user_profiles')
                        ->where('ad_user_id', $request->input('id_user'))
                        ->update(['ad_profile_id' => $request->input('id_profile'), 'updated_at'=>date("Y-m-d H:i:s"), 'active'=>true]);

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

                    return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list']);

                } catch(QueryException $e){
                    return redirect()->back()->with(array('error'=>$e->getMessage()));
                }
            }else{
                try{
                    $query_update_profile = \DB::table('ad_user_profiles')
                        ->where('ad_user_id', $request->input('id_user'))
                        ->update(['active'=>false]);
                    if($query_update_profile){
                        return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list']);
                    }
                } catch(QueryException $e){
                    return redirect()->back()->with(array('error'=>$e->getMessage()));
                }
            }
        }
    }

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

    public function ajax_user_profiles($tipo_usuario){
        $query = \DB::table('ad_profiles')->get();
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
}
