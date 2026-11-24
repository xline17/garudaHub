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
            'amount' => 'required|numeric|min:0',
            'proposal' => 'nullable|string',
        ]);

        if (!empty($validated['proposal'])) {
            $validated['proposal'] = strip_tags($validated['proposal']);
        }

        $project->bids()->create([
            'user_id' => $request->user()->id,
            'amount' => $validated['amount'],
            'proposal' => $validated['proposal'] ?? null,
        ]);

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