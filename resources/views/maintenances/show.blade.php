{{-- resources/views/maintenances/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        Detail Pemeliharaan: {{ $maintenance->maintenance_number }}
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Tiket</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detail riwayat pekerjaan teknisi dan biaya.</p>
            </div>
            <div>
                <span
                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 uppercase tracking-wider">
                    {{ $maintenance->maintenance_type }}
                </span>
            </div>
        </div>

        <div class="px-6 py-5">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Data Aset</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <a href="{{ route('assets.show', $maintenance->asset_id) }}"
                            class="text-blue-600 hover:underline font-bold">
                            {{ $maintenance->asset->asset_code }} - {{ $maintenance->asset->name }}
                        </a>
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Tanggal Pekerjaan</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $maintenance->maintenance_date->format('d F Y') }}</dd>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Teknisi / Vendor pelaksana</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $maintenance->technician }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Total Biaya (Cost)</dt>
                    <dd class="mt-1 text-sm font-bold text-gray-900">Rp
                        {{ number_format($maintenance->cost, 2, ',', '.') }}</dd>
                </div>

                <div class="sm:col-span-2 border-t pt-4">
                    <dt class="text-sm font-medium text-gray-500">Catatan Pekerjaan</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">
                        {{ $maintenance->notes ?? 'Tidak ada catatan khusus.' }}</dd>
                </div>

                @if ($maintenance->attachment)
                    <div class="sm:col-span-2 border-t pt-4 mt-2">
                        <dt class="text-sm font-medium text-gray-500 mb-2">Lampiran Dokumen/Bukti</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="{{ asset('storage/' . $maintenance->attachment) }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                {{-- Heroicon: Document Arrow Down --}}
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Lihat Dokumen
                            </a>
                        </dd>
                    </div>
                @endif
            </dl>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-right">
            <a href="{{ route('maintenances.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                &larr; Kembali ke Daftar Pemeliharaan
            </a>
        </div>
    </div>
</x-app-layout>
