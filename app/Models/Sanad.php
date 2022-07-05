<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanad extends Model
{
    protected $table = 'sanad';
    protected $guarded = [];
    protected $filable = ['name','type','code','model_type','model_id','date'];
    public $timestamps = false;


    public function sanadable()
    {
        return $this->morphTo();
    }

    public function khazna()
    {
        return $this->belongsTo(khazna::class,'khazna_id');
    }
}
