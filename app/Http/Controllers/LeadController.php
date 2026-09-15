<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
    $leads = \App\Models\Lead::with('assignedUser')->latest()->get();

    return view('leads.index', compact('leads'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'budget' => 'nullable|numeric',
        'purchase_purpose' => 'required|string',
        'payment_method' => 'required|string',
        'source' => 'required|string',
        'status' => 'required|string',
        'notes' => 'nullable|string',
    ]);

    $validated['assigned_user_id'] = auth()->id();

    \App\Models\Lead::create($validated);

    return redirect()
        ->route('leads.index')
        ->with('success', 'تمت إضافة العميل بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Lead $lead)
{
    // ⭐ جلب العلاقات المرتبطة بالـ Lead
    $lead->load([
        'assignedUser',
        'units.project',
        'activities.user',
        'appointments.unit',
        'appointments.user',
        'deals.unit',
        'deals.user',
        'customer',
    ]);

    return view('leads.show', compact('lead'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Lead $lead)
{
    return view('leads.edit', compact('lead'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Lead $lead)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'budget' => 'nullable|numeric',
        'purchase_purpose' => 'required|string',
        'payment_method' => 'required|string',
        'source' => 'required|string',
        'status' => 'required|string',
        'notes' => 'nullable|string',
    ]);

    $lead->update($validated);

    return redirect()
        ->route('leads.show', $lead)
        ->with('success', 'تم تحديث بيانات العميل بنجاح.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Lead $lead)
{
    if (
        $lead->activities()->exists() ||
        $lead->appointments()->exists() ||
        $lead->deals()->exists() ||
        $lead->customer()->exists()
    ) {
        return redirect()
            ->route('leads.show', $lead)
            ->with('error', 'لا يمكن حذف هذا العميل لأنه مرتبط بسجلات أخرى.');
    }

    $lead->delete();

    return redirect()
        ->route('leads.index')
        ->with('success', 'تم حذف العميل بنجاح.');
}
}
