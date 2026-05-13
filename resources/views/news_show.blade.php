<x-app-layout>
    <section class="site-section">
        <div class="site-container">
            <article class="public-card copy-stack">
                <span class="site-eyebrow">{{ $work->category->name ?? 'Update' }}</span>
                <h1 class="site-title">{{ $work->title }}</h1>
                <div class="meta-row">
                    <span>{{ optional($work->published_at)->format('d M Y') ?: 'Draft' }}</span>
                    <span>{{ $work->author_name ?: 'Organization Desk' }}</span>
                </div>
                <div class="work-card__media">
                    <img src="{{ asset($work->image ?: 'img/work.png') }}" alt="{{ $work->title }}">
                </div>
                <div class="rich-copy">
                    {!! $work->body ?: '<p>No full update has been added yet.</p>' !!}
                </div>
                <div>
                    <a href="{{ route('news.index') }}" class="site-btn-outline">Back to News</a>
                </div>
            </article>
        </div>
    </section>
</x-app-layout>
