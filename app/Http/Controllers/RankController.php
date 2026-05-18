<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RankController extends Controller
{
    public function index()
    {
        $ranks = Rank::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('rank_code', 'like', "%{$search}%");
            })
            ->orderByRankCode()
            ->paginate(10);

        return Inertia::render('Settings/Ranks/IndexModal', [
            'ranks' => $ranks,
            'filters' => request()->only(['search']),
        ]);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rank_code' => 'required|string|max:50|unique:ranks,rank_code',
            'is_active' => 'boolean',
        ]);

        $rank = Rank::create($validated);
        
        ActivityLogService::logCreated('ranks', $rank);

        return redirect()->route('admin.settings.ranks.index')
            ->with('success', 'Rank created successfully.');
    }

    
    public function update(Request $request, Rank $rank)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rank_code' => 'required|string|max:50|unique:ranks,rank_code,' . $rank->id,
            'is_active' => 'boolean',
        ]);

        $oldValues = $rank->toArray();
        $rank->update($validated);
        
        ActivityLogService::logUpdated('ranks', $rank, $oldValues);

        return redirect()->route('admin.settings.ranks.index')
            ->with('success', 'Rank updated successfully.');
    }

    public function destroy(Rank $rank)
    {
        ActivityLogService::logDeleted('ranks', $rank);
        $rank->delete();

        return redirect()->route('admin.settings.ranks.index')
            ->with('success', 'Rank deleted successfully.');
    }

    public function toggleStatus(Rank $rank)
    {
        $oldStatus = $rank->is_active;
        $rank->update(['is_active' => !$rank->is_active]);
        
        ActivityLogService::logToggled('ranks', $rank);

        return redirect()->route('admin.settings.ranks.index')
            ->with('success', 'Rank status updated successfully.');
    }
}
