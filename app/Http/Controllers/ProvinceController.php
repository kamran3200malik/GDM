<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return Inertia::render('Settings/Provinces/Index', [
            'provinces' => $provinces,
            'filters' => request()->only(['search']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:provinces,code',
            'is_active' => 'boolean',
        ]);

        $province = Province::create($validated);
        
        ActivityLogService::logCreated('provinces', $province);

        return redirect()->route('admin.settings.provinces.index')
            ->with('success', 'Province created successfully.');
    }

    public function update(Request $request, Province $province)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:provinces,code,' . $province->id,
            'is_active' => 'boolean',
        ]);

        $oldValues = $province->toArray();
        $province->update($validated);
        
        ActivityLogService::logUpdated('provinces', $province, $oldValues);

        return redirect()->route('admin.settings.provinces.index')
            ->with('success', 'Province updated successfully.');
    }

    public function destroy(Province $province)
    {
        ActivityLogService::logDeleted('provinces', $province);
        $province->delete();

        return redirect()->route('admin.settings.provinces.index')
            ->with('success', 'Province deleted successfully.');
    }

    public function toggleStatus(Province $province)
    {
        $oldStatus = $province->is_active;
        $province->update(['is_active' => !$province->is_active]);
        
        ActivityLogService::logToggled('provinces', $province);

        return redirect()->route('admin.settings.provinces.index')
            ->with('success', 'Province status updated successfully.');
    }
}
