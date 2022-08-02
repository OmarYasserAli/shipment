<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanad_far3 extends Model
{
    protected $table = 'sanad_far3';
    protected $guarded = [];
    protected $filable = ['name','code','date'];
    // public $timestamps = false;

    public function mostafed_type(){
        return 'فرع';
    }
    public function sanadable()
    {
        return $this->belongsTo(BranchInfo::class,'mandoub_id');
    }
}
