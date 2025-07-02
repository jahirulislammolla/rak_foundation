<x-admin-layout>
<div class="py-2 flex justify-between align-center">
    <button type="button" class="px-4 py-1.5 rounded bg-sky-500 text-white" onclick="document.getElementById('formContainer').classList.remove('hidden')">
        Create Profile
    </button>
    <div class="text-left">
        <select name="type" id="type" class="p-2 border border-gray-300 rounded-lg mr-3">
            <option value="">All Types</option>
            <option value="1">Academic Profile</option>
            <option value="2">Research and Professional Profile</option>
        </select>
        <input type="text" 
        name="search_profile" 
        id="search_profile"
        value="{{ request()->input('search') ?? '' }}"
        class="px-4 py-1.5 rounded border border-slate-900 text-black"
        placeholder="search profile..."
        />
    </div>
</div>

<div class="py-1 px-3 flex justify-between align-center text-lg text-green-600">
    @if(Session::has('success'))
    <div class="alert alert-danger">
    {{ Session::get('success')}}
    </div>
    @endif
</div>

@include('admin.profile.form', [
    'profile' => new \App\Models\Profile(),
    
])

<div id="dataContainer" class="rounded-lg">

</div>

<script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    const searchInput = document.getElementById('search_profile');
    const searchType = document.getElementById('type');

    function search(page = 1) {
        document.getElementById('dataContainer').innerHTML = `
            <div class="flex justify-center items-center h-96 text-sky-600">
                <span class="text-xl md:text-4xl">Loading...</span>
            </div>
        `;

        let search = searchInput ? searchInput.value : '';
        let type = searchType ? searchType.value : '';
        setUrl(page, search, type);

        // Construct the URL with query parameters
        const url = new URL('/manage-profiles', window.location.origin);
        url.searchParams.append('page', page);
        if (search) url.searchParams.append('search', search);
        if (type) url.searchParams.append('type', type);

        // Use fetch API
        fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text(); // Parse response as plain text
            })
            .then(data => {
                document.getElementById('dataContainer').innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    search('{{ request()->input('page') ?? 1 }}');

    $("body").on("keyup", "#search_profile", function(){
        search({{ request()->input('page') ?? 1 }})
    });
    $("body").on("change", "#type", function(){
        search({{ request()->input('page') ?? 1 }})
    });

    function setUrl(page, search, type) {
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        url.searchParams.delete('search');
        url.searchParams.delete('type');
        if(search) {
            url.searchParams.set('search', search);
            url.searchParams.set('type', type);
        }
        console.log(url.href);
        window.history.pushState({}, '', url.href);
    }

    $('input[name="profile_type"]').on('change', function(){
        const inputValue = $(this).val();
        const batchDiv = document.getElementById('batchDiv');
        const branchDiv = document.getElementById('branchDiv');

        if (inputValue == 1) {
                batchDiv.classList.remove('hidden');
                branchDiv.classList.add('hidden');
            } else {
                batchDiv.classList.add('hidden');
                branchDiv.classList.remove('hidden');
            }
    })

});
</script>
</x-admin-layout>