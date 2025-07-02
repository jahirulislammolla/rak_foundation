<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
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

            $educations = Education::query() 
                ->select(
                    'id' , 
                    'title',
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
                ->orderBy('priority', "ASC")
                ->orderBy("id", "DESC")
                ->paginate(10);

            return view('admin.education.data', 
                    compact('educations', 'search')
                    )->render();
        }


        return view('admin.education.index');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $education = new Education();

        $education->title = $request->title;
        $education->content = $request->content;
        $education->priority = $request->priority;
        $education->status = $request->status;
        $education->save();

        return back()->with('success', 'education created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $education = Education::find($id);
        return view('admin.education.edit', compact('education'));
    }

    /**
     * Update the specified resource in store.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $education = Education::find($id);

        $education->title = $request->title;
        $education->content = $request->content;
        $education->priority = $request->priority;
        $education->status = $request->status;
        $education->save();

        return back()->with('success', 'education update successfully.');
    }

}
