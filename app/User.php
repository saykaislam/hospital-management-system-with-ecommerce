<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = [];
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function roles()
//    {
//        return $this
//            ->belongsToMany('App\Role')
//            ->withTimestamps();
//    }
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

//    public function users()
//    {
//        return $this
//            ->belongsToMany('App\User')
//            ->withTimestamps();
//    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        //dd($role);
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function clinic(){
        return $this->hasOne('App\Clinic');
    }

    public function doctor(){
        return $this->hasOne('App\Doctor');
    }

    public function products()
    {
        return $this->hasMany('App\Product','user_id');
    }

    public function seller(){
        return $this->HasOne('App\Seller','user_id');
    }
    public function shop(){
        return $this->HasOne('App\Shop','user_id');
    }
}
