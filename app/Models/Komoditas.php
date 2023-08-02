<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    use HasFactory;
    protected $table = 'komoditas';
    // protected $guarded = ['id'];
    protected $guarded = [];


    public function pangan()
    {
        return $this->hasMany(Pangan::class);
    }

   

   
}
