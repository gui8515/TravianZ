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

    // Table associated with the model
    protected $table = 'users';

    // The attributes that are mass assignable.
    protected $fillable = ['*'];

    // The attributes that not mass assignable.
    protected $guarded = [];

    // The attributes excluded from the model's JSON form.
    protected $hidden = [
        'password',
    ];

    // Validation rules for the model
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|between:6,32|confirmed',
    ];

    // Relationships
    public function villages()    {
        return $this->hasMany(Village::class);
    }

}
