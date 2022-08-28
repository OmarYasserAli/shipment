<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    protected $table = 'user_history';
    protected $guarded = [];
    protected $filable = ['action_desc','user_id','action_name'];
    public $timestamps = true;


    public function users()
    {
        return $this->belongsTo(AllUser::class,'user_id');
    }
}
