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
         .event-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-6px);
        }
        .event-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
        /* .bg-header {
		background-color: rgba(0, 149, 255, 0.389) !important;
		background: linear-gradient(rgba(9, 30, 62, .7), rgba(9, 30, 62, .7)), url('{{ asset('img/aboutus.jpg') }}') center center no-repeat;
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
                    <img alt="Image" class="w-100 animate-zoom" height="420px"
                        src="{{ asset('img/event.png') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">Upcoming Events</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-4">

                <!-- Event Card Start -->
                <div class="col-md-6 col-lg-4">
                    <div class="card event-card">
                        <img src="{{ asset('img/blog-2.jpg') }}" class="card-img-top event-image" alt="Event Image">
                        <div class="card-body">
                        <h5 class="card-title">Tech Conference 2025</h5>
                        <p class="card-text">Join the biggest technology conference featuring keynote speakers...</p>
                        <div style="display:flex; justify-content: space-between;">
                            <div class="text-muted mb-2">
                                <i class="bi bi-calendar-event"></i><strong>10 July 2025</strong>
                            </div>
                            <div>
                                <small class="text-danger">⏳ 2 days</small>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <a href="/event-registration" class="btn btn-success" style="border-radius: 3px;">Register Now</a>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Event Card End -->

                <!-- Repeat Card for More Events -->
                <div class="col-md-6 col-lg-4">
                    <div class="card event-card">
                        <img src="{{ asset('img/blog-2.jpg') }}" class="card-img-top event-image" alt="Event Image">
                        <div class="card-body">
                        <h5 class="card-title">Socail Safety</h5>
                        <p class="card-text">Hands-on workshop on design tools and UI/UX strategies by industry leaders.</p>
                        <div style="display:flex; justify-content: space-between;">
                            <div class="text-muted mb-2">
                                <i class="bi bi-calendar-event"></i><strong>12 July 2025</strong>
                            </div>
                            <div>
                                <small class="text-info">⏳ 10 days</small>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <a href="/event-registration" class="btn btn-success" style="border-radius: 3px;">Register Now</a>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card event-card">
                        <img src="{{ asset('img/blog-3.jpg') }}" class="card-img-top event-image" alt="Event Image">
                        <div class="card-body">
                        <h5 class="card-title">Creative Design Workshop</h5>
                        <p class="card-text">Hands-on workshop on design tools and UI/UX strategies by industry leaders.</p>
                       <div style="display:flex; justify-content: space-between;">
                            <div class="text-muted mb-2">
                                <i class="bi bi-calendar-event"></i><strong>15 July 2025</strong>
                            </div>
                            <div>
                                <small class="text-info">⏳ 12 days</small>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <a href="/event-registration" class="btn btn-success" style="border-radius: 3px;">Register Now</a>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Team End -->
    <!-- Vendor End -->
    <!-- Footer Start -->
</x-app-layout>