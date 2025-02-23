<?php

namespace App\Repositories;

use App\Models\Fournisseur;

class FournisseurRepository
{
    protected $model;

    public function __construct(Fournisseur $model)
    {
        $this->model = $model;
    }

    public function getAllWithSearch($searchTerm = null, $perPage = 10)
    {
        $query = $this->model->newQuery();
    
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('first_name', 'like', "%{$searchTerm}%")
                  ->orWhere('last_name', 'like', "%{$searchTerm}%");
            });
        }
    
        return $query->orderBy('created_at', 'desc')->paginate($perPage);    }

    public function find(Fournisseur $fournisseur)
    {
        return $fournisseur ;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(Fournisseur $fournisseur, array $data)
    {
        $fournisseur->update($data);
        return $fournisseur;
    }

    public function delete(Fournisseur $fournisseur)
    {
        return $fournisseur->delete();
    }

}