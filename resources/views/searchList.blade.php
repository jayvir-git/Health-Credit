<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body>
    <x-navbar />
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Company Name</th>
                                <th scope="col" class="px-4 py-3">Specialty</th>
                                <th scope="col" class="px-4 py-3">Address</th>
                                <th scope="col" class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($providers as $provider)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $provider->name }}</th>
                                    <td class="px-4 py-3">{{ $provider->specialty }}</td>
                                    <td class="px-4 py-3">{{ $provider->address }}</td>
                                    <td class="px-4 py-3">
                                        <a href="/apply?providerId={{ $provider->id }}&userId={{ auth()->user()->id }}&providerName={{ $provider->name }}"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-1.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Apply</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @if ($providers != null)
        <gmp-map center="{{ $providers[0]->lattitude }},{{ $providers[0]->longitude }}" zoom="12"
            map-id="DEMO_MAP_ID" style="height: 500px">
            @foreach ($providers as $provider)
                <gmp-advanced-marker position="{{ $provider->lattitude }}, {{ $provider->longitude }}"
                    title="{{ $provider->name }}"></gmp-advanced-marker>
            @endforeach
        </gmp-map>
    @endif

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDBLbV6QV2-JjJv7E7Lg7UmtDf5egsFNE&libraries=maps&v=beta&libraries=marker"
        defer></script>
</body>
