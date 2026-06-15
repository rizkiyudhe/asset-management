<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
                {{ __('Penghapusan Aset (Disposal)') }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">Log aset yang rusak parah, dijual, atau dihentikan operasionalnya</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- TOMBOL DI ATAS CARD --}}
            <div class="flex justify-end mb-6">
                <a href="{{ route('disposals.create') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 text-white font-semibold py-2 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    Buat Disposal Baru
                </a>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl shadow-sm relative flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="block font-medium">{{ session('success') }}</span>
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
                                    Tanggal & Nilai Jual</th>
                                <th
                                    class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Alasan Disposal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($disposals as $dp)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-800">
                                            {{ $dp->asset->name ?? 'Aset Tidak Ditemukan' }}</div>
                                        <div class="text-xs font-bold text-rose-600 mt-0.5">
                                            {{ $dp->asset->asset_code ?? '-' }}</div>
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-700">{{ $dp->disposal_date->format('d M Y') }}
                                        </div>
                                        <div class="text-xs font-bold text-gray-800 mt-0.5">Rp
                                            {{ number_format($dp->disposal_value, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-5 py-4 text-sm text-gray-600">
                                        {{ $dp->disposal_reason }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-10 text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            <span class="text-gray-500 font-medium text-sm">Belum ada riwayat
                                                penghapusan aset</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($disposals->hasPages())
                <div class="mt-4">{{ $disposals->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
