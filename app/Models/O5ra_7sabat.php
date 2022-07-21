<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class O5ra_7sabat extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'code_';
    protected $table = 'o5ra_7sabat';
    protected $guarded = [];
    public function sanadat()
    {
        return $this->morphMany(Sanad::class, 'sanadable');
        
    }
    
}
