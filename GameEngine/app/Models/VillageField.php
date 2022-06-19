<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageField extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'village_fields';

    // The attributes that are mass assignable.
    protected $fillable = ['*'];

    // The attributes that not mass assignable.
    protected $guarded = [];

    // The attributes excluded from the model's JSON form.
    protected $hidden = [];

    // Validation rules for the model
    public static $rules = [];

    // Relationships
    public function village()    {
        return $this->belongsTo(Village::class);
    }


}
