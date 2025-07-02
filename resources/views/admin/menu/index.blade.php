<x-admin-layout>
<div class="py-2 flex justify-between align-center">
    <button type="button" class="px-4 py-1.5 rounded bg-sky-500 text-white" onclick="document.getElementById('formContainer').classList.remove('hidden')">
        Create Publication
    </button>
    <div class="text-left">
        <input type="text" 
        name="search_publication" 
        id="search_publication"
        value="{{ request()->input('search') ?? '' }}"
        class="px-4 py-1.5 rounded border border-slate-900 text-black"
        placeholder="search publication..."
        />
    </div>
</div>

@include('admin.publication.form', [
    'publication' => new \App\Models\Publication(),
    
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

    const searchInput = document.getElementById('search_publication');

    function search(page = 1) {
    document.getElementById('dataContainer').innerHTML = `
        <div class="flex justify-center items-center h-96 text-sky-600">
            <span class="text-xl md:text-4xl">Loading...</span>
        </div>
    `;
    let search = searchInput ? searchInput.value : '';
    setUrl(page, search);

    const params = new URLSearchParams({ page, search });

    fetch(`/manage-publications?${params.toString()}`, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text(); // Assumes the response is HTML
        })
        .then(data => {
            document.getElementById('dataContainer').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


    search('{{ request()->input('page') ?? 1 }}');

    $("body").on("keyup", "#search_publication", function(){
        search({{ request()->input('page') ?? 1 }})
    });

    function setUrl(page, search) {
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        url.searchParams.delete('search');
        if(search) {
            url.searchParams.set('search', search);
        }
        console.log(url.href);
        window.history.pushState({}, '', url.href);
    }

    $('input[name="publication_type"]').on('change', function(){
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