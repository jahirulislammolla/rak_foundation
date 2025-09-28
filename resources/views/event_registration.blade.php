<x-app-layout>
    <style>
        @keyframes zoomInOut { 0%{transform:scale(1)}50%{transform:scale(1.02)}100%{transform:scale(1)} }
        .animate-zoom{ animation: zoomInOut 10s ease-in-out infinite; }
        .shadow-css{ box-shadow:0 10px 24px -10px #00000057; color:black; border-radius:5px; cursor:pointer; }
        .bg-hover-primary{ transition: background-color .5s ease-in-out, color .5s ease-in-out; }
        .bg-hover-primary:hover{ background-color:#113561bf !important; color:white; }
        .bg-hover-primary:hover h4{ color:white; }
        .event-card{ border-radius:12px; overflow:hidden; box-shadow:0 6px 16px rgba(0,0,0,.1); transition:transform .3s ease; }
        .event-card:hover{ transform: translateY(-6px); }
        .event-image{ height:200px; width:100%; object-fit:cover; }
    </style>

    {{-- Header --}}
    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100  animate-zoom" style="height: calc(100svh / 2);"  src="{{ asset($settings['event_registration_image'] ?? '') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            {{-- <h2 class="display-5 text-white animated zoomIn">Event Registration</h2> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Body --}}
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="registration-box">
                        <form method="POST" action="{{ route('event_registrations.store', request()->event_id) }}">
                            @csrf

                            {{-- Personal Info --}}
                            <h5 class="form-section-title">🧍 Personal Information</h5>
                            <div class="mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email Address *</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required>
                            </div>

                            {{-- Event Info --}}
                            <h5 class="form-section-title">📅 Event Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Select Event *</label>
                                <select class="form-select" name="event_id" required>
                                    <option value="" disabled {{ old('event_id', request()->event_id) ? '' : 'selected' }}>-- Choose an event --</option>
                                    @forelse($events as $ev)
                                        <option value="{{ $ev->id }}" @selected(old('event_id', request()->event_id)==$ev->id)>
                                            {{ $ev->title }} @if($ev->starts_at) — {{ $ev->starts_at->format('d M Y') }} @endif
                                        </option>
                                    @empty
                                        <option value="" disabled>No active events available</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ticket Type *</label>

                                @php
                                    // comes from controller: $ticketMap = ['student'=>100,'general'=>300,'vip'=>1000]
                                @endphp

                                @foreach($ticketMap as $key => $price)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ticket_type" id="tt_{{ $key }}"
                                           value="{{ $key }}" {{ old('ticket_type')===$key ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="tt_{{ $key }}">
                                        {{ ucfirst($key) }} (৳{{ number_format($price) }})
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            {{-- Payment Info --}}
                            <h5 class="form-section-title">💳 Payment Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Payment Method *</label>
                                <select class="form-select" name="payment_method" required>
                                    <option disabled {{ old('payment_method') ? '' : 'selected' }}>-- Select method --</option>
                                    @foreach($paymentMethods as $pm)
                                        <option value="{{ $pm }}" @selected(old('payment_method')===$pm)>{{ $pm }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Transaction ID *</label>
                                <input type="text" class="form-control" name="transaction_id" value="{{ old('transaction_id') }}" required>
                            </div>

                            {{-- Consent --}}
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="terms" name="consent" {{ old('consent') ? 'checked' : '' }} required>
                                <label class="form-check-label" for="terms">
                                    I agree to the
                                    <a href="#"
                                    role="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#termsModal"
                                    onclick="event.preventDefault(); event.stopPropagation();">
                                        Terms & Conditions
                                    </a>.
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-warning py-2">✅ Register Now</button>
                            </div>
                        </form>
                    </div><!-- /registration-box -->
                </div>
            </div>
        </div>
    </div>
    @php
            // ডাটাবেস/সেটিংস থেকে আসলে এগুলো কন্ট্রোলার থেকে পাঠাও।
            $termsTitle = $settings['terms_title'] ?? 'Event Terms & Conditions';
            $termsHtml  = $settings['terms_and_condition'] ?? '<p>Our terms & condition</p>';
        @endphp

        {{-- Terms & Conditions Modal --}}
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">{{ $termsTitle }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {!! $termsHtml !!} {{-- trusted HTML; না হলে {{ $termsText }} ব্যবহার করো --}}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                onclick="document.getElementById('terms').checked = true;">
                Agree & Continue
                </button>
            </div>
            </div>
        </div>
        </div>

</x-app-layout>
