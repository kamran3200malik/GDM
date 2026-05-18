<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when(request('class_type'), function ($query, $classType) {
                $query->where('class_type', $classType);
            })
            ->orderBy('class_type')
            ->orderBy('name')
            ->paginate(10);

        return Inertia::render('Settings/Sections/IndexModal', [
            'sections' => $sections,
            'filters' => request()->only(['search', 'class_type']),
        ]);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_type' => 'required|in:junior,senior,advance',
            'is_active' => 'boolean',
        ]);

        $section = Section::create($validated);
        
        ActivityLogService::logCreated('sections', $section);

        return redirect()->route('admin.settings.sections.index')
            ->with('success', 'Section created successfully.');
    }

    
    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_type' => 'required|in:junior,senior,advance',
            'is_active' => 'boolean',
        ]);

        $oldValues = $section->toArray();
        $section->update($validated);
        
        ActivityLogService::logUpdated('sections', $section, $oldValues);

        return redirect()->route('admin.settings.sections.index')
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        ActivityLogService::logDeleted('sections', $section);
        $section->delete();

        return redirect()->route('admin.settings.sections.index')
            ->with('success', 'Section deleted successfully.');
    }

    public function toggleStatus(Section $section)
    {
        $oldStatus = $section->is_active;
        $section->update(['is_active' => !$section->is_active]);
        
        ActivityLogService::logToggled('sections', $section);

        return redirect()->route('admin.settings.sections.index')
            ->with('success', 'Section status updated successfully.');
    }
}
