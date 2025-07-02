<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\XMLHttpRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Store message data
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Message::updateOrCreate(
            ['email' => $request->email],
            [
                'fullname' => $validatedData['fullname'],
                'subject' => $validatedData['subject'] ?? null,
                'message' => $validatedData['message'],
            ]
        );

        return response()->json(['success' => 'Message stored successfully.']);
    }

    // Show a list of messages
    public function index(XMLHttpRequest $request)
    {
        
        if($request->requestHeaderCheck())
        {
            $search = $request->search ?? '';

            $messages = Message::query() 
                ->when( $search, function ($query) use ($search) {
                    $query->where('fullname', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('message', 'like', '%' . $search . '%');
                })
                ->orderBy("id", "DESC")
                ->paginate(10);

            return view('admin.message.data', 
                    compact('messages', 'search')
                    )->render();
        }


        return view('admin.message.index');
    }

    public function delete($id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect()->back()->with('message', 'Delete Successful!!');
    }

}
