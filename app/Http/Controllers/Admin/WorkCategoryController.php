<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkCategoryController extends Controller
{
    public function index()
    {
        $categories = WorkCategory::orderBy('priority')->orderBy('name')->paginate(30);
        return view('admin.work-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required','string','max:190'],
            'slug'       => ['nullable','string','max:190','unique:work_categories,slug'],
            'priority'   => ['nullable','integer','min:0'],
            'is_active'  => ['nullable','boolean'],
        ]);

        $data['slug'] = $data['slug'] ? Str::slug($data['slug']) : Str::slug($data['name']);
        if (WorkCategory::where('slug',$data['slug'])->exists()) {
            $data['slug'] .= '-'.Str::random(4);
        }
        $data['priority']  = $data['priority'] ?? 0;
        $data['is_active'] = $request->boolean('is_active', true);

        WorkCategory::create($data);

        return back()->with('success','Category created.');
    }

    public function update(Request $request, WorkCategory $workCategory)
    {
        $data = $request->validate([
            'name'       => ['required','string','max:190'],
            'slug'       => ['nullable','string','max:190','unique:work_categories,slug,'.$workCategory->id],
            'priority'   => ['nullable','integer','min:0'],
            'is_active'  => ['nullable','boolean'],
        ]);

        $data['slug'] = $data['slug'] ? Str::slug($data['slug']) : Str::slug($data['name']);
        $data['priority']  = $data['priority'] ?? $workCategory->priority;
        $data['is_active'] = $request->boolean('is_active', true);

        $workCategory->update($data);

        return back()->with('success','Category updated.');
    }

    public function destroy(WorkCategory $workCategory)
    {
        // FK is nullOnDelete, so related works' work_category_id will become null
        $workCategory->delete();
        return back()->with('success','Category deleted.');
    }
}
