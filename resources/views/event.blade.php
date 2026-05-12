<x-app-layout>
    <x-public-hero
        badge="Events"
        title="Upcoming gatherings, campaigns, and community moments."
        subtitle="Public events are now presented as premium campaign cards while keeping the same published and upcoming query chain."
        image="{{ $settings['event_image'] ?? 'img/event.png' }}"
        quote="Events are where community visibility turns into participation."
        primary-text="Register for an Event"
        primary-url="{{ url('/event-registration') }}"
        secondary-text="Contact Team"
        secondary-url="{{ url('/contact') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="section-heading">
                <span class="site-eyebrow">Calendar</span>
                <h2>Active event opportunities.</h2>
                <p>Only events passing the `published()` and `upcoming()` scopes appear here, ordered by featured priority and start date.</p>
            </div>

            <div class="site-grid grid-3">
                @forelse($events as $event)
                    <article class="public-card work-card content-stack">
                        <div class="work-card__media">
                            <img src="{{ asset($event->banner_path ?: 'img/event.png') }}" alt="{{ $event->title }}">
                        </div>
                        <div class="content-stack">
                            <span class="badge-soft">
                                <i class="bi bi-calendar-event"></i>
                                {{ $event->formatted_date }}
                            </span>
                            <h3>{{ $event->title }}</h3>
                            <p class="mb-0">{{ \Illuminate\Support\Str::limit($event->short_description, 140) }}</p>
                            <div class="meta-row">
                                <span><i class="bi bi-geo-alt"></i> {{ $event->location ?: 'Location to be announced' }}</span>
                                <span>
                                    @if(!is_null($event->days_remaining))
                                        {{ $event->days_remaining }} day{{ $event->days_remaining === 1 ? '' : 's' }} left
                                    @else
                                        Event schedule updated
                                    @endif
                                </span>
                            </div>
                            <div>
                                <a href="{{ url('event-registration') . '?event_id=' . $event->id }}" class="site-btn-outline">Register Now</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">No upcoming events are available right now.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $events->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
</x-app-layout>
