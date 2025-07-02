@extends('layouts.app')
@section('content')

<!-- Spinner Start -->
<div class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center" id="spinner">
<div class="spinner"></div>
</div>
<!-- Spinner End -->
<!-- Topbar Start -->
<div class="container-fluid bg-dark px-5 d-none d-lg-block">
<div class="row gx-0">
<div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
<div class="d-inline-flex align-items-center" style="height: 45px;">
<small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</small>
<small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>+012 345 6789</small>
<small class="text-light"><i class="fa fa-envelope-open me-2"></i>info@example.com</small>
</div>
</div>
<div class="col-lg-4 text-center text-lg-end">
<div class="d-inline-flex align-items-center" style="height: 45px;">
<a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal"></i></a>
<a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
<a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
<a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
<a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-youtube fw-normal"></i></a>
</div>
</div>
</div>
</div>
<!-- Topbar End -->
<!-- Navbar Start -->
<div class="container-fluid position-relative p-0">
<nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
<a class="navbar-brand p-0" href="index.html">
<h1 class="m-0"><i class="fa fa-user-tie me-2"></i>Startup</h1>
</a>
<button class="navbar-toggler" data-bs-target="#navbarCollapse" data-bs-toggle="collapse" type="button">
<span class="fa fa-bars"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
<div class="navbar-nav ms-auto py-0">
<a class="nav-item nav-link" href="index.html">Home</a>
<a class="nav-item nav-link" href="about.html">About</a>
<a class="nav-item nav-link" href="service.html">Services</a>
<div class="nav-item dropdown">
<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Blog</a>
<div class="dropdown-menu m-0">
<a class="dropdown-item" href="blog.html">Blog Grid</a>
<a class="dropdown-item" href="detail.html">Blog Detail</a>
</div>
</div>
<div class="nav-item dropdown">
<a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown" href="#">Pages</a>
<div class="dropdown-menu m-0">
<a class="dropdown-item active" href="price.html">Pricing Plan</a>
<a class="dropdown-item" href="feature.html">Our features</a>
<a class="dropdown-item" href="team.html">Team Members</a>
<a class="dropdown-item" href="testimonial.html">Testimonial</a>
<a class="dropdown-item" href="quote.html">Free Quote</a>
</div>
</div>
<a class="nav-item nav-link" href="contact.html">Contact</a>
</div>
<butaton class="btn text-primary ms-3" data-bs-target="#searchModal" data-bs-toggle="modal" type="button"><i class="fa fa-search"></i></butaton>
<a class="btn btn-primary py-2 px-4 ms-3" href="https://htmlcodex.com/startup-company-website-template">Download Pro Version</a>
</div>
</nav>
<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
<div class="row py-5">
<div class="col-12 pt-lg-5 mt-lg-5 text-center">
<h1 class="display-4 text-white animated zoomIn">Prices</h1>
<a class="h5 text-white" href="">Home</a>
<i class="far fa-circle text-white px-2"></i>
<a class="h5 text-white" href="">Prices</a>
</div>
</div>
</div>
</div>
<!-- Navbar End -->
<!-- Full Screen Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1">
<div class="modal-dialog modal-fullscreen">
<div class="modal-content" style="background: rgba(9, 30, 62, .7);">
<div class="modal-header border-0">
<button aria-label="Close" class="btn bg-white btn-close" data-bs-dismiss="modal" type="button"></button>
</div>
<div class="modal-body d-flex align-items-center justify-content-center">
<div class="input-group" style="max-width: 600px;">
<input class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword" type="text"/>
<button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
</div>
</div>
</div>
</div>
</div>
<!-- Full Screen Search End -->
<!-- Pricing Plan Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
<div class="container py-5">
<div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
<h5 class="fw-bold text-primary text-uppercase">Pricing Plans</h5>
<h1 class="mb-0">We are Offering Competitive Prices for Our Clients</h1>
</div>
<div class="row g-0">
<div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
<div class="bg-light rounded">
<div class="border-bottom py-4 px-5 mb-4">
<h4 class="text-primary mb-1">Basic Plan</h4>
<small class="text-uppercase">For Small Size Business</small>
</div>
<div class="p-5 pt-0">
<h1 class="display-5 mb-3">
<small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>49.00<small class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
</h1>
<div class="d-flex justify-content-between mb-3"><span>HTML5 &amp; CSS3</span><i class="fa fa-check text-primary pt-1"></i></div>
<div class="d-flex justify-content-between mb-3"><span>Bootstrap v5</span><i class="fa fa-check text-primary pt-1"></i></div>
<div class="d-flex justify-content-between mb-3"><span>Responsive Layout</span><i class="fa fa-times text-danger pt-1"></i></div>
<div class="d-flex justify-content-between mb-2"><span>Cross-browser Support</span><i class="fa fa-times text-danger pt-1"></i></div>
<a class="btn btn-primary py-2 px-4 mt-4" href="">Order Now</a>
</div>
</div>
</div>
<div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
<div class="bg-white rounded shadow position-relative" style="z-index: 1;">
<div class="border-bottom py-4 px-5 mb-4">
<h4 class="text-primary mb-1">Standard Plan</h4>
<small class="text-uppercase">For Medium Size Business</small>
</div>
<div class="p-5 pt-0">
<h1 class="display-5 mb-3">
<small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>99.00<small class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
</h1>
<div class="d-flex justify-content-between mb-3"><span>HTML5 &amp; CSS3</span><i class="fa fa-check text-primary pt-1"></i></div>
<div class="d-flex justify-content-between mb-3"><span>Bootstrap v5</span><i class="fa fa-check text-primary pt-1"></i></div>
<div class="d-flex justify-content-between mb-3"><span>Responsive Layout</span><i class="fa fa-check text-primary pt-1"></i></div>
<div class="d-flex justify-content-between mb-2"><span>Cross-browser Support</span><i class="fa fa-times text-danger pt-1"></i></div>
<a class="btn btn-primary py-2 px-4 mt-4" href="">Order Now</a>
</div>
</div>
</div>
<div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
<div class="bg-light rounded">
<div class="border-bottom py-4 px-5 mb-4">
<h4 class="text-primary mb-1">Advanced Plan</h4>
<small class="text-uppercase">For Large Size Business</small>
</div>
<div class="p-5 pt-0">
<h1 class="display-5 mb-3">
<small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>149.00<small class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
</h1>
<div class="d-flex justify-content-between mb-3"><span>HTML5 &amp; CSS3</span><i class="fa fa-check text-primary pt-1"></i></div>
<div class="d-flex justify-content-between mb-3"><span>Bootstrap v5</span><i class="fa fa-check text-primary pt-1"></i></div>
<div class="d-flex justify-content-between mb-3"><span>Responsive Layout</span><i class="fa fa-check text-primary pt-1"></i></div>
<div class="d-flex justify-content-between mb-2"><span>Cross-browser Support</span><i class="fa fa-check text-primary pt-1"></i></div>
<a class="btn btn-primary py-2 px-4 mt-4" href="">Order Now</a>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Pricing Plan End -->
<!-- Quote Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
<div class="container py-5">
<div class="row g-5">
<div class="col-lg-7">
<div class="section-title position-relative pb-3 mb-5">
<h5 class="fw-bold text-primary text-uppercase">Request A Quote</h5>
<h1 class="mb-0">Need A Free Quote? Please Feel Free to Contact Us</h1>
</div>
<div class="row gx-3">
<div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
<h5 class="mb-4"><i class="fa fa-reply text-primary me-3"></i>Reply within 24 hours</h5>
</div>
<div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
<h5 class="mb-4"><i class="fa fa-phone-alt text-primary me-3"></i>24 hrs telephone support</h5>
</div>
</div>
<p class="mb-4">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
<div class="d-flex align-items-center mt-2 wow zoomIn" data-wow-delay="0.6s">
<div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
<i class="fa fa-phone-alt text-white"></i>
</div>
<div class="ps-4">
<h5 class="mb-2">Call to ask any question</h5>
<h4 class="text-primary mb-0">+012 345 6789</h4>
</div>
</div>
</div>
<div class="col-lg-5">
<div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn" data-wow-delay="0.9s">
<form>
<div class="row g-3">
<div class="col-xl-12">
<input class="form-control bg-light border-0" placeholder="Your Name" style="height: 55px;" type="text"/>
</div>
<div class="col-12">
<input class="form-control bg-light border-0" placeholder="Your Email" style="height: 55px;" type="email"/>
</div>
<div class="col-12">
<select class="form-select bg-light border-0" style="height: 55px;">
<option selected="">Select A Service</option>
<option value="1">Service 1</option>
<option value="2">Service 2</option>
<option value="3">Service 3</option>
</select>
</div>
<div class="col-12">
<textarea class="form-control bg-light border-0" placeholder="Message" rows="3"></textarea>
</div>
<div class="col-12">
<button class="btn btn-dark w-100 py-3" type="submit">Request A Quote</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<!-- Quote End -->
<!-- Vendor Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
<div class="container py-5 mb-5">
<div class="bg-white">
<div class="owl-carousel vendor-carousel">
<img alt="" src="{{ asset('img/vendor-1.jpg') }}"/>
<img alt="" src="{{ asset('img/vendor-2.jpg') }}"/>
<img alt="" src="{{ asset('img/vendor-3.jpg') }}"/>
<img alt="" src="{{ asset('img/vendor-4.jpg') }}"/>
<img alt="" src="{{ asset('img/vendor-5.jpg') }}"/>
<img alt="" src="{{ asset('img/vendor-6.jpg') }}"/>
<img alt="" src="{{ asset('img/vendor-7.jpg') }}"/>
<img alt="" src="{{ asset('img/vendor-8.jpg') }}"/>
<img alt="" src="{{ asset('img/vendor-9.jpg') }}"/>
</div>
</div>
</div>
</div>
<!-- Vendor End -->
<!-- Footer Start -->
<div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
<div class="container">
<div class="row gx-5">
<div class="col-lg-4 col-md-6 footer-about">
<div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
<a class="navbar-brand" href="index.html">
<h1 class="m-0 text-white"><i class="fa fa-user-tie me-2"></i>Startup</h1>
</a>
<p class="mt-3 mb-4">Lorem diam sit erat dolor elitr et, diam lorem justo amet clita stet eos sit. Elitr dolor duo lorem, elitr clita ipsum sea. Diam amet erat lorem stet eos. Diam amet et kasd eos duo.</p>
<form action="">
<div class="input-group">
<input class="form-control border-white p-3" placeholder="Your Email" type="text"/>
<button class="btn btn-dark">Sign Up</button>
</div>
</form>
</div>
</div>
<div class="col-lg-8 col-md-6">
<div class="row gx-5">
<div class="col-lg-4 col-md-12 pt-5 mb-5">
<div class="section-title section-title-sm position-relative pb-3 mb-4">
<h3 class="text-light mb-0">Get In Touch</h3>
</div>
<div class="d-flex mb-2">
<i class="bi bi-geo-alt text-primary me-2"></i>
<p class="mb-0">123 Street, New York, USA</p>
</div>
<div class="d-flex mb-2">
<i class="bi bi-envelope-open text-primary me-2"></i>
<p class="mb-0">info@example.com</p>
</div>
<div class="d-flex mb-2">
<i class="bi bi-telephone text-primary me-2"></i>
<p class="mb-0">+012 345 67890</p>
</div>
<div class="d-flex mt-4">
<a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
<a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
<a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
<a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram fw-normal"></i></a>
</div>
</div>
<div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
<div class="section-title section-title-sm position-relative pb-3 mb-4">
<h3 class="text-light mb-0">Quick Links</h3>
</div>
<div class="link-animated d-flex flex-column justify-content-start">
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The Team</a>
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
<a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
</div>
</div>
<div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
<div class="section-title section-title-sm position-relative pb-3 mb-4">
<h3 class="text-light mb-0">Popular Links</h3>
</div>
<div class="link-animated d-flex flex-column justify-content-start">
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The Team</a>
<a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
<a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="container-fluid text-white" style="background: #061429;">
<div class="container text-center">
<div class="row justify-content-end">
<div class="col-lg-8 col-md-6">
<div class="d-flex align-items-center justify-content-center" style="height: 75px;">
<p class="mb-0">© <a class="text-white border-bottom" href="#">Your Site Name</a>. All Rights Reserved. 
						
						<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
						Designed by <a class="text-white border-bottom" href="https://htmlcodex.com">HTML Codex</a></p>
</div>
</div>
</div>
</div>
</div>
<!-- Footer End -->
<!-- Back to Top -->
<a class="btn btn-lg btn-primary btn-lg-square rounded back-to-top" href="#"><i class="bi bi-arrow-up"></i></a>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>

@endsection