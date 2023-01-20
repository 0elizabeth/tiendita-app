<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpago extends Model
{
    use HasFactory;
    public function ventas(){
        return $this->hasMany(Venta::class);
    }
}
