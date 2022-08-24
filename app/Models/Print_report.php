<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Print_report extends Model
{
    protected $table = 'print_reports';
    protected $guarded = [];
    protected $filable = ['codes','user_id'];
    public $timestamps = false;

    
    // public function sanadable()
    // {
    //     return $this->belongsTo(AllUser::class,'client_id');
    // }
}
