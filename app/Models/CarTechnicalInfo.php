<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarTechnicalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'puissance_fiscale',
        'puissance_reelle_din',
        'co2',
        'cylindree',
        'nombre_places',
        'nombre_portes',
        'dernier_kilometrage_releve'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}