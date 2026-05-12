<x-app-layout>
    <x-public-hero
        badge="Our Work"
        title="Published work, initiatives, and documentation from the field."
        subtitle="Search, filter, and browse program outputs without changing the existing `our-work` query contract."
        image="{{ $settings['our_work_image'] ?? 'img/work.png' }}"
        quote="Public work pages should feel like evidence, not filler."
        primary-text="Explore Focus Areas"
        primary-url="{{ route('focus-areas.show') }}"
        secondary-text="Contact Team"
        secondary-url="{{ url('/contact') }}" />

    <section class="site-section">
        <div class="site-container">
            @php
                $currentRange = $range ?? 'all';
                $baseQuery = array_filter([
                    'cat' => request('cat'),
                    'q' => request('q'),
                ], fn ($value) => $value !== null && $value !== '');
                $ranges = [
                    'all' => 'All Time',
                    '2026' => '2026',
                    '2025' => '2025',
                    '2024' => '2024',
                ];
            @endphp

            <div class="section-heading">
                <span class="site-eyebrow">Archive</span>
                <h2>Programs and publications.</h2>
                <p>Items shown below come from `Work` with category joins, range filters, and active-state constraints defined in the route closure.</p>
            </div>

            <div class="public-card mb-4">
                <div class="d-flex flex-wrap gap-2 mb-4">
                    @foreach($ranges as $key => $label)
                        <a href="{{ route('works.index', $baseQuery + ['range' => $key]) }}" class="{{ (string) $currentRange === (string) $key ? 'site-btn' : 'site-btn-outline' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <form method="GET" class="site-form">
                    <input type="hidden" name="range" value="{{ $currentRange }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="cat">Category</label>
                            <select id="cat" name="cat" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" @selected((string) request('cat') === (string) $c->id)>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="q">Search</label>
                            <input id="q" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search by title, excerpt, or body">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="site-btn border-0 w-100">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="site-grid grid-3">
                @forelse($works as $work)
                    <article class="public-card work-card content-stack">
                        <div class="work-card__media">
                            <a href="{{ route('works.index', ['slug' => $work->slug]) }}">
                                <img src="{{ asset($work->image ?: 'img/work.png') }}" alt="{{ $work->title }}">
                            </a>
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
                            <p class="mb-0">{{ \Illuminate\Support\Str::limit($work->excerpt ?: strip_tags($work->body), 150) }}</p>
                            <div>
                                <a href="{{ route('works.index', ['slug' => $work->slug]) }}" class="site-btn-outline">Read More</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">No works matched your filters.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $works->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
</x-app-layout>
