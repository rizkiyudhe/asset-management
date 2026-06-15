<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
                    {{ __('Log Pemeliharaan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Riwayat perbaikan dan inspeksi aset</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <a href="{{ route('maintenances.create') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Catat Pemeliharaan
                    </a>
                </div>
                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl shadow-sm relative flex items-center gap-3"
                        role="alert">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
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
                                        No. Tiket</th>
                                    <th
                                        class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Aset</th>
                                    <th
                                        class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Tanggal & Jenis</th>
                                    <th
                                        class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Teknisi / Biaya</th>
                                    <th
                                        class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($records as $record)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            <span
                                                class="text-sm font-bold text-blue-600">{{ $record->maintenance_number }}</span>
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-800">
                                                {{ $record->asset->name ?? 'Aset Dihapus' }}</div>
                                            <div class="text-xs text-gray-500 mt-0.5">
                                                {{ $record->asset->asset_code ?? '-' }}</div>
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-700">
                                                {{ $record->maintenance_date->format('d M Y') }}</div>
                                            @php
                                                $typeConfig = match ($record->maintenance_type) {
                                                    'preventive' => ['bg-blue-100', 'text-blue-700'],
                                                    'corrective' => ['bg-rose-100', 'text-rose-700'],
                                                    'inspection' => ['bg-amber-100', 'text-amber-700'],
                                                    default => ['bg-gray-100', 'text-gray-700'],
                                                };
                                            @endphp
                                            <span
                                                class="inline-flex mt-1 px-2 py-0.5 rounded-md text-[10px] font-bold tracking-wide uppercase {{ $typeConfig[0] }} {{ $typeConfig[1] }}">
                                                {{ $record->maintenance_type }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-700">{{ $record->technician }}</div>
                                            <div class="text-xs font-bold text-gray-800 mt-0.5">Rp
                                                {{ number_format($record->cost, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">

                                                {{-- Tombol Detail --}}
                                                <a href="{{ route('maintenances.show', $record) }}"
                                                    class="inline-flex items-center gap-1 text-teal-600 hover:text-teal-800 bg-teal-50 hover:bg-teal-100 px-2.5 py-1.5 rounded-md transition-all duration-200">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    Detail
                                                </a>

                                                {{-- Tombol Hapus & Modal Alpine --}}
                                                <div x-data="{ openDelete: false }" class="inline">
                                                    <button @click="openDelete = true" type="button"
                                                        class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-md transition-all duration-200">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                        Hapus
                                                    </button>

                                                    {{-- Modal Overlay --}}
                                                    <div x-show="openDelete"
                                                        class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 text-left"
                                                        style="display: none;">
                                                        <div x-show="openDelete"
                                                            x-transition:enter="ease-out duration-300"
                                                            x-transition:enter-start="opacity-0"
                                                            x-transition:enter-end="opacity-100"
                                                            x-transition:leave="ease-in duration-200"
                                                            x-transition:leave-start="opacity-100"
                                                            x-transition:leave-end="opacity-0"
                                                            @click="openDelete = false"
                                                            class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity">
                                                        </div>

                                                        {{-- Modal Content --}}
                                                        <div x-show="openDelete"
                                                            x-transition:enter="ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave="ease-in duration-200"
                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                            class="relative bg-white rounded-2xl max-w-sm w-full p-6 text-center shadow-2xl border border-gray-100 z-10 transform transition-all">
                                                            <div
                                                                class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-50 text-red-600 mb-4">
                                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                    stroke-width="2" stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                                </svg>
                                                            </div>
                                                            <h3 class="text-lg font-bold text-gray-900 mb-1">Yakin
                                                                Ingin
                                                                Hapus?</h3>
                                                            <p
                                                                class="text-xs text-gray-500 mb-6 leading-relaxed whitespace-normal">
                                                                Log pemeliharaan <span
                                                                    class="font-semibold text-gray-700">{{ $record->maintenance_number }}</span>
                                                                akan dihapus secara permanen.</p>

                                                            <div class="flex justify-center gap-3">
                                                                <button @click="openDelete = false" type="button"
                                                                    class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition-colors min-w-[80px]">Batal</button>
                                                                <form
                                                                    action="{{ route('maintenances.destroy', $record) }}"
                                                                    method="POST" class="inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition-all min-w-[80px]">Ya,
                                                                        Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-10 text-center">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg class="w-12 h-12 text-gray-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                    </path>
                                                </svg>
                                                <span class="text-gray-500 font-medium text-sm">Belum ada riwayat
                                                    pemeliharaan</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if (method_exists($records, 'links') && $records->hasPages())
                    <div class="mt-4">
                        {{ $records->links() }}
                    </div>
                @endif
            </div>
        </div>

        <style>
            .overflow-x-auto::-webkit-scrollbar {
                height: 6px;
            }

            .overflow-x-auto::-webkit-scrollbar-track {
                background: #f8fafc;
                border-radius: 8px;
            }

            .overflow-x-auto::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 8px;
            }

            .overflow-x-auto::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
        </style>
</x-app-layout>
