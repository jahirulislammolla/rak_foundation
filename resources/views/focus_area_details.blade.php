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

    </style>

    <!-- Spinner End -->
    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100 animate-zoom" height="420px" src="{{ asset('img/work.png') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">Our Work</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container mx-auto max-w-4xl py-10">
        <div class="mb-6">
            <a href="{{ route('focus-areas.index') }}" class="text-sky-600 underline">← Back</a>
        </div>
        <h1 class="text-3xl font-bold mb-4">{{ $focus_area->title }}</h1>

        @if($focus_area->image)
        <img src="{{ asset('storage/'.$focus_area->image) }}" class="rounded-xl mb-6" alt="{{ $focus_area->title }}">
        @endif

        <div class="prose max-w-none">
            {!! nl2br(e($focus_area->description)) !!}
        </div>
    </div>
</x-app-layout>
