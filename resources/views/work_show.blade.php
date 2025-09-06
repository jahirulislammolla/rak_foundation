<x-app-layout>
    <style>
        .post-hero{ height: 380px; object-fit: cover; width:100%; }
    </style>

    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="{{ $work->title }}" class="post-hero" src="{{ asset($work->image) }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-6 text-white animated zoomIn">{{ $work->title }}</h2>
                            @if($work->category)
                                <span class="text-white btn bg-primary mt-2">{{ $work->category->name }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 mx-auto" style="max-width: 1000px;">
        <div class="mb-3 text-muted">
            <i class="far fa-user me-2"></i>{{ $work->author_name ?: '—' }}
            <span class="mx-2">•</span>
            <i class="far fa-calendar-alt me-2"></i>{{ optional($work->published_at)->format('d M, Y') ?: 'Draft' }}
        </div>

        {{-- যদি body HTML-safe হয়: --}}
        <div class="content">
            {!! $work->body !!}
        </div>

        <div class="mt-4">
            <a href="{{ route('works.index') }}" class="btn btn-outline-primary">← Back to Works</a>
        </div>
    </div>
</x-app-layout>
