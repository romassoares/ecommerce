<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function index()
    {
        $clients = $this->client->all();
        return view('agenda.client.index', compact('clients'));
    }

    public function create()
    {
        return view('agenda.client.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:150|string|unique:clients',
        ]);
        if ($validated) {
            $save = $this->client->create([
                'name' => $validated['name'],
            ]);
            if ($save) {
                return redirect()->route('client.index')->with('msg', 'item saved successed');
            } else {
                return redirect()->back()->with('msg', 'saving error');
            }
        } else {
            return redirect()->back()->with('msg', 'validation error');
        }
    }
}
