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
        'footer_image' => 'Footer Logo Image',
        'icon_image' => 'Favicon Icon Image',
        'home_image' => 'Home Page Banner Image',
        'home_section_image' => 'Home Page Section Image',
        'about_image' => 'About Page Banner Image',
        'event_image' => 'Event Page Banner Image',
        'event_registration_image' => 'Event Registration Page Banner Image',
        'gallery_image' => 'Gallery Page Banner Image',
        'our_focus_area_image' => 'Our Foucs Area Page Banner Image',
        'our_work_image' => 'Our Work Page Banner Image',
        'committee_image' => 'Committee Page Banner Image',
        'membership_image' => 'Membership Page Banner Image',
        'contact_image' => 'Contact Page Banner Image',
        'donation_image' => 'Donation Page Banner Image',
    ];

    protected $page_titles = [
        'page_top_title' => 'Page Top Title',
        'home_page_main_title' => 'Home Page Main Title',
        'home_page_section_title' => 'Home Page Section Title',

    ];

    protected $basic_infos = [
        'home_page_section_description' => 'Home Page Section Description',
        'home_page_footer_description' => 'Home Page footer Description',
        'about_page_description' => 'About Page Description',
        'membership_section_description' => 'Membership Section Desctiption',
        'terms_and_condition' => 'Terms and Condition',
        'privacy_policy' => 'Privacy Policy',
    ];

    protected $socials = [
        'linkedin' => 'Linkedin Link',
        'facebook' => 'Facebook Link',
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
        return view('admin.basic_contact_setting.page');
    }


    public function store_contact_settings(Request $request)
    {
        $contacts = [
            'contact_address',
            'contact_telephone',
            'contact_email',
            'contact_location'
        ];

        foreach ($contacts as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' =>  $request[$key] ?? '']);
        }

        Cache::forget('GlobalSettings');

        return redirect()->back()->with('success', 'Images updated successfully!');
    }

    public function get_basic_info_setting()
    {
        return view('admin.basic_info_setting.page', [
            'basic_infos' => $this->basic_infos
        ]);
    }


    public function store_basic_info_settings(Request $request)
    {
        $basic_infos = $this->basic_infos;

        foreach ($basic_infos as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' =>  $request[$key] ?? '']);
        }

        Cache::forget('GlobalSettings');

        return redirect()->back()->with('success', 'Images updated successfully!');
    }

    public function get_page_title_setting()
    {
        return view('admin.page_title_setting.page', [
            'page_titles' => $this->page_titles
        ]);
    }


    public function store_page_title_settings(Request $request)
    {
        $page_titles = $this->page_titles;

        foreach ($page_titles as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' =>  $request[$key] ?? '']);
        }

        Cache::forget('GlobalSettings');

        return redirect()->back()->with('success', 'Images updated successfully!');
    }

    protected array $buttonFixedTemplate = [
        'member.apply_membership' => [
            "key" => "apply_membership",
            "enabled" => true,
            "text" => "Apply for Membership",
            "url" => "/member-application",
            "target_blank" => false,
            "rel_nofollow" => false,
            "style" => [
                "color" => "#ffffff",
                "bg" => "rgba(255, 68, 0, 0.899)",
                "hover_color" => "#ffffff",
                "hover_bg" => "#cc3300",
                "border_color" => "rgba(255, 68, 0, 0.899)",
                "hover_border_color" => "#cc3300"
            ],
            "size" => "lg",
            "rounded" => "sm",
            "outline" => false,
            "pill" => false,
            "full_width" => false,
            "icon" => null,
            "extra_classes" => "btn btn-primary py-3 px-4 mt-3 zoomIn",
            "attrs" => []
        ],
        'home.join_us' => [
            "key" => "join_us",
            "enabled" => true,
            "text" => "Join Us",
            "url" => "/member-application",
            "target_blank" => false,
            "rel_nofollow" => false,
            "style" => [
                "color" => "#ffffff",
                "bg" => "#dc3545",
                "hover_color" => "#ffffff",
                "hover_bg" => "#bb2d3b",
                "border_color" => "#dc3545",
                "hover_border_color" => "#bb2d3b"
            ],
            "size" => "lg",
            "rounded" => "sm",
            "outline" => false,
            "pill" => false,
            "full_width" => false,
            "icon" => ["position" => "right", "html" => "<i class=\"fa fa-arrow me-1\"></i>"],
            "extra_classes" => "btn btn-danger py-md-3 px-md-5 me-3 animated slideIn",
            "attrs" => []
        ],
        'home.sponsor_now' => [
            "key" => "sponsor_now",
            "enabled" => true,
            "text" => "Sponsor Now",
            "url" => "/donate",
            "target_blank" => false,
            "rel_nofollow" => false,
            "style" => [
                "color" => "#ffffff",
                "bg" => "#0d6efd",
                "hover_color" => "#ffffff",
                "hover_bg" => "#0b5ed7",
                "border_color" => "#0d6efd",
                "hover_border_color" => "#0b5ed7"
            ],
            "size" => "lg",
            "rounded" => "sm",
            "outline" => false,
            "pill" => false,
            "full_width" => false,
            "icon" => null,
            "extra_classes" => "btn btn-primary py-3 px-5 mt-3 wow zoomIn",
            "attrs" => ["data-wow-delay" => "0.9s"]
        ],
        'committee.donate_now' => [
            "key" => "donate_now",
            "enabled" => true,
            "text" => "Donate Now",
            "url" => "/donate",
            "target_blank" => false,
            "rel_nofollow" => false,
            "style" => [
                "color" => "#ffffff",
                "bg" => "#198754",
                "hover_color" => "#ffffff",
                "hover_bg" => "#157347",
                "border_color" => "#198754",
                "hover_border_color" => "#157347"
            ],
            "size" => "lg",
            "rounded" => "sm",
            "outline" => false,
            "pill" => false,
            "full_width" => false,
            "icon" => null,
            "extra_classes" => "btn btn-success m-1",
            "attrs" => []
        ],
    ];
    protected array $editableFields = [
        'text',
        'style.color',
        'style.bg',
        'style.hover_color',
        'style.hover_bg',
        'style.border_color',
        'style.hover_border_color',
    ];

    /** ফর্মে দেখানোর জন্য বাটনগুলোর লিস্ট */
    protected array $buttonList = [
        'member'   => ['apply_membership' => 'Member Page — Apply for Membership'],
        'home'     => ['join_us' => 'Home — Join Us', 'sponsor_now' => 'Home — Sponsor Now'],
        'committee' => ['donate_now' => 'Committee — Donate Now'],
    ];

    /** helper: key make */
    protected function k(string $page, string $btnKey, string $fieldPath): string
    {
        // setting key format: button.{page}.{key}.{fieldPath}
        return "button.{$page}.{$btnKey}." . $fieldPath;
    }

    /** GET: simple form */
    public function get_button_simple()
    {
        // বর্তমান ভ্যালু বের করি (Setting থেকে না পেলে template default)
        $data = [];
        foreach ($this->buttonList as $page => $buttons) {
            foreach ($buttons as $btnKey => $label) {
                $template = $this->buttonFixedTemplate["{$page}.{$btnKey}"];
                $row = [
                    'text' => Setting::where('key', $this->k($page, $btnKey, 'text'))->value('value') ?? $template['text'],
                    'style' => [
                        'color' => Setting::where('key', $this->k($page, $btnKey, 'style.color'))->value('value') ?? $template['style']['color'],
                        'bg' => Setting::where('key', $this->k($page, $btnKey, 'style.bg'))->value('value') ?? $template['style']['bg'],
                        'hover_color' => Setting::where('key', $this->k($page, $btnKey, 'style.hover_color'))->value('value') ?? $template['style']['hover_color'],
                        'hover_bg' => Setting::where('key', $this->k($page, $btnKey, 'style.hover_bg'))->value('value') ?? $template['style']['hover_bg'],
                        'border_color' => Setting::where('key', $this->k($page, $btnKey, 'style.border_color'))->value('value') ?? $template['style']['border_color'],
                        'hover_border_color' => Setting::where('key', $this->k($page, $btnKey, 'style.hover_border_color'))->value('value') ?? $template['style']['hover_border_color'],
                    ],
                ];
                $data[$page][$btnKey] = $row;
            }
        }

        // প্রিভিউ: বিল্ড করা full config
        $full = $this->buildFromSettings();
        $fullPreview = json_encode($full, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return view('admin.button_setting.simple', [
            'buttonList'   => $this->buttonList,
            'values'       => $data,
            'fullPreview'  => $fullPreview,
        ]);
    }

    /** POST: simple form save */
    public function store_button_simple(Request $request)
    {
        // ইনপুট name হবে: buttons[page][key][text], buttons[page][key][style][bg] ...
        $buttons = $request->input('buttons', []);

        // বেসিক স্যানিটাইজ/ভ্যালিডেশন (simple)
        foreach ($this->buttonList as $page => $btns) {
            foreach ($btns as $btnKey => $label) {
                $in = $buttons[$page][$btnKey] ?? [];

                // text
                if (isset($in['text'])) {
                    Setting::updateOrCreate(
                        ['key' => $this->k($page, $btnKey, 'text')],
                        ['value' => trim((string)$in['text'])]
                    );
                }

                // style.*
                $style = $in['style'] ?? [];
                foreach (['color', 'bg', 'hover_color', 'hover_bg', 'border_color', 'hover_border_color'] as $f) {
                    if (isset($style[$f])) {
                        Setting::updateOrCreate(
                            ['key' => $this->k($page, $btnKey, "style.$f")],
                            ['value' => trim((string)$style[$f])]
                        );
                    }
                }
            }
        }

        // সেভের পর full config রিবিল্ড করে রাখি (রেন্ডার এতে নির্ভর করে)
        $full = $this->buildFromSettings();
        Setting::updateOrCreate(['key' => 'buttons_config'], [
            'value' => json_encode($full, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        ]);

        Cache::forget('GlobalSettings');
        Cache::forget('setting:buttons_config');

        return back()->with('success', 'Buttons updated successfully!');
    }

    /** settings থেকে full config বানাই (only 7 fields override) */
    protected function buildFromSettings(): array
    {
        $full = ['member' => [], 'home' => [], 'committee' => []];

        foreach ($this->buttonFixedTemplate as $dot => $tpl) {
            [$page, $btnKey] = explode('.', $dot, 2);

            // base = template
            $btn = $tpl;

            // 7 ফিল্ড override করি (Setting থেকে)
            // text
            $text = Setting::where('key', $this->k($page, $btnKey, 'text'))->value('value');
            if ($text !== null) $btn['text'] = $text;

            // style.*
            foreach (['color', 'bg', 'hover_color', 'hover_bg', 'border_color', 'hover_border_color'] as $f) {
                $val = Setting::where('key', $this->k($page, $btnKey, "style.$f"))->value('value');
                if ($val !== null) $btn['style'][$f] = $val;
            }

            $full[$page][] = $btn;
        }

        return $full;
    }
}
