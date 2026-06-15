<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
            {{ __('Dashboard Analytics') }}
        </h2>
        <p class="text-sm text-gray-500 mt-1">Ringkasan performa dan kondisi aset perusahaan</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 1. Cards Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Card: Total Assets --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Aset</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_assets'] }}</h3>
                    </div>
                </div>

                {{-- Card: Active Assets --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Aset Aktif</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['active_assets'] }}</h3>
                    </div>
                </div>

                {{-- Card: Maintenance --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Dalam Perbaikan</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['maintenance_assets'] }}</h3>
                    </div>
                </div>

                {{-- Card: Damaged/Lost --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="p-3 bg-rose-50 text-rose-600 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Rusak / Hilang</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['damaged_assets'] }}</h3>
                    </div>
                </div>

                {{-- Card: Total Categories --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Kategori</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_categories'] }}</h3>
                    </div>
                </div>

                {{-- Card: Total Locations --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="p-3 bg-teal-50 text-teal-600 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Titik Lokasi</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_locations'] }}</h3>
                    </div>
                </div>
            </div>

            {{-- 2. Charts Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Chart: Aset Berdasarkan Kategori --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Distribusi Aset per Kategori</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>

                {{-- Chart: Biaya Maintenance --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Biaya Pemeliharaan {{ $currentYear }}</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="maintenanceChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- 3. Tables Section (Recent Data) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Table: Aset Terbaru --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Aset Baru Ditambahkan</h3>
                        <a href="{{ route('assets.index') }}" class="text-sm text-blue-600 hover:underline">Lihat
                            Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50 text-gray-500">
                                <tr>
                                    <th class="py-2 px-3">Kode / Nama</th>
                                    <th class="py-2 px-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($recentAssets as $asset)
                                    <tr>
                                        <td class="py-2 px-3">
                                            <div class="font-bold text-gray-800">{{ $asset->asset_code }}</div>
                                            <div class="text-xs">{{ $asset->name }}</div>
                                        </td>
                                        <td class="py-2 px-3">
                                            <span
                                                class="px-2 py-1 bg-gray-100 rounded text-xs font-semibold">{{ ucfirst($asset->status) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-4 text-center text-gray-400">Belum ada aset.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Table: Maintenance Terbaru --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Log Pemeliharaan Terbaru</h3>
                        <a href="{{ route('maintenances.index') }}"
                            class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50 text-gray-500">
                                <tr>
                                    <th class="py-2 px-3">No. Tiket</th>
                                    <th class="py-2 px-3 text-right">Biaya</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($recentMaintenances as $mnt)
                                    <tr>
                                        <td class="py-2 px-3">
                                            <div class="font-bold text-blue-600">{{ $mnt->maintenance_number }}</div>
                                            <div class="text-xs">{{ $mnt->asset->name ?? 'Aset Dihapus' }}</div>
                                        </td>
                                        <td class="py-2 px-3 text-right font-medium">
                                            Rp {{ number_format($mnt->cost, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-4 text-center text-gray-400">Belum ada
                                            pemeliharaan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Script untuk Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart Kategori (Pie/Doughnut)
            const ctxCategory = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($categoryLabels) !!},
                    datasets: [{
                        data: {!! json_encode($categoryData) !!},
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
                            '#14b8a6'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                }
            });

            // Chart Maintenance (Bar/Line)
            const ctxMaintenance = document.getElementById('maintenanceChart').getContext('2d');
            new Chart(ctxMaintenance, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    datasets: [{
                        label: 'Total Biaya (Rp)',
                        data: {!! json_encode($monthlyCosts) !!},
                        backgroundColor: '#3b82f6',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
