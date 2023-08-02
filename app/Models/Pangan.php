<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangan extends Model
{
    use HasFactory;
    
   

    protected $table = 'pangans';
    protected $guarded = ['id'];
    protected $with = ['user','komoditas'];

    protected $casts = [
        'periode' => 'datetime:d-m-Y',
    ];


    public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
     
     public function komoditas()
     {
         return $this->belongsTo(Komoditas::class);
     }

    
}
