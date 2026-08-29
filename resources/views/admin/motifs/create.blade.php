<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.motifs.index') }}" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-extrabold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                {{ __('Tambah Motif Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <form action="{{ route('admin.motifs.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            {{-- Left Column: Image Upload & Preview --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm p-6">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4 text-base">File Grafis & Status</h3>
                    
                    {{-- Upload Area --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">File Grafis Motif <span class="text-rose-500">*</span></label>
                        
                        <div class="relative group flex justify-center px-4 py-6 border-2 border-slate-200 dark:border-slate-700 border-dashed rounded-xl hover:border-emerald-500 dark:hover:border-emerald-500 transition-colors duration-200 cursor-pointer bg-slate-50/50 dark:bg-slate-900/30">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-10 w-10 text-slate-400 dark:text-slate-600 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div class="flex text-sm text-slate-600 dark:text-slate-400 justify-center">
                                    <label for="image" class="relative cursor-pointer rounded-md font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-500 focus-within:outline-none">
                                        <span>Unggah berkas motif</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg, image/svg+xml">
                                    </label>
                                </div>
                                <p class="text-xs text-slate-400 dark:text-slate-500">PNG, JPG, JPEG, SVG (Maks. 5MB)</p>
                            </div>
                        </div>

                        {{-- Validation Error for Image --}}
                        @error('image')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 200x200 Image Preview Box --}}
                    <div class="mt-6 flex flex-col items-center">
                        <span class="block text-sm font-bold text-slate-700 dark:text-slate-300 self-start mb-2">Preview Image</span>
                        <div class="w-[200px] h-[200px] bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden shadow-sm flex items-center justify-center relative p-2">
                            {{-- Placeholder image / message --}}
                            <div id="image-placeholder" class="text-center p-4">
                                <svg class="mx-auto h-8 w-8 text-slate-300 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-[11px] text-slate-400 dark:text-slate-600 font-semibold mt-1">Belum memilih berkas</p>
                            </div>
                            {{-- Live preview --}}
                            <img id="image-preview" src="#" alt="Preview" class="max-w-full max-h-full object-contain hidden">
                        </div>
                    </div>

                    {{-- Status Checkbox --}}
                    <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-700">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="is_active" value="1" class="w-4 h-4 rounded-md text-emerald-600 focus:ring-emerald-500 focus:border-emerald-500 border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm transition-all duration-200 @error('is_active') border-red-500 @enderror" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                            <div class="ml-3">
                                <span class="block text-sm font-bold text-slate-900 dark:text-white group-hover:text-emerald-500 transition-colors">Checkbox Aktif</span>
                                <span class="block text-xs text-slate-400 dark:text-slate-500 font-semibold">Tentukan apakah motif langsung aktif di katalog.</span>
                            </div>
                        </label>
                        @error('is_active')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Right Column: Main Form Fields --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm p-6 md:p-8 space-y-6">
                    <h3 class="font-bold text-slate-900 dark:text-white text-base pb-3 border-b border-slate-100 dark:border-slate-700">Informasi Motif</h3>

                    {{-- Motif Name --}}
                    <div>
                        <label for="nama" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Motif <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Contoh: Motif Batik Kawung Modern" class="w-full px-4 py-3 text-sm bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:bg-white dark:focus:bg-slate-950 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 dark:text-white transition-all duration-200 @error('nama') border-red-500 ring-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        @error('nama')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category Selector --}}
                    <div>
                        <label for="kategori" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kategori Motif <span class="text-rose-500">*</span></label>
                        <select name="kategori" id="kategori" class="w-full px-4 py-3 text-sm bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:bg-white dark:focus:bg-slate-950 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 dark:text-white transition-all duration-200 capitalize @error('kategori') border-red-500 ring-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('kategori') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" placeholder="Tuliskan deskripsi detail motif di sini..." class="w-full px-4 py-3 text-sm bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:bg-white dark:focus:bg-slate-950 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 dark:text-white transition-all duration-200 @error('description') border-red-500 ring-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-700">
                        <a href="{{ route('admin.motifs.index') }}" class="px-6 py-3 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-900 text-slate-700 dark:text-slate-300 font-bold text-xs rounded-xl hover:shadow-sm transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                            Simpan Motif
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const placeholder = document.getElementById('image-placeholder');
            const previewImage = document.getElementById('image-preview');

            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        previewImage.classList.remove('hidden');
                        if (placeholder) {
                            placeholder.classList.add('hidden');
                        }
                    }
                    reader.readAsDataURL(file);
                } else {
                    previewImage.src = '#';
                    previewImage.classList.add('hidden');
                    if (placeholder) {
                        placeholder.classList.remove('hidden');
                    }
                }
            });
        });
    </script>
    @endpush
</x-admin-layout>
