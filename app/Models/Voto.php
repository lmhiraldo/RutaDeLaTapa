<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tapa;
use App\Models\Bar;
use App\Models\Bar_Tapa;
use App\Models\User;

class Voto extends Model
{
    use HasFactory;
    
    protected $table = 'votos';

    protected $fillable = ['user_id', 'bar_tapa_id', 'rating', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barTapa()
    {
        return $this->belongsTo(Bar_Tapa::class, 'bar_tapa_id');
    }
}