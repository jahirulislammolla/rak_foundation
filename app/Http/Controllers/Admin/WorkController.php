<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    /* --------- PUBLIC --------- */
    public function publicIndex(Request $request)
    {
        $cat = WorkCategory::where('slug', $request->get('category'))
                ->where('is_active', true)->first();

        $works = Work::with('category')
            ->publishedActive()
            ->when($cat, fn($q)=>$q->where('work_category_id', $cat->id))
            ->orderBy('priority')->orderByDesc('published_at')
            ->paginate(9)->appends($request->only('category'));

        $categories = WorkCategory::where('is_active',true)->orderBy('priority')->get(['id','name','slug']);
        return view('works.index', compact('works','categories','cat'));
    }

    public function show($slug)
    {
        $work = Work::with('category')->publishedActive()->where('slug',$slug)->firstOrFail();
        return view('works.show', compact('work'));
    }

    /* --------- ADMIN --------- */
    public function index()
    {
        $works = Work::with('category')->orderBy('priority')->orderByDesc('published_at')->paginate(20);
        $categories = WorkCategory::orderBy('priority')->get(['id','name']);
        return view('admin.works.index', compact('works','categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => ['required','string','max:190'],
            'slug'             => ['nullable','string','max:190','unique:works,slug'],
            'work_category_id' => ['nullable','exists:work_categories,id'],
            'author_name'      => ['nullable','string','max:190'],
            'excerpt'          => ['nullable','string','max:300'],
            'body'             => ['nullable','string'],
            'image'            => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'published_at'     => ['nullable','date'],
            'priority'         => ['nullable','integer','min:0'],
            'is_active'        => ['nullable','boolean'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        if (Work::where('slug',$data['slug'])->exists()) $data['slug'] .= '-'.Str::random(4);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('works','public');
        }
        $data['is_active'] = $request->boolean('is_active', true);
        $data['priority']  = $data['priority'] ?? 0;

        Work::create($data);
        return back()->with('success','Work created.');
    }

    public function update(Request $request, Work $work)
    {
        $data = $request->validate([
            'title'            => ['required','string','max:190'],
            'slug'             => ['nullable','string','max:190','unique:works,slug,'.$work->id],
            'work_category_id' => ['nullable','exists:work_categories,id'],
            'author_name'      => ['nullable','string','max:190'],
            'excerpt'          => ['nullable','string','max:300'],
            'body'             => ['nullable','string'],
            'image'            => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'published_at'     => ['nullable','date'],
            'priority'         => ['nullable','integer','min:0'],
            'is_active'        => ['nullable','boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($work->image) Storage::disk('public')->delete($work->image);
            $data['image'] = $request->file('image')->store('works','public');
        }
        $data['is_active'] = $request->boolean('is_active', true);
        $data['priority']  = $data['priority'] ?? $work->priority;

        $work->update($data);
        return back()->with('success','Work updated.');
    }

    public function destroy(Work $work)
    {
        if ($work->image) Storage::disk('public')->delete($work->image);
        $work->delete();
        return back()->with('success','Deleted.');
    }
}
