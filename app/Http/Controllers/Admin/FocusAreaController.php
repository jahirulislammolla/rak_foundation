<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FocusArea;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FocusAreaController extends Controller
{
    public function index()
    {
        $items = FocusArea::query()->orderBy('order')->paginate(15);
        return view('admin.focus-areas.index', compact('items'));
    }

    public function create()
    {
        $item = new FocusArea(); // empty model for form binding
        return view('admin.focus-areas.create', compact('item'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        // slug auto if empty
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        // store() এবং update()—দুটোতেই
        $data['is_active'] = (int) $request->input('is_active', 1);

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
            $file->move(base_path('public/images'), $fileNameToStore);

            $data['image'] = 'images/' . $fileNameToStore;
        }

        $foucsArea = FocusArea::create($data);

        return redirect()->route('manage-focus-area.edit', $foucsArea->id)
            ->with('success', 'Focus area created successfully.');
    }

    public function edit(FocusArea $focus_area)
    {
        $item = $focus_area;
        return view('admin.focus-areas.edit', compact('item'));
    }

    public function update(Request $request, FocusArea $focus_area)
    {
        $data = $this->validated($request, $focus_area->id);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_active'] = (int) $request->input('is_active', 1);

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
            $file->move(base_path('public/foucsArea'), $fileNameToStore);

            $data['image'] = 'foucsArea/' . $fileNameToStore;
        }

        $focus_area->update($data);

        return redirect()->route('manage-focus-area.edit', $focus_area->id)
            ->with('success', 'Focus area updated successfully.');
    }

    public function destroy(FocusArea $focus_area)
    {
        if ($focus_area->image && Storage::disk('public')->exists($focus_area->image)) {
            Storage::disk('public')->delete($focus_area->image);
        }
        $focus_area->delete();

        return back()->with('success', 'Focus area deleted.');
    }

    private function validated(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:focus_areas,slug' . ($ignoreId ? ',' . $ignoreId : '')],
            'order'             => ['nullable', 'integer', 'min:0'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
            'image'             => ['nullable', 'image', 'max:2048'], // 2MB
            'is_active'         => ['nullable'],
        ]);
    }
}
