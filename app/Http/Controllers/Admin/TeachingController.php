<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\Teaching;
use Illuminate\Http\Request;

class TeachingController extends Controller
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

            $teachings = Teaching::query() 
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
                ->orderBy("type", "ASC")
                ->orderBy("priority", "ASC")
                ->orderBy("id", "DESC")
                ->paginate(10);

            return view('admin.teaching.data', 
                    compact('teachings', 'search')
                    )->render();
        }


        return view('admin.teaching.index');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
    
        $teaching = new Teaching();

        $teaching->title = $request->title;
        $teaching->type = $request->type;
        $teaching->content = $request->content;
        $teaching->priority = $request->priority;
        $teaching->status = $request->status;
        $teaching->save();

        return back()->with('success', 'teaching created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teaching = Teaching::find($id);
        return view('admin.teaching.edit', compact('teaching'));
    }

    /**
     * Update the specified resource in store.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
    
        $teaching = Teaching::find($id);

        $teaching->title = $request->title;
        $teaching->type = $request->type;
        $teaching->content = $request->content;
        $teaching->priority = $request->priority;
        $teaching->status = $request->status;
        $teaching->save();

        return back()->with('success', 'teaching update successfully.');
    }

}
