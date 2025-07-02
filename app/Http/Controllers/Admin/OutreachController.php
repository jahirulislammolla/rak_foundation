<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\Outreach;
use Illuminate\Http\Request;

class OutreachController extends Controller
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

            $outreachs = Outreach::query() 
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
                ->orderBy("priority", "ASC")
                ->orderBy("id", "DESC")
                ->paginate(10);

            return view('admin.outreach.data', 
                    compact('outreachs', 'search')
                    )->render();
        }


        return view('admin.outreach.index');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $outreach = new Outreach();

        $outreach->title = $request->title;
        $outreach->content = $request->content;
        $outreach->priority = $request->priority;
        $outreach->status = $request->status;
        $outreach->save();

        return back()->with('success', 'outreach created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $outreach = Outreach::find($id);
        return view('admin.outreach.edit', compact('outreach'));
    }

    /**
     * Update the specified resource in store.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $outreach = Outreach::find($id);

        $outreach->title = $request->title;
        $outreach->content = $request->content;
        $outreach->priority = $request->priority;
        $outreach->status = $request->status;
        $outreach->save();

        return back()->with('success', 'outreach update successfully.');
    }

}
