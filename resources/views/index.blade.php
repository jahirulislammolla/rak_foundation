<x-app-layout>
    <x-public-hero
        badge="Social Impact Platform"
        title="{{ $settings['home_page_main_title'] ?? 'Together for resilient communities and measurable local change.' }}"
        subtitle="{{ \Illuminate\Support\Str::limit(strip_tags($settings['home_page_section_description'] ?? 'We organize people, funding, and field work into practical social impact programs that deliver visible progress.'), 240) }}"
        image="{{ $settings['home_image'] ?? 'img/background_home.jpg' }}"
        quote="From emergency response to long-term empowerment, every initiative is designed to create dignity, trust, and momentum."
        primary-text="Become a Member"
        primary-url="{{ route('member.apply') }}"
        secondary-text="Support a Cause"
        secondary-url="{{ route('donate.form') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="site-grid grid-4">
                <div class="public-card metric-card">
                    <strong>{{ $focus_areas->count() }}</strong>
                    <span>Active focus areas shaped around real community needs.</span>
                </div>
                <div class="public-card metric-card">
                    <strong>{{ $works->total() }}</strong>
                    <span>Published work stories documenting field outcomes and lessons.</span>
                </div>
                <div class="public-card metric-card">
                    <strong>{{ $members->total() }}</strong>
                    <span>Approved members contributing ideas, time, and advocacy.</span>
                </div>
                <div class="public-card metric-card">
                    <strong>24/7</strong>
                    <span>A platform ready to engage volunteers, donors, and communities.</span>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section-tight">
        <div class="site-container">
            <div class="surface-split">
                <div class="public-card copy-stack">
                    <div class="section-heading mb-0">
                        <span class="site-eyebrow">Who We Are</span>
                        <h2>{!! $settings['home_page_section_title'] ?? 'A people-first organization with practical implementation discipline.' !!}</h2>
                    </div>
                    <div class="rich-copy">
                        {!! $settings['home_page_section_description'] ?? '<p>We bring together volunteers, professionals, donors, and partner communities to build sustainable programs in education, emergency support, livelihoods, and civic resilience.</p>' !!}
                    </div>
                    <div class="site-actions">
                        <x-dyn-button page="home" key="join_us" fallbackText="Join Us" fallbackUrl="/member-application" />
                        <a href="{{ url('/about') }}" class="site-btn-outline">Learn More</a>
                    </div>
                </div>

                <div class="public-card p-0 overflow-hidden">
                    <div class="work-card__media h-100">
                        <img src="{{ asset($settings['home_section_image'] ?? 'img/aboutus.png') }}" alt="Community engagement" style="height:100%; min-height:420px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="site-container">
            <div class="section-heading">
                <span class="site-eyebrow">Focus Areas</span>
                <h2>Programs designed around urgency, inclusion, and long-term improvement.</h2>
                <p>Each focus area reflects a problem we are actively working on with structured initiatives, partner support, and transparent public communication.</p>
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
                            <a href="{{ route('focus-areas.show', ['slug' => $item->slug]) }}" class="site-btn-outline">Explore Area</a>
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">No focus areas are available right now.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="site-section-tight">
        <div class="site-container">
            <div class="section-heading">
                <span class="site-eyebrow">Member Voices</span>
                <h2>People behind the mission.</h2>
                <p>Our membership network is not decorative. It is the operating backbone for planning, field coordination, fundraising, and accountability.</p>
            </div>

            <div class="site-grid grid-3">
                @forelse($members as $member)
                    <article class="public-card person-card content-stack">
                        <div class="person-card__media">
                            <img src="{{ asset($member->photo_path ?: 'img/user.jpg') }}" alt="{{ $member->name }}">
                        </div>
                        <div class="content-stack">
                            <div>
                                <h3>{{ $member->name }}</h3>
                                <p class="mb-0">{{ $member->profession ?: 'Community member' }}</p>
                            </div>
                            <span class="badge-soft">{{ $member->type_label }}</span>
                            <p class="mb-0">{{ \Illuminate\Support\Str::limit($member->note ?: 'Committed to collaborative social impact and community growth.', 120) }}</p>
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">Approved members will appear here after review.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="site-container">
            <div class="section-heading">
                <span class="site-eyebrow">Latest Work</span>
                <h2>Stories, case updates, and field evidence from our public work.</h2>
                <p>These publications show where the organization is spending energy, what is changing on the ground, and how programs are being documented over time.</p>
            </div>

            <div class="site-grid grid-3">
                @forelse($works as $work)
                    <article class="public-card work-card content-stack">
                        <div class="work-card__media">
                            <img src="{{ asset($work->image ?: 'img/work.png') }}" alt="{{ $work->title }}">
                        </div>
                        <div class="content-stack">
                            @if($work->category)
                                <span class="badge-soft">{{ $work->category->name }}</span>
                            @endif
                            <h3>{{ $work->title }}</h3>
                            <div class="meta-row">
                                <span><i class="bi bi-person"></i> {{ $work->author_name ?: 'Organization Desk' }}</span>
                                <span><i class="bi bi-calendar3"></i> {{ optional($work->published_at)->format('d M Y') ?: 'Draft' }}</span>
                            </div>
                            <p class="mb-0">{{ \Illuminate\Support\Str::limit($work->excerpt ?: strip_tags($work->body), 160) }}</p>
                            <div>
                                <a href="{{ route('works.index', ['slug' => $work->slug]) }}" class="site-btn-outline">Read Story</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">No published work is available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="site-section-tight">
        <div class="site-container">
            <div class="cta-banner site-panel">
                <div class="copy-stack">
                    <span class="site-eyebrow">Take Action</span>
                    <h3 class="mb-0">Ready to fund an initiative, join the network, or start a conversation?</h3>
                    <p class="mb-0">The public site is now oriented around trust, clarity, and conversion: membership, donations, events, and contact are all one click away.</p>
                </div>
                <div class="site-actions">
                    <a href="{{ url('/contact') }}" class="site-btn-outline">Contact Us</a>
                    <a href="{{ route('donate.form') }}" class="site-btn">Donate</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
