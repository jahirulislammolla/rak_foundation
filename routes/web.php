<?php

use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Models\Menu;
use App\Models\Profile;

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
    Route::resource('menus', 'Admin\MenuController');
    Route::get('/manage-messages', [MessageController::class, 'index'])->name('message.index');
    Route::delete('/manage-messages-delete/{id}', [MessageController::class, 'delete'])->name('message.delete');

});

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
    return view('index');
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/membership', function () {
    return view('membership');
});

Route::get('/event', function () {
    return view('event');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/our-work', function () {
    return view('our_work');
});

Route::get('/donate', function () {
    return view('donate');
});

Route::get('/event-registration', function () {
    return view('event_registration');
});

Route::get('/committee', function () {
    return view('committee');
});


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
