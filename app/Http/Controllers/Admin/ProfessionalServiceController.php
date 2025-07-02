<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\ProfessionalService;
use Illuminate\Http\Request;

class ProfessionalServiceController extends Controller
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

            $professional_services = ProfessionalService::query() 
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

            return view('admin.professional_service.data', 
                    compact('professional_services', 'search')
                    )->render();
        }


        return view('admin.professional_service.index');
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
    
        $professional_service = new ProfessionalService();

        $professional_service->title = $request->title;
        $professional_service->type = $request->type;
        $professional_service->content = $request->content;
        $professional_service->priority = $request->priority;
        $professional_service->status = $request->status;
        $professional_service->save();

        return back()->with('success', 'professional service created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $professional_service = ProfessionalService::find($id);
        return view('admin.professional_service.edit', compact('professional_service'));
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
    
        $professional_service = ProfessionalService::find($id);

        $professional_service->title = $request->title;
        $professional_service->content = $request->content;
        $professional_service->type = $request->type;
        $professional_service->priority = $request->priority;
        $professional_service->status = $request->status;
        $professional_service->save();

        return back()->with('success', 'Professional service update successfully.');
    }

}

