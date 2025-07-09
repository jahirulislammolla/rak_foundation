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

        .amount-btn {
            min-width: 100px;
        }

        .donation-box {
            border-radius: 12px;
            background: #ddeff5a1;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .donate-summary {
            background: #f8f9fa;
            border-left: 5px solid #198754;
            padding: 15px;
            border-radius: 8px;
        }

        .section-title-donation {
            margin-top: 60px;
            margin-bottom: 20px;
        }
        
        .section_color{
            background-color: #e9efff9e !important;
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
                    <img alt="Image" class="w-100 animate-zoom" height="420px" src="{{ asset('img/donationus.png') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">Support RAK Foundation</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 donation-box">

                    <h4 class="mb-4">Choose Donation Amount</h4>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button class="btn btn-outline-primary amount-btn bg-hover-primary">৳100</button>
                        <button class="btn btn-outline-primary amount-btn bg-hover-primary">৳500</button>
                        <button class="btn btn-outline-primary amount-btn bg-hover-primary">৳1000</button>
                        <button class="btn btn-outline-primary amount-btn bg-hover-primary">৳5000</button>
                    </div>
                    <input type="number" class="form-control mb-4" placeholder="Or enter custom amount">

                    <h5>Choose a Cause</h5>
                    <select class="form-select mb-4">
                        <option selected disabled>Select Cause</option>
                        <option>Zakat</option>
                        <option>Education Support</option>
                        <option>Medical Fund</option>
                        <option>Orphan Care</option>
                        <option>General Donation</option>
                    </select>

                    <h5>Your Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="Full Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                    <input type="text" class="form-control mb-3" placeholder="Phone Number">
                    <textarea class="form-control mb-3" rows="2" placeholder="Address (optional)"></textarea>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="anon">
                        <label class="form-check-label" for="anon">Donate anonymously</label>
                    </div>

                    <h5>Select Payment Method</h5>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <button class="btn btn-outline-dark">bKash</button>
                        <button class="btn btn-outline-dark">Nagad</button>
                        <button class="btn btn-outline-dark">Card</button>
                        <button class="btn btn-outline-dark">Bank Transfer</button>
                    </div>

                    <div class="donate-summary mb-4">
                        <strong>Summary:</strong><br>
                        Amount: ৳1000<br>
                        Cause: Medical Fund<br>
                        Payment Method: bKash
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success py-2 px-4 fs-5" style="background-color: #18b90f; border-radius: 4px; border:1px solid #f8f9fa;">Donate Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Donate Section -->
        <div class="container text-center">
            <h3 class="section-title-donation">Why Donate to RAK Foundation?</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-sm rounded section_color">
                        <h5>📚 Education Programs</h5>
                        <p>We support students with scholarships, books and schools.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-sm rounded section_color">
                        <h5>🏥 Medical Aid</h5>
                        <p>Help patients with life-saving treatments and medicine.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-sm rounded section_color">
                        <h5>🧒 Orphan Care</h5>
                        <p>We take care of orphans with food, shelter and love.</p>
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