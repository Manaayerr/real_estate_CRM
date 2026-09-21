<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * عرض جميع المشاريع
     */
    public function index()
    {
        $projects = Project::withCount('units')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }


    /**
     * صفحة إضافة مشروع
     */
    public function create()
    {
        return view('projects.create');
    }


    /**
     * حفظ مشروع جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'تمت إضافة المشروع بنجاح.');
    }


    /**
     * عرض مشروع واحد
     */
    public function show(Project $project)
    {
        $project->load('units');

        return view('projects.show', compact('project'));
    }


    /**
     * صفحة تعديل المشروع
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }


    /**
     * تحديث المشروع
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);

        $project->update($validated);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'تم تحديث المشروع بنجاح.');
    }


    /**
     * حذف المشروع
     */
    public function destroy(Project $project)
    {
        if ($project->units()->exists()) {
            return redirect()
                ->route('projects.show', $project)
                ->with('error', 'لا يمكن حذف المشروع لأنه يحتوي على وحدات مرتبطة به.');
        }

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'تم حذف المشروع بنجاح.');
    }
}