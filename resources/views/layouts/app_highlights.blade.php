<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <title> Dr. Md Saifuzzaman</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/background/icon.ico') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/app_update.css') }}" rel="stylesheet">
    <style>
        .active {
            color: rgb(6, 163, 220);
        }
        #footer{
            position: relative;
            background-image: url("{{ asset('assets/images/background/footer.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #1b334df0;
        }
        /* Add transition animation for navbar links */
        #nav-link a, #nav-content a {
            transition: background-color 0.5s ease, color 0.5s ease;
        }
        #nav-link a:hover, #nav-content a:hover {
            background-color: #ff6600ee; /* hover background color */
            color: white; /* hover text color */
        }
        /* Add transition animation for footer links */
        footer a {
            transition: color 0.5s ease;
        }
        footer a:hover {
            color: #FF6600; /* hover text color */
        }
    </style>
</head>
<body style='font-family: "Helvetica Neue", Arial, sans-serif;'>
    @include('components.header')
    {{-- =============================================== --}}
    {{ $slot }}
    {{-- =============================================== --}}
    {{-- <div class="scroll-to-top scroll-to-target" data-target="html" style="display: block;">
        <span class="icon fa fa-angle-double-up">
        </span>
    </div> --}}

<footer>
   <div class="bg-slate-900 py-3 px-4 w-full">
      <div class="container mx-auto text-white text-center">
         <p>
            <script>
               document.write(new Date().getFullYear())
               
            </script> © Md Saifuzzaman All Rights Reserved.
         </p>
      </div>
   </div>
</footer>
    <script>
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('#nav-link a');
        const navContents = document.querySelectorAll('#nav-content a');
        navLinks.forEach(link => {
            console.log(link.getAttribute('href'), currentPath);
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });

        navContents.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });

        // script.js
        window.addEventListener('scroll', function() {
            var header = document.querySelector('.slotholder');
            var scrollPosition = window.scrollY;
            header.style.top = (scrollPosition / 2) + 'px';  // Adjust the division value to control speed
        });

        document.getElementById('nav-toggle').onclick = function() {
            document.getElementById('nav-content').classList.toggle('hidden');
            const openIcon = document.getElementById('open-icon');
            const closeIcon = document.getElementById('close-icon');
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }

        // Get the header element
        const header = document.getElementById('header');

        const navLink = document.getElementById('nav-link');

        const anchorTags = navLink.querySelectorAll('a');

        // Function to add or remove the shadow class based on scroll position

    </script>
</body>
</html>
