<x-app-layout>
    <x-public-hero
        badge="Members"
        title="Meet the people strengthening the organization from within."
        subtitle="This public list still uses the existing approved-member scope and pagination chain, but now presents members as a cleaner premium directory."
        image="img/join_membership.png"
        quote="Visible, credible membership reinforces public trust."
        primary-text="Apply Now"
        primary-url="{{ route('member.apply') }}"
        secondary-text="Membership Info"
        secondary-url="{{ url('/membership') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="section-heading">
                <span class="site-eyebrow">Directory</span>
                <h2>Approved members.</h2>
                <p>Profiles shown here come from the `members` table filtered through the `approved()` scope, ordered by approval date.</p>
            </div>

            <div class="site-grid grid-4">
                @forelse($members as $m)
                    <article class="public-card person-card content-stack">
                        <div class="person-card__media">
                            <img src="{{ asset($m->photo_path ?: 'img/user.jpg') }}" alt="{{ $m->name }}">
                        </div>
                        <div class="content-stack">
                            <div>
                                <h3>{{ $m->name }}</h3>
                                <p class="mb-0">{{ $m->profession ?: 'Member' }}</p>
                            </div>
                            <div class="meta-row">
                                <span>{{ $m->type_label }}</span>
                                @if($m->start_date)
                                    <span>Since {{ $m->start_date->format('Y') }}</span>
                                @endif
                            </div>
                            @if($m->note)
                                <p class="mb-0">{{ \Illuminate\Support\Str::limit($m->note, 100) }}</p>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">No approved members yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $members->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
</x-app-layout>
