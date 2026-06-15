{{-- resources/views/assets/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        Detail Aset: {{ $asset->asset_code }}
    </x-slot>

    <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Kolom Kiri: Informasi Utama Aset --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow overflow-hidden p-6">
                <div class="flex justify-between items-start border-b pb-4 mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $asset->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $asset->brand ?? 'No Brand' }} /
                            {{ $asset->model ?? 'No Model' }}</p>
                    </div>
                    <div>
                        @php
                            $statusColor = match ($asset->status) {
                                'active' => 'bg-green-100 text-green-800',
                                'maintenance' => 'bg-yellow-100 text-yellow-800',
                                'damaged', 'lost' => 'bg-red-100 text-red-800',
                                'disposed' => 'bg-gray-100 text-gray-800',
                                default => 'bg-blue-100 text-blue-800',
                            };
                        @endphp
                        <span
                            class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusColor }}">
                            {{ ucfirst($asset->status) }}
                        </span>
                    </div>
                </div>

                {{-- Grid Detail Spesifikasi --}}
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500 block">Kategori</span>
                        <strong class="text-gray-800">{{ $asset->category->name ?? '-' }}</strong>
                    </div>
                    <div>
                        <span class="text-gray-500 block">Lokasi Sekarang</span>
                        <strong class="text-gray-800">{{ $asset->location->name ?? '-' }}</strong>
                    </div>
                    <div>
                        <span class="text-gray-500 block">Serial Number</span>
                        <strong class="text-gray-800">{{ $asset->serial_number ?? 'N/A' }}</strong>
                    </div>
                    <div>
                        <span class="text-gray-500 block">Kondisi Fisik</span>
                        <strong
                            class="text-gray-800 uppercase text-xs px-2 py-0.5 bg-gray-100 rounded">{{ $asset->condition }}</strong>
                    </div>
                    <div class="border-t pt-2 mt-2">
                        <span class="text-gray-500 block">Tanggal Pembelian</span>
                        <strong class="text-gray-800">{{ $asset->purchase_date->format('d M Y') }}</strong>
                    </div>
                    <div class="border-t pt-2 mt-2">
                        <span class="text-gray-500 block">Harga Perolehan</span>
                        <strong class="text-gray-800">Rp
                            {{ number_format($asset->purchase_price, 2, ',', '.') }}</strong>
                    </div>
                </div>

                <div class="mt-6 border-t pt-4">
                    <span class="text-gray-500 block text-sm mb-1">Deskripsi</span>
                    <p class="text-gray-700 text-sm bg-gray-50 p-3 rounded border">
                        {{ $asset->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>

            {{-- Riwayat Maintenance Mini Table --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-3">Riwayat Pemeliharaan</h3>
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">No Tiket</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Tanggal</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Jenis</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Biaya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($asset->maintenanceRecords as $record)
                            <tr>
                                <td class="px-4 py-2 font-medium text-blue-600">{{ $record->maintenance_number }}</td>
                                <td class="px-4 py-2">{{ $record->maintenance_date->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 uppercase text-xs">{{ $record->maintenance_type }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($record->cost, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-center text-gray-400">Belum ada riwayat
                                    perbaikan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Kolom Kanan: Media Gambar & QR Code Management --}}
        <div class="space-y-6">
            {{-- Foto Aset --}}
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <span class="text-sm font-medium text-gray-500 block mb-2">Visual Aset</span>
                @if ($asset->image)
                    <img src="{{ asset('storage/' . $asset->image) }}" alt="Foto Asset"
                        class="w-full h-48 object-cover rounded-lg border">
                @else
                    <div
                        class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 rounded-lg border border-dashed">
                        Tidak Ada Foto
                    </div>
                @endif
            </div>

            {{-- QR Code Module --}}
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <span class="text-sm font-medium text-gray-500 block mb-3">Label QR Code Unik</span>

                {{-- View QR --}}
                <div id="qr-print-area" class="bg-white p-4 inline-block border rounded-lg shadow-sm">
                    <img src="{{ asset('storage/assets/qrcodes/' . $asset->asset_code . '.svg') }}" alt="QR Code"
                        class="w-40 h-40 mx-auto">
                    <p class="text-xs font-bold text-gray-700 mt-2 tracking-wider">{{ $asset->asset_code }}</p>
                </div>

                {{-- Action QR Button --}}
                <div class="mt-6 grid grid-cols-2 gap-2">
                    <a href="{{ route('assets.qr.download', $asset->id) }}"
                        class="inline-flex justify-center items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs font-medium transition shadow-sm">
                        {{-- Heroicon: ArrowDownTray --}}
                        Download QR
                    </a>
                    <button onclick="printQrCode()"
                        class="inline-flex justify-center items-center px-3 py-2 bg-gray-800 hover:bg-gray-900 text-white rounded text-xs font-medium transition shadow-sm">
                        Print Label
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script JavaScript Cetak QR Code Area Terisolasi --}}
    <script>
        function printQrCode() {
            var printContents = document.getElementById('qr-print-area').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML =
                "<html><head><title>Print Label QR</title><style>body{display:flex;justify-content:center;align-items:center;height:100vh;margin:0;font-family:sans-serif;text-align:center;}</style></head><body><div>" +
                printContents + "</div></body></html>";

            window.print();

            // Kembalikan isi halaman utama setelah cetak ditutup
            document.body.innerHTML = originalContents;
            window.location.reload(); // Reload untuk me-rebind event listener JS yang hilang
        }
    </script>
</x-app-layout>
