<x-app-layout>
    <!-- Spinner Start -->
    <style>
        @keyframes zoomInOut {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
        .animate-zoom { animation: zoomInOut 10s ease-in-out infinite; }
        .shadow-css { box-shadow: 0 10px 24px -10px #00000057; color: black; border-radius: 5px; cursor: pointer; }
        .bg-hover-primary { transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out; }
        .bg-hover-primary:hover { background-color: #113561bf !important; color: white; }
        .bg-hover-primary:hover h4 { color: white; }
    </style>
    <!-- Spinner End -->

    <div class="container-fluid position-relative p-0">
        <div id="header-carousel" class="carousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100  animate-zoom" style="height: calc(100svh / 2);"  src="{{ asset('img/join_membership.png') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">Membership</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8">

                    <h1 class="h4 fw-semibold text-dark mb-4">Apply for Membership</h1>

                    @if(session('success'))
                        <div class="alert alert-success small">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form method="POST" action="{{ route('member.apply.store') }}" enctype="multipart/form-data">
                                @csrf

                                <!-- Row 1 -->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                    </div>
                                </div>

                                <!-- Row 2 -->
                                <div class="row g-3 mt-1">
                                    <div class="col-md-6">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Profession</label>
                                        <input type="text" name="profession" value="{{ old('profession') }}" class="form-control">
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="mt-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" rows="2" class="form-control">{{ old('address') }}</textarea>
                                </div>

                                <!-- Membership Type + Photo -->
                                <div class="row g-3 mt-1">
                                    <div class="col-md-6">
                                        <label class="form-label d-block">Membership Type *</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="membership_type" id="mt_yearly"
                                                   value="yearly" {{ old('membership_type','yearly')==='yearly'?'checked':'' }}>
                                            <label class="form-check-label" for="mt_yearly">Yearly (৳ 0)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="membership_type" id="mt_lifetime"
                                                   value="lifetime" {{ old('membership_type')==='lifetime'?'checked':'' }}>
                                            <label class="form-check-label" for="mt_lifetime">Lifetime (৳ 0)</label>
                                        </div>
                                        <div class="form-text">* Fee will be set automatically on submission.</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Photo (optional)</label>
                                        <input type="file" name="photo" accept="image/*" class="form-control">
                                    </div>
                                </div>

                                <!-- Note -->
                                <div class="mt-3">
                                    <label class="form-label">Why do you want to join? (optional)</label>
                                    <textarea name="note" rows="3" class="form-control">{{ old('note') }}</textarea>
                                </div>

                                <!-- Actions -->
                                <div class="d-flex align-items-center gap-2 mt-4">
                                    <button class="btn btn-primary">
                                        Submit Application
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div><!-- /card -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
