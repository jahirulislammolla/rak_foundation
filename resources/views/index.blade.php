<x-app-layout>
    <!-- Navbar & Carousel Start -->
    <style>
        @keyframes zoomInOut {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
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


  .title-responsive { font-size: 1.5rem; }               /* xs <576px */
    @media (min-width: 576px){ .title-responsive { font-size: 1.75rem; } } /* sm */
    @media (min-width: 768px){ .title-responsive { font-size: 2rem; } }    /* md */
    @media (min-width: 992px){ .title-responsive { font-size: 2.5rem; } }  /* lg */
    @media (min-width:1200px){ .title-responsive { font-size: 3rem; } }    /* xl */
    @media (min-width:1400px){ .title-responsive { font-size: 3.5rem; } }  /* xxl */

    </style>
    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100 animate-zoom" style="height: 100dvh;" src="{{ asset($settings['home_image'] ?? '') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="title-responsive text-white mb-md-4 animated zoomIn text-uppercase">{{ $settings['home_page_main_title'] ?? 'Together for a Better Tomorrow' }}</h1>
                            {{-- <a class="btn btn-danger py-md-3 px-md-5 me-3 animated slideIn" href="/member-application">Join Us
                                <i class="fa fa-arrow me-1"></i></a>
                                 --}}
                            <x-dyn-button page="home" key="join_us" fallbackText="Join Us" fallbackUrl="/member-application" />

                        </div>
                    </div>
                </div>
                {{-- <div class="carousel-item">
                    <img alt="Image" class="w-100" src="{{ asset('img/village.jpg') }}" />
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn">Serving Humanity with Heart</h1>
                        <a class="btn btn-primary py-md-3 px-md-5 me-3 animated slideIn" href="quote.html">Help Us
                            <i class="fa fa-arrow me-1"></i></a>

                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    </div>
    <!-- Navbar & Carousel End -->
    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button aria-label="Close" class="btn bg-white btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword" type="text" />
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->
    <!-- Facts Start -->
    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5 px-5">
            <div class="d-flex overflow-hidden" style="z-index:10; 
                color: black; background: #11356133;
                 border-radius: 15px; box-shadow:0 25px 50px -12px #00000057;">
                <div class="col-lg-6">
                    <div class="position-relative h-100">
                        <img style="z-index: 1;" class="position-absolute w-100 h-100 rounded" data-wow-delay="0.9s" src="{{ asset($settings['home_section_image'] ?? '') }}" style="object-fit: cover;" />
                    </div>
                </div>
                <div class="col-lg-6 py-20 px-5" style="padding: 70px 0px;">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h2 class="mb-0">{!! $settings['home_page_section_title'] ?? '' !!}</h1>
                    </div>
                    <div class="text-gray-700 mb-3">
                        {!! $settings['home_page_section_description'] ?? '' !!}
                    </div>

                    <x-dyn-button page="home" key="sponsor_now" fallbackText="Sponsor Now" fallbackUrl="/donate" />
                </div>
            </div>
        </div>
    </div>
    <!-- Features Start -->
    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h1 class="fw-bold text-primary text-uppercase">Our Focus Area</h1>
            </div>

            <div class="row g-5">
                @forelse($focus_areas as $i => $item)
                @php
                // wow delay: 0.3s, 0.6s, 0.9s, ...
                $delay = number_format(0.3 * (($i % 3) + 1), 1);
                $detailUrl = route('focus-areas.show') . '?slug='. $item->slug;
                @endphp

                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="{{ $delay }}s">
                    <div class="service-item bg-light bg-hover-primary shadow-css rounded d-flex flex-column align-items-center justify-content-center text-center">

                        {{-- Icon / Image --}}
                        <div class="service-icon d-flex align-items-center justify-content-center">
                            <i class="fa fa-shield-alt text-white"></i>
                        </div>

                        <h4 class="mb-3">{{ $item->title }}</h4>
                        <p class="m-0">{{ $item->short_description }}</p>

                        <a class="btn btn-lg btn-primary rounded mt-3" href="{{ $detailUrl }}">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No focus areas to show.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Service End -->
    <!-- Quote End -->
    <!-- Testimonial Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h2 class="fw-bold text-primary text-uppercase">Our Memebers</h2>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
                @foreach ($members as $member)

                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <img class="img-fluid rounded" src="{{ asset($member->photo_path) }}" style="width: 60px; height: 60px;" />
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">{{ $member->name ?? '' }}</h4>
                            <small class="text-uppercase">{{ $member->profession ?? '' }}</small>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        {{ $member->note ?? '' }}
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    <!-- Team Start -->
    <!-- Team End -->
    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h2 class="fw-bold text-primary text-uppercase">Our Latest Work</h2>
            </div>
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
                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="#">
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
        </div>
    </div>

</x-app-layout>
