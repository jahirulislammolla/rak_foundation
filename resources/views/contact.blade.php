<x-app-layout>
<!-- Spinner Start -->
<style>
	@keyframes zoomInOut {
		0% {
			transform: scale(1);
		}

		50% {
			transform: scale(1.05);
		}

		100% {
			transform: scale(1);
		}
	}

	.animate-zoom {
		animation: zoomInOut 10s ease-in-out infinite;
	}

	.shadow-css{
		box-shadow: 0 10px 24px -10px #00000057;
		color: black;
		border-radius: 5px;
		cursor: pointer;
	}
	
	.bg-hover-primary {
		transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out; /* Adjust duration and easing as needed */
	}

	.bg-hover-primary:hover {
		background-color: #113561bf !important;
		color: white;
	}

	.bg-hover-primary:hover h4{
		color: white;
	}
	.bg-header {
		background-color: rgba(0, 149, 255, 0.389) !important;
		background: linear-gradient(rgba(9, 30, 62, .7), rgba(9, 30, 62, .7)), url("{{ asset($settings['contact_image']) ?? '' }}") center center no-repeat;
	}
</style>
{{-- <div class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
	id="spinner">
	<div class="spinner"></div>
</div> --}}
<!-- Spinner End -->
<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
	<div class="row py-5">
		<div class="col-12 pt-lg-5 mt-lg-5 text-center pl-lg-20">
			<h2 class="display-5 text-white animated zoomIn">Contact Us</h2>
		</div>
	</div>
</div>
<!-- Contact Start -->
<div class="container-fluid py-2 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container py-1">
		<div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
			<h5 class="fw-bold text-primary text-uppercase">Contact Us</h5>
		</div>
		<div class="row g-5 mb-5">
			<div class="col-lg-4">
				<div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
					<div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
						<i class="fa fa-phone-alt text-white"></i>
					</div>
					<div class="ps-4">
						<h5 class="mb-2">Call to ask any question</h5>
						<h4 class="text-primary mb-0">{{ $settings['contact_telephone'] ?? '' }}</h4>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
					<div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
						<i class="fa fa-envelope-open text-white"></i>
					</div>
					<div class="ps-4">
						<h5 class="mb-2">Email to get free quote</h5>
						<h4 class="text-primary mb-0">{{ $settings['contact_email'] ?? '' }}</h4>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
					<div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
						<i class="fa fa-map-marker-alt text-white"></i>
					</div>
					<div class="ps-4">
						<h5 class="mb-2">Visit our office</h5>
						<h4 class="text-primary mb-0">{{ $settings['contact_address'] ?? '' }}</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="row g-5">
			<div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
				<form action="{{ route('message.store') }}" method="POST">
                    @csrf
					<div class="row g-3">
						<div class="col-md-6">
							<input type="text" name="fullname" class="form-control border-0 bg-light px-4" placeholder="Your Name" style="height: 55px;">
						</div>
						<div class="col-md-6">
							<input type="email" name="email" class="form-control border-0 bg-light px-4" placeholder="Your Email" style="height: 55px;">
						</div>
						<div class="col-12">
							<input type="text" name="subject" class="form-control border-0 bg-light px-4" placeholder="Subject" style="height: 55px;">
						</div>
						<div class="col-12">
							<textarea name="message" class="form-control border-0 bg-light px-4 py-3" rows="4" placeholder="Message"></textarea>
						</div>
						<div class="col-12">
							<button class="btn btn-success w-100 py-3" type="submit">Send Message</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
				<iframe class="position-relative rounded w-100 h-100"
					src="{{ $settings['contact_location'] ?? '' }}"
					frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
					tabindex="0"></iframe>
			</div>
		</div>
	</div>
</div>
<!-- Contact End -->
<!-- About End -->
<!-- Team End -->
<!-- Vendor End -->
<!-- Footer Start -->
</x-app-layout>
