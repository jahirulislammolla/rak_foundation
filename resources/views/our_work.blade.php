<x-app-layout>
    <style>
        @keyframes zoomInOut { 0%{transform:scale(1)}50%{transform:scale(1.02)}100%{transform:scale(1)} }
        .animate-zoom{ animation: zoomInOut 10s ease-in-out infinite; }
        .shadow-css{ box-shadow:0 10px 24px -10px #00000057; color:black; border-radius:5px; cursor:pointer; }
        .bg-hover-primary{ transition: background-color .5s ease-in-out, color .5s ease-in-out; }
        .bg-hover-primary:hover{ background:#113561bf !important; color:#fff; }
        .bg-hover-primary:hover h4{ color:#fff; }
    </style>

    {{-- Header --}}
    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100 animate-zoom" height="420px" src="{{ asset($settings['our_work_image'] ?? '') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">Our Work</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Grid + Filters --}}
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            {{-- Filters --}}
            <form method="get" class="row g-2 mb-4">
                <div class="col-md-4">
                    <select name="cat" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" @selected((string)request('cat') === (string)$c->id)>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <input name="q" value="{{ request('q') }}" class="form-control" placeholder="Search works...">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">Filter</button>
                </div>
            </form>

            <div class="row g-5">
                

                @forelse($works as $work)
                    @php
                        // wow delay 0.3s, 0.6s, 0.9s সাইকেল
                        $delays = [0.3, 0.6, 0.9];
                        $delay = $delays[($loop->iteration - 1) % 3];
                        $excerpt = $work->excerpt ?? '';
                    @endphp
                    <div class="col-lg-4 wow slideInUp" data-wow-delay="{{ $delay }}s">
                        <div class="blog-item bg-light rounded overflow-hidden">
                            <div class="blog-img position-relative overflow-hidden">
                                <img alt="{{ $work->title }}" src="{{ asset($work->image) }}" width="100%" height="220px" class="overflow-hidden" />
                                @if($work->category)
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                       href="#">
                                        {{ $work->category->name }}
                                    </a>
                                @endif
                            </div>
                            <div class="p-4">
                                <div class="d-flex mb-3">
                                    <small class="me-3">
                                        <i class="far fa-user text-primary me-2"></i>{{ $work->author_name ?: '—' }}
                                    </small>
                                    <small>
                                        <i class="far fa-calendar-alt text-primary me-2"></i>
                                        {{ optional($work->published_at)->format('d M, Y') ?: 'Draft' }}
                                    </small>
                                </div>
                                <h4 class="mb-3">{{ $work->title }}</h4>
                                <p>{{ $excerpt }}</p>
                                <div class="text-center">
                                    <a class="text-uppercase" href="{{ route('works.index', ['slug' => $work->slug ]) }}">
                                        Read More <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No works found.</div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $works->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
