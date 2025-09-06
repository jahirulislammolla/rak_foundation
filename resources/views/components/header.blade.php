    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="/" class="navbar-brand p-0">
                <h1 class="m-0">
                    <img src="{{ asset($settings['logo_image']) ?? '' }}" alt="Logo" style="width: 120px; height: auto; margin-right: 10px;">
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="/" class="nav-item nav-link active">Home</a>
                    <a href="/about" class="nav-item nav-link">About</a>
                    <a href="/events" class="nav-item nav-link">Event</a>
                    <a href="/galleries" class="nav-item nav-link">Gallery</a>
                    <div class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Resources</a>
                      <div class="dropdown-menu m-0">
                          <a class="dropdown-item" href="/focus-areas">Our Focus Area</a>
                          <a class="dropdown-item" href="/our-work">Our Work</a>
                          <a class="dropdown-item" href="/committees">Our Committee</a>
                          <a class="dropdown-item" href="/members">Our Member</a>
                      </div>
                  </div>
                    <a href="/membership" class="nav-link nav-item">Membership</a>
                    <a href="contact" class="nav-item nav-link">Contact</a>
                </div>
                <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
                <a href="/donate" class="btn btn-primary py-2 px-4 ms-3">DONATE</a>
            </div>
        </nav>
    </div>
    <!-- Navbar & Carousel End -->
    <!-- Add this script before the closing </body> tag or in a JS file -->
<script>
  // Wait until DOM is ready
  document.addEventListener("DOMContentLoaded", function () {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

    navLinks.forEach((link) => {
      // Remove any previously active
      link.classList.remove("active");

      // Match by pathname
      if (link.getAttribute("href") === currentPath) {
        link.classList.add("active");
      }

      // Optional: add special case for homepage
      if ((currentPath === "/" || currentPath === "") && link.getAttribute("href") === "") {
        link.classList.add("active");
      }
    });
  });
</script>
