<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Http\Controllers\UserController;

class Village extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'villages';

    // The attributes that are mass assignable.
    protected $fillable = ['*'];

    // The attributes that not mass assignable.
    protected $guarded = [];

    // The attributes excluded from the model's JSON form.
    protected $hidden = [];

    // Validation rules for the model
    public static $rules = [];

    // Relationships
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function villageFields()
    {
        return $this->hasMany(VillageField::class);
    }
}
