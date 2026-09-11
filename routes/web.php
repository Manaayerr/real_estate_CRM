<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use App\Models\Lead;
use App\Models\Appointment;
use App\Models\Deal;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $totalLeads = Lead::count();

    $newLeads = Lead::where('status', 'new')->count();

    $appointments = Appointment::count();

    $deals = Deal::count();

    $latestLeads = Lead::latest()->take(5)->get();

    return view('dashboard', compact(
        'totalLeads',
        'newLeads',
        'appointments',
        'deals',
        'latestLeads'
    ));
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/leads', [LeadController::class, 'index'])
    ->middleware('auth')
    ->name('leads.index');
Route::get('/leads/create', [LeadController::class, 'create'])
    ->middleware('auth')
    ->name('leads.create');

Route::post('/leads', [LeadController::class, 'store'])
    ->middleware('auth')
    ->name('leads.store');

Route::get('/leads/{lead}', [LeadController::class, 'show'])
    ->middleware('auth')
    ->name('leads.show');

Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])
    ->middleware('auth')
    ->name('leads.edit');

Route::put('/leads/{lead}', [LeadController::class, 'update'])
    ->middleware('auth')
    ->name('leads.update');

Route::delete('/leads/{lead}', [LeadController::class, 'destroy'])
    ->middleware('auth')
    ->name('leads.destroy');

require __DIR__.'/auth.php';
