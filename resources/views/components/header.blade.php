@php
    $orgName = $settings['page_top_title'] ?? 'Social Organization';
    $tagline = $settings['home_page_main_title'] ?? 'Collective action for lasting community progress';

    $navItems = [
        ['label' => 'Home', 'url' => route('home'), 'active' => request()->routeIs('home')],
        ['label' => 'About', 'url' => url('/about'), 'active' => request()->is('about')],
        ['label' => 'Focus Areas', 'url' => route('focus-areas.show'), 'active' => request()->is('focus-areas')],
        ['label' => 'Work', 'url' => route('works.index'), 'active' => request()->is('our-work')],
        ['label' => 'Events', 'url' => url('/events'), 'active' => request()->is('events') || request()->is('event-registration')],
        ['label' => 'Gallery', 'url' => url('/galleries'), 'active' => request()->is('galleries')],
        ['label' => 'Members', 'url' => route('members.index'), 'active' => request()->is('members') || request()->is('membership') || request()->is('member-application')],
        ['label' => 'Committee', 'url' => url('/committees'), 'active' => request()->is('committees')],
        ['label' => 'Contact', 'url' => url('/contact'), 'active' => request()->is('contact')],
    ];
@endphp

<header class="site-header">
    <div class="">
        <div class="site-header__bar">
            <a href="{{ route('home') }}" class="site-brand">
                <img class="site-brand__logo" src="{{ asset($settings['logo_image'] ?? 'img/logo_top.png') }}" alt="{{ $orgName }}">
                <div class="site-brand__text">
                    <strong>{{ $orgName }}</strong>
                    <span>{{ \Illuminate\Support\Str::limit(strip_tags($tagline), 58) }}</span>
                </div>
            </a>

            <button
                type="button"
                class="site-menu-toggle"
                data-site-menu-toggle
                aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>

            <div class="site-header__nav-wrap" data-site-nav>
                <nav class="site-nav">
                    @foreach($navItems as $item)
                        <a href="{{ $item['url'] }}" class="site-nav__link {{ $item['active'] ? 'is-active' : '' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                     <a href="{{ route('donate.form') }}" class="site-btn">Donate Now</a>
                </nav>
            </div>
        </div>
    </div>
</header>
