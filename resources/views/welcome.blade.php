<x-guest-layout>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="masthead">
                <div class="masthead-content">
                    <div class="container-fluid px-4 px-lg-0">
                        <h1 class="fst-italic lh-1 mb-4">Our Website is Coming Soon</h1>
                        <p class="mb-5">We're working hard to finish the development of this site. Sign up below to
                            receive updates and to be notified when we launch!</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>