<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tapa;
use App\Models\Bar;
use App\Models\Voto;

class Bar_Tapa extends Model
{
    protected $table = 'bar_tapa';
    protected $primaryKey = 'id';

    protected $fillable = [
        'bar_id',
        'tapa_id',
    ];

    //relacion mucho a muchos 
    public function tapas()
    {
        return $this->belongsToMany(Tapa::class, 'bar_tapa', 'bar_id', 'tapa_id');
    }
    
    //relacion mucho a muchos
    public function bars()
    {
        return $this->belongsToMany(Bar::class, 'bar_tapa', 'tapa_id', 'bar_id');
    }
    
    //un voto se refiere a una tapa_bar especifica
    public function votos()
    {
        return $this->hasMany(Voto::class, 'bar_tapa_id', 'id');
    }

    // Método para calcular el total de votos
    public function totalVotos()
    {
        return $this->votos->sum('rating');
    }
    
}