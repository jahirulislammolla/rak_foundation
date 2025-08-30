<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FocusArea;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FocusAreaController extends Controller
{
    // PUBLIC: grid page (your “Our Focus Area” section)
    public function publicIndex()
    {
        $items = FocusArea::active()->orderBy('order')->get();
        return view('focus-areas.index', compact('items'));
    }

    // PUBLIC: full details page
    public function show($slug) 
    {
        $focus_area = FocusArea::where('slug', $slug)->first();
        if (!$focus_area) {
            abort(404); // Proper 404 page দেখাবে
        }
        return view('focus_area_details', compact('focus_area'));
    }

    // ADMIN: list
    public function index()
    {
        $items = FocusArea::orderBy('order')->paginate(20);
        return view('admin.focus-areas.index', compact('items'));
    }

    // ADMIN: create
    public function create()
    {
        return view('admin.focus-areas.create');
    }

    // ADMIN: store
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'              => 'required|string|max:190',
            'slug'               => 'nullable|string|max:190|unique:focus_areas,slug',
            'icon_class'         => 'nullable|string|max:190',
            'image'              => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'short_description'  => 'nullable|string|max:255',
            'description'        => 'nullable|string',
            'order'              => 'nullable|integer|min:0',
            'is_active'          => 'nullable|boolean',
        ]);

        // slug generate if not provided
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        // make slug unique if clash
        if (FocusArea::where('slug',$data['slug'])->exists()) {
            $data['slug'] .= '-'.Str::random(4);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('focus-areas', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['order']     = $data['order'] ?? 0;

        FocusArea::create($data);

        return redirect()->route('admin.focus-areas.index')
            ->with('success','Focus area created.');
    }

    // ADMIN: edit
    public function edit(FocusArea $focusArea)
    {
        return view('admin.focus-areas.edit', ['item'=>$focusArea]);
    }

    // ADMIN: update
    public function update(Request $request, FocusArea $focusArea)
    {
        $data = $request->validate([
            'title'              => 'required|string|max:190',
            'slug'               => 'nullable|string|max:190|unique:focus_areas,slug,'.$focusArea->id,
            'icon_class'         => 'nullable|string|max:190',
            'image'              => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'short_description'  => 'nullable|string|max:255',
            'description'        => 'nullable|string',
            'order'              => 'nullable|integer|min:0',
            'is_active'          => 'nullable|boolean',
        ]);

        $data['slug'] = $data['slug'] ? Str::slug($data['slug']) : Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('focus-areas', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['order']     = $data['order'] ?? $focusArea->order;

        $focusArea->update($data);

        return redirect()->route('admin.focus-areas.index')
            ->with('success','Focus area updated.');
    }

    // ADMIN: delete
    public function destroy(FocusArea $focusArea)
    {
        $focusArea->delete();
        return back()->with('success','Deleted.');
    }
}
