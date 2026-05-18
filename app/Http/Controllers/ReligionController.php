<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReligionController extends Controller
{
    public function index()
    {
        $religions = Religion::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return Inertia::render('Settings/Religions/IndexModal', [
            'religions' => $religions,
            'filters' => request()->only(['search']),
        ]);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $religion = Religion::create($validated);
        
        ActivityLogService::logCreated('religions', $religion);

        return redirect()->route('admin.settings.religions.index')
            ->with('success', 'Religion created successfully.');
    }

    
    public function update(Request $request, Religion $religion)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $oldValues = $religion->toArray();
        $religion->update($validated);
        
        ActivityLogService::logUpdated('religions', $religion, $oldValues);

        return redirect()->route('admin.settings.religions.index')
            ->with('success', 'Religion updated successfully.');
    }

    public function destroy(Religion $religion)
    {
        ActivityLogService::logDeleted('religions', $religion);
        $religion->delete();

        return redirect()->route('admin.settings.religions.index')
            ->with('success', 'Religion deleted successfully.');
    }

    public function toggleStatus(Religion $religion)
    {
        $oldStatus = $religion->is_active;
        $religion->update(['is_active' => !$religion->is_active]);
        
        ActivityLogService::logToggled('religions', $religion);

        return redirect()->route('admin.settings.religions.index')
            ->with('success', 'Religion status updated successfully.');
    }
}
