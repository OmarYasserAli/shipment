<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchInfo extends Model
{
    protected $primaryKey = 'code_';
    protected $table = 'branch_info_tb';
    protected $guarded = [];


    public function sanadat()
    {
        return $this->morphMany(Sanad::class, 'sanadable');
        
    }
    
}
