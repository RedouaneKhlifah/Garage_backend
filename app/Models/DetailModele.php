<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailModele extends Model
{
    use HasFactory;

    protected $fillable = [
        'modele_id',
        'name'
    ];

    public function modele()
    {
        return $this->belongsTo(Modele::class);
    }
}