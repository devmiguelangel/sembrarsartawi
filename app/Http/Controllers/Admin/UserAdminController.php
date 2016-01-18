<?php

namespace Sibas\Http\Controllers\Admin;

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
            }
            //dd($users);
            return view('admin.user.list', compact('nav', 'action', 'users', 'main_menu'));
        }elseif($action=='new'){
            $cities = \DB::table('ad_retailer_cities')
                        ->join('ad_cities','ad_retailer_cities.ad_city_id', '=', 'ad_cities.id')
                        ->select('ad_cities.id', 'ad_cities.name', 'ad_cities.abbreviation')
                        ->where('ad_retailer_cities.active', '=', 1)
                        ->get();
            return view('admin.user.new', compact('nav','action', 'cities', 'main_menu'));
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
        $user_new = new User();
        $user_new->id=date('U');
        $user_new->username=$request->input('txtIdusuario');
        $user_new->password=Hash::make($request->input('contrasenia'));
        $user_new->full_name=$request->input('txtNombre');
        $user_new->email=$request->input('txtEmail');
        $user_new->phone_number=$request->input('txtTelefono');
        $user_new->ad_city_id=$request->input('depto');
        $user_new->ad_agency_id=$request->input('agencia');
        $user_new->ad_user_type_id=$request->input('tipo_usuario');
        $user_new->active=true;
        if($user_new->save()) {
            return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list']);
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
    public function edit($nav, $action, $id_user)
    {
        $main_menu = $this->menu_principal();
        if($action=='edit'){
            $user_find = \DB::table('ad_users')
                            ->where('id', '=', $id_user)
                            ->first();

            //dd($user_find);
            $cities = \DB::table('ad_retailer_cities')
                ->join('ad_cities','ad_retailer_cities.ad_city_id', '=', 'ad_cities.id')
                ->select('ad_cities.id', 'ad_cities.name', 'ad_cities.abbreviation')
                ->where('ad_cities.abbreviation', '<>', 'PE')
                ->where('ad_retailer_cities.active', '=', 1)
                ->get();
            //dd($cities);

            $agencies = \DB::table('ad_retailer_city_agencies')
                            ->join('ad_agencies', 'ad_retailer_city_agencies.ad_agency_id', '=', 'ad_agencies.id')
                            ->select('ad_agencies.id', 'ad_agencies.name')
                            ->where('ad_retailer_city_agencies.ad_retailer_city_id', '=', $user_find->ad_city_id)
                            ->get();
            //dd($agencies);

            return view('admin.user.edit', compact('nav', 'action', 'user_find', 'cities', 'agencies', 'main_menu'));
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
        $user_update = User::find($request->input('id_user'));
        $user_update->full_name=$request->input('txtNombre');
        $user_update->email=$request->input('txtEmail');
        $user_update->phone_number=$request->input('txtTelefono');
        $user_update->ad_city_id=$request->input('depto');
        $user_update->ad_agency_id=$request->input('agencia');
        $user_update->ad_user_type_id=$request->input('tipo_usuario');
        if($user_update->save()) {
            return redirect()->route('admin.user.list', ['nav' => 'user', 'action' => 'list']);
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
    public function ajax_agency($id_depto)
    {
        $agencia=\DB::table('ad_retailer_city_agencies')
                    ->join('ad_agencies', 'ad_retailer_city_agencies.ad_agency_id', '=', 'ad_agencies.id')
                    ->select('ad_agencies.id', 'ad_agencies.name')
                    ->where('ad_retailer_city_agencies.ad_retailer_city_id', '=', $id_depto)
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
}
