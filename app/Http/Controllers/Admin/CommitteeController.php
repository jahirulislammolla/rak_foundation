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

    public function create()
    {
        $committee = new Committee(); // form defaults
        return view('admin.committees.create', compact('committee'));
    }

    public function edit(Request $request, $id)
    {
        $committee = Committee::find($id);

        return view('admin.committees.edit', compact('committee'));
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
            $file = $request->file('photo');
                        // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();
            
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/committee'), $fileNameToStore);

            $data['photo'] = 'committee/' . $fileNameToStore;
        }

        $data['priority'] = $data['priority'] ?? 0;

        $committee = Committee::create($data);

        return redirect()->route('manage-committees.edit', $committee->id)
            ->with('success', 'Committee member created.');
    }

    public function update(Request $request, $id)
    {
        $committee = Committee::find($id);

        $data = $request->validate([
            'name'               => ['required','string','max:190'],
            'designation'        => ['required','string','max:190'],
            'short_description'  => ['nullable','string','max:255'],
            'photo'              => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'priority'           => ['nullable','integer','min:0'],
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
                        // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();
            
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/committee'), $fileNameToStore);

            $data['photo'] = 'committee/' . $fileNameToStore;
        }

        $committee->update($data);

        return redirect()->route('manage-committees.edit', $committee->id)
            ->with('success', 'Committee member updated.');
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
