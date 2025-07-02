@php
$social = [
'linkedin.png' => 'https://www.linkedin.com/in/saifuzzaman-md/?originalSubdomain=ca',
'github.png'=> 'https://github.com/mdsaifuzzaman',
'research.png' => 'https://www.researchgate.net/profile/Md-Saifuzzaman-2',
'orcid.png' => 'https://orcid.org/0000-0001-8494-8971',
'scholar.png' => 'https://scholar.google.ca/citations?user=T8y1A4gAAAAJ&hl=en',
'skype.png' => '#',
'scopus.png' => '#',
];

@endphp
<style>
    /* Initial style for the image */
    #social img.w-10.h-10.sm\:w-12.sm\:h-12.lg\:h-14.lg\:w-14.rounded-lg {
        transition: transform 0.3s ease, background-color 0.3s ease, padding 0.3s ease; /* Add transition property */
    }

    /* Hover effect for the image */
    #social img.w-10.h-10.sm\:w-12.sm\:h-12.lg\:h-14.lg\:w-14.rounded-lg:hover {
        background-color: white; /* Change background color on hover */
        padding: 3px; /* Add padding on hover */
        transform: scale(.9); /* Slightly increase the size on hover */
    }
    </style>
</style>
<section id='social' class="mb-2 lg:mb-5">
    <div class="w-full hidden justify-start items-center gap-2 lg:gap-3 lg:flex fade-in">
        @foreach ($social as $key => $value)
        <a href="{{ $value }}" target="_blank" rel="noopener noreferrer">
            <img class="w-10 h-10 sm:w-12 sm:h-12 lg:h-14 lg:w-14 rounded-lg lg:mt-4 mx-auto lg:mx-0 hover:bg-white hover:p-2" src="{{ asset( 'assets/images/social/'. $key ) }}" alt="{{ $key }}">
        </a>
        @endforeach
    </div>
    <div class="w-full flex justify-start items-center gap-2 lg:gap-3 lg:hidden fade-in">
        @foreach ($social as $key => $value)
        @if ($key <= 3) <a href="{{ $value }}" target="_blank" rel="noopener noreferrer">
            <img class="w-14 h-14 sm:w-14 sm:h-14 lg:h-20 lg:w-20 rounded-lg lg:mt-4 mx-auto lg:mx-0 hover:bg-white hover:p-2" src="{{ asset( 'assets/images/social/'. $key ) }}" alt="{{ $key }}">
            </a>
            @endif
            @endforeach
    </div>
    <div class="w-full flex justify-start items-center gap-2 lg:gap-3 lg:hidden mt-3 fade-in">
        @foreach ($social as $key => $value)
        @if($key > 3)
        <a href="{{ $value }}" target="_blank" rel="noopener noreferrer">
            <img class="w-14 h-14 sm:w-14 sm:h-14 lg:h-20 lg:w-20 rounded-lg lg:mt-4 mx-auto lg:mx-0 hover:bg-white hover:p-2" src="{{ asset( 'assets/images/social/'. $key ) }}" alt="{{ $key }}">
        </a>
        @endif
        @endforeach
    </div>
</section>