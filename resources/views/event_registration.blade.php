<x-app-layout>
    <x-public-hero
        badge="Registration"
        title="Reserve your place with a cleaner event registration flow."
        subtitle="Validation rules, ticket pricing logic, and `EventRegistration::create` remain unchanged. This update improves only the public experience."
        image="{{ $settings['event_registration_image'] ?? 'img/event_registration.png' }}"
        quote="Public registration should communicate confidence before it asks for payment details."
        primary-text="See Events"
        primary-url="{{ url('/events') }}"
        secondary-text="Contact Team"
        secondary-url="{{ url('/contact') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="surface-split">
                <div class="public-card copy-stack">
                    <div class="section-heading mb-0">
                        <span class="site-eyebrow">How It Works</span>
                        <h2>Choose an event, select ticket type, submit payment reference.</h2>
                    </div>
                    <p class="mb-0">Available events come from the same `published()->upcoming()` flow used elsewhere. Ticket amounts are still assigned server-side from the controller map.</p>
                    <div class="site-grid grid-3">
                        @foreach($ticketMap as $ticket => $price)
                            <div class="public-card timeline-card content-stack">
                                <h3>{{ ucfirst($ticket) }}</h3>
                                <p class="mb-0">৳{{ number_format($price) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="public-card">
                    @if(session('success'))
                        <div class="notice-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="notice-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('event_registrations.store') }}" class="site-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="full_name">Full Name *</label>
                                <input id="full_name" type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email Address *</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Phone Number *</label>
                                <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-12">
                                <label for="event_id">Select Event *</label>
                                <select id="event_id" class="form-select" name="event_id" required>
                                    <option value="" disabled {{ old('event_id', $prefillEvent) ? '' : 'selected' }}>Choose an event</option>
                                    @forelse($events as $event)
                                        <option value="{{ $event->id }}" @selected(old('event_id', $prefillEvent) == $event->id)>
                                            {{ $event->title }} - {{ optional($event->start_at)->format('d M Y') }}
                                        </option>
                                    @empty
                                        <option value="" disabled>No active events available</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="d-block">Ticket Type *</label>
                                <div class="d-flex flex-column gap-2 mt-2">
                                    @foreach($ticketMap as $key => $price)
                                        <label class="badge-soft justify-content-start">
                                            <input class="form-check-input m-0" type="radio" name="ticket_type" value="{{ $key }}" {{ old('ticket_type') === $key ? 'checked' : '' }} required>
                                            <span>{{ ucfirst($key) }} (৳{{ number_format($price) }})</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="payment_method">Payment Method *</label>
                                <select id="payment_method" class="form-select" name="payment_method" required>
                                    <option disabled {{ old('payment_method') ? '' : 'selected' }}>Select method</option>
                                    @foreach($paymentMethods as $method)
                                        <option value="{{ $method }}" @selected(old('payment_method') === $method)>{{ $method }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="transaction_id">Transaction ID *</label>
                                <input id="transaction_id" type="text" class="form-control" name="transaction_id" value="{{ old('transaction_id') }}" required>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" name="consent" {{ old('consent') ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal" onclick="event.preventDefault();">Terms & Conditions</a>.
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="site-btn border-0">Register Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @php
        $termsTitle = $settings['terms_title'] ?? 'Event Terms & Conditions';
        $termsHtml = $settings['terms_and_condition'] ?? '<p>Terms and conditions will be published here.</p>';
    @endphp

    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">{{ $termsTitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rich-copy">
                    {!! $termsHtml !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="site-btn-outline border-0" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="site-btn border-0" data-bs-dismiss="modal" onclick="document.getElementById('terms').checked = true;">Agree & Continue</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
