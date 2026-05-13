# RAK Foundation — Codex Step-by-Step Implementation Plan

> Use this file as the main instruction document for Codex.  
> Goal: convert the existing RAK Foundation Laravel project into a polished, modern, responsive public website + admin panel, then add the planned new feature modules step by step.

---

## 0. Project Context

RAK Foundation is an existing Laravel 10 application with:

- Public-facing foundation website
- Authenticated admin panel
- Laravel Blade views
- Vite + Tailwind CSS + Alpine.js
- MySQL database
- Breeze-style authentication
- `spatie/laravel-permission`
- Existing modules for focus areas, works, events, gallery, members, donations, committees, messages, users, roles, permissions, menus, and settings

The redesign must preserve the existing project structure and gradually improve it. Do **not** rebuild the project from scratch.

---

## 1. Non-Negotiable Rules for Codex

1. **Do not break existing routes, controllers, models, or database tables.**
2. **Do not rename existing public routes unless explicitly instructed.**
3. **Do not delete existing Blade files.** If replacement is needed, keep backup logic or use smaller components.
4. **Use Laravel Blade + Tailwind CSS.** Do not introduce React/Vue into the Laravel app unless the project already uses it.
5. **Use mock/demo data only where real DB data is not available yet.** Prefer real models when existing tables already support the page.
6. **Use reusable Blade components** instead of duplicating markup.
7. **Preserve existing admin auth behavior.** Admin routes are under auth middleware.
8. **Add role/permission middleware carefully.** Do not lock out existing admins accidentally.
9. **All new forms must have CSRF protection, validation, and safe file upload rules.**
10. **All new public pages must be mobile responsive.**
11. **Do not hardcode payment/SMS credentials.** Use `.env` + config files.
12. **Run tests/build checks after each major phase.**
13. **Make small commits or small logical changes.** One phase at a time.
14. **When uncertain, inspect existing code before changing it.**

---

## 2. Existing Public Pages to Preserve and Redesign

| Page | Route | Existing View/Controller Direction |
|---|---|---|
| Home | `/` | `resources/views/index.blade.php` |
| About | `/about` | `about.blade.php` |
| Contact | `/contact` | `contact.blade.php` |
| Membership | `/membership` | `membership.blade.php` |
| Member Application | `/member-application` | `PublicMembershipController` |
| Members | `/members` | `PublicMembershipController@index` |
| Events | `/events` | `event.blade.php` |
| Event Registration | `/event-registration` | `PublicEventRegistrationController` |
| Gallery | `/galleries` | `gallery.blade.php` |
| Our Work | `/our-work` | `our_work.blade.php`, `work_show.blade.php` |
| Donate | `/donate` | `PublicDonateController` |
| Committee | `/committees` | `committee.blade.php` |
| Focus Areas | `/focus-areas` | `focus_areas.blade.php`, `focus_area.blade.php` |
| Public Profile | `/our-profile` | `profile_public.blade.php` |
| Contact Submit | `POST /messages` | `MessageController@store` |

---

## 3. New Public Pages to Add

| Page | Route | Purpose |
|---|---|---|
| Impact Dashboard | `/impact` | Public transparency dashboard with donation, members, volunteers, cause progress, charts, annual report link |
| Volunteer | `/volunteer` | Volunteer information + application form + active volunteer preview |
| News & Updates | `/news` | Public news/blog listing |
| News Detail | `/news/{slug}` | Public news detail page |
| Annual Report | `/annual-report` | Year-wise published PDF reports |

---

## 4. Existing Admin Modules to Preserve

| Module | Route Prefix | Controller Direction |
|---|---|---|
| Dashboard | `/dashboard` | Existing dashboard |
| Users | `/users` | `UserController` |
| Roles | `/roles` | `RoleController` |
| Permissions | `/permissions` | `PermissionController` |
| Events | `/manage-events` | `EventController` |
| Event Registrations | `/manage-event-registrations` | `EventRegistrationController` |
| Focus Areas | `/manage-focus-area` | `FocusAreaController` |
| Committees | `/manage-committees` | `CommitteeController` |
| Members | `/manage-members` | `MemberApplicationController` |
| Works | `/manage-works` | `WorkController` |
| Work Categories | `/manage-work-categories` | `WorkCategoryController` |
| Galleries | `/manage-galleries` | `GalleryController` |
| Donations | `/manage-donations` | `DonateController` |
| Menus | `/manage-menus` | `MenuController` |
| Messages | `/manage-messages` | `MessageController` |
| Settings | multiple settings routes | `SettingController` |

---

## 5. New Admin Modules to Add

| Module | Suggested Route Prefix | Purpose |
|---|---|---|
| Volunteers | `/manage-volunteers` | Review applications, approve/reject, assign to events, log hours, export |
| News & Updates | `/manage-news` | News/blog CRUD, category, featured image, publish toggle |
| Certificates | `/manage-certificates` | Certificate templates, generation, sending log |
| Payments | `/manage-payments` | Gateway transaction log and donation links |
| Notifications | `/manage-notifications` | SMS/Email/WhatsApp trigger settings and logs |
| Annual Reports | `/manage-reports` | Upload yearly PDF reports, publish/unpublish |
| Language Settings | `/settings/language` | EN/Bangla toggle and translation settings |

---

## 6. Design System

### 6.1 Brand Direction

The UI must feel:

- Classic
- Professional
- Trustworthy
- Humanitarian
- Clean and premium
- Suitable for charity, education, healthcare, and social work

The public website should create a strong first impression and make donation/volunteer CTAs easy to find.

### 6.2 Color Palette

Use these Tailwind-compatible colors:

```css
--rak-navy: #1a3c5e;
--rak-navy-light: #2d5a8e;
--rak-gold: #c8a84b;
--rak-teal: #0f6e56;
--rak-crimson: #8b2c2c;
--rak-cream: #f5f2eb;
--rak-dark: #2c2c2c;
--rak-muted: #6b7280;
--rak-card: #ffffff;
```

### 6.3 Tailwind Config Task

Add or extend colors in `tailwind.config.js`:

```js
theme: {
  extend: {
    colors: {
      rak: {
        navy: '#1a3c5e',
        'navy-light': '#2d5a8e',
        gold: '#c8a84b',
        teal: '#0f6e56',
        crimson: '#8b2c2c',
        cream: '#f5f2eb',
        dark: '#2c2c2c',
        muted: '#6b7280',
      },
    },
  },
}
```

If the project already has a Tailwind config, merge carefully. Do not replace existing content blindly.

### 6.4 Typography

Recommended direction:

- Headings: elegant serif style where possible
- Body/UI: clean sans-serif
- Bangla text: use fallback fonts that display Bangla properly

Suggested CSS stack:

```css
font-family: 'Inter', 'Noto Sans Bengali', system-ui, sans-serif;
```

For headings:

```css
font-family: 'Playfair Display', Georgia, serif;
```

If external fonts are not already configured, use system font fallback first. Do not make the build depend on unavailable external font files.

---

## 7. Required Shared Blade Components

Create reusable components under `resources/views/components` where possible.

Suggested components:

```text
resources/views/components/public/header.blade.php
resources/views/components/public/footer.blade.php
resources/views/components/public/page-hero.blade.php
resources/views/components/public/section-title.blade.php
resources/views/components/public/stat-card.blade.php
resources/views/components/public/focus-card.blade.php
resources/views/components/public/work-card.blade.php
resources/views/components/public/event-card.blade.php
resources/views/components/public/member-card.blade.php
resources/views/components/public/news-card.blade.php
resources/views/components/public/progress-bar.blade.php
resources/views/components/public/status-badge.blade.php
resources/views/components/public/lang-toggle.blade.php
resources/views/components/public/empty-state.blade.php
resources/views/components/admin/sidebar.blade.php
resources/views/components/admin/topbar.blade.php
resources/views/components/admin/stat-card.blade.php
resources/views/components/admin/status-badge.blade.php
resources/views/components/admin/data-table.blade.php
```

Do not create too many over-abstracted components. Make practical, readable components.

---

## 8. Phase-by-Phase Work Plan

## Phase 0 — Repository Audit

### Task
Inspect the existing Laravel project before changing anything.

### Codex Actions

1. List important files:

```bash
ls
ls resources/views
ls resources/views/components || true
ls resources/views/admin || true
ls app/Http/Controllers
ls app/Http/Controllers/Admin || true
ls app/Models
php artisan route:list
```

2. Inspect:

```text
routes/web.php
resources/views/layouts/app.blade.php
resources/views/layouts/admin.blade.php
resources/views/components/header.blade.php
resources/views/components/footer.blade.php
resources/css/app.css
tailwind.config.js
vite.config.js
```

3. Identify whether Tailwind is already loaded in public Blade layout.
4. Identify existing CSS conflicts from Bootstrap/custom public CSS.
5. Identify current asset paths for images.

### Acceptance Criteria

- Codex understands current layout structure.
- Codex knows where public header/footer are located.
- Codex knows if Tailwind classes are compiled and used.
- No file changed yet unless necessary for diagnostics.

---

## Phase 1 — Design Tokens and Base CSS

### Task
Set up global visual foundation without breaking old pages.

### Codex Actions

1. Update `tailwind.config.js` with RAK colors.
2. Update `resources/css/app.css` with base styles.
3. Add utility classes if needed:

```css
.rak-container {
  @apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8;
}

.rak-card {
  @apply bg-white rounded-2xl border border-slate-200 shadow-sm;
}

.rak-section {
  @apply py-16 sm:py-20;
}
```

4. Make sure existing Vite build still works.

### Commands

```bash
npm run build
php artisan view:clear
```

### Acceptance Criteria

- Build passes.
- Existing pages still render.
- New brand colors are available in Tailwind.

---

## Phase 2 — Public Layout Redesign

### Task
Create a modern shared public layout with header/footer.

### Files

```text
resources/views/layouts/app.blade.php
resources/views/components/header.blade.php
resources/views/components/footer.blade.php
```

If current project uses different names, adapt to existing structure.

### Header Requirements

- Logo: `RAK Foundation`
- Navigation:
  - Home
  - About
  - Focus Areas
  - Our Work
  - Events
  - Gallery
  - Members
  - Donate
  - Contact
- Extra navigation:
  - Impact
  - Volunteer
  - News
  - Annual Report
- CTA buttons:
  - Donate
  - Volunteer
- Language toggle:
  - EN / বাংলা
- Mobile hamburger menu using Alpine.js
- Sticky header style
- Active route state

### Footer Requirements

- Foundation short description
- Quick links
- Focus area links
- Contact info
- Social placeholders
- Copyright
- Donation CTA mini block

### Acceptance Criteria

- Header works on desktop and mobile.
- Footer is consistent.
- Public pages still load.
- No route errors.

---

## Phase 3 — Homepage Redesign

### Task
Redesign `resources/views/index.blade.php`.

### Data Sources

Use existing DB data where available:

- Active focus areas ordered by `order` and `title`
- Active works ordered by latest `published_at`
- Approved members ordered by latest approval date

If variables are not currently passed to the view, inspect the existing route/controller and add them carefully without breaking current logic.

### Homepage Sections

1. Hero section
   - Strong headline
   - Short description
   - CTA: Donate Now
   - CTA: Become Volunteer
   - Hero visual/card
   - Trust badges

2. Stats section
   - Total raised
   - People helped
   - Active members
   - Volunteers

3. Focus areas preview
   - Education
   - Healthcare
   - Humanitarian Aid
   - Community Development

4. Latest works/projects

5. Impact preview
   - Cause progress bars
   - Transparency message
   - Link to `/impact`

6. Latest news preview
   - Use mock/news table if available later
   - For now, if no news table exists, show latest works as updates or hide safely

7. Members/volunteers highlight

8. Donation CTA banner

### UI Rules

- Avoid empty white space in first fold.
- CTA buttons must be highly visible.
- Hero must look premium and trustworthy.
- Mobile layout must stack cleanly.

### Acceptance Criteria

- Home page looks like a modern foundation website.
- Dynamic data works if available.
- No undefined variable errors.
- Mobile responsive.

---

## Phase 4 — Existing Public Page Redesign

### Task
Redesign existing public pages one by one.

### 4.1 About Page

File:

```text
resources/views/about.blade.php
```

Sections:

- Page hero
- Mission
- Vision
- Values
- Foundation timeline
- Committee/leadership preview
- Trust section

### 4.2 Focus Areas Page

Files:

```text
resources/views/focus_areas.blade.php
resources/views/focus_area.blade.php
```

Requirements:

- Grid cards
- Icon/image
- Title
- Short description
- Detail page via slug query behavior must remain compatible

### 4.3 Our Work Page

Files:

```text
resources/views/our_work.blade.php
resources/views/work_show.blade.php
```

Requirements:

- Search/filter layout if current backend supports it
- Work cards
- Category badges
- Date
- Read more
- Detail layout

### 4.4 Events Page

Files:

```text
resources/views/event.blade.php
resources/views/event_registration.blade.php
```

Requirements:

- Upcoming events
- Past event style
- Registration CTA
- Volunteer-needed badge if possible

### 4.5 Gallery Page

File:

```text
resources/views/gallery.blade.php
```

Requirements:

- Responsive masonry/grid
- Category filters if backend supports it
- Clean image cards

### 4.6 Members and Membership Pages

Files:

```text
resources/views/membership.blade.php
resources/views/members_apply.blade.php
resources/views/members_list.blade.php
```

Requirements:

- Member benefits
- Approved member cards
- Application form style
- Status/trust message

### 4.7 Donate Page

File:

```text
resources/views/donate.blade.php
```

Requirements:

- Donation cause cards
- Cause progress bars
- Amount selector
- Donor form
- Payment method UI:
  - bKash
  - Nagad
  - Card
  - Manual fallback
- Security/trust note

Do not implement real gateway until payment phase. For UI phase, prepare the form field names clearly.

### 4.8 Contact Page

File:

```text
resources/views/contact.blade.php
```

Requirements:

- Contact form
- Address, phone, email
- Map placeholder
- Social links

### Acceptance Criteria

- All existing public pages load successfully.
- No existing form submission route is broken.
- Design is consistent.
- Mobile responsive.

---

## Phase 5 — New Public Pages

## 5.1 Impact Dashboard Page

### Files

```text
app/Http/Controllers/PublicImpactController.php
resources/views/impact.blade.php
```

### Route

```php
Route::get('/impact', [PublicImpactController::class, 'index'])->name('impact.index');
```

### Data

Use existing tables:

- `donations`
- `donation_causes`
- `members`
- `events`

Use `volunteers` table only after it is created.

### Widgets

- Total raised
- People helped
- Active members
- Active volunteers
- Cause progress bars
- Yearly donation chart mockup or Chart.js if already available
- Cause breakdown
- District coverage/map placeholder
- Annual report download CTA

### Performance Rule

Use cache for heavy aggregation:

```php
Cache::remember('public_impact_stats', now()->addHours(6), function () {
    // stats query
});
```

### Acceptance Criteria

- `/impact` loads.
- Works even if volunteers/reports are empty.
- No slow query risk on public page.

---

## 5.2 Volunteer Page

### Files

```text
app/Models/Volunteer.php
app/Http/Controllers/PublicVolunteerController.php
app/Http/Controllers/Admin/VolunteerController.php
app/Http/Requests/StoreVolunteerRequest.php
resources/views/volunteer.blade.php
resources/views/admin/volunteers/index.blade.php
resources/views/admin/volunteers/show.blade.php
resources/views/admin/volunteers/edit.blade.php
```

### Migration

Create `volunteers` table:

```php
Schema::create('volunteers', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('phone')->nullable();
    $table->string('email')->nullable();
    $table->string('district')->nullable();
    $table->json('skills')->nullable();
    $table->json('availability')->nullable();
    $table->text('message')->nullable();
    $table->string('status')->default('pending'); // pending, approved, rejected
    $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamp('approved_at')->nullable();
    $table->text('admin_note')->nullable();
    $table->unsignedInteger('hours_logged')->default(0);
    $table->timestamps();
    $table->softDeletes();
});
```

### Public Flow

- Visitor submits application.
- Status becomes `pending`.
- Admin reviews.
- Admin approves/rejects.

### Admin Flow

- List applications
- Filter by status
- View details
- Approve
- Reject with note
- Log hours
- Export later if needed

### Acceptance Criteria

- Public application works.
- Admin can approve/reject.
- Validation exists.
- No foreign key issue if user is deleted.

---

## 5.3 News & Updates

### Files

```text
app/Models/News.php
app/Http/Controllers/PublicNewsController.php
app/Http/Controllers/Admin/NewsController.php
app/Http/Requests/Admin/StoreNewsRequest.php
app/Http/Requests/Admin/UpdateNewsRequest.php
resources/views/news.blade.php
resources/views/news_show.blade.php
resources/views/admin/news/index.blade.php
resources/views/admin/news/create.blade.php
resources/views/admin/news/edit.blade.php
resources/views/admin/news/show.blade.php
```

### Migration

Create `news` table:

```php
Schema::create('news', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('excerpt')->nullable();
    $table->longText('body')->nullable();
    $table->string('image')->nullable();
    $table->string('category')->nullable();
    $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamp('published_at')->nullable();
    $table->boolean('is_featured')->default(false);
    $table->boolean('is_active')->default(true);
    $table->json('locale_data')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

### Public Routes

```php
Route::get('/news', [PublicNewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [PublicNewsController::class, 'show'])->name('news.show');
```

### Admin Routes

```php
Route::resource('manage-news', Admin\NewsController::class);
```

### Acceptance Criteria

- Public news listing works.
- News detail works.
- Admin CRUD works.
- Image upload is validated.
- Slug generated safely.

---

## 5.4 Annual Report

### Files

```text
app/Models/AnnualReport.php
app/Http/Controllers/PublicAnnualReportController.php
app/Http/Controllers/Admin/AnnualReportController.php
resources/views/annual_report.blade.php
resources/views/admin/reports/index.blade.php
resources/views/admin/reports/create.blade.php
resources/views/admin/reports/edit.blade.php
```

### Migration

Create `annual_reports` table:

```php
Schema::create('annual_reports', function (Blueprint $table) {
    $table->id();
    $table->unsignedInteger('year');
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('pdf_path');
    $table->boolean('is_published')->default(false);
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

### Public Route

```php
Route::get('/annual-report', [PublicAnnualReportController::class, 'index'])->name('annual-report.index');
```

### Security

- Validate PDF file only.
- Store in `storage/app/public/reports`.
- Use `php artisan storage:link`.

### Acceptance Criteria

- Admin can upload yearly PDF.
- Public can view published reports only.
- Download links work.

---

## Phase 6 — Admin Panel Redesign

### Task
Modernize admin layout without breaking existing functionality.

### Files

```text
resources/views/layouts/admin.blade.php
resources/views/components/admin/sidebar.blade.php
resources/views/components/admin/topbar.blade.php
resources/views/admin/dashboard.blade.php
```

### Admin Layout Requirements

- Navy sidebar
- Topbar with search, notifications, profile
- Responsive mobile sidebar
- Active menu state
- Clean white cards
- Tables with status badges
- Filter/search controls
- Quick action buttons

### Sidebar Existing Items

- Dashboard
- Users
- Roles & Permissions
- Focus Areas
- Our Work
- Events
- Event Registrations
- Gallery
- Members
- Member Applications
- Donations
- Donation Causes
- Committees
- Contact Messages
- Settings

### Sidebar New Items

- Volunteers
- News & Updates
- Certificates
- Payments
- Notifications
- Annual Reports
- Language Settings

### Dashboard Cards

- Total Donations
- Pending Donations
- Members
- Volunteers
- Events
- New Messages

### Dashboard Tables

- Pending approvals
- Recent donations
- Member applications
- Volunteer applications
- Event registrations summary

### Acceptance Criteria

- Existing admin pages still work.
- Sidebar links do not create route errors.
- New module links only appear when routes exist, or use safe conditional route checks.
- Admin layout is responsive.

---

## Phase 7 — Payment Integration Preparation

### Important
Implement payment gateway integration carefully. If real merchant credentials are not available, build the structure with sandbox-ready config and safe placeholders.

### Files

```text
config/payment.php
app/Services/Payment/PaymentGatewayInterface.php
app/Services/Payment/BkashPaymentGateway.php
app/Services/Payment/NagadPaymentGateway.php
app/Services/Payment/SslCommerzPaymentGateway.php
app/Services/Payment/PaymentService.php
app/Http/Controllers/PaymentController.php
app/Models/PaymentTransaction.php
resources/views/admin/payments/index.blade.php
resources/views/admin/payments/show.blade.php
```

### Migration

Create `payment_transactions` table:

```php
Schema::create('payment_transactions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('donation_id')->nullable()->constrained('donations')->nullOnDelete();
    $table->string('gateway'); // bkash, nagad, card, manual
    $table->string('txn_id')->nullable()->index();
    $table->decimal('amount', 12, 2)->default(0);
    $table->string('currency')->default('BDT');
    $table->string('status')->default('initiated'); // initiated, pending, paid, failed, cancelled
    $table->json('gateway_response')->nullable();
    $table->timestamp('initiated_at')->nullable();
    $table->timestamp('completed_at')->nullable();
    $table->timestamps();
});
```

### Routes

```php
Route::post('/payment/initiate', [PaymentController::class, 'initiate'])->name('payment.initiate');
Route::get('/payment/callback/{gateway}', [PaymentController::class, 'callback'])->name('payment.callback');
Route::post('/payment/ipn/{gateway}', [PaymentController::class, 'ipn'])->name('payment.ipn');
```

### Security

- Verify gateway callback/IPN signatures.
- Never trust amount from callback without checking internal donation/payment record.
- Do not store raw secrets in DB.
- Log gateway responses safely.
- Rate limit IPN routes if possible.

### Acceptance Criteria

- Donation form can initiate payment flow.
- Transaction record is created.
- Admin can view transactions.
- Manual fallback still works.
- No hardcoded credentials.

---

## Phase 8 — Certificate System

### Files

```text
app/Models/CertificateTemplate.php
app/Models/Certificate.php
app/Services/CertificateService.php
app/Http/Controllers/Admin/CertificateController.php
resources/views/admin/certificates/index.blade.php
resources/views/admin/certificates/templates.blade.php
```

### Migrations

Create `certificate_templates`:

```php
Schema::create('certificate_templates', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('type'); // donor, volunteer, member
    $table->longText('html_template');
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
```

Create `certificates`:

```php
Schema::create('certificates', function (Blueprint $table) {
    $table->id();
    $table->string('recipient_type'); // donor, volunteer, member
    $table->unsignedBigInteger('recipient_id')->nullable();
    $table->foreignId('template_id')->nullable()->constrained('certificate_templates')->nullOnDelete();
    $table->string('pdf_path')->nullable();
    $table->string('channel')->nullable(); // email, sms, both
    $table->timestamp('sent_at')->nullable();
    $table->foreignId('sent_by')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamps();
});
```

### PDF Package

Use existing PDF solution if project already has one. Otherwise use `barryvdh/laravel-dompdf` only after confirming dependency compatibility.

### Acceptance Criteria

- Admin can view templates.
- Certificate records can be generated.
- PDF path is stored.
- Certificate generation does not block main request if queued later.

---

## Phase 9 — Notification System

### Files

```text
config/sms.php
app/Services/SmsService.php
app/Services/WhatsAppService.php
app/Jobs/SendNotificationJob.php
app/Models/NotificationLog.php
app/Http/Controllers/Admin/NotificationController.php
resources/views/admin/notifications/index.blade.php
resources/views/admin/notifications/broadcast.blade.php
```

### Migration

Create `notifications_log` table:

```php
Schema::create('notifications_log', function (Blueprint $table) {
    $table->id();
    $table->string('type')->nullable();
    $table->unsignedBigInteger('recipient_id')->nullable();
    $table->string('recipient_type')->nullable();
    $table->string('channel'); // email, sms, whatsapp
    $table->text('message_body')->nullable();
    $table->string('status')->default('pending');
    $table->timestamp('sent_at')->nullable();
    $table->text('error_message')->nullable();
    $table->timestamps();
});
```

### Auto Trigger Events

- Membership approved → Email + SMS
- Donation confirmed → Email + SMS + Certificate link
- Event registration → Email + SMS
- Event reminder → SMS/WhatsApp
- Volunteer approved → Email + SMS

### Queue Requirement

Use queue for notifications:

```env
QUEUE_CONNECTION=database
```

Commands:

```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

### Acceptance Criteria

- Notification logs are created.
- Failed sending is captured.
- HTTP requests are not slowed by SMS/WhatsApp sending.

---

## Phase 10 — Bangla Language Support

### Goal
Add a visible `EN / বাংলা` toggle and prepare public content for translation.

### Files

```text
app/Http/Middleware/SetLocale.php
resources/views/components/public/lang-toggle.blade.php
resources/lang/en/messages.php
resources/lang/bn/messages.php
```

### Route

```php
Route::get('/language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'bn'])) {
        abort(404);
    }

    session(['locale' => $locale]);

    return back();
})->name('language.switch');
```

### Middleware

- Read locale from session
- Set `app()->setLocale($locale)`
- Default to `en`

### Acceptance Criteria

- Toggle works.
- Session stores locale.
- Navbar/footer text can use translation strings.
- Existing pages do not break.

---

## Phase 11 — Permissions and Seeders

### Update Roles

Existing roles:

- `super-admin`
- `admin`
- `staff`
- `user`

### New Permission Groups

Add permissions carefully:

```text
volunteer permissions:
- view-volunteers
- create-volunteers
- edit-volunteers
- delete-volunteers
- approve-volunteers
- assign-volunteers

news permissions:
- view-news
- create-news
- edit-news
- delete-news
- publish-news

certificate permissions:
- view-certificates
- create-certificates
- send-certificates
- manage-templates

payment permissions:
- view-payments
- refund-payments

notification permissions:
- view-notifications
- send-notifications
- configure-triggers

report permissions:
- view-reports
- upload-reports
- publish-reports
```

### Seeder Rule

Do not duplicate existing permissions. Use `firstOrCreate`.

### Acceptance Criteria

- Seeder can run multiple times safely.
- Existing admins keep access.
- New permissions assigned to super-admin/admin.

---

## Phase 12 — Testing and QA

### Commands

Run after every major phase:

```bash
php artisan route:list
php artisan view:clear
php artisan config:clear
php artisan cache:clear
npm run build
php artisan test
```

### Manual Test Checklist

Public:

- `/`
- `/about`
- `/focus-areas`
- `/our-work`
- `/events`
- `/galleries`
- `/members`
- `/donate`
- `/contact`
- `/impact`
- `/volunteer`
- `/news`
- `/annual-report`

Admin:

- `/dashboard`
- existing admin modules
- `/manage-volunteers`
- `/manage-news`
- `/manage-payments`
- `/manage-certificates`
- `/manage-notifications`
- `/manage-reports`
- `/settings/language`

Forms:

- Contact form
- Donation form
- Member application form
- Volunteer application form
- Event registration form
- News create/edit
- Report upload

### Common Error Checks

- Undefined variable in Blade
- Missing route names
- Missing storage symlink
- Permission denied for uploads
- Broken Vite manifest
- Admin sidebar route errors
- Mobile menu not opening
- File validation missing
- Payment callback route not CSRF-exempt if gateway requires POST from outside

---

## 13. Suggested Codex Prompt Sequence

Use these prompts with Codex one by one. Do not ask Codex to do everything in one giant step.

---

### Prompt 1 — Audit the Existing Project

```text
Read RAK_Foundation_Codex_Implementation_Plan.md. Start with Phase 0 only.
Inspect the Laravel project structure, current routes, layouts, Blade files, Tailwind/Vite config, and admin/public structure.
Do not modify files yet except if you need to create a short audit note.
Return a concise audit summary and list the exact files that need changes for Phase 1 and Phase 2.
```

---

### Prompt 2 — Add Design Tokens

```text
Continue from the audit. Implement Phase 1 only.
Add RAK Foundation design tokens/colors to Tailwind and base CSS utilities.
Do not redesign pages yet.
Run or explain npm build checks.
Return changed files and any build issues.
```

---

### Prompt 3 — Public Layout Header/Footer

```text
Implement Phase 2 only.
Redesign the public header/footer/layout using Blade + Tailwind + Alpine.js.
Preserve existing routes.
Make the header responsive with mobile menu and language toggle placeholder.
Do not redesign individual pages yet.
Return changed files and test checklist.
```

---

### Prompt 4 — Homepage Redesign

```text
Implement Phase 3 only.
Redesign the homepage using existing dynamic data where available.
Use reusable Blade components.
Keep the first fold strong, premium, and CTA-focused.
Do not touch admin panel yet.
Return changed files and any variables/controllers updated.
```

---

### Prompt 5 — Existing Public Pages

```text
Implement Phase 4.
Redesign existing public pages one by one using the new design system.
Preserve all current form actions, route names, and data variables.
Use reusable components.
Return changed files and routes tested.
```

---

### Prompt 6 — Add Impact, Volunteer, News, Annual Report Public Pages

```text
Implement Phase 5.
Add the new public pages: /impact, /volunteer, /news, /news/{slug}, /annual-report.
Create migrations/models/controllers/views only as needed.
Make pages safe when tables are empty.
Use validation for public volunteer application.
Return changed files, new routes, migrations, and test steps.
```

---

### Prompt 7 — Admin Panel Redesign

```text
Implement Phase 6.
Modernize the admin layout/sidebar/topbar/dashboard while preserving existing admin module behavior.
Add new module menu links safely.
Do not cause route errors if a route is missing.
Return changed files and admin test checklist.
```

---

### Prompt 8 — Payment Structure

```text
Implement Phase 7.
Create payment transaction structure and admin payment log.
Prepare bKash/Nagad/Card gateway abstraction using .env/config.
Do not hardcode credentials.
Keep manual donation fallback.
If real gateway credentials are missing, implement sandbox-safe placeholders and clear TODOs.
Return changed files, migrations, routes, and security notes.
```

---

### Prompt 9 — Certificates

```text
Implement Phase 8.
Create certificate templates and certificate issuing structure.
Use an existing PDF package if already installed; otherwise prepare the service structure and mention the dependency needed.
Do not break donation/member/volunteer flows.
Return changed files and test instructions.
```

---

### Prompt 10 — Notifications

```text
Implement Phase 9.
Create SMS/WhatsApp notification service structure and notification logs.
Use queue jobs for sending.
Do not block HTTP requests.
Do not hardcode gateway credentials.
Return changed files, migrations, queue setup, and test instructions.
```

---

### Prompt 11 — Bangla Language Support

```text
Implement Phase 10.
Add EN/Bangla language toggle with session-based locale middleware.
Add translation files for core navbar/footer/common UI labels.
Do not translate database content yet unless the model already supports it.
Return changed files and routes.
```

---

### Prompt 12 — Permissions and Final QA

```text
Implement Phase 11 and Phase 12.
Update role/permission seeders safely using firstOrCreate.
Assign new permissions to super-admin/admin without removing existing permissions.
Run final QA checklist: route list, build, tests, important public/admin pages.
Return final changed file summary and any remaining TODOs.
```

---

## 14. Blade Component Mapping for Final Implementation

### Public Views

```text
resources/views/index.blade.php
resources/views/about.blade.php
resources/views/focus_areas.blade.php
resources/views/focus_area.blade.php
resources/views/our_work.blade.php
resources/views/work_show.blade.php
resources/views/event.blade.php
resources/views/event_registration.blade.php
resources/views/gallery.blade.php
resources/views/membership.blade.php
resources/views/members_apply.blade.php
resources/views/members_list.blade.php
resources/views/donate.blade.php
resources/views/contact.blade.php
resources/views/impact.blade.php
resources/views/volunteer.blade.php
resources/views/news.blade.php
resources/views/news_show.blade.php
resources/views/annual_report.blade.php
```

### Public Components

```text
resources/views/components/public/header.blade.php
resources/views/components/public/footer.blade.php
resources/views/components/public/page-hero.blade.php
resources/views/components/public/section-title.blade.php
resources/views/components/public/stat-card.blade.php
resources/views/components/public/progress-bar.blade.php
resources/views/components/public/status-badge.blade.php
resources/views/components/public/focus-card.blade.php
resources/views/components/public/work-card.blade.php
resources/views/components/public/event-card.blade.php
resources/views/components/public/member-card.blade.php
resources/views/components/public/news-card.blade.php
resources/views/components/public/lang-toggle.blade.php
resources/views/components/public/empty-state.blade.php
```

### Admin Views

```text
resources/views/layouts/admin.blade.php
resources/views/admin/dashboard.blade.php
resources/views/admin/volunteers/index.blade.php
resources/views/admin/volunteers/show.blade.php
resources/views/admin/volunteers/edit.blade.php
resources/views/admin/news/index.blade.php
resources/views/admin/news/create.blade.php
resources/views/admin/news/edit.blade.php
resources/views/admin/news/show.blade.php
resources/views/admin/payments/index.blade.php
resources/views/admin/payments/show.blade.php
resources/views/admin/certificates/index.blade.php
resources/views/admin/certificates/templates.blade.php
resources/views/admin/notifications/index.blade.php
resources/views/admin/notifications/broadcast.blade.php
resources/views/admin/reports/index.blade.php
resources/views/admin/reports/create.blade.php
resources/views/admin/reports/edit.blade.php
resources/views/admin/settings/language.blade.php
```

---

## 15. Final Acceptance Criteria

The project is considered complete when:

1. Public website has a modern consistent design.
2. All existing public pages still work.
3. New public pages work:
   - `/impact`
   - `/volunteer`
   - `/news`
   - `/annual-report`
4. Admin layout is modernized.
5. Existing admin modules still work.
6. New admin modules exist and are navigable.
7. Volunteer applications can be submitted and reviewed.
8. News can be created and published.
9. Annual reports can be uploaded and displayed publicly.
10. Payment transaction structure exists.
11. Certificates structure exists.
12. Notification log/service structure exists.
13. Language toggle works.
14. `npm run build` succeeds.
15. `php artisan route:list` succeeds.
16. `php artisan test` does not show new unexpected failures.
17. Mobile responsive check passes for main public pages.
18. No sensitive credentials are hardcoded.
19. File uploads are validated.
20. Admin users are not locked out.

---

## 16. Deployment Notes

Before production:

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan migrate
php artisan storage:link
php artisan config:cache
php artisan view:cache
php artisan route:cache
```

Production `.env` must include:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
QUEUE_CONNECTION=database
```

Payment/SMS credentials must be configured only in `.env` and never committed.

---

## 17. Important Security Checklist

- Set `APP_DEBUG=false` in production.
- Use HTTPS.
- Validate all upload MIME types and sizes.
- Protect certificate/report file access if needed.
- Verify payment gateway signatures.
- Do not expose raw gateway responses publicly.
- Use queue workers for notifications.
- Use role/permission middleware carefully.
- Remove demo users/passwords before production.
- Do not commit `.env`.

---

## 18. Final Instruction to Codex

Work phase by phase.  
Do not skip audit.  
Do not rewrite the whole project.  
Preserve existing behavior first, improve design second, add new modules third.  
After every phase, list changed files, commands run, errors found, and next recommended step.

---

## 19. Design Review Addendum - 2026-05-13

This addendum records the current design gaps found during implementation review and should be treated as an extra checklist before final QA.

### 19.1 Current Implementation Gaps Found

1. The public redesign had started, but the visual tokens were not connected to `tailwind.config.js`; RAK colors and font stacks must be available to all new Blade/Tailwind work.
2. `public/css/public-site.css` used a green/cream custom palette instead of the approved RAK navy, gold, teal, crimson, cream palette.
3. The public header missed planned links for Impact, Volunteer, News, Annual Reports, and the EN/Bangla toggle.
4. The public footer missed the transparency/reporting links and a clear donation/volunteer CTA block.
5. The CSS used oversized decorative fixed background shapes and very large container width. These should be avoided because they reduce polish and can create layout issues on wide screens.
6. The public site had routes for existing modules only; new public pages in the plan needed safe route placeholders so navigation does not break while admin modules are developed.
7. The plan listed many reusable components but the code currently uses a smaller mixed component/CSS pattern. Future work should either add practical public components gradually or keep the CSS classes consistent. Do not over-abstract.
8. Volunteer, News, and Annual Report full admin/data workflows are still future work. Public placeholders should be replaced by database-backed versions in Phase 5.
9. Bangla support currently needs middleware and translation files. A route/session toggle alone is not enough for full localization.
10. Final design QA must include mobile header wrapping, long organization names, and Bangla label rendering.

### 19.2 Design Changes Added From This Review

1. Added RAK Tailwind color tokens and font families.
2. Aligned public CSS variables with the RAK brand palette.
3. Reduced card/container radius to a cleaner professional style.
4. Removed decorative background orb behavior from the public shell.
5. Added safe public navigation entries for Impact, Volunteer, News, and Annual Reports.
6. Added a session-based language switch route and visible EN/Bangla toggle.
7. Added safe public placeholder pages for `/impact`, `/volunteer`, `/news`, `/news/{slug}`, and `/annual-report`.

### 19.3 Remaining Work After This Addendum

1. Build real Volunteer migration/model/request/admin review workflow.
2. Build real News migration/model/admin CRUD and replace Work-as-update fallback.
3. Build Annual Report migration/model/admin PDF upload workflow.
4. Add `SetLocale` middleware and translation files for navbar/footer/common labels.
5. Create practical Blade components only where duplication appears across pages.
6. Run full route, build, and browser QA after each phase.
