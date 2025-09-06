<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberApplication;
use Illuminate\Http\Request;

class PublicMembershipController extends Controller
{
    public function create()
    {
        return view('members_apply');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => ['required','string','max:255'],
            'email'           => ['nullable','email','max:255'],
            'phone'           => ['nullable','string','max:50'],
            'profession'      => ['nullable','string','max:255'],
            'address'         => ['nullable','string','max:500'],
            'membership_type' => ['required','in:yearly,lifetime'],
            'photo'           => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'note'            => ['nullable','string','max:1000'],
        ]);

        // Server-side fee enforcement
        $data['fee'] = $data['membership_type'] === 'lifetime' ? 5000 : 1000;

       if ($request->hasFile('photo')) {
            $file = $request->file('photo');
                        // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();
            
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            
            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/member'), $fileNameToStore);

            $data['photo_path'] = 'member/' . $fileNameToStore;
        }


        $data['status'] = 'pending';
        Member::create($data);

        return redirect()->route('member.apply')->with('success', 'Your application has been submitted. We will review it soon.');
    }

    public function index()
    {
        $members = Member::approved()
            ->latest('approved_at')
            ->paginate(12);

        return view('members_list', compact('members'));
    }
}

