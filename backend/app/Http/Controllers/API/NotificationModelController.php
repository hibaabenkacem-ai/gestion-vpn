<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\NotificationModel;
use Illuminate\Http\Request;

class NotificationModelController extends Controller
{
    public function index()
    {
        return NotificationModel::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinataire' => 'required|string',
            'message' => 'required|string',
            'date_envoi' => 'nullable|date',
        ]);

        $notif = NotificationModel::create($validated);
        return response()->json($notif, 201);
    }

    public function show(NotificationModel $notification)
    {
        return $notification;
    }

    public function update(Request $request, NotificationModel $notification)
    {
        $notification->update($request->only(['destinataire','message','date_envoi']));
        return response()->json($notification);
    }

    public function destroy(NotificationModel $notification)
    {
        $notification->delete();
        return response()->json(['message' => 'Notification supprimée']);
    }
}
