<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TradeController extends Controller
{
    public function index()
    {
        $trades = Trade::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return Inertia::render('Settings/Trades/IndexModal', [
            'trades' => $trades,
            'filters' => request()->only(['search']),
        ]);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:trades,code',
            'is_active' => 'boolean',
        ]);

        $trade = Trade::create($validated);
        
        ActivityLogService::logCreated('trades', $trade);

        return redirect()->route('admin.settings.trades.index')
            ->with('success', 'Trade created successfully.');
    }

    
    public function update(Request $request, Trade $trade)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:trades,code,' . $trade->id,
            'is_active' => 'boolean',
        ]);

        $oldValues = $trade->toArray();
        $trade->update($validated);
        
        ActivityLogService::logUpdated('trades', $trade, $oldValues);

        return redirect()->route('admin.settings.trades.index')
            ->with('success', 'Trade updated successfully.');
    }

    public function destroy(Trade $trade)
    {
        ActivityLogService::logDeleted('trades', $trade);
        $trade->delete();

        return redirect()->route('admin.settings.trades.index')
            ->with('success', 'Trade deleted successfully.');
    }

    public function toggleStatus(Trade $trade)
    {
        $oldStatus = $trade->is_active;
        $trade->update(['is_active' => !$trade->is_active]);
        
        ActivityLogService::logToggled('trades', $trade);

        return redirect()->route('admin.settings.trades.index')
            ->with('success', 'Trade status updated successfully.');
    }
}
