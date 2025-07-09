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
	/* .bg-header {
		background-color: rgba(0, 149, 255, 0.389) !important;
		background: linear-gradient(rgba(9, 30, 62, .7), rgba(9, 30, 62, .7)), url('{{ asset('img/aboutus.png') }}') center center no-repeat;
	} */
</style>
{{-- <div class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
	id="spinner">
	<div class="spinner"></div>
</div> --}}
<!-- Spinner End -->
<div class="container-fluid position-relative p-0">
	<div class="carousel" data-bs-ride="carousel" id="header-carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img alt="Image" class="w-100 animate-zoom" height="420px" src="{{ asset('img/aboutus.png') }}" />
				<div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
					<div class="p-3" style="max-width: 900px;">
						<h2 class="display-5 text-white animated zoomIn">About Us</h2>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container py-5">
		<div class="row g-5" style="justify-content: center;">
			<div class="col-lg-6">
				<div class="section-title position-relative pb-3 mb-5">
					<h2 class="fw-bold text-primary text-uppercase">About Us</h5>
				</div>
				<p class="mb-4">RAK Foundation is a non-profit organization dedicated to uplifting underprivileged communities through impactful initiatives in education, healthcare, and charitable outreach. Our mission is to empower lives by providing access to quality learning, essential health services, and emergency relief for those in need.</p>
				<p class="mb-4">Founded on the belief that every human being deserves dignity, opportunity, and care — RAK Foundation works at the grassroots level to bring sustainable change where it matters most. From sponsoring children's education and distributing medical aid, to supporting families during crises, our programs are designed to foster hope, self-reliance, and community growth.</p>
				<p class="mb-4">With the support of generous donors, compassionate volunteers, and passionate partners, RAK Foundation continues to build a future where no one is left behind.</p>
				<a class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s" href="quote.html">DONATE US</a>
			</div>
			<div class="col-lg-5" style="min-height: 500px;">
				<div class="position-relative h-100">
					<img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s"
						src="{{ asset('img/about.jpg') }}" style="object-fit: cover;" />
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
