<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Specialties</h2>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach (['Cosmetic', 'Vision', 'Dental', 'Hearing', 'Veterinary', 'General', 'Other'] as $sp)
                <a
                    class="specialty flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    {{ $sp }}
                </a>
            @endforeach
        </div>
    </div>
</section>
<script>
    document.querySelectorAll('.specialty').forEach(anchor => {
        anchor.addEventListener('click', function(event) {
            event.preventDefault();

            // Create a form dynamically
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/search/results';

            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]')?.content;
            form.appendChild(csrfInput);

            // Add specialty data
            // const specialtyInput = document.createElement('input');
            // specialtyInput.type = 'hidden';
            // specialtyInput.name = 'specialty';
            // specialtyInput.value = anchor.innerText;
            // form.appendChild(specialtyInput);
            const specialties = [anchor.innerText]; // Convert to an array if needed
            specialties.forEach(specialty => {
                const specialtyInput = document.createElement('input');
                specialtyInput.type = 'hidden';
                specialtyInput.name = 'specialty[]'; // Use the `[]` notation
                specialtyInput.value = specialty;
                form.appendChild(specialtyInput);
            });

            // Submit form
            document.body.appendChild(form);
            form.submit();
        });
    });
</script>
