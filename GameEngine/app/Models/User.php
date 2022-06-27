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
    use Authenticatable;
    use Authorizable;
    use HasFactory;


    protected $table = 'users';
    // Table associated with the model
    protected $primaryKey = 'id';
    // Primary key of the table
    protected $keyType = 'int';
    // Type of the primary key
    public $incrementing = true;
    // Autoincrementing primary key
    public $timestamps = true;
    // Timestamps

    // Attributes
    protected $attributes = [
        'password' => '1234',
    ];
    // Allowed fields for mass assignment
    protected $fillable = ['*'];

    // Fields that are not allowed for mass assignment
    protected $guarded = [];

    // The attributes excluded from the model's JSON form.
    protected $hidden = [
        'password',
    ];
    // Validation rules for the model
    public static $rules = [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|between:6,32|confirmed',
    ];
    // Relationships
    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
