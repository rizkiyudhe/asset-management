<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
                {{ __('Formulir Disposal Aset') }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">Keluarkan aset dari operasional sistem secara permanen</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden p-6">

                <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 text-sm rounded-r-lg shadow-sm">
                    <strong>Peringatan Kuat:</strong> Melakukan disposal akan menonaktifkan aset ini dari sistem secara
                    permanen (Status menjadi <strong>Disposed</strong>). Tindakan ini tidak disarankan untuk dibatalkan.
                </div>

                <form action="{{ route('disposals.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Aset <span
                                    class="text-rose-500">*</span></label>
                            <select name="asset_id" required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-rose-500 focus:ring-rose-500 text-sm">
                                <option value="">-- Pilih Aset --</option>
                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->id }}"
                                        {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                        [{{ $asset->asset_code }}] - {{ $asset->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('asset_id')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Eksekusi <span
                                    class="text-rose-500">*</span></label>
                            <input type="date" name="disposal_date" value="{{ old('disposal_date', date('Y-m-d')) }}"
                                required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-rose-500 focus:ring-rose-500 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penghapusan <span
                                    class="text-rose-500">*</span></label>
                            <textarea name="disposal_reason" rows="3" required
                                placeholder="Misal: Rusak total dan tidak bisa diperbaiki, atau dijual ke pihak ketiga..."
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-rose-500 focus:ring-rose-500 text-sm">{{ old('disposal_reason') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nilai Jual / Residu (Rp) -
                                Opsional</label>
                            <input type="number" step="0.01" min="0" name="disposal_value"
                                value="{{ old('disposal_value', 0) }}"
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-rose-500 focus:ring-rose-500 text-sm">
                            <span class="text-xs text-gray-400 mt-1 block">Isi 0 jika aset dibuang karena rusak.</span>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">
                        <a href="{{ route('disposals.index') }}"
                            class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition-colors">Batal</a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 text-white text-xs font-bold rounded-xl shadow-md transition-all transform hover:-translate-y-0.5">
                            Konfirmasi Disposal
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
