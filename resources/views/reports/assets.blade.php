<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Laporan Aset Perusahaan</h2>
        <p class="text-sm text-gray-500 mt-1">Filter, analisis, dan ekspor data aset</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Form Filter --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                <form action="{{ route('reports.assets') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Kategori</label>
                            <select name="category_id"
                                class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Lokasi</label>
                            <select name="location_id"
                                class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500">
                                <option value="">Semua Lokasi</option>
                                @foreach ($locations as $loc)
                                    <option value="{{ $loc->id }}"
                                        {{ request('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Status</label>
                            <select name="status"
                                class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>
                                    Maintenance</option>
                                <option value="damaged" {{ request('status') == 'damaged' ? 'selected' : '' }}>Rusak
                                </option>
                                <option value="disposed" {{ request('status') == 'disposed' ? 'selected' : '' }}>
                                    Disposed</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Dari Tanggal Beli</label>
                                <input type="date" name="start_date" value="{{ request('start_date') }}"
                                    class="w-full rounded-lg border-gray-300 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Sampai Tanggal</label>
                                <input type="date" name="end_date" value="{{ request('end_date') }}"
                                    class="w-full rounded-lg border-gray-300 text-sm">
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-wrap justify-between items-center border-t border-gray-100 pt-4 gap-3">
                        <div class="flex gap-2">
                            <button type="submit" name="action" value="filter"
                                class="px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded-lg transition-colors">Terapkan
                                Filter</button>
                            <a href="{{ route('reports.assets') }}"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg transition-colors">Reset</a>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" name="action" value="export_excel"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Excel
                            </button>
                            <button type="submit" name="action" value="export_pdf"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                PDF
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Tabel Hasil Filter --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kode &
                                    Nama</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kategori &
                                    Lokasi</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal &
                                    Harga Beli</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($assets as $asset)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-5 py-3 whitespace-nowrap">
                                        <div class="font-bold text-blue-600">{{ $asset->asset_code }}</div>
                                        <div class="text-sm text-gray-800">{{ $asset->name }}</div>
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-600">
                                        <div>{{ $asset->category->name ?? '-' }}</div>
                                        <div class="text-xs font-semibold mt-0.5">{{ $asset->location->name ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-600">
                                        <div>{{ $asset->purchase_date->format('d M Y') }}</div>
                                        <div class="font-bold text-gray-800 mt-0.5">Rp
                                            {{ number_format($asset->purchase_price, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 bg-gray-100 rounded text-xs font-semibold">{{ strtoupper($asset->status) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-8 text-center text-gray-500 text-sm">Tidak ada
                                        data aset yang sesuai dengan filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($assets->hasPages())
                <div class="mt-4">{{ $assets->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
