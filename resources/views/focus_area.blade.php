<x-app-layout>
    <!-- Spinner Start -->
    <style>
        @keyframes zoomInOut {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }

            100% {
                transform: scale(1);
            }
        }

        .animate-zoom {
            animation: zoomInOut 10s ease-in-out infinite;
        }

        .shadow-css {
            box-shadow: 0 10px 24px -10px #00000057;
            color: black;
            border-radius: 5px;
            cursor: pointer;
        }

        .bg-hover-primary {
            transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
            /* Adjust duration and easing as needed */
        }

        .bg-hover-primary:hover {
            background-color: #113561bf !important;
            color: white;
        }

        .bg-hover-primary:hover h4 {
            color: white;
        }

        .gallery-card {
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-4px);
        }

        .gallery-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.05);
        }

        .gallery-title {
            text-align: center;
            margin-bottom: 40px;
        }

        /* .bg-header {
		background-color: rgba(0, 149, 255, 0.389) !important;
		background: linear-gradient(rgba(9, 30, 62, .7), rgba(9, 30, 62, .7)), url('{{ asset('img/aboutus.png') }}') center center no-repeat;
	} */

    </style>
    {{-- <div
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
        id="spinner">
        <div class="spinner"></div>
    </div> --}}
    <!-- Spinner End -->
    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100  animate-zoom" style="height: calc(100svh / 2);"  src="{{ asset($item->image) }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">{{ $item->title }}</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 align-items-start justify-content-center">

                <div class="col-lg-10 ">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">

                            {{-- Full description (safe render) --}}
                            @if($item->description)
                            {!! $item->description !!}
                            @else
                            <p class="text-muted">Details will be published soon.</p>
                            @endif
                        </div>
                    </div>

                    {{-- (Optional) Related items/grid/CTA এখানে যোগ করতে পারো --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
