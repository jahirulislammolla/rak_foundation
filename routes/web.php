<?php

use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\DonateController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventRegistrationController;
use App\Http\Controllers\Admin\FocusAreaController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MemberApplicationController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PublicEventRegistrationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkCategoryController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicDonateController;
use App\Http\Controllers\PublicMembershipController;
use App\Models\Committee;
use App\Models\Event;
use App\Models\FocusArea;
use App\Models\Gallery;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Profile;
use App\Models\Work;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
#'role:super-admin|admin'
## admin role permission route
Route::group(['middleware' => ['auth']], function() {

    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);
    Route::resource('manage-events', EventController::class);
    Route::patch('manage-events/{event}/toggle', [EventController::class, 'toggle'])->name('manage-events.toggle');
    Route::resource('manage-event-registrations', EventRegistrationController::class);
    Route::get('event-registrations-export', [EventRegistrationController::class, 'export'])
        ->name('manage-event-registrations.export');
    Route::patch('event-registrations/{registration}/verify',
        [EventRegistrationController::class, 'verify']
    )->name('manage-event-registrations.verify');

    Route::resource('manage-focus-area', FocusAreaController::class);
    Route::resource('manage-committees', CommitteeController::class);
    Route::resource('manage-members', MemberApplicationController::class);
    Route::patch('manage-members/{memberApplication}/approve', [MemberApplicationController::class, 'approve'])->name('manage-members.approve');
    Route::patch('manage-members/{memberApplication}/reject', [MemberApplicationController::class, 'reject'])->name('manage-members.reject');
    Route::resource('manage-works', WorkController::class);
    Route::resource('manage-work-categories', WorkCategoryController::class);
    Route::resource('manage-galleries', GalleryController::class);
    Route::patch('manage-galleries/{gallery}/toggle', [GalleryController::class, 'toggle'])->name('manage-galleries.toggle');
    Route::get('manage-donations', [DonateController::class, 'index'])->name('manage-donations.index');
    Route::patch('manage-donations/{donation}/approve', [DonateController::class, 'approve'])->name('manage-donations.approve');
    Route::patch('manage-donations/{donation}/reject',  [DonateController::class, 'reject'])->name('manage-donations.reject');
    Route::resource('manage-menus', MenuController::class);
    Route::get('/manage-messages', [MessageController::class, 'index'])->name('message.index');
    Route::delete('/manage-messages-delete/{id}', [MessageController::class, 'delete'])->name('message.delete');
    Route::get('/image-settings', [SettingController::class, 'image_get_setting'])->name('image_settings');
    Route::post('/store-settings', [SettingController::class, 'image_store_setting'])->name('image_store_settings');
    Route::get('/social-link-settings', [SettingController::class, 'get_social_link_setting'])->name('social_link_settings');
    Route::post('/store-social-link-settings', [SettingController::class, 'store_social_link_settings'])->name('store_social_link_settings');
    Route::get('/contact-settings', [SettingController::class, 'get_contact_setting'])->name('contact_settings');
    Route::post('/store-contact-settings', [SettingController::class, 'store_contact_settings'])->name('store_contact_settings');
    Route::get('/basic-info-settings', [SettingController::class, 'get_basic_info_setting'])->name('basic_info_settings');
    Route::post('/store-basic-info-settings', [SettingController::class, 'store_basic_info_settings'])->name('store_basic_info_settings');
    Route::get('/page-title-settings', [SettingController::class, 'get_page_title_setting'])->name('page_title_settings');
    Route::post('/store-page-title-settings', [SettingController::class, 'store_page_title_settings'])->name('store_page_title_settings');



});
// Public
Route::get('/member-application', [PublicMembershipController::class, 'create'])->name('member.apply');
Route::post('/member-application', [PublicMembershipController::class, 'store'])->name('member.apply.store');
Route::get('/members', [PublicMembershipController::class, 'index'])->name('members.index'); // approved list

Route::post('/messages', [MessageController::class, 'store'])->name('message.store');

Route::get('/dashboard', function () {
    $menus = Cache::rememberForever('AdminPanelMenus', function () {
        return Menu::query()
            ->with('submenu')
            ->mainMenu()
            ->orderBy('title')
            ->get();
    });
    return view('admin.dashboard.index', compact('menus'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// nomal route
Route::get('/', function () {
     $focus_areas = FocusArea::active()
            ->orderBy('order')
            ->orderBy('title')
            ->get(['id','title','slug','icon_class','short_description','image']);
    
    $works = Work::query()
            ->with('category:id,name')
            ->where('is_active', 1)
            ->orderByDesc('published_at')           // নতুনটা আগে
            ->paginate(3)
            ->withQueryString();

   $members = Member::approved()
            ->latest('approved_at')
            ->paginate(6);

    return view('index', compact('focus_areas', 'works', 'members'));
})->name('home');


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/membership', function () {
    return view('membership');
});

Route::get('/events', function () {
    $events = Event::published()
            ->upcoming()
            ->orderByDesc('is_featured')
            ->orderBy('priority')
            ->orderBy('start_at')
            ->paginate(12);

    return view('event', compact('events'));
});

Route::get('/galleries', function () {
    $galleries = Gallery::where('is_active', true)
            ->latest()
            ->paginate(12);

    return view('gallery', compact('galleries'));

});

Route::get('/our-work', function (Request $request) {

    $work = Work::where('slug', $request->slug)->first();
    if($work)
    {
        return view('work_show', compact('work'));
    }

    $q   = trim((string) $request->get('q', ''));
    $cat = $request->get('cat'); // id or slug—এক্ষেত্রে id ধরছি

    $works = Work::query()
        ->with('category:id,name')
        ->where('is_active', 1)
        // চাইলে ->published() ইউজ করতে পারো
        ->when($cat, fn($qq) => $qq->where('work_category_id', $cat))
        ->when($q, function ($qq) use ($q) {
            $qq->where(function ($x) use ($q) {
                $x->where('title', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%")
                    ->orWhere('body', 'like', "%{$q}%");
            });
        })              // উচ্চ প্রায়োরিটি আগে
        ->orderByRaw('published_at IS NULL')    // published না হলে পরে
        ->orderByDesc('published_at')           // নতুনটা আগে
        ->paginate(9)
        ->withQueryString();

    $categories = WorkCategory::orderBy('name')->get(['id','name']);

    return view('our_work', compact('works', 'categories', 'q', 'cat'));
})->name('works.index');

Route::get('/donate', function () {
    return view('donate');
});

// Public
Route::get('/donate', [PublicDonateController::class, 'showForm'])->name('donate.form');
Route::post('/donate', [PublicDonateController::class, 'store'])->name('donate.store');

Route::get('/event-registration', [PublicEventRegistrationController::class, 'index']);

Route::post('/event-registration-store', [PublicEventRegistrationController::class, 'store'])->name('event_registrations.store');

Route::get('/committees', function () {
            // priority ছোট মান = আগে
    $members  = Committee::orderBy('priority')->orderBy('id')->get();

    return view('committee', compact( 'members'));
});

Route::get('/focus-areas', function(Request $request){
    $item = FocusArea::where('slug', $request->slug)->first();
    if(!$item)
    {
        $focus_areas = FocusArea::active()
            ->orderBy('order')
            ->orderBy('title')
            ->get(['id','title','slug','icon_class','short_description','image']);
        return view('focus_areas', compact('focus_areas'));
    }
    return view('focus_area', compact('item'));
})->name('focus-areas.show');


Route::get('/profile', function () {
    $profiles = Profile::query()
    ->active()
    ->orderBy('type', 'ASC')
    ->orderBy('priority', 'ASC')
    ->orderBy('id', 'DESC')
    ->get();
    return view('profile', compact('profiles'));
});



require __DIR__.'/auth.php';
