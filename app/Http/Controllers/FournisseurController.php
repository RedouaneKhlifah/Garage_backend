<?php

namespace App\Http\Controllers;

use App\Events\ModelUpdated;
use App\Http\Requests\FournisseurRequest;
use App\Models\Fournisseur;
use App\Services\FournisseurService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class FournisseurController extends Controller
{
    protected $fournisseurService;

    public function __construct(FournisseurService $fournisseurService)
    {
        $this->fournisseurService = $fournisseurService;
    }

    public function index(Request $request): JsonResponse
    {
        $searchTerm = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $fournisseurs = $this->fournisseurService->getAllFournisseurs($searchTerm, $perPage);
        return response()->json($fournisseurs);
    }

    public function store(FournisseurRequest $request): JsonResponse
    {
        $fournisseur = $this->fournisseurService->createFournisseur($request->validated());
        return response()->json($fournisseur, 201);
    }

    public function show(Fournisseur $fournisseur): JsonResponse
    {
        $fournisseur = $this->fournisseurService->getFournisseur($fournisseur);
        return response()->json($fournisseur);
    }

    public function update(FournisseurRequest $request, Fournisseur $fournisseur): JsonResponse
    {
        $fournisseur = $this->fournisseurService->updateFournisseur($fournisseur, $request->validated());

        return $fournisseur
            ? response()->json($fournisseur)
            : response()->json(['message' => 'Fournisseur not found'], 404);
    }

    public function destroy(Fournisseur $fournisseur): JsonResponse
    {
        $success = $this->fournisseurService->deleteFournisseur($fournisseur);

        return response()->json(null, 204);
    }
}