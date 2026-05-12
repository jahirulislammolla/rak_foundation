<x-app-layout>
    <x-public-hero
        badge="Gallery"
        title="Visual moments from programs, events, and field engagement."
        subtitle="The gallery keeps the same active-image pagination flow, but now looks like a curated media archive instead of a basic grid."
        image="{{ $settings['gallery_image'] ?? 'img/gallery.png' }}"
        quote="Images help translate mission statements into visible reality."
        primary-text="View Events"
        primary-url="{{ url('/events') }}"
        secondary-text="Support the Mission"
        secondary-url="{{ route('donate.form') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="section-heading">
                <span class="site-eyebrow">Photo Archive</span>
                <h2>Field snapshots and public moments.</h2>
                <p>Every item shown here comes from the active gallery collection and helps reinforce transparency around the organization’s visible work.</p>
            </div>

            <div class="site-grid grid-3">
                @forelse($galleries as $g)
                    <article class="public-card gallery-card content-stack">
                        <div class="gallery-card__media">
                            <img src="{{ asset($g->image_path ?: 'img/gallery.png') }}" alt="{{ $g->title }}">
                        </div>
                        <div class="content-stack">
                            <h3>{{ $g->title }}</h3>
                            <p class="mb-0">A visual record from our public-facing community journey.</p>
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">No gallery items are available right now.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $galleries->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
</x-app-layout>
