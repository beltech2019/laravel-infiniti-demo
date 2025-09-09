<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Games;
use Illuminate\Http\Request;
use Log;

class GameController extends Controller
{
    public function index()
    {
        $games = Games::all();
        return view('admin.games.index', compact('games'));
    }

    public function update(Request $request, $id)
    {
        $game = Games::findOrFail($id);
        $game->publish = $game->publish === 1 ? 0 : 1;
        $game->save();
        return back()->with('success', 'Game publish status updated.');
    }
}
