<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pneu extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'position',
        'season',
        'width',
        'aspect_ratio',
        'diameter',
        'indice_vitesse',
        'charge',
        'marque',
        'modele',
        'runflat',
        'renforce'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}