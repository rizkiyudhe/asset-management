<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Kelola Lokasi Aset</h2>
            <p class="text-sm text-gray-500 mt-1">Master data titik penempatan inventaris perusahaan</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-6">
                <a href="{{ route('locations.create') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-semibold py-2 px-4 rounded-xl shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Tambah Lokasi
                </a>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-6 px-4 py-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama
                                    Lokasi</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Deskripsi
                                </th>
                                <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Total
                                    Aset</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($locations as $loc)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-3 whitespace-nowrap"><span
                                            class="text-sm font-bold text-gray-800">{{ $loc->name }}</span></td>
                                    <td class="px-5 py-3 text-sm text-gray-600 truncate max-w-xs">
                                        {{ $loc->description ?? '-' }}</td>
                                    <td class="px-5 py-3 whitespace-nowrap text-center">
                                        <span
                                            class="px-2.5 py-1 bg-teal-50 text-teal-700 rounded-lg text-xs font-bold border border-teal-100">{{ $loc->assets_count ?? 0 }}
                                            Aset</span>
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('locations.edit', $loc) }}"
                                                class="inline-flex items-center gap-1 text-teal-600 hover:text-teal-800 bg-teal-50 hover:bg-teal-100 px-2.5 py-1.5 rounded-md transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg> Edit
                                            </a>
                                            <div x-data="{ openDelete: false }" class="inline">
                                                <button @click="openDelete = true" type="button"
                                                    class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-md transition-all">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg> Hapus
                                                </button>
                                                <div x-show="openDelete"
                                                    class="fixed inset-0 z-50 flex items-center justify-center p-4 text-left"
                                                    style="display: none;">
                                                    <div x-show="openDelete" @click="openDelete = false"
                                                        class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm"></div>
                                                    <div x-show="openDelete"
                                                        class="relative bg-white rounded-2xl max-w-sm w-full p-6 text-center shadow-2xl z-10">
                                                        <div
                                                            class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-50 text-red-600 mb-4">
                                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                        </div>
                                                        <h3 class="text-lg font-bold text-gray-900 mb-1">Yakin Ingin
                                                            Hapus?</h3>
                                                        <p class="text-xs text-gray-500 mb-6">Lokasi <span
                                                                class="font-semibold">{{ $loc->name }}</span> akan
                                                            dihapus.</p>
                                                        <div class="flex justify-center gap-3">
                                                            <button @click="openDelete = false" type="button"
                                                                class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition-colors">Batal</button>
                                                            <form action="{{ route('locations.destroy', $loc) }}"
                                                                method="POST" class="inline">
                                                                @csrf @method('DELETE')
                                                                <button type="submit"
                                                                    class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl shadow-md transition-all">Ya,
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
                                    <td colspan="4" class="px-5 py-10 text-center text-gray-500 text-sm">Belum ada
                                        lokasi terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($locations->hasPages())
                <div class="mt-4">{{ $locations->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
