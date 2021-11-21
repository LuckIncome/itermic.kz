<?php namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\UserTrait;
use App\Traits\ModelTrait;

class User extends Authenticatable
{
    use Notifiable, UserTrait, ModelTrait;

    protected $modelName = __CLASS__;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password', 'role_id', 'good', 'admin'
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role ()
    {
        return $this->hasOne('App\Models\Roles', 'id', 'role_id');
    }

    public function getFioAttribute()
    {
        return $this->surname . ' ' . $this->name . ' ' .$this->patronymic;
    }

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = \Hash::make($pass);
    }
}
