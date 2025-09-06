<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::query()
            ->with('category:id,name')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.works.index', compact('works'));
    }

    public function create()
    {
        $categories = WorkCategory::query()->orderBy('name')->get(['id','name']);
        $work = new Work(); // for form defaults
        return view('admin.works.create', compact('categories', 'work'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['title']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

                // image store
        if ($request->hasFile('image')) {
            $file = $request->file('image');
                        // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();
            
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/work'), $fileNameToStore);

            $data['image'] = 'work/' . $fileNameToStore;
        }

        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $work = Work::create($data);

       return redirect()->route('manage-works.edit', $work->id)->with('success', 'Work created.');
    }

    public function edit(Request $request, $id)
    {
        $work = Work::find($id);

        $categories = WorkCategory::query()->orderBy('name')->get(['id','name']);
        return view('admin.works.edit', compact('work', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $work = Work::find($id);

        $data = $this->validated($request, $work->id);

        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['title']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
                        // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();
            
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/work'), $fileNameToStore);

            $data['image'] = 'work/' . $fileNameToStore;
        }

        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $work->update($data);

        return redirect()->route('manage-works.edit', $work->id)->with('success', 'Work updated.');
    }

    public function destroy(Work $work)
    {
        $work->delete();
        return back()->with('success', 'Work deleted.');
    }

    protected function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'            => ['required','string','max:255'],
            'slug'             => [
                'nullable','string','max:255',
                Rule::unique('works','slug')->ignore($ignoreId)
            ],
            'work_category_id' => ['nullable','exists:work_categories,id'],
            'author_name'      => ['nullable','string','max:255'],
            'excerpt'          => ['nullable','string','max:300'],
            'body'             => ['nullable','string'],
            'image'            => ['nullable','image','max:2048'],
            'published_at'     => ['nullable','date'],
            'priority'         => ['nullable','integer'],
            'is_active'        => ['nullable','in:0,1'],
        ]);
    }
}
