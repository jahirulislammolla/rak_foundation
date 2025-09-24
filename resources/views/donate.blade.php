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

        .section_color {
            background-color: #e9efff9e !important;
        }

        /* .bg-header {
		background-color: rgba(0, 149, 255, 0.389) !important;
		background: linear-gradient(rgba(9, 30, 62, .7), rgba(9, 30, 62, .7)), url('{{ asset('img/aboutus.png') }}') center center no-repeat;
	} */

    </style>

    <!-- Spinner End -->
    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100 animate-zoom" height="420px" src="{{ asset( $settings['donation_image'] ?? '') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">Support Our Foundation</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container my-5">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('donate.store') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-8 donation-box">

                        <h4 class="mb-4">Choose Donation Amount</h4>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @foreach([100,500,1000,5000] as $preset)
                            <button type="button" class="btn btn-outline-primary amount-btn bg-hover-primary" data-amount="{{ $preset }}">৳{{ $preset }}</button>
                            @endforeach
                        </div>
                        <input type="number" class="form-control mb-4 @error('amount') is-invalid @enderror" name="amount" id="amountInput" placeholder="Or enter custom amount" value="{{ old('amount') }}">
                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <h5>Choose a Cause</h5>
                        <select class="form-select mb-4 @error('donation_cause_id') is-invalid @enderror" name="donation_cause_id">
                            <option selected disabled>Select Cause</option>
                            @foreach($causes as $cause)
                            <option value="{{ $cause->id }}" @selected(old('donation_cause_id')==$cause->id)>{{ $cause->name }}</option>
                            @endforeach
                        </select>
                        @error('donation_cause_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                        <h5>Your Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}">
                                @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <input type="text" class="form-control mb-3 @error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                        @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                        <textarea class="form-control mb-3" rows="2" name="address" placeholder="Address (optional)">{{ old('address') }}</textarea>
                        <textarea class="form-control mb-3" rows="2" name="note" placeholder="Note (optional)">{{ old('note') }}</textarea>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="anon" name="is_anonymous" value="1" @checked(old('is_anonymous'))>
                            <label class="form-check-label" for="anon">Donate anonymously</label>
                        </div>

                        <h5>Select Payment Method</h5>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @foreach([ 'bkash'=>'bKash','nagad'=>'Nagad','card'=>'Card','bank'=>'Bank Transfer' ] as $key=>$label)
                            <label class="btn btn-outline-dark">
                                <input type="radio" class="me-2" name="payment_method" value="{{ $key }}" @checked(old('payment_method')===$key)> {{ $label }}
                            </label>
                            @endforeach
                        </div>
                        @error('payment_method') <div class="text-danger mb-3">{{ $message }}</div> @enderror

                        {{-- Summary (client side preview) --}}
                        <div class="donate-summary mb-4" id="summaryBox" hidden>
                            <strong>Summary:</strong><br>
                            <span id="sumAmount">Amount: ৳0</span><br>
                            <span id="sumCause">Cause: -</span><br>
                            <span id="sumMethod">Payment Method: -</span>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-success py-2 px-4 fs-5" style="background-color: #18b90f; border-radius: 4px; border:1px solid #f8f9fa;">Donate Now</button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Why donate section: তোমার আগের ব্লকই থাকুক --}}
        </div>
    </div>

    {{-- Tiny JS for quick-amount + summary --}}
    <script>
(() => {
  const amountInput = document.getElementById('amountInput');
  document.querySelectorAll('[data-amount]').forEach(btn => {
    btn.addEventListener('click', () => {
      amountInput.value = btn.dataset.amount;
      updateSummary();
    });
  });

  const causeSelect = document.querySelector('select[name="donation_cause_id"]');
  const methodRadios = document.querySelectorAll('input[name="payment_method"]');
  const summaryBox = document.getElementById('summaryBox');
  const sumAmount = document.getElementById('sumAmount');
  const sumCause = document.getElementById('sumCause');
  const sumMethod = document.getElementById('sumMethod');

  // লেবেল ম্যাপ (আরও নির্ভরযোগ্য)
  const methodLabels = { bkash: 'bKash', nagad: 'Nagad', card: 'Card', bank: 'Bank Transfer' };

  function updateSummary() {
    const amt = parseFloat(amountInput?.value ?? 0) || 0;

    const selectedOption = causeSelect?.selectedOptions?.[0];
    const causeText = selectedOption?.text ?? '-';

    const methodCode = document.querySelector('input[name="payment_method"]:checked')?.value;
    const method = methodCode ? (methodLabels[methodCode] ?? methodCode) : '-';

    sumAmount.textContent = `Amount: ৳${amt}`;
    sumCause.textContent = `Cause: ${causeText}`;
    sumMethod.textContent = `Payment Method: ${method}`;
    summaryBox.hidden = false;
  }

  amountInput?.addEventListener('input', updateSummary);
  causeSelect?.addEventListener('change', updateSummary);
  methodRadios.forEach(r => r.addEventListener('change', updateSummary));
})();
</script>

</x-app-layout>
