<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\TehseelController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => false,
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function (Request $request) {
    $user = $request->user();
    
    if ($user->isSuperAdmin()) {
        return app(SuperAdminDashboardController::class)->index($request);
    } elseif ($user->isAdmin()) {
        return app(AdminDashboardController::class)->index($request);
    } elseif ($user->isTeacher()) {
        return Inertia::render('Dashboards/TeacherDashboard');
    }
    
    // Fallback to default dashboard
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin specific routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/students', [AdminDashboardController::class, 'getStudents'])->name('students');
    Route::get('/teachers', [AdminDashboardController::class, 'getTeachers'])->name('teachers');
    
    // Student CRUD routes
    Route::resource('students', StudentController::class);
    
    // Settings routes
    Route::prefix('settings')->name('settings.')->group(function () {
        // Sections CRUD
        Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
        Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
        Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
        Route::get('/sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
        Route::put('/sections/{section}', [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');
        Route::post('/sections/{section}/toggle', [SectionController::class, 'toggleStatus'])->name('sections.toggle');
        
        // Units CRUD
        Route::get('/units', [UnitController::class, 'index'])->name('units.index');
        Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
        Route::post('/units', [UnitController::class, 'store'])->name('units.store');
        Route::get('/units/{unit}/edit', [UnitController::class, 'edit'])->name('units.edit');
        Route::put('/units/{unit}', [UnitController::class, 'update'])->name('units.update');
        Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');
        Route::post('/units/{unit}/toggle', [UnitController::class, 'toggleStatus'])->name('units.toggle');
        
        // Ranks CRUD
        Route::get('/ranks', [RankController::class, 'index'])->name('ranks.index');
        Route::get('/ranks/create', [RankController::class, 'create'])->name('ranks.create');
        Route::post('/ranks', [RankController::class, 'store'])->name('ranks.store');
        Route::get('/ranks/{rank}/edit', [RankController::class, 'edit'])->name('ranks.edit');
        Route::put('/ranks/{rank}', [RankController::class, 'update'])->name('ranks.update');
        Route::delete('/ranks/{rank}', [RankController::class, 'destroy'])->name('ranks.destroy');
        Route::post('/ranks/{rank}/toggle', [RankController::class, 'toggleStatus'])->name('ranks.toggle');
        
        // Trades CRUD
        Route::get('/trades', [TradeController::class, 'index'])->name('trades.index');
        Route::get('/trades/create', [TradeController::class, 'create'])->name('trades.create');
        Route::post('/trades', [TradeController::class, 'store'])->name('trades.store');
        Route::get('/trades/{trade}/edit', [TradeController::class, 'edit'])->name('trades.edit');
        Route::put('/trades/{trade}', [TradeController::class, 'update'])->name('trades.update');
        Route::delete('/trades/{trade}', [TradeController::class, 'destroy'])->name('trades.destroy');
        Route::post('/trades/{trade}/toggle', [TradeController::class, 'toggleStatus'])->name('trades.toggle');
        
        // Religions CRUD
        Route::get('/religions', [ReligionController::class, 'index'])->name('religions.index');
        Route::get('/religions/create', [ReligionController::class, 'create'])->name('religions.create');
        Route::post('/religions', [ReligionController::class, 'store'])->name('religions.store');
        Route::get('/religions/{religion}/edit', [ReligionController::class, 'edit'])->name('religions.edit');
        Route::put('/religions/{religion}', [ReligionController::class, 'update'])->name('religions.update');
        Route::delete('/religions/{religion}', [ReligionController::class, 'destroy'])->name('religions.destroy');
        Route::post('/religions/{religion}/toggle', [ReligionController::class, 'toggleStatus'])->name('religions.toggle');
        
        // Provinces CRUD
        Route::get('/provinces', [ProvinceController::class, 'index'])->name('provinces.index');
        Route::post('/provinces', [ProvinceController::class, 'store'])->name('provinces.store');
        Route::put('/provinces/{province}', [ProvinceController::class, 'update'])->name('provinces.update');
        Route::delete('/provinces/{province}', [ProvinceController::class, 'destroy'])->name('provinces.destroy');
        Route::post('/provinces/{province}/toggle', [ProvinceController::class, 'toggleStatus'])->name('provinces.toggle');
        
        // Districts CRUD
        Route::get('/districts', [DistrictController::class, 'index'])->name('districts.index');
        Route::post('/districts', [DistrictController::class, 'store'])->name('districts.store');
        Route::put('/districts/{district}', [DistrictController::class, 'update'])->name('districts.update');
        Route::delete('/districts/{district}', [DistrictController::class, 'destroy'])->name('districts.destroy');
        Route::post('/districts/{district}/toggle', [DistrictController::class, 'toggleStatus'])->name('districts.toggle');
        
        // Tehseels CRUD
        Route::get('/tehseels', [TehseelController::class, 'index'])->name('tehseels.index');
        Route::post('/tehseels', [TehseelController::class, 'store'])->name('tehseels.store');
        Route::put('/tehseels/{tehseel}', [TehseelController::class, 'update'])->name('tehseels.update');
        Route::delete('/tehseels/{tehseel}', [TehseelController::class, 'destroy'])->name('tehseels.destroy');
        Route::post('/tehseels/{tehseel}/toggle', [TehseelController::class, 'toggleStatus'])->name('tehseels.toggle');
        
        // Activity Logs
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
