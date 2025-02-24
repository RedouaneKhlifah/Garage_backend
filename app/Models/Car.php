<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'immatriculation',
        'date_premiere_immatriculation',
        'client_id',
        'marque_id',
        'modele_id',
        'detail_modele_id',
        'version',
        'energie',
        'type_mines',
        'genre',
        'numero_chassis',
        'carrosserie',
        'numero_moteur',
        'date_prochaine_controle_technique',
        'autre_information',
        'controle_technique',
        'certificat_assurance',
        'company_assurance',
        'observations'
    ];

    protected $casts = [
        'date_premiere_immatriculation' => 'date',
        'date_prochaine_controle_technique' => 'date',
        'autre_information' => 'array',
        'controle_technique' => 'array',
        'certificat_assurance' => 'array',
    ];

    // Relationships
    public function technicalInfo()
    {
        return $this->hasOne(CarTechnicalInfo::class);
    }

    public function tires()
    {
        return $this->hasMany(Pneu::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class);
    }

    public function detailModele()
    {
        return $this->belongsTo(DetailModele::class);
    }
}