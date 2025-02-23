<?php

namespace App\Services;

use App\Models\Fournisseur;
use App\Repositories\FournisseurRepository;

class FournisseurService
{
    protected $repository;

    public function __construct(FournisseurRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllFournisseurs($searchTerm = null, $perPage = 10)
    {
        return $this->repository->getAllWithSearch($searchTerm, $perPage);
    }

    public function getFournisseur(Fournisseur $fournisseur) 
    {
        return $this->repository->find($fournisseur);
    }

    public function createFournisseur(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateFournisseur(Fournisseur $fournisseur, array $data)
    {
        return $this->repository->update($fournisseur, $data);
    }

    public function deleteFournisseur(Fournisseur $fournisseur)
    {
        return $this->repository->delete($fournisseur);
    }
}