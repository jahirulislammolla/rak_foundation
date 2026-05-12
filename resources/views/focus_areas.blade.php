<x-app-layout>
    <x-public-hero
        badge="Focus Areas"
        title="The social priorities we are actively organized around."
        subtitle="These are not generic labels. They represent actual areas of program attention, public communication, and future fundraising alignment."
        image="{{ $settings['our_focus_area_image'] ?? 'img/committee.png' }}"
        quote="Focused organizations are easier to trust and easier to support."
        primary-text="View Our Work"
        primary-url="{{ route('works.index') }}"
        secondary-text="Donate"
        secondary-url="{{ route('donate.form') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="section-heading">
                <span class="site-eyebrow">Program Map</span>
                <h2>Where we concentrate effort.</h2>
                <p>Focus areas are loaded through the `FocusArea::active()` scope and ordered for public presentation, so the new design keeps that ranking visible and intentional.</p>
            </div>

            <div class="site-grid grid-3">
                @forelse($focus_areas as $item)
                    <article class="public-card focus-card content-stack">
                        <span class="icon-wrap">
                            <i class="{{ $item->icon_class ?: 'bi bi-stars' }}"></i>
                        </span>
                        <h3>{{ $item->title }}</h3>
                        <p class="mb-0">{{ $item->short_description }}</p>
                        <div>
                            <a href="{{ route('focus-areas.show', ['slug' => $item->slug]) }}" class="site-btn-outline">View Details</a>
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">No focus areas are available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
