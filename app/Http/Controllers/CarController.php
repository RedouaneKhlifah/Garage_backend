<?php

namespace App\Http\Controllers;

use App\Events\ModelUpdated;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Services\CarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends Controller
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index(Request $request): JsonResponse
    {
        $searchTerm = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $cars = $this->carService->getAllCars($searchTerm, $perPage);
        return response()->json($cars);
    }

    public function store(CarRequest $request): JsonResponse
    {
        $car = $this->carService->createCar($request->validated());
        broadcast(new ModelUpdated($car, 'car', 'created'));
        return response()->json($car, 201);
    }

    public function show(Car $car): JsonResponse
    {
        $car = $this->carService->getCar($car);
        return response()->json($car);
    }

    public function update(CarRequest $request, Car $car): JsonResponse
    {
        $car = $this->carService->updateCar($car, $request->validated());
        broadcast(new ModelUpdated($car, 'car', 'updated'));
        return response()->json($car);
    }

    public function destroy(Car $car): JsonResponse
    {
        $this->carService->deleteCar($car);
        broadcast(new ModelUpdated($car, 'car', 'deleted'));
        return response()->json(null, 204);
    }
}