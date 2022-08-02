<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanad_o5ra extends Model
{
    protected $table = 'sanad_o5ra';
    protected $guarded = [];
    protected $filable = ['name','code','date'];
    // public $timestamps = false;

    public function mostafed_type(){
        return 'حسابات أخرى';
    }
    public function sanadable()
    {
        return $this->belongsTo(O5ra_7sabat::class,'mandoub_id');
    }
}
