<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::query()
            ->with('province')
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            })
            ->when(request('province_id'), function ($query, $provinceId) {
                $query->where('province_id', $provinceId);
            })
            ->orderBy('name')
            ->paginate(10);

        $provinces = Province::active()->orderBy('name')->get();

        return Inertia::render('Settings/Districts/Index', [
            'districts' => $districts,
            'provinces' => $provinces,
            'filters' => request()->only(['search', 'province_id']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:districts,code',
            'is_active' => 'boolean',
        ]);

        $district = District::create($validated);
        
        ActivityLogService::logCreated('districts', $district);

        return redirect()->route('admin.settings.districts.index')
            ->with('success', 'District created successfully.');
    }

    public function update(Request $request, District $district)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:districts,code,' . $district->id,
            'is_active' => 'boolean',
        ]);

        $oldValues = $district->toArray();
        $district->update($validated);
        
        ActivityLogService::logUpdated('districts', $district, $oldValues);

        return redirect()->route('admin.settings.districts.index')
            ->with('success', 'District updated successfully.');
    }

    public function destroy(District $district)
    {
        ActivityLogService::logDeleted('districts', $district);
        $district->delete();

        return redirect()->route('admin.settings.districts.index')
            ->with('success', 'District deleted successfully.');
    }

    public function toggleStatus(District $district)
    {
        $oldStatus = $district->is_active;
        $district->update(['is_active' => !$district->is_active]);
        
        ActivityLogService::logToggled('districts', $district);

        return redirect()->route('admin.settings.districts.index')
            ->with('success', 'District status updated successfully.');
    }
}
