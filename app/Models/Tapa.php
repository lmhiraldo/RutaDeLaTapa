<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapa extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'img', 'description', 'price'];
    
    protected $primaryKey = 'id';
  
public function bars()
{
    return $this->belongsToMany(Bar::class, 'bar_tapa', 'tapa_id', 'bar_id')->withTimestamps()->withPivot('id');
}

    
}