{{-- resources/views/assets/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        Tambah Aset Baru
    </x-slot>

    <div class="bg-white rounded-lg shadow overflow-hidden p-6 max-w-4xl mx-auto">
        <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori <span
                            class="text-red-500">*</span></label>
                    <select name="category_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi <span
                            class="text-red-500">*</span></label>
                    <select name="location_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Pilih Lokasi --</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}"
                                {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('location_id')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Nama Aset --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Nama Aset <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Merk/Brand & Model --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Brand / Merk</label>
                    <input type="text" name="brand" value="{{ old('brand') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Model</label>
                    <input type="text" name="model" value="{{ old('model') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Serial Number --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Serial Number</label>
                    <input type="text" name="serial_number" value="{{ old('serial_number') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('serial_number')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Harga & Tanggal Pembelian --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga Beli <span
                            class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="purchase_price" value="{{ old('purchase_price') }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Pembelian <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="purchase_date" value="{{ old('purchase_date') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Kondisi & Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kondisi <span
                            class="text-red-500">*</span></label>
                    <select name="condition" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="excellent" {{ old('condition') == 'excellent' ? 'selected' : '' }}>Sangat Baik
                            (Excellent)</option>
                        <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>Baik (Good)</option>
                        <option value="fair" {{ old('condition') == 'fair' ? 'selected' : '' }}>Cukup (Fair)</option>
                        <option value="poor" {{ old('condition') == 'poor' ? 'selected' : '' }}>Buruk (Poor)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status <span
                            class="text-red-500">*</span></label>
                    <select name="status" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance
                        </option>
                        <option value="damaged" {{ old('status') == 'damaged' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi Tambahan</label>
                    <textarea name="description" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                </div>

                {{-- Upload Gambar --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Foto Aset (Opsional, Max: 2MB)</label>
                    <input type="file" name="image" accept="image/jpeg, image/png, image/jpg"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('image')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <a href="{{ route('assets.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Batal</a>
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">Simpan
                    Aset</button>
            </div>
        </form>
    </div>
</x-app-layout>
