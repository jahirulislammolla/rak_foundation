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
                    <img alt="Image" class="w-100 animate-zoom" height="420px" src="{{ asset('img/event_registration.png') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            {{-- <h2 class="display-5 text-white animated zoomIn">Event Registration</h2> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="registration-box">
                        {{-- <h2 class="text-center mb-4">🎉 Event Registration</h2> --}}

                        <!-- Form Start -->
                        <form>

                            <!-- Personal Info -->
                            <h5 class="form-section-title">🧍 Personal Information</h5>
                            <div class="mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email Address *</label>
                                <input type="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" required>
                            </div>

                            <!-- Event Info -->
                            <h5 class="form-section-title">📅 Event Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Select Event *</label>
                                <select class="form-select" required>
                                    <option selected disabled>-- Choose an event --</option>
                                    <option>Annual Charity Summit 2025</option>
                                    <option>Medical Support Campaign</option>
                                    <option>Student Zakat Program</option>
                                    <option>Orphan Day Celebration</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ticket Type *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ticketType" id="student"
                                        required>
                                    <label class="form-check-label" for="student">Student (৳100)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ticketType" id="general">
                                    <label class="form-check-label" for="general">General (৳300)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ticketType" id="vip">
                                    <label class="form-check-label" for="vip">VIP (৳1000)</label>
                                </div>
                            </div>

                            <!-- Payment Info -->
                            <h5 class="form-section-title">💳 Payment Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Payment Method *</label>
                                <select class="form-select" required>
                                    <option selected disabled>-- Select method --</option>
                                    <option>bKash</option>
                                    <option>Nagad</option>
                                    <option>Rocket</option>
                                    <option>Bank Transfer</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Transaction ID *</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <!-- Consent -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#">Terms & Conditions</a>.
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning py-2">✅ Register Now</button>
                            </div>

                        </form>
                        <!-- Form End -->
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