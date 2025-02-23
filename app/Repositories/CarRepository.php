<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Support\Facades\DB;

class CarRepository
{
    protected $model;

    public function __construct(Car $model)
    {
        $this->model = $model;
    }

    public function getAllWithSearch($searchTerm = null, $perPage = 10)
    {
        $query = $this->model->with([
            'marque', 
            'modele', 
            'detailModele', 
            'client', 
            'technicalInfo', 
            'tires'
        ]);

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('immatriculation', 'like', "%{$searchTerm}%")
                  ->orWhere('numero_chassis', 'like', "%{$searchTerm}%")
                  ->orWhereHas('marque', function ($q) use ($searchTerm) {
                      $q->where('name', 'like', "%{$searchTerm}%");
                  })
                  ->orWhereHas('modele', function ($q) use ($searchTerm) {
                      $q->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function find(Car $car)
    {
        return $this->model->with([
            'marque', 
            'modele', 
            'detailModele', 
            'client', 
            'technicalInfo', 
            'tires'
        ])->findOrFail($car->id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $car = $this->model->create($data);
            
            if (isset($data['technical_info'])) {
                $car->technicalInfo()->create($data['technical_info']);
            }
            
            if (isset($data['tires'])) {
                $car->tires()->createMany($data['tires']);
            }
            
            return $car->load(['technicalInfo', 'tires']);
        });
    }

    public function update(Car $car, array $data)
    {
        return DB::transaction(function () use ($car, $data) {
            $car->update($data);
            
            if (isset($data['technical_info'])) {
                $car->technicalInfo()->updateOrCreate([], $data['technical_info']);
            }
            
            if (isset($data['tires'])) {
                $car->tires()->delete();
                $car->tires()->createMany($data['tires']);
            }
            
            return $car->load(['technicalInfo', 'tires']);
        });
    }

    public function delete(Car $car)
    {
        return DB::transaction(function () use ($car) {
            $car->technicalInfo()->delete();
            $car->tires()->delete();
            return $car->delete();
        });
    }
}