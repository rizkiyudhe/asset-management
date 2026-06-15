{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asset Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        {{-- Mobile sidebar backdrop --}}
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
            @click="sidebarOpen = false"></div>

        {{-- Sidebar Component --}}
        @include('layouts.navigation')

        {{-- Main Content Area --}}
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">

            {{-- Top Navbar --}}
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b shadow-sm">
                <div class="flex items-center">
                    {{-- Hamburger Menu Toggle for Mobile --}}
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h2 class="ml-4 text-xl font-semibold text-gray-800">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                </div>

                {{-- User Profile Dropdown --}}
                <div class="flex items-center">
                    <span class="mr-3 text-sm font-medium text-gray-600">{{ auth()->user()->name ?? 'User' }}</span>
                </div>
            </header>

            {{-- Main Content --}}
            <main class="w-full p-6 mx-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
