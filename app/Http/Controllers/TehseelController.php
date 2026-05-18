<?php

namespace App\Http\Controllers;

use App\Models\Tehseel;
use App\Models\District;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TehseelController extends Controller
{
    public function index()
    {
        $tehseels = Tehseel::query()
            ->with('district')
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            })
            ->when(request('district_id'), function ($query, $districtId) {
                $query->where('district_id', $districtId);
            })
            ->orderBy('name')
            ->paginate(10);

        $districts = District::active()->orderBy('name')->get();

        return Inertia::render('Settings/Tehseels/Index', [
            'tehseels' => $tehseels,
            'districts' => $districts,
            'filters' => request()->only(['search', 'district_id']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:tehseels,code',
            'is_active' => 'boolean',
        ]);

        $tehseel = Tehseel::create($validated);
        
        ActivityLogService::logCreated('tehseels', $tehseel);

        return redirect()->route('admin.settings.tehseels.index')
            ->with('success', 'Tehseel created successfully.');
    }

    public function update(Request $request, Tehseel $tehseel)
    {
        $validated = $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:tehseels,code,' . $tehseel->id,
            'is_active' => 'boolean',
        ]);

        $oldValues = $tehseel->toArray();
        $tehseel->update($validated);
        
        ActivityLogService::logUpdated('tehseels', $tehseel, $oldValues);

        return redirect()->route('admin.settings.tehseels.index')
            ->with('success', 'Tehseel updated successfully.');
    }

    public function destroy(Tehseel $tehseel)
    {
        ActivityLogService::logDeleted('tehseels', $tehseel);
        $tehseel->delete();

        return redirect()->route('admin.settings.tehseels.index')
            ->with('success', 'Tehseel deleted successfully.');
    }

    public function toggleStatus(Tehseel $tehseel)
    {
        $oldStatus = $tehseel->is_active;
        $tehseel->update(['is_active' => !$tehseel->is_active]);
        
        ActivityLogService::logToggled('tehseels', $tehseel);

        return redirect()->route('admin.settings.tehseels.index')
            ->with('success', 'Tehseel status updated successfully.');
    }
}
