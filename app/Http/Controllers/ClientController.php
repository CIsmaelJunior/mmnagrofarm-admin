<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::withCount('commandes')->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'telephone' => 'nullable|string|max:20',
            'entreprise' => 'nullable|string|max:255',
            'adresse_livraison' => 'nullable|string',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'notes' => 'nullable|string',
            'actif' => 'boolean'
        ]);

        $data = $request->all();
        $data['actif'] = $request->has('actif') ? true : false;

        Client::create($data);

        return redirect()->route('clients.index')
            ->with('success', 'Client créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::with(['commandes' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        return view('dashboard.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('dashboard.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'telephone' => 'nullable|string|max:20',
            'entreprise' => 'nullable|string|max:255',
            'adresse_livraison' => 'nullable|string',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'notes' => 'nullable|string',
            'actif' => 'boolean'
        ]);

        $data = $request->all();
        $data['actif'] = $request->has('actif') ? true : false;

        $client->update($data);

        return redirect()->route('clients.show', $client->id)
            ->with('success', 'Client mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès !');
    }
}
