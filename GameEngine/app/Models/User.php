<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * the table associated with the model
     * @var string
     */

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'birthday',
        'location',
        'id_tribe',
        'id_alliance',
        'is_plus',
        'is_gold',
        'is_protected',
        'is_online',
        'is_banned',
        'plus_expires_at',
        'gold_expires_at',
        'protect_expires_at',
        'last_online',
        'activated_at',
        'banned_at',
        'access_level',
        'remember_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Validation rules for the model
     * @var array
     */

    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|between:6,32|confirmed',
    ];

}
