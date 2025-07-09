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
                    <img alt="Image" class="w-100 animate-zoom" height="420px"
                        src="{{ asset('img/committee.png') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">Committee</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <!-- Header -->
        <section class="text-center py-5 bg-white">
            <h1 class="fw-bold">Our Honorable Committee</h1>
            <p class="text-muted lead">The dedicated individuals behind RAK Foundation's success and impact.</p>
        </section>

        <!-- Committee Members Grid -->
        <div class="container py-4">
            <div class="row g-4">

                <!-- Member 1 -->
                <div class="col-md-4">
                    <div class="card text-center p-4 shadow-sm member-card">
                        <img src="{{ asset('img/team-1.jpg') }}" alt="Chairman" class="mx-auto mb-3 w-100">
                        <h5 class="fw-bold mb-0">Dr. Afsar Uddin</h5>
                        <small class="text-muted">Chairman</small>
                        <p class="mt-2 small text-secondary">A visionary leader with decades of experience in
                            humanitarian work.</p>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="col-md-4">
                    <div class="card text-center p-4 shadow-sm member-card">
                        <img src="{{ asset('img/team-2.jpg') }}" alt="Secretary"
                            class="mx-auto mb-3 w-100">
                        <h5 class="fw-bold mb-0">Nasima Begum</h5>
                        <small class="text-muted">Secretary</small>
                        <p class="mt-2 small text-secondary">Dedicated to women's health, education, and rural
                            development.</p>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="col-md-4">
                    <div class="card text-center p-4 shadow-sm member-card">
                        <img src="{{ asset('img/team-3.jpg') }}" alt="Treasurer"
                            class="mx-auto mb-3 w-100">
                        <h5 class="fw-bold mb-0">Rahim Uddin</h5>
                        <small class="text-muted">Treasurer</small>
                        <p class="mt-2 small text-secondary">Handles financial oversight and ensures donor transparency.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Committee Table -->
        <div class="container mt-5">
            <h4 class="mb-3">📋 Committee Structure</h4>
            <div class="table-responsive">
                <table class="table table-bordered bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Chairman</td>
                            <td>Dr. Afsar Uddin</td>
                            <td>afsar@rakfoundation.org</td>
                        </tr>
                        <tr>
                            <td>Secretary</td>
                            <td>Nasima Begum</td>
                            <td>nasima@rakfoundation.org</td>
                        </tr>
                        <tr>
                            <td>Treasurer</td>
                            <td>Rahim Uddin</td>
                            <td>rahim@rakfoundation.org</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chairman Message -->
        <section class="py-5 bg-white">
            <div class="container text-center">
                <blockquote class="blockquote">
                    <p class="mb-4">"RAK Foundation stands for compassion and change. Our committee is committed to
                        building a better, equitable society for all."</p>
                    <footer class="blockquote-footer">Dr. Afsar Uddin, Chairman</footer>
                </blockquote>
            </div>
        </section>

        <!-- Call to Action -->
        <div class="container text-center py-4">
            <h5>Want to get involved?</h5>
            <a href="/contact" class="btn btn-outline-primary m-1">Contact Us</a>
            <a href="/donate" class="btn btn-success m-1">Donate Now</a>
        </div>
    </div>
    <!-- About End -->
    <!-- Team End -->
    <!-- Vendor End -->
    <!-- Footer Start -->
</x-app-layout>