<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masaref extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'code_';
    protected $table = 'masaref';
    protected $guarded = [];
    public function sanadat()
    {
        return $this->morphMany(Sanad::class, 'sanadable');
        
    }
    
}
