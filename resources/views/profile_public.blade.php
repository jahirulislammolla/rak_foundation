<x-app-layout>
    <x-public-hero
        badge="Public Profile"
        title="Academic and professional profile archive."
        subtitle="This page repairs the old public profile flow by moving it away from the authenticated `/profile` route and presenting the stored profile entries as a public-facing timeline."
        image="{{ $settings['about_image'] ?? 'img/aboutus.png' }}"
        quote="Public profile information should not collide with authenticated account management."
        primary-text="About Organization"
        primary-url="{{ url('/about') }}"
        secondary-text="Contact"
        secondary-url="{{ url('/contact') }}" />

    <section class="site-section">
        <div class="site-container">
            @php
                $grouped = $profiles->groupBy('type');
                $labels = [
                    1 => 'Academic Appointments',
                    2 => 'Professional Appointments',
                ];
            @endphp

            <div class="section-heading">
                <span class="site-eyebrow">Profile Archive</span>
                <h2>Structured public profile content.</h2>
                <p>Entries below are loaded from the `profiles` table using the existing `active()` scope and priority ordering defined in the route.</p>
            </div>

            <div class="site-grid grid-2">
                @forelse($grouped as $type => $items)
                    <div class="public-card copy-stack">
                        <h3 class="mb-0">{{ $labels[$type] ?? 'Profile Entries' }}</h3>
                        @foreach($items as $profile)
                            <article class="public-card timeline-card content-stack">
                                <h3>{{ $profile->title }}</h3>
                                <div class="rich-copy">
                                    {!! $profile->content !!}
                                </div>
                            </article>
                        @endforeach
                    </div>
                @empty
                    <div class="public-card">
                        <p class="mb-0">No public profile entries are available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
