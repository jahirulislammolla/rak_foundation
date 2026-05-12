<x-app-layout>
    <x-public-hero
        badge="Contact"
        title="Start a conversation with the team behind the programs."
        subtitle="Questions, partnerships, volunteer interest, sponsorship conversations, and field coordination requests all start here."
        image="{{ $settings['contact_image'] ?? 'img/contact.jpg' }}"
        quote="Clear communication is one of the strongest trust signals any social organization can offer."
        primary-text="Send Message"
        primary-url="#contact-form"
        secondary-text="Donate"
        secondary-url="{{ route('donate.form') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="site-grid grid-3 mb-4">
                <div class="public-card content-stack">
                    <span class="badge-soft"><i class="bi bi-telephone"></i> Phone</span>
                    <h3 class="mb-0">{{ $settings['contact_telephone'] ?? 'Not set' }}</h3>
                    <p class="mb-0">Call for urgent questions, coordination, or follow-up.</p>
                </div>
                <div class="public-card content-stack">
                    <span class="badge-soft"><i class="bi bi-envelope"></i> Email</span>
                    <h3 class="mb-0">{{ $settings['contact_email'] ?? 'Not set' }}</h3>
                    <p class="mb-0">Use email for partnership proposals and formal communication.</p>
                </div>
                <div class="public-card content-stack">
                    <span class="badge-soft"><i class="bi bi-geo-alt"></i> Address</span>
                    <h3 class="mb-0">Visit or write to us</h3>
                    <p class="mb-0">{{ $settings['contact_address'] ?? 'Address not set' }}</p>
                </div>
            </div>

            <div class="surface-split">
                <div class="public-card">
                    @if(session('success'))
                        <div class="notice-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="notice-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="section-heading">
                        <span class="site-eyebrow">Message Form</span>
                        <h2 id="contact-form">Tell us what you need.</h2>
                        <p>We kept the existing `POST /messages` flow and validation fields intact, but moved it into a more polished contact experience.</p>
                    </div>

                    <form action="{{ route('message.store') }}" method="POST" class="site-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fullname">Your Name</label>
                                <input id="fullname" type="text" name="fullname" value="{{ old('fullname') }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Your Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label for="subject">Subject</label>
                                <input id="subject" type="text" name="subject" value="{{ old('subject') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" class="form-control" required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12">
                                <button class="site-btn border-0" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="public-card p-0 overflow-hidden">
                    @if(!empty($settings['contact_location']))
                        <iframe
                            class="w-100 h-100"
                            src="{{ $settings['contact_location'] }}"
                            frameborder="0"
                            style="min-height: 520px; border: 0;"
                            allowfullscreen
                            loading="lazy"></iframe>
                    @else
                        <div class="p-5 copy-stack">
                            <h3>Location map not configured.</h3>
                            <p class="mb-0">Set `contact_location` in settings to render the embedded map on this page.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
