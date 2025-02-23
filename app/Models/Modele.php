<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque_id',
        'name'
    ];

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function detailModeles()
    {
        return $this->hasMany(DetailModele::class);
    }
}