<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
                    {{ __('Mutasi Lokasi Aset') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Log riwayat perpindahan lokasi penempatan aset</p>
            </div>
            <a href="{{ route('transfers.create') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Mutasi Aset
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl shadow-sm relative flex items-center gap-3"
                    role="alert">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Aset</th>
                                <th
                                    class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Lokasi Asal</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Arah</th>
                                <th
                                    class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Lokasi Baru</th>
                                <th
                                    class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Tanggal & Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($transfers as $tf)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-5 py-3 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-800">
                                            {{ $tf->asset->name ?? 'Aset Dihapus' }}</div>
                                        <div class="text-xs font-bold text-blue-600 mt-0.5">
                                            {{ $tf->asset->asset_code ?? '-' }}</div>
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-600">
                                        <span
                                            class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium border border-gray-200">
                                            {{ $tf->fromLocation->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap text-center text-gray-400">
                                        <svg class="w-5 h-5 mx-auto text-blue-500 animate-pulse" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-600">
                                        <span
                                            class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-bold border border-blue-100">
                                            {{ $tf->toLocation->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-sm text-gray-600">
                                        <div class="font-semibold text-gray-800">
                                            {{ $tf->transfer_date->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-400 mt-0.5 max-w-xs truncate"
                                            title="{{ $tf->notes }}">{{ $tf->notes ?? 'Tidak ada catatan.' }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-10 text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                            </svg>
                                            <span class="text-gray-500 font-medium text-sm">Belum ada riwayat mutasi
                                                lokasi</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($transfers->hasPages())
                <div class="mt-4">
                    {{ $transfers->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
