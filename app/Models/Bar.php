<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'address', 'phone', 'opening_hours', 'latitude',
    'longitude'];
    protected $perPage = 20;


    //Relación muchos a muchos  
    public function tapas()
    {
        return $this->belongsToMany(Tapa::class, 'bar_tapa', 'bar_id', 'tapa_id')->withPivot('id')->withTimestamps();
    }   
   

   // Reglas de validación para el modelo Bar
   public static function rules()
   {
       return [
           'name' => 'required|string|max:1000',
           'description' => 'required|string|max:2000',
           'address' => 'required|string|max:1000',
           'phone' => 'required|string|max:20',
           'opening_hours' => 'required|string|max:1000',
           'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
       ];
   }

   
}