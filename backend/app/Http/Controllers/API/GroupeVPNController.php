<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\GroupeVPN;
use Illuminate\Http\Request;

class GroupeVPNController extends Controller
{
    public function index()
    {
        return GroupeVPN::with('users')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_groupe' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $groupe = GroupeVPN::create($validated);
        return response()->json($groupe, 201);
    }

    public function show(GroupeVPN $groupe)
    {
        return $groupe->load('users');
    }

    public function update(Request $request, GroupeVPN $groupe)
    {
        $groupe->update($request->only(['nom_groupe','description']));
        return response()->json($groupe);
    }

    public function destroy(GroupeVPN $groupe)
    {
        $groupe->delete();
        return response()->json(['message' => 'Groupe supprimé']);
    }
}
