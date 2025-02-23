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
    protected $clientService;

    public function __construct(FournisseurService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index(Request $request): JsonResponse
    {
        $searchTerm = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $fournisseurs = $this->clientService->getAllFournisseurs($searchTerm, $perPage);
        return response()->json($fournisseurs);
    }

    public function store(FournisseurRequest $request): JsonResponse
    {
        $client = $this->clientService->createFournisseur($request->validated());
        broadcast(new ModelUpdated($client, 'client', 'created'));
        return response()->json($client, 201);
    }

    public function show(Fournisseur $client): JsonResponse
    {
        $client = $this->clientService->getFournisseur($client);
        return response()->json($client);
    }

    public function update(FournisseurRequest $request, Fournisseur $client): JsonResponse
    {
        $client = $this->clientService->updateFournisseur($client, $request->validated());
        broadcast(new ModelUpdated($client, 'client', 'updated'));

        return $client
            ? response()->json($client)
            : response()->json(['message' => 'Fournisseur not found'], 404);
    }

    public function destroy(Fournisseur $client): JsonResponse
    {
        $success = $this->clientService->deleteFournisseur($client);
        broadcast(new ModelUpdated($client, 'client', 'deleted'));

        return response()->json(null, 204);
    }
}