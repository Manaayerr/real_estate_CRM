<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProjectController;
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


    // ⭐ إحصائيات حالات العملاء
    $leadStatuses = Lead::select('status')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('status')
        ->get();


    // ⭐ المواعيد القادمة
    $upcomingAppointments = Appointment::with('lead')
        ->where('appointment_date', '>=', now())
        ->orderBy('appointment_date')
        ->take(5)
        ->get();


    return view('dashboard', compact(

        'totalLeads',

        'newLeads',

        'appointments',

        'deals',

        'latestLeads',

        // ⭐ إرسال المواعيد القادمة للـ Dashboard
        'upcomingAppointments',

        // ⭐ إرسال إحصائيات الحالات للـ Dashboard
        'leadStatuses'

    ));

})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // ⭐ Projects CRUD
    Route::resource('projects', ProjectController::class);

});


/*
|--------------------------------------------------------------------------
| Leads
|--------------------------------------------------------------------------
*/

// عرض جميع العملاء المحتملين
Route::get('/leads', [LeadController::class, 'index'])
    ->middleware('auth')
    ->name('leads.index');


// صفحة إضافة عميل محتمل
Route::get('/leads/create', [LeadController::class, 'create'])
    ->middleware('auth')
    ->name('leads.create');


// حفظ عميل محتمل
Route::post('/leads', [LeadController::class, 'store'])
    ->middleware('auth')
    ->name('leads.store');


// عرض عميل محتمل
Route::get('/leads/{lead}', [LeadController::class, 'show'])
    ->middleware('auth')
    ->name('leads.show');


// صفحة تعديل عميل محتمل
Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])
    ->middleware('auth')
    ->name('leads.edit');


// تحديث عميل محتمل
Route::put('/leads/{lead}', [LeadController::class, 'update'])
    ->middleware('auth')
    ->name('leads.update');


// حذف عميل محتمل
Route::delete('/leads/{lead}', [LeadController::class, 'destroy'])
    ->middleware('auth')
    ->name('leads.destroy');


require __DIR__.'/auth.php';