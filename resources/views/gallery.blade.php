{{-- resources/views/gallery/index.blade.php --}}
<x-app-layout>
    <style>
        @keyframes zoomInOut { 0%{transform:scale(1)} 50%{transform:scale(1.02)} 100%{transform:scale(1)} }
        .animate-zoom { animation: zoomInOut 10s ease-in-out infinite; }

        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            transition: transform .3s ease;
        }
        .gallery-card:hover { transform: translateY(-4px); }
        .gallery-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform .4s ease;
            display: block;
        }
        .gallery-card:hover img { transform: scale(1.05); }

        /* Hover overlay for title */
        .gallery-overlay {
            position: absolute;
            inset: 0; /* top:0; right:0; bottom:0; left:0 */
            background: linear-gradient(to top, rgba(0,0,0,0.6), rgba(0,0,0,0.0) 60%);
            display: flex;
            align-items: flex-end;
            padding: 12px;
            color: #fff;
            opacity: 0;
            transform: translateY(8px);
            transition: opacity .3s ease, transform .3s ease;
        }
        .gallery-card:hover .gallery-overlay,
        .gallery-card:focus-within .gallery-overlay {
            opacity: 1;
            transform: translateY(0);
        }
        .gallery-title {
            font-size: 1rem;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0,0,0,.4);
            /* long title clamp */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100  animate-zoom" style="height: calc(100svh / 2);"  src="{{ asset($settings['gallery_image'] ?? '') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white">Our Image Gallery</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Dynamic Grid --}}
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4">
                @forelse($galleries as $g)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="gallery-card" tabindex="0">
                            <img src="{{ asset($g->image_path) }}" alt="{{ $g->title }}">
                            <div class="gallery-overlay">
                                <div class="gallery-title">{{ $g->title }}</div>
                            </div>
                        </div>
                        {{-- টাইটেল নিচে আর দেখানো হচ্ছে না; SEO/Accessibility চাইলে visually-hidden রাখুন --}}
                        <span class="visually-hidden">{{ $g->title }}</span>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No images found.</div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $galleries->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>
