<?php

namespace App\Http\Controllers;

use App\Models\Apikeys;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApikeysController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $apikeys = $user->apikeys()->get();

        return Inertia::render('Apikeys/Index', [
            'apikeys' => $apikeys,
        ]);
    }

    public function create()
    {
        return Inertia::render('Apikeys/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $user = auth()->user();

        $user->apiKeys()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('Apikeys.index');
    }

    public function destroy(Apikeys $Apikey)
    {
        $Apikey->delete();

        return redirect()->route('Apikeys.index');
    }
}
