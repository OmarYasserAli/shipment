<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanad_3amil extends Model
{
    protected $table = 'sanad_3amil';
    protected $guarded = [];
    protected $filable = ['name','code','date'];
    // public $timestamps = false;

    public function mostafed_type(){
        return 'عميل';
    }
    public function sanadable()
    {
        return $this->belongsTo(AllUser::class,'client_id');
    }
}
