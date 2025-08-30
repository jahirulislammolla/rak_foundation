<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    //
    protected $images = [
        'logo_image' => 'Logo Image',
        'home_image' => 'Home Page Banner Image',
        'home_section_image' => 'Home Page Section Image',
        'about_image' => 'About Page Banner Image',
        'event_image' => 'Event Page Banner Image',
        'event_registration_image' => 'Event Registration Page Banner Image',
        'gallery_image' => 'Gallery Page Banner Image',
        'our_work_image' => 'Our Work Page Banner Image',
        'committee_image' => 'Committee Page Banner Image',
        'membership_image' => 'Membership Page Banner Image',
        'contact_image' => 'Contact Page Banner Image',
        'donation_image' => 'Donation Page Banner Image',
    ];

    protected $socials = [
        'linkedin' => 'Linkedin Link',
        'facebook'=> 'Facebook Link',
        'twitter' => 'Twitter Link',
        'instragram' => 'Instragram Link',
    ];

    public function image_get_setting()
    {
        return view('admin.image_setting.page', [
            'images' => $this->images,
        ]);
    }
    public function image_store_setting(Request $request)
    {

        $images = $this->images;
        foreach ($images as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                            // Get file name with extension
                $fileNameWithExt = $file->getClientOriginalName();
                
                // Get just the file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                
                // Get the file extension
                $extension = $file->getClientOriginalExtension();
                
                // Create a unique file name
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                
                // $path = $file->storeAs('public/publications', $fileNameToStore);
                $file->move(base_path('public/images'), $fileNameToStore);

                $path = 'images/' . $fileNameToStore;

                Setting::updateOrCreate(['key' => $key], ['value' =>  $path]);
            }
        }

        Cache::forget('GlobalSettings');

        return redirect()->back()->with('success', 'Images updated successfully!');
    }


    public function get_social_link_setting()
    {

        return view('admin.social_link_setting.page', [
            'socials' => $this->socials
        ]);
    }

    public function store_social_link_settings(Request $request)
    {
        $socials = $this->socials;
        foreach ($socials as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' =>  $request[$key] ?? '']);
        }

        Cache::forget('GlobalSettings');

        return redirect()->back()->with('success', 'Images updated successfully!');
    }

    public function get_contact_setting()
    {

        return view('admin.basic_contact_setting.page', compact('pages'));
    }

 
    public function store_contact_settings(Request $request)
    {
            $socials = [
                'contact_address',
                'contact_telephone',
                'contact_email',
            ];

        foreach ($socials as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' =>  $request[$key] ?? '']);
        }

        Cache::forget('GlobalSettings');

        return redirect()->back()->with('success', 'Images updated successfully!');
    }


}
