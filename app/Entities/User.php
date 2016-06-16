<?php

namespace Sibas\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ad_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'username', 'email', 'password' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token' ];

    public $incrementing = false;

    protected $with = [
        'retailerUser.retailer',
        'retailerUser.company',
        'type',
        'profile',
        'city',
        'agency',
        'permissions',
    ];


    public function retailerUser()
    {
        return $this->hasOne(RetailerUser::class, 'ad_user_id', 'id');
    }


    public function type()
    {
        return $this->belongsTo(UserType::class, 'ad_user_type_id', 'id');
    }


    public function profile()
    {
        return $this->belongsToMany(Profile::class, 'ad_user_profiles', 'ad_user_id', 'ad_profile_id');
    }


    public function city()
    {
        return $this->belongsTo(City::class, 'ad_city_id', 'id');
    }


    public function agency()
    {
        return $this->belongsTo(Agency::class, 'ad_agency_id', 'id');
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'ad_user_permissions', 'ad_user_id',
            'ad_permission_id')->wherePivot('active', true);
    }

}