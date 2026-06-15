<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Edit Lokasi: {{ $location->name }}</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
                <form action="{{ route('locations.update', $location) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lokasi <span
                                    class="text-rose-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $location->name) }}" required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                            @error('name')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi (Opsional)</label>
                            <textarea name="description" rows="3"
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">{{ old('description', $location->description) }}</textarea>
                            @error('description')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">
                        <a href="{{ route('locations.index') }}"
                            class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition-colors">Batal</a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-gradient-to-r from-teal-600 to-teal-700 text-white text-xs font-bold rounded-xl shadow-md transition-all">Update
                            Lokasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
