<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
                    {{ __('Buat Formulir Mutasi') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Pindahkan penempatan lokasi internal aset perusahaan</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden p-6">

                <form action="{{ route('transfers.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        {{-- Pilih Aset --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Aset Terdaftar <span
                                    class="text-rose-500">*</span></label>
                            <select name="asset_id" required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">-- Pilih Aset --</option>
                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->id }}"
                                        {{ old('asset_id') == $asset->id || $selectedAssetId == $asset->id ? 'selected' : '' }}>
                                        [{{ $asset->asset_code }}] - {{ $asset->name }} (Lokasi Saat Ini:
                                        {{ $asset->location->name ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('asset_id')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Lokasi Tujuan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Penempatan Baru <span
                                    class="text-rose-500">*</span></label>
                            <select name="to_location_id" required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">-- Pilih Lokasi Tujuan --</option>
                                @foreach ($locations as $loc)
                                    <option value="{{ $loc->id }}"
                                        {{ old('to_location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('to_location_id')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Tanggal Mutasi --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mutasi Berjalan <span
                                    class="text-rose-500">*</span></label>
                            <input type="date" name="transfer_date"
                                value="{{ old('transfer_date', date('Y-m-d')) }}" required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            @error('transfer_date')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Catatan Alasan Mutasi --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan / Alasan
                                Perpindahan</label>
                            <textarea name="notes" rows="4"
                                placeholder="Contoh: Perpindahan unit kerja dari divisi IT ke operasional gudang..."
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('notes') }}</textarea>
                            @error('notes')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">
                        <a href="{{ route('transfers.index') }}"
                            class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                            Simpan & Eksekusi Mutasi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
