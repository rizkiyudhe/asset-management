{{-- resources/views/maintenances/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        Catat Pemeliharaan Baru
    </x-slot>

    <div class="bg-white rounded-lg shadow overflow-hidden p-6 max-w-3xl mx-auto">

        <div class="mb-4 p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 text-sm">
            <strong>Perhatian:</strong> Menyimpan formulir ini akan otomatis mengubah status aset terkait menjadi
            <strong>Maintenance</strong>.
        </div>

        <form action="{{ route('maintenances.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Pilih Aset --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Pilih Aset <span
                            class="text-red-500">*</span></label>
                    <select name="asset_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Cari & Pilih Aset --</option>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->id }}"
                                {{ old('asset_id') == $asset->id || $selectedAssetId == $asset->id ? 'selected' : '' }}>
                                [{{ $asset->asset_code }}] - {{ $asset->name }} (Saat ini:
                                {{ ucfirst($asset->status) }})
                            </option>
                        @endforeach
                    </select>
                    @error('asset_id')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Jenis Pemeliharaan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Pemeliharaan <span
                            class="text-red-500">*</span></label>
                    <select name="maintenance_type" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="preventive" {{ old('maintenance_type') == 'preventive' ? 'selected' : '' }}>
                            Preventive (Pencegahan)</option>
                        <option value="corrective" {{ old('maintenance_type') == 'corrective' ? 'selected' : '' }}>
                            Corrective (Perbaikan/Kerusakan)</option>
                        <option value="inspection" {{ old('maintenance_type') == 'inspection' ? 'selected' : '' }}>
                            Inspection (Inspeksi Rutin)</option>
                    </select>
                </div>

                {{-- Tanggal Pemeliharaan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Tindakan <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="maintenance_date" value="{{ old('maintenance_date', date('Y-m-d')) }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Teknisi / Vendor --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Teknisi / Vendor <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="technician" value="{{ old('technician') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Misal: PT Teknologi Canggih / Budi">
                </div>

                {{-- Biaya Pemeliharaan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Biaya (Rp) <span
                            class="text-red-500">*</span></label>
                    <input type="number" step="0.01" min="0" name="cost" value="{{ old('cost', 0) }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Catatan / Detail Pekerjaan --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Catatan Hasil Pemeliharaan</label>
                    <textarea name="notes" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Deskripsikan kerusakan atau hasil inspeksi...">{{ old('notes') }}</textarea>
                </div>

                {{-- Upload Lampiran (Invoice/Foto) --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Lampiran Bukti (Invoice / Foto Pekerjaan -
                        Opsional)</label>
                    <input type="file" name="attachment" accept=".pdf, image/jpeg, image/png, image/jpg"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <span class="text-xs text-gray-400 mt-1 block">Format: PDF, JPG, PNG. Maksimal: 2MB</span>
                    @error('attachment')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <a href="{{ route('maintenances.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Batal</a>
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">Simpan
                    Catatan</button>
            </div>
        </form>
    </div>
</x-app-layout>
