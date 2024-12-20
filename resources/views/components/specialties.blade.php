<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Specialties</h2>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach (['Cosmetic', 'Vision', 'Dental', 'Hearing', 'Veterinary', 'General', 'Other'] as $sp)
                <a id="{{ $sp }}"
                    class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    {{-- <form action="{{ route('results') }}" method="POST"> --}}
                    {{-- @csrf --}}
                    {{-- <input type="checkbox" name="specialty" id="specialty" value="{{ $sp }}" hidden> --}}
                    {{-- <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $sp }}</span> --}}
                    {{ $sp }}
                    {{-- </form> --}}
                </a>
            @endforeach
        </div>
    </div>
</section>
<script>
    document.querySelectorAll('a').forEach(anchor => {
        anchor.addEventListener('click', function(event) {
            // Your event handling code here
            event.preventDefault(); // Prevent the default link behavior
            console.log(anchor)
            // Perform the POST request
            fetch('/search/results', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        // Your data here
                        specialty: anchor.text,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    });
</script>
