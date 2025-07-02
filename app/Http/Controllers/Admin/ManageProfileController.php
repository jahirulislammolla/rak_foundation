<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ManageProfileController extends Controller
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

            $profiles = Profile::query() 
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

            return view('admin.profile.data', 
                    compact('profiles', 'search')
                    )->render();
        }


        return view('admin.profile.index');
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
    
        $profile = new Profile();

        $profile->title = $request->title;
        $profile->type = $request->type;
        $profile->content = $request->content;
        $profile->priority = $request->priority;
        $profile->status = $request->status;
        $profile->save();

        return back()->with('success', 'Profile created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = Profile::find($id);
        return view('admin.profile.edit', compact('profile'));
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
    
        $profile = Profile::find($id);

        $profile->title = $request->title;
        $profile->type = $request->type;
        $profile->content = $request->content;
        $profile->priority = $request->priority;
        $profile->status = $request->status;
        $profile->save();

        return back()->with('success', 'Profile update successfully.');
    }

}
