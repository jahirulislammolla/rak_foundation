<x-app-layout>
    <x-public-hero
        badge="Donate"
        title="Support a cause with a cleaner, more trustworthy donation experience."
        subtitle="The public donation flow still writes directly into `donations`, but the page now feels like a serious campaign interface instead of a basic form."
        image="{{ $settings['donation_image'] ?? 'img/donation.png' }}"
        quote="Donation pages succeed when they remove hesitation and clarify purpose."
        primary-text="Contact for Partnership"
        primary-url="{{ url('/contact') }}"
        secondary-text="See Our Work"
        secondary-url="{{ route('works.index') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="surface-split">
                <div class="public-card copy-stack">
                    <div class="section-heading mb-0">
                        <span class="site-eyebrow">Support</span>
                        <h2>Fund a cause that the organization can act on.</h2>
                    </div>
                    <p class="mb-0">Causes in this form come from active `DonationCause` records. Submission creates a pending `Donation` entry for later admin review.</p>
                    <div class="site-grid grid-2">
                        <div class="public-card feature-card content-stack">
                            <h3>Clear Causes</h3>
                            <p class="mb-0">Supporters can quickly understand where funds are intended to go.</p>
                        </div>
                        <div class="public-card feature-card content-stack">
                            <h3>Pending Review</h3>
                            <p class="mb-0">Existing backend approval flow remains unchanged for admin verification.</p>
                        </div>
                    </div>
                </div>

                <div class="public-card">
                    @if(session('success'))
                        <div class="notice-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('donate.store') }}" class="site-form">
                        @csrf

                        <div class="row g-3">
                            <div class="col-12">
                                <label>Choose Donation Amount</label>
                                <div class="d-flex flex-wrap gap-2 mt-2 mb-2">
                                    @foreach([100, 500, 1000, 5000] as $preset)
                                        <button type="button" class="site-btn-outline border-0 amount-trigger" data-amount="{{ $preset }}">৳{{ $preset }}</button>
                                    @endforeach
                                </div>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amountInput" placeholder="Or enter a custom amount" value="{{ old('amount') }}">
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label for="donation_cause_id">Choose a Cause</label>
                                <select id="donation_cause_id" class="form-select @error('donation_cause_id') is-invalid @enderror" name="donation_cause_id">
                                    <option selected disabled>Select cause</option>
                                    @foreach($causes as $cause)
                                        <option value="{{ $cause->id }}" @selected(old('donation_cause_id') == $cause->id)>{{ $cause->name }}</option>
                                    @endforeach
                                </select>
                                @error('donation_cause_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="full_name">Full Name</label>
                                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}">
                                @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="phone">Phone Number</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                                @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="address">Address</label>
                                <textarea id="address" class="form-control" name="address">{{ old('address') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="note">Note</label>
                                <textarea id="note" class="form-control" name="note">{{ old('note') }}</textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="anon" name="is_anonymous" value="1" @checked(old('is_anonymous'))>
                                    <label class="form-check-label" for="anon">Donate anonymously</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label>Payment Method</label>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach(['bkash' => 'bKash', 'nagad' => 'Nagad', 'card' => 'Card', 'bank' => 'Bank Transfer'] as $key => $label)
                                        <label class="badge-soft">
                                            <input type="radio" class="form-check-input m-0" name="payment_method" value="{{ $key }}" @checked(old('payment_method') === $key)>
                                            <span>{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('payment_method') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <div class="public-card" id="summaryBox" hidden>
                                    <strong class="d-block mb-2">Donation Summary</strong>
                                    <div id="sumAmount">Amount: ৳0</div>
                                    <div id="sumCause">Cause: -</div>
                                    <div id="sumMethod">Payment Method: -</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="site-btn border-0" type="submit">Donate Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        (() => {
            const amountInput = document.getElementById('amountInput');
            const causeSelect = document.getElementById('donation_cause_id');
            const summaryBox = document.getElementById('summaryBox');
            const sumAmount = document.getElementById('sumAmount');
            const sumCause = document.getElementById('sumCause');
            const sumMethod = document.getElementById('sumMethod');
            const methodLabels = { bkash: 'bKash', nagad: 'Nagad', card: 'Card', bank: 'Bank Transfer' };

            document.querySelectorAll('.amount-trigger').forEach((button) => {
                button.addEventListener('click', () => {
                    amountInput.value = button.dataset.amount;
                    updateSummary();
                });
            });

            function updateSummary() {
                const amount = parseFloat(amountInput?.value ?? 0) || 0;
                const cause = causeSelect?.selectedOptions?.[0]?.text ?? '-';
                const methodCode = document.querySelector('input[name="payment_method"]:checked')?.value;
                const method = methodCode ? (methodLabels[methodCode] ?? methodCode) : '-';

                sumAmount.textContent = `Amount: ৳${amount}`;
                sumCause.textContent = `Cause: ${cause}`;
                sumMethod.textContent = `Payment Method: ${method}`;
                summaryBox.hidden = false;
            }

            amountInput?.addEventListener('input', updateSummary);
            causeSelect?.addEventListener('change', updateSummary);
            document.querySelectorAll('input[name="payment_method"]').forEach((radio) => {
                radio.addEventListener('change', updateSummary);
            });
        })();
    </script>
</x-app-layout>
