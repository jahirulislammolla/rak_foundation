<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $q = Event::query()
            ->when($request->filled('status'), fn($qr) =>
                $request->status === 'active' ? $qr->where('is_active', 1) :
                ($request->status === 'inactive' ? $qr->where('is_active', 0) : $qr)
            )
            ->orderByDesc('created_at');

        $events = $q->paginate(20)->withQueryString();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => ['required','string','max:255'],
            'slug'              => ['nullable','string','max:255','unique:events,slug'],
            'short_description' => ['nullable','string'],
            'description'       => ['nullable','string'],
            'location'          => ['nullable','string','max:255'],
            'register_url'      => ['nullable','url'],
            'start_at'          => ['required','date'],
            'end_at'            => ['nullable','date','after_or_equal:start_at'],
            'is_active'         => ['nullable','boolean'],
            'is_featured'       => ['nullable','boolean'],
            'priority'          => ['nullable','integer'],
            'banner'            => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if (empty($data['slug'])) $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
                        // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();
            
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/event'), $fileNameToStore);

            $data['banner_path'] = 'event/' . $fileNameToStore;
        }
        $data['is_active']   = (bool)($data['is_active'] ?? true);
        $data['is_featured'] = (bool)($data['is_featured'] ?? false);
        $data['created_by']  = Auth::id();
        $data['updated_by']  = Auth::id();

        $event = Event::create($data);
        return redirect()->route('manage-events.edit', $event->id)->with('success', 'Event created.');
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {

        $event = Event::find($id);
        
        $data = $request->validate([
            'title'             => ['required','string','max:255'],
            'slug'              => ['nullable','string','max:255','unique:events,slug,'.$event->id],
            'short_description' => ['nullable','string'],
            'location'          => ['nullable','string','max:255'],
            'start_at'          => ['required','date'],
            'end_at'            => ['nullable','date','after_or_equal:start_at'],
            'is_active'         => ['nullable','boolean'],
            'is_featured'       => ['nullable','boolean'],
            'priority'          => ['nullable','integer'],
            'banner'            => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if (empty($data['slug'])) $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
                        // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();
            
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/event'), $fileNameToStore);

            $data['banner_path'] = 'event/' . $fileNameToStore;
        }
        
        $data['is_active']   = (bool)($data['is_active'] ?? $event->is_active);
        $data['is_featured'] = (bool)($data['is_featured'] ?? $event->is_featured);
        $data['updated_by']  = Auth::id();

        $event->update($data);
        return redirect()->route('manage-events.edit', $event->id)->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event deleted.');
    }

    public function toggle(Event $event)
    {
        $event->is_active = !$event->is_active;
        $event->updated_by = Auth::id();
        $event->save();
        return back()->with('success', 'Status toggled.');
    }
}
