<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;

class ApiPlaylistController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $playlists = $user->playlists;

        return response()->json($playlists);
    }
}
