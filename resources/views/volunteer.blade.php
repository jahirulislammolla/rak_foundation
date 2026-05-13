<x-app-layout>
    <x-public-hero
        badge="Volunteer"
        title="Join field work, events, and community support programs."
        subtitle="The volunteer module is prepared as a public entry point. The full application review workflow belongs in the next migration/admin phase."
        image="img/join_membership.png"
        primary-text="Apply for Membership"
        primary-url="{{ route('member.apply') }}"
        secondary-text="Contact Team"
        secondary-url="{{ url('/contact') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="surface-split">
                <div class="public-card copy-stack">
                    <span class="site-eyebrow">How Volunteers Help</span>
                    <h2>Practical roles for people who can give time, skill, or local knowledge.</h2>
                    <p>Volunteer onboarding should collect skills, district, availability, and a short motivation note once the volunteer table is added. Until then, this page routes interested people to membership and contact flows that already exist.</p>
                    <div class="site-grid grid-2">
                        <div class="feature-card">
                            <span class="badge-soft">Events</span>
                            <p class="mb-0 mt-3">Support registration, logistics, field coordination, and follow-up.</p>
                        </div>
                        <div class="feature-card">
                            <span class="badge-soft">Programs</span>
                            <p class="mb-0 mt-3">Assist education, healthcare, relief, and community outreach programs.</p>
                        </div>
                    </div>
                </div>

                <div class="public-card copy-stack">
                    <span class="site-eyebrow">Upcoming Opportunities</span>
                    @forelse($events as $event)
                        <div class="timeline-card">
                            <h3>{{ $event->title }}</h3>
                            <p class="mb-2">{{ optional($event->start_at)->format('d M Y') ?: 'Date will be announced' }}</p>
                            <a href="{{ url('/event-registration') }}" class="site-btn-outline">Register Interest</a>
                        </div>
                    @empty
                        <p class="mb-0">Upcoming volunteer opportunities will appear after events are published.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
