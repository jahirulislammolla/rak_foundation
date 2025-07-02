<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\Leadership;
use Illuminate\Http\Request;

class LeadershipController extends Controller
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

            $leaderships = Leadership::query() 
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

            return view('admin.leadership.data', 
                    compact('leaderships', 'search')
                    )->render();
        }


        return view('admin.leadership.index');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $leadership = new Leadership();

        $leadership->title = $request->title;
        $leadership->content = $request->content;
        $leadership->priority = $request->priority;
        $leadership->status = $request->status;
        $leadership->save();

        return back()->with('success', 'leadership created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leadership = Leadership::find($id);
        return view('admin.leadership.edit', compact('leadership'));
    }

    /**
     * Update the specified resource in store.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $leadership = Leadership::find($id);

        $leadership->title = $request->title;
        $leadership->content = $request->content;
        $leadership->priority = $request->priority;
        $leadership->status = $request->status;
        $leadership->save();

        return back()->with('success', 'leadership update successfully.');
    }

}
