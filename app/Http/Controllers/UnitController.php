<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return Inertia::render('Settings/Units/IndexModal', [
            'units' => $units,
            'filters' => request()->only(['search']),
        ]);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:units,code',
            'is_active' => 'boolean',
        ]);

        $unit = Unit::create($validated);
        
        ActivityLogService::logCreated('units', $unit);

        return redirect()->route('admin.settings.units.index')
            ->with('success', 'Unit created successfully.');
    }

    
    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:units,code,' . $unit->id,
            'is_active' => 'boolean',
        ]);

        $oldValues = $unit->toArray();
        $unit->update($validated);
        
        ActivityLogService::logUpdated('units', $unit, $oldValues);

        return redirect()->route('admin.settings.units.index')
            ->with('success', 'Unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        ActivityLogService::logDeleted('units', $unit);
        $unit->delete();

        return redirect()->route('admin.settings.units.index')
            ->with('success', 'Unit deleted successfully.');
    }

    public function toggleStatus(Unit $unit)
    {
        $oldStatus = $unit->is_active;
        $unit->update(['is_active' => !$unit->is_active]);
        
        ActivityLogService::logToggled('units', $unit);

        return redirect()->route('admin.settings.units.index')
            ->with('success', 'Unit status updated successfully.');
    }
}
