<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanad_taslim extends Model
{
    protected $table = 'sanad_taslim';
    protected $guarded = [];
    protected $filable = ['name','code','date'];
    // public $timestamps = false;

    public function mostafed_type(){
        return 'مندوب';
    }
    public function sanadable()
    {
        return $this->belongsTo(AllUser::class,'mandoub_id');
    }
}
