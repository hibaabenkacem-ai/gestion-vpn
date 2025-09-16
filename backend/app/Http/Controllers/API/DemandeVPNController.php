<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DemandeVPN;
use Illuminate\Http\Request;

class DemandeVPNController extends Controller
{
    public function index()
    {
        return DemandeVPN::with(['user','groupe'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'groupe_vpn_id' => 'required|exists:groupe_vpns,id',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
            'justification' => 'required|string',
        ]);

        $demande = DemandeVPN::create($validated);
        return response()->json($demande, 201);
    }

    public function show(DemandeVPN $demande)
    {
        return $demande->load(['user','groupe']);
    }

    public function update(Request $request, DemandeVPN $demande)
    {
        $demande->update($request->only(['date_debut','date_fin','justification','statut']));
        return response()->json($demande);
    }

    public function destroy(DemandeVPN $demande)
    {
        $demande->delete();
        return response()->json(['message' => 'Demande supprimée avec succès']);
    }
}
