<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchInfo extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'serial';
    protected $table = 'branch_info_tb';
    protected $guarded = [];
    protected $filables =['name_' ,'name_E' , 'address_' => 'required', 'Tel_','notes_'];
    
}
