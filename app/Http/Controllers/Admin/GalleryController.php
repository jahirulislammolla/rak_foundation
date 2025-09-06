<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $galleries = Gallery::query()
            ->when($request->filled('status'), fn($q)=>
                $request->status==='active' ? $q->where('is_active',1) :
                ($request->status==='inactive' ? $q->where('is_active',0) : $q)
            )
            ->latest()
            ->paginate(20);

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => ['required','string','max:255'],
            'image'      => ['required','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'is_active'  => ['nullable','boolean'],
        ]);

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
            $file->move(base_path('public/gallery'), $fileNameToStore);

            $data['image_path'] = 'gallery/' . $fileNameToStore;
        }

        $data['is_active']  = (bool) ($data['is_active'] ?? true);

        Gallery::create($data);

        return redirect()->route('manage-galleries.index')->with('success', 'Gallery item created.');
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        $data = $request->validate([
            'title'      => ['required','string','max:255'],
            'image'      => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'is_active'  => ['nullable','boolean'],
        ]);

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
            $file->move(base_path('public/gallery'), $fileNameToStore);

            $data['image_path'] = 'gallery/' . $fileNameToStore;
        }

        $data['is_active'] = (bool) ($data['is_active'] ?? $gallery->is_active);

        $gallery->update($data);

        return redirect()->route('manage-galleries.index')->with('success', 'Gallery item updated.');
    }

    public function toggle($id)
    {
        $gallery = Gallery::find($id);
        $gallery->is_active = !$gallery->is_active;
        $gallery->save();

        return back()->with('success', 'Status toggled.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        return back()->with('success', 'Gallery item deleted.');
    }
}
