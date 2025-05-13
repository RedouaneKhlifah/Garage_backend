<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fournisseur extends Model
{
    use HasFactory , SoftDeletes;

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'civility',
        'company',
        'last_name',
        'first_name',
        'address',
        'postal_code',
        'city',
        'country',
        'email',
        'website',
        'main_phone',
        'secondary_phone',
        'fax',
        'mobile',
        'ice',
        'payment_method',
        'observation',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        if (in_array($this->civility, ['Madame', 'Mademoiselle', 'Monsieur'])) {
            return "{$this->first_name} {$this->last_name}";
        } elseif ($this->civility === 'Société') {
            return $this->company;
        } else {
            return 'Client';
        }
    }
}
