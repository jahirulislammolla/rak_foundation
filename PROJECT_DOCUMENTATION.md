# RAK Foundation Project Documentation

## 1. Project Overview

RAK Foundation একটি Laravel 10 ভিত্তিক ওয়েব অ্যাপ্লিকেশন। এতে public-facing foundation website এবং authenticated admin panel দুটোই আছে। Public side থেকে visitor foundation information, focus areas, works, events, gallery, committee, member list, donation form, membership application এবং contact/message form ব্যবহার করতে পারে। Admin side থেকে content, users, roles, permissions, donations, event registrations, member applications, settings এবং site assets manage করা যায়।

## 2. Technology Stack

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.1+, Laravel 10 |
| Frontend build | Vite 4, Tailwind CSS 3, Alpine.js |
| UI/CSS assets | Bootstrap, custom public/admin CSS, icon/font assets |
| Database | MySQL by default |
| Authentication | Laravel Breeze style auth controllers/views |
| Authorization | `spatie/laravel-permission` |
| API token support | Laravel Sanctum |
| Testing | PHPUnit |

## 3. Important Directories

| Path | Purpose |
| --- | --- |
| `app/Http/Controllers` | Public, auth, profile এবং base controllers |
| `app/Http/Controllers/Admin` | Admin panel CRUD এবং management controllers |
| `app/Models` | Eloquent models |
| `app/Support/helpers.php` | Global helper functions autoloaded by Composer |
| `database/migrations` | Database schema definitions |
| `database/seeders` | Initial/demo data seeders |
| `resources/views` | Blade templates for public site, auth, admin, components |
| `resources/css`, `resources/js` | Vite/Tailwind source assets |
| `public` | Public images, uploaded-style assets, CSS/JS libraries |
| `routes/web.php` | Main web and admin routes |
| `routes/auth.php` | Login, password and logout routes |
| `config/permission.php` | Spatie permission configuration |

## 4. Setup Instructions

### Requirements

- PHP 8.1 or newer
- Composer
- Node.js and npm
- MySQL/MariaDB
- Laravel-compatible local server, for example Laragon, Laravel Valet, Sail, or `php artisan serve`

### Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Update `.env` database values:

```env
APP_NAME="RAK Foundation"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rak_foundation
DB_USERNAME=root
DB_PASSWORD=
```

Run database migrations and seeders:

```bash
php artisan migrate
php artisan db:seed
```

If role and permission demo data is needed, run:

```bash
php artisan db:seed --class=UserRolePermissionSeeder
```

Start frontend build/dev server:

```bash
npm run dev
```

Start Laravel server if needed:

```bash
php artisan serve
```

For production assets:

```bash
npm run build
```

## 5. Environment Configuration

The project ships with `.env.example`. Important values:

| Key | Description |
| --- | --- |
| `APP_NAME` | Application name |
| `APP_ENV` | `local`, `production`, etc. |
| `APP_DEBUG` | Should be `false` in production |
| `APP_URL` | Main site URL |
| `DB_*` | MySQL database connection |
| `MAIL_*` | SMTP/mail configuration |
| `CACHE_DRIVER` | Cache backend, default file |
| `QUEUE_CONNECTION` | Queue backend, default sync |
| `SESSION_DRIVER` | Session backend, default file |

Security note: Some seeders contain default/demo user accounts. Change or remove those credentials before any production deployment.

## 6. Public Website Features

| Feature | Route | Main View/Controller |
| --- | --- | --- |
| Home | `/` | `resources/views/index.blade.php` |
| About | `/about` | `about.blade.php` |
| Contact | `/contact` | `contact.blade.php` |
| Membership page | `/membership` | `membership.blade.php` |
| Member application | `/member-application` | `PublicMembershipController` |
| Approved members list | `/members` | `PublicMembershipController@index` |
| Events listing | `/events` | `event.blade.php` |
| Event registration | `/event-registration` | `PublicEventRegistrationController` |
| Gallery | `/galleries` | `gallery.blade.php` |
| Our Work listing/detail | `/our-work` | `our_work.blade.php`, `work_show.blade.php` |
| Donate | `/donate` | `PublicDonateController` |
| Committee | `/committees` | `committee.blade.php` |
| Focus areas listing/detail | `/focus-areas` | `focus_areas.blade.php`, `focus_area.blade.php` |
| Public profile | `/our-profile` | `profile_public.blade.php` |
| Contact messages | `POST /messages` | `MessageController@store` |

### Home Page Data

The home page loads:

- Active focus areas ordered by `order` and `title`
- Active works ordered by latest `published_at`
- Approved members ordered by latest approval date

## 7. Authentication

Authentication routes are in `routes/auth.php`.

| Action | Route |
| --- | --- |
| Login form | `GET /login` |
| Login submit | `POST /login` |
| Password reset form | `GET /reset-password/{token}` |
| Password reset submit | `POST /reset-password` |
| Password update | `PUT /password` |
| Logout | `POST /logout` |

Registration routes are intentionally placed inside an authenticated route group in `routes/web.php`, so only logged-in users can access `/register`.

## 8. Admin Panel Features

Admin routes are protected by `auth` middleware. Main dashboard route:

```text
/dashboard
```

Admin capabilities:

| Module | Routes/Controller | Purpose |
| --- | --- | --- |
| Users | `users` / `UserController` | Create, update, delete users |
| Roles | `roles` / `RoleController` | Role CRUD and permission assignment |
| Permissions | `permissions` / `PermissionController` | Permission CRUD |
| Events | `manage-events` / `EventController` | Event CRUD and active toggle |
| Event registrations | `manage-event-registrations` / `EventRegistrationController` | Registration list, verify, delete, export |
| Focus areas | `manage-focus-area` / `FocusAreaController` | Focus area CRUD |
| Committees | `manage-committees` / `CommitteeController` | Committee member CRUD |
| Members | `manage-members` / `MemberApplicationController` | Application review, approve, reject, export |
| Works | `manage-works` / `WorkController` | Work/news/project CRUD |
| Work categories | `manage-work-categories` / `WorkCategoryController` | Work category management |
| Galleries | `manage-galleries` / `GalleryController` | Gallery CRUD and active toggle |
| Donations | `manage-donations` / `DonateController` | Donation review, approve, reject |
| Menus | `manage-menus` / `MenuController` | Admin menu management |
| Messages | `manage-messages` / `MessageController` | Contact message list and delete |
| Settings | Multiple settings routes / `SettingController` | Image, social, contact, basic info, page title and button settings |

## 9. Main Database Tables

| Table | Purpose |
| --- | --- |
| `users` | Admin/application users |
| `password_reset_tokens` | Password reset token storage |
| `failed_jobs` | Queue failure tracking |
| `personal_access_tokens` | Sanctum tokens |
| `menus` | Admin menu structure |
| `roles`, `permissions`, pivot tables | Spatie role-permission system |
| `settings` | Key-value site settings |
| `focus_areas` | Public focus area content |
| `committees` | Committee member information |
| `people` | Member/volunteer style people records |
| `work_categories` | Categories for works |
| `works` | Work/project/news-like content |
| `events` | Event records |
| `event_registrations` | Public event registration submissions |
| `members` | Membership applications and approved members |
| `galleries` | Gallery images |
| `donation_causes` | Donation purpose/category |
| `donations` | Donation submissions and review status |

## 10. Data Model Notes

### `focus_areas`

Stores focus area title, slug, icon class, image, short description, full description, order and active state.

### `works`

Stores work content with category relation, title, slug, author, image, excerpt, body, published date, priority, active state and optional `image_widths` JSON.

### `events`

Stores event title, slug, location, short description, start/end date, banner, active/featured state, priority and creator/updater references.

### `event_registrations`

Stores event participant information, ticket type, amount, payment method, transaction id, consent and status.

### `members`

Stores membership application information, payment details, status, approval data, membership number, start/end dates and notes.

### `donations`

Stores donation cause, amount, payment method, donor information, anonymous flag, note, transaction id, status, review timestamps and reviewer.

## 11. Seeders

| Seeder | Purpose |
| --- | --- |
| `DatabaseSeeder` | Calls `UserSeeder`, `FocusAreaSeeder`, `WorkSeeder` |
| `UserSeeder` | Creates default/demo users |
| `UserRolePermissionSeeder` | Creates roles, permissions and assigns roles to demo users |
| `FocusAreaSeeder` | Creates sample focus areas |
| `WorkSeeder` | Creates sample work records |
| `DonationCauseSeeder` | Creates donation causes |

Production note: Review all seed data before running in a live environment.

## 12. Blade Views

Important public views:

- `index.blade.php`
- `about.blade.php`
- `contact.blade.php`
- `membership.blade.php`
- `members_apply.blade.php`
- `members_list.blade.php`
- `event.blade.php`
- `event_registration.blade.php`
- `gallery.blade.php`
- `our_work.blade.php`
- `work_show.blade.php`
- `committee.blade.php`
- `focus_areas.blade.php`
- `focus_area.blade.php`
- `profile_public.blade.php`
- `donate.blade.php`

Important layouts/components:

- `resources/views/layouts/app.blade.php`
- `resources/views/layouts/admin.blade.php`
- `resources/views/layouts/guest.blade.php`
- `resources/views/components/header.blade.php`
- `resources/views/components/footer.blade.php`
- `resources/views/components/paginator.blade.php`

Admin views are grouped under:

```text
resources/views/admin
resources/views/role-permission
resources/views/profile
```

## 13. Assets

The project contains both Vite-managed assets and static public assets.

| Path | Purpose |
| --- | --- |
| `resources/css/app.css` | Tailwind source CSS |
| `resources/js/app.js` | Vite JS entry |
| `public/css` | Public site CSS |
| `public/js` | Public site JavaScript |
| `public/assets` | Admin CSS/JS/fonts/images |
| `public/img`, `public/images` | Site images |
| `public/event`, `public/gallery`, `public/member`, `public/work`, `public/committee` | Uploaded/static content images |

NPM scripts:

```bash
npm run dev
npm run build
npm run tailwind
```

## 14. Authorization

Authorization uses `spatie/laravel-permission`.

Existing role names from seeder:

- `super-admin`
- `admin`
- `staff`
- `user`

Existing permission groups include:

- role permissions
- permission permissions
- user permissions
- product permissions

Some admin routes are protected only by `auth` middleware in `routes/web.php`. If stricter access control is needed, add role/permission middleware to route groups or controller constructors.

## 15. Common Development Commands

```bash
composer install
composer dump-autoload
php artisan key:generate
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed --class=UserRolePermissionSeeder
php artisan route:list
php artisan config:clear
php artisan cache:clear
php artisan view:clear
npm install
npm run dev
npm run build
php artisan test
```

## 16. Testing

Tests are stored in:

```text
tests/Feature
tests/Unit
```

Current test files include authentication/profile tests from Laravel Breeze-style scaffolding. Run:

```bash
php artisan test
```

## 17. Deployment Checklist

- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Set correct `APP_URL`
- Configure production database credentials
- Configure mail credentials
- Replace/remove demo seeded users and passwords
- Run `composer install --no-dev --optimize-autoloader`
- Run `npm run build`
- Run migrations carefully
- Run `php artisan config:cache`
- Run `php artisan route:cache` only after confirming all routes support caching
- Ensure `storage` and `bootstrap/cache` are writable
- Configure web server document root to `public`
- Protect uploaded/static asset directories as required

## 18. Security Notes

- Demo credentials inside seeders should not be used in production.
- Admin routes currently use `auth`; add role/permission middleware where required.
- File uploads should be validated by type and size in controllers.
- Set `APP_DEBUG=false` in production.
- Use HTTPS in production.
- Review public asset folders for accidental sensitive files.
- Rotate any credentials that were committed or shared.

## 19. Known Project Notes

- `README.md` is still mostly the default Laravel README and contains a stray `personal_website` line.
- Some Bangla comments in `routes/web.php` appear encoding-corrupted.
- Public route `/focus-areas` uses the `slug` query parameter for detail pages.
- Public route `/our-work` uses the `slug` query parameter for detail pages and otherwise shows a searchable/filterable listing.
- `UserRolePermissionSeeder` is not called by default from `DatabaseSeeder`; run it manually when role/permission seed data is needed.

## 20. Suggested Future Improvements

- Replace default Laravel README with a short project-specific README.
- Add route-level role/permission middleware for admin modules.
- Add form request classes for large admin/public validation flows.
- Move inline public route closures into dedicated controllers for maintainability.
- Standardize upload storage under Laravel `storage/app/public` with `php artisan storage:link`.
- Add tests for donation, membership, event registration, admin approval and public listing flows.
- Clean duplicate static assets between `public/assets` and `resources/views/assets`.
- Fix corrupted Bangla comments and document route behavior with named routes.
