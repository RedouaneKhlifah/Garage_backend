<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

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
        'vat_number',
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

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'client_id');
    }
}
