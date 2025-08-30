<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonController extends Controller
{
    // list with optional type filter
    public function index(Request $request)
    {
        $type = $request->get('type'); // member | volunteer | null
        $q = Person::query()->orderBy('priority')->orderByDesc('id');
        if (in_array($type, ['member','volunteer'])) $q->where('type',$type);
        $people = $q->paginate(20)->appends($request->only('type'));

        return view('admin.people.index', compact('people','type'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:190'],
            'type'     => ['required','in:member,volunteer'],
            'priority' => ['nullable','integer','min:0'],
            'photo'    => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('people','public');
        }
        $data['priority'] = $data['priority'] ?? 0;

        Person::create($data);
        return back()->with('success','Saved.');
    }

    public function update(Request $request, Person $person)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:190'],
            'type'     => ['required','in:member,volunteer'],
            'priority' => ['nullable','integer','min:0'],
            'photo'    => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($person->photo) Storage::disk('public')->delete($person->photo);
            $data['photo'] = $request->file('photo')->store('people','public');
        }

        $person->update($data);
        return back()->with('success','Updated.');
    }

    public function destroy(Person $person)
    {
        if ($person->photo) Storage::disk('public')->delete($person->photo);
        $person->delete();
        return back()->with('success','Deleted.');
    }
}
