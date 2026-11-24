<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'proposal' => 'nullable|string',
        ]);

        $project->bids()->create($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Penawaran berhasil dikirim.');
    }

    public function destroy(Bid $bid)
    {
        $project = $bid->project;
        $bid->delete();

        return redirect()->route('projects.show', $project)
            ->with('success', 'Penawaran berhasil dihapus.');
    }
}