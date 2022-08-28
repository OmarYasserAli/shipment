<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Print_report extends Model
{
    protected $table = 'print_reports';
    protected $guarded = [];
    protected $filable = ['codes','user_id','url','print_title'];
    public $timestamps = true;


     public function users()
     {
         return $this->belongsTo(AllUser::class,'user_id');
     }
}
