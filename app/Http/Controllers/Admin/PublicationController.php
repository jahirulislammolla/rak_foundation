<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
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

            $publications = Publication::query() 
                ->select(
                    'id' , 
                    'title',
                    'year',
                    'type',
                    'writer' ,
                    'publisher' ,
                    'file' ,
                    'link' ,
                    'status'
                )
                ->when( $search, function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('year', 'like', '%' . $search . '%')
                        ->orWhere('writer', 'like', '%' . $search . '%')
                        ->orWhere('publisher', 'like', '%' . $search . '%');
                })
                ->when($type, function ($query) use($type){
                    $query->where('type', $type);
                })
                ->orderBy("id", "DESC")
                ->paginate(10);

            return view('admin.publication.data', 
                    compact('publications', 'search')
                    )->render();
        }


        return view('admin.publication.index');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'year' => 'nullable|integer',
        ]);
    
        $publication = new Publication();

        if (request()->hasFile('file')) {

            request()->validate([
                'file' => 'required|mimes:pdf', // max size 2MB
            ]);

            $file = request()->file('file');

            // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();
            
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/assets/publications'), $fileNameToStore);

            $publication->file = 'assets/publications/' . $fileNameToStore;
        }

        $publication->title = $request->title;
        $publication->type = $request->type;
        $publication->year = $request->year;
        $publication->writer = $request->writer;
        $publication->publisher = $request->publisher;
        $publication->link = $request->link;
        $publication->status = $request->status;
        $publication->save();

        return back()->with('success', 'Publication created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publication = Publication::find($id);
        return view('admin.publication.edit', compact('publication'));
    }

    /**
     * Update the specified resource in store.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'year' => 'nullable|integer',
        ]);
    
        $publication = Publication::find($id);

        if ($request->hasFile('file')) {

            $request->validate([
                'file' => 'required|mimes:pdf', // max size 2MB
            ]);

            $file = request()->file('file');

            // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();
            
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // Store the file
            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/assets/publications'), $fileNameToStore);

            $publication->file = 'assets/publications/' . $fileNameToStore;
        }

        $publication->title = $request->title;
        $publication->type = $request->type;
        $publication->year = $request->year;
        $publication->writer = $request->writer;
        $publication->publisher = $request->publisher;
        $publication->link = $request->link;
        $publication->status = $request->status;
        $publication->save();

        return back()->with('success', 'Publication update successfully.');
    }

}
