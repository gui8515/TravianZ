<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageField extends Model
{
    use HasFactory;

    /* Associate table with model
    * @var string
    */

    protected $table = 'village_fields';

    /* Define fillable attributes
    * @var string[]
    */

    protected $fillable = [
        'id_village',
        'field',
        'building',
        'level',
        'is_resource',
    ];

     /* Define hidden attributes
    * @var string[]
    */
    protected $hidden = [
        // 'id',
    ];

    /* Validation rules for the model
    * @var array
    */
    public static $rules = [
        // 'uuid' => 'required|uuid|unique:villages',
    ];


}
