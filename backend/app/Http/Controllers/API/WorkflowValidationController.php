<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WorkflowValidation;
use Illuminate\Http\Request;

class WorkflowValidationController extends Controller
{
    public function index()
    {
        return WorkflowValidation::with(['demande'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'demande_vpn_id' => 'required|exists:demande_vpns,id',
            'etape_actuelle' => 'required|string',
            'statut' => 'required|string',
            'commentaire' => 'nullable|string',
        ]);

        $workflow = WorkflowValidation::create($validated);
        return response()->json($workflow, 201);
    }

    public function show(WorkflowValidation $workflow)
    {
        return $workflow->load(['demande']);
    }

    public function update(Request $request, WorkflowValidation $workflow)
    {
        $workflow->update($request->only(['statut','commentaire']));
        return response()->json($workflow);
    }

    public function destroy(WorkflowValidation $workflow)
    {
        $workflow->delete();
        return response()->json(['message' => 'Workflow supprimé']);
    }
}
