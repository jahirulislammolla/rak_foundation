<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\Award;
use Illuminate\Http\Request;

class ManageAwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(XMLHttpRequest $request)
    {
        
        if($request->requestHeaderCheck())
        {
            $search = $request->search ?? '';

            $awards = Award::query() 
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
                ->orderBy('priority', "ASC")
                ->orderBy("id", "DESC")
                ->paginate(10);

            return view('admin.awards.data', 
                    compact('awards', 'search')
                    )->render();
        }


        return view('admin.awards.index');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $award = new Award();

        $award->title = $request->title;
        $award->priority = $request->priority;
        $award->content = $request->content;
        $award->status = $request->status;
        $award->save();

        return back()->with('success', 'Award created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $award = Award::find($id);
        return view('admin.awards.edit', compact('award'));
    }

    /**
     * Update the specified resource in store.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $award = Award::find($id);

        $award->title = $request->title;
        $award->priority = $request->priority;
        $award->content = $request->content;
        $award->status = $request->status;
        $award->save();

        return back()->with('success', 'Award update successfully.');
    }

}

