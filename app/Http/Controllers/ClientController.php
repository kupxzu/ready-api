<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of clients (read-only).
     */
    public function index()
    {
        $clients = User::where('role', 'client')->get();

        return response()->json([
            'clients' => $clients,
        ]);
    }

    /**
     * Display the specified client (read-only).
     */
    public function show(string $id)
    {
        $client = User::where('role', 'client')->find($id);

        if (!$client) {
            return response()->json([
                'message' => 'Client not found',
            ], 404);
        }

        return response()->json([
            'client' => $client,
        ]);
    }
}
