<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanad_masaref extends Model
{
    protected $table = 'sanad_masaref';
    protected $guarded = [];
    protected $filable = ['name','code','date'];
    // public $timestamps = false;
    public function mostafed_type(){
        return 'حساب مصاريف';
    }
    public function sanadable()
    {
        return $this->belongsTo(Masaref::class,'mandoub_id');
    }
   
}
