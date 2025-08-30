<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommitteeController extends Controller
{
    // Admin list page
    public function index()
    {
        $committees = Committee::orderBy('priority')->orderByDesc('id')->paginate(20);
        return view('admin.committees.index', compact('committees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'               => ['required','string','max:190'],
            'designation'        => ['required','string','max:190'],
            'short_description'  => ['nullable','string','max:255'],
            'photo'              => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'priority'           => ['nullable','integer','min:0'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('committees','public');
        }
        $data['priority'] = $data['priority'] ?? 0;

        Committee::create($data);

        return back()->with('success','Committee member created.');
    }

    public function update(Request $request, Committee $committee)
    {
        $data = $request->validate([
            'name'               => ['required','string','max:190'],
            'designation'        => ['required','string','max:190'],
            'short_description'  => ['nullable','string','max:255'],
            'photo'              => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'priority'           => ['nullable','integer','min:0'],
        ]);

        if ($request->hasFile('photo')) {
            if ($committee->photo) {
                Storage::disk('public')->delete($committee->photo);
            }
            $data['photo'] = $request->file('photo')->store('committees','public');
        }

        $committee->update($data);

        return back()->with('success','Committee member updated.');
    }

    public function destroy(Committee $committee)
    {
        if ($committee->photo) {
            Storage::disk('public')->delete($committee->photo);
        }
        $committee->delete();
        return back()->with('success','Committee member deleted.');
    }
}
