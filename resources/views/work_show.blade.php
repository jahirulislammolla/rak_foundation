<x-app-layout>
    <x-public-hero
        badge="{{ $work->category?->name ?? 'Work Detail' }}"
        title="{{ $work->title }}"
        subtitle="{{ \Illuminate\Support\Str::limit($work->excerpt ?: strip_tags($work->body), 220) }}"
        image="{{ $work->image ?: 'img/work.png' }}"
        quote="A strong public work detail page should feel editorial, not accidental."
        primary-text="Back to All Work"
        primary-url="{{ route('works.index') }}"
        secondary-text="Donate"
        secondary-url="{{ route('donate.form') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="public-card">
                <div class="meta-row mb-4">
                    <span><i class="bi bi-person"></i> {{ $work->author_name ?: 'Organization Desk' }}</span>
                    <span><i class="bi bi-calendar3"></i> {{ optional($work->published_at)->format('d M Y') ?: 'Draft' }}</span>
                    @if($work->category)
                        <span><i class="bi bi-bookmark"></i> {{ $work->category->name }}</span>
                    @endif
                </div>

                <div class="rich-copy" id="work-content">
                    {!! $work->body !!}
                </div>

                <div class="mt-4">
                    <a href="{{ route('works.index') }}" class="site-btn-outline">Back to Works</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        (() => {
            const root = document.getElementById('work-content');
            if (!root) return;
            const widths = @json($work->image_widths ?? []);
            const images = root.querySelectorAll('img');

            images.forEach((image, index) => {
                const width = Array.isArray(widths) ? widths[index] : null;
                image.style.height = 'auto';
                image.style.borderRadius = '18px';
                image.style.margin = '24px auto';
                image.style.display = 'block';
                image.style.maxWidth = '100%';
                if (width) {
                    image.style.width = width + '%';
                }
            });
        })();
    </script>
</x-app-layout>
