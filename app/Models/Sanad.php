<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanad extends Model
{
    protected $table = 'sanad';
    protected $guarded = [];
    protected $filable = ['name','type','code','model_type','model_id','date'];
    // public $timestamps = false;
     protected $casts = [
        'amount' => 'double',
       
    ];

    public function sanadable()
    {
        return $this->morphTo();
    }

    public function khazna() 
    {
        return $this->belongsTo(khazna::class,'khazna_id');
    }
    public function mostafed_type()
    {
        if($this->sanadable_type =='App\Models\BranchInfo')
            return 'فرع';
        if($this->sanadable_type =='App\Models\Masaref')
            return 'مصاريف';
        if($this->sanadable_type =='App\Models\O5ra_7sabat')
            return 'اخرى';
        if($this->sanadable_type =='App\User')
        {
            return ($this->sanadable->type_) ;  
        }
    }
}
