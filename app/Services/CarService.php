<?php

namespace App\Services;

use App\Models\Car;
use App\Repositories\CarRepository;

class CarService
{
    protected $repository;

    public function __construct(CarRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCars($searchTerm = null, $perPage = 10)
    {
        return $this->repository->getAllWithSearch($searchTerm, $perPage);
    }

    public function getCar(Car $car)
    {
        return $this->repository->find($car);
    }

    public function createCar(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateCar(Car $car, array $data)
    {
        return $this->repository->update($car, $data);
    }

    public function deleteCar(Car $car)
    {
        return $this->repository->delete($car);
    }
}