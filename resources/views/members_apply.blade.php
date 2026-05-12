<x-app-layout>
    <x-public-hero
        badge="Apply"
        title="Submit your membership application."
        subtitle="We kept the existing public membership flow and validation exactly as-is, then rebuilt the page for clarity, credibility, and easier completion."
        image="img/join_membership.png"
        quote="Good membership experiences reduce friction without lowering standards."
        primary-text="See Members"
        primary-url="{{ route('members.index') }}"
        secondary-text="Back to Membership"
        secondary-url="{{ url('/membership') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="surface-split">
                <div class="public-card copy-stack">
                    <div class="section-heading mb-0">
                        <span class="site-eyebrow">Before You Apply</span>
                        <h2>Share enough information for a credible review.</h2>
                    </div>
                    <p class="mb-0">Application data writes directly to the `members` table through `PublicMembershipController::store`, with photo upload to `public/member`. That means the UI should be clear, but the backend contract stays unchanged.</p>
                    <div class="site-grid grid-2">
                        <div class="public-card feature-card content-stack">
                            <h3>Yearly Membership</h3>
                            <p class="mb-0">For recurring annual participation and engagement.</p>
                        </div>
                        <div class="public-card feature-card content-stack">
                            <h3>Lifetime Membership</h3>
                            <p class="mb-0">For long-term commitment and stronger institutional support.</p>
                        </div>
                    </div>
                </div>

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

                    <form method="POST" action="{{ route('member.apply.store') }}" enctype="multipart/form-data" class="site-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name">Full Name *</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Phone</label>
                                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="profession">Profession</label>
                                <input id="profession" type="text" name="profession" value="{{ old('profession') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="address">Address</label>
                                <textarea id="address" name="address" rows="3" class="form-control">{{ old('address') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="d-block">Membership Type *</label>
                                <div class="d-flex flex-column gap-2 pt-2">
                                    <label class="badge-soft justify-content-start">
                                        <input class="form-check-input m-0" type="radio" name="membership_type" value="yearly" {{ old('membership_type', 'yearly') === 'yearly' ? 'checked' : '' }}>
                                        <span>Yearly Membership</span>
                                    </label>
                                    <label class="badge-soft justify-content-start">
                                        <input class="form-check-input m-0" type="radio" name="membership_type" value="lifetime" {{ old('membership_type') === 'lifetime' ? 'checked' : '' }}>
                                        <span>Lifetime Membership</span>
                                    </label>
                                </div>
                                <small class="text-muted d-block mt-2">The fee is enforced server-side after submission.</small>
                            </div>
                            <div class="col-md-6">
                                <label for="photo">Photo</label>
                                <input id="photo" type="file" name="photo" accept="image/*" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="note">Why do you want to join?</label>
                                <textarea id="note" name="note" rows="4" class="form-control">{{ old('note') }}</textarea>
                            </div>
                            <div class="col-12 d-flex flex-wrap gap-3 pt-2">
                                <button class="site-btn border-0" type="submit">Submit Application</button>
                                <a href="{{ url('/membership') }}" class="site-btn-outline">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
