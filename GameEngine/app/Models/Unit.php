<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Unit extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
