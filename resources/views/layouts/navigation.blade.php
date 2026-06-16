{{-- resources/views/layouts/navigation.blade.php --}}
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="absolute inset-y-0 left-0 z-30 w-64 px-4 overflow-y-auto transition duration-300 transform bg-blue-900 lg:static lg:translate-x-0 lg:inset-0 shadow-lg">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <span class="text-2xl font-bold text-white tracking-wider">AssetSys</span>
        </div>
    </div>

    <nav class="mt-10 pb-10">
        {{-- Menu Global --}}
        <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('dashboard') ? 'bg-blue-800 text-gray-100' : 'text-gray-300 hover:bg-blue-800 hover:text-gray-100' }} transition-colors duration-200 transform rounded-md"
            href="{{ route('dashboard') }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="mx-4 text-sm font-medium">Dashboard</span>
        </a>

        {{-- Logika Penentuan Menu Berdasarkan Role --}}
        @php
            $role = auth()->user()->role->name ?? '';
        @endphp

        {{-- Menu Admin & Staff Asset --}}
        @if (in_array($role, ['admin', 'staff_asset']))
            <h3 class="px-6 mt-8 text-xs font-semibold text-blue-400 uppercase tracking-wider">Manajemen Aset</h3>

            <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('assets.*') ? 'bg-blue-800 text-gray-100' : 'text-gray-300 hover:bg-blue-800 hover:text-gray-100' }} transition-colors duration-200 transform rounded-md"
                href="{{ route('assets.index') }}">
                {{-- Heroicon: Cube --}}
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span class="mx-4 text-sm font-medium">Data Asset</span>
            </a>

            <h3 class="px-6 mt-8 text-xs font-semibold text-blue-400 uppercase tracking-wider">Log Operasional</h3>

            <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('maintenances.*') ? 'bg-blue-800 text-gray-100' : 'text-gray-300 hover:bg-blue-800 hover:text-gray-100' }} transition-colors duration-200 transform rounded-md"
                href="{{ route('maintenances.index') }}">
                {{-- Heroicon: Wrench --}}
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="mx-4 text-sm font-medium">Pemeliharaan</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('transfers.*') ? 'bg-blue-800 text-gray-100' : 'text-gray-300 hover:bg-blue-800 hover:text-gray-100' }} transition-colors duration-200 transform rounded-md"
                href="{{ route('transfers.index') }}">
                {{-- Heroicon: Arrows Right Left --}}
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                <span class="mx-4 text-sm font-medium">Mutasi Lokasi</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('disposals.*') ? 'bg-blue-800 text-gray-100' : 'text-gray-300 hover:bg-blue-800 hover:text-gray-100' }} transition-colors duration-200 transform rounded-md"
                href="{{ route('disposals.index') }}">
                {{-- Heroicon: Trash --}}
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
                <span class="mx-4 text-sm font-medium">Disposal Aset</span>
            </a>
        @endif

        {{-- Menu Khusus Admin --}}
        @if ($role === 'admin')
            <h3 class="px-6 mt-8 text-xs font-semibold text-blue-400 uppercase tracking-wider">Master Data</h3>

            <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('categories.*') ? 'bg-blue-800 text-gray-100' : 'text-gray-300 hover:bg-blue-800 hover:text-gray-100' }} transition-colors duration-200 transform rounded-md"
                href="{{ route('categories.index') }}">
                {{-- Heroicon: Tag --}}
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                <span class="mx-4 text-sm font-medium">Kategori</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('locations.*') ? 'bg-blue-800 text-gray-100' : 'text-gray-300 hover:bg-blue-800 hover:text-gray-100' }} transition-colors duration-200 transform rounded-md"
                href="{{ route('locations.index') }}">
                {{-- Heroicon: Map Pin --}}
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="mx-4 text-sm font-medium">Lokasi</span>
            </a>
        @endif

        {{-- Menu Manager --}}
        @if (in_array($role, ['admin', 'manager']))
            <h3 class="px-6 mt-8 text-xs font-semibold text-blue-400 uppercase tracking-wider">Laporan</h3>
            <a class="flex items-center px-6 py-2 mt-4 text-gray-300 transition-colors duration-200 transform hover:bg-blue-800 hover:text-gray-100 rounded-md"
                href="{{ route('reports.assets') }}">
                {{-- Heroicon: Document Report --}}
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="mx-4 text-sm font-medium">Report Pendapatan / Aset</span>
            </a>
        @endif
    </nav>
</aside>
