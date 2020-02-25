<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
//    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
    public function isAdmin(){
        if ($this->role){
            if($this->role->name == 'admin'){
                return true;
            }
        }
        return false;
    }
        public function isSupervisor(){
        if ($this->role){
            if($this->role->name == 'supervisor'){
                return true;
            }
        }
        return false;
    }

    public function projects(){
        return $this->hasMany('App\Models\Project');
    }

}
