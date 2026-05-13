<x-app-layout>
    <x-public-hero
        badge="News & Updates"
        title="Latest stories, notices, and field updates."
        subtitle="Until the dedicated news module is added, this page uses published work items as public updates so the route is useful immediately."
        image="img/blog-1.jpg"
        primary-text="Our Work"
        primary-url="{{ route('works.index') }}"
        secondary-text="Contact"
        secondary-url="{{ url('/contact') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="site-grid grid-3">
                @forelse($updates as $work)
                    <article class="public-card work-card content-stack">
                        <div class="work-card__media">
                            <img src="{{ asset($work->image ?: 'img/work.png') }}" alt="{{ $work->title }}">
                        </div>
                        <div class="content-stack">
                            <span class="badge-soft">{{ $work->category->name ?? 'Update' }}</span>
                            <h3>{{ $work->title }}</h3>
                            <div class="meta-row">
                                <span>{{ optional($work->published_at)->format('d M Y') ?: 'Draft' }}</span>
                            </div>
                            <p class="mb-0">{{ \Illuminate\Support\Str::limit($work->excerpt ?: strip_tags($work->body), 150) }}</p>
                            <div>
                                <a href="{{ route('news.show', $work->slug) }}" class="site-btn-outline">Read Update</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">News and updates will appear here after publication.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $updates->links() }}
            </div>
        </div>
    </section>
</x-app-layout>
