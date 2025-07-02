<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\Mentorship;
use Illuminate\Http\Request;

class MentorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(XMLHttpRequest $request)
    {
        
        if($request->requestHeaderCheck())
        {
            $search = $request->search ?? '';
            $type = $request->type ?? '';

            $mentorships = Mentorship::query() 
                ->select(
                    'id' , 
                    'title',
                    'type',
                    'content',
                    'priority',
                    'status'
                )
                ->when( $search, function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                })
                ->when($type, function ($query) use($type){
                    $query->where('type', $type);
                })
                ->orderBy('type', "ASC")
                ->orderBy('priority', "ASC")
                ->orderBy("id", "DESC")
                ->paginate(10);

            return view('admin.mentorship.data', 
                    compact('mentorships', 'search')
                    )->render();
        }


        return view('admin.mentorship.index');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $mentorship = new Mentorship();

        $mentorship->title = $request->title;
        $mentorship->type = $request->type;
        $mentorship->content = $request->content;
        $mentorship->priority = $request->priority;
        $mentorship->status = $request->status;
        $mentorship->save();

        return back()->with('success', 'mentorship created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mentorship = Mentorship::find($id);
        return view('admin.mentorship.edit', compact('mentorship'));
    }

    /**
     * Update the specified resource in store.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $mentorship = Mentorship::find($id);

        $mentorship->title = $request->title;
        $mentorship->type = $request->type;
        $mentorship->content = $request->content;
        $mentorship->priority = $request->priority;
        $mentorship->status = $request->status;
        $mentorship->save();

        return back()->with('success', 'mentorship update successfully.');
    }

}

