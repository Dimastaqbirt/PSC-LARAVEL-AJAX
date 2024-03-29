<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}