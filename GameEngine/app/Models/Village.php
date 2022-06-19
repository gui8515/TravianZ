<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    /* Associate table with model
    * @var string
    */

    protected $table = 'villages';

    /* Define fillable attributes
    * @var string[]
    */

    protected $fillable = [
        // 'uuid',
        'id_user',
        'is_capital',
        'id_village',
        'population',
        'loyalty',
        'culture_points',
        'max_culture_points',
        'wood',
        'max_wood',
        'stone',
        'max_stone',
        'iron',
        'max_iron',
        'crop',
        'max_crop',
        'wood_prod',
        'stone_prod',
        'iron_prod',
        'crop_prod',
        'wood_prod_bonus',
        'stone_prod_bonus',
        'iron_prod_bonus',
        'crop_prod_bonus'
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
