<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.templates.index') }}" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-extrabold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                {{ __('Edit Template') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <form action="{{ route('admin.templates.update', $template->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            @method('PUT')

            {{-- Left Column: Image Upload & Preview --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm p-6">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4 text-base">File Grafis & Status</h3>
                    
                    {{-- Upload Area: Preview Jersey Utuh --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Ganti Preview Jersey Utuh <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                        
                        <div class="relative group flex justify-center px-4 py-6 border-2 border-slate-200 dark:border-slate-700 border-dashed rounded-xl hover:border-emerald-500 dark:hover:border-emerald-500 transition-colors duration-200 cursor-pointer bg-slate-50/50 dark:bg-slate-900/30">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-10 w-10 text-slate-400 dark:text-slate-600 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div class="flex text-sm text-slate-600 dark:text-slate-400 justify-center">
                                    <label for="image" class="relative cursor-pointer rounded-md font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-500 focus-within:outline-none">
                                        <span>Unggah Preview (image_path)</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg">
                                    </label>
                                </div>
                                <p class="text-xs text-slate-400 dark:text-slate-500">Gambar utuh hasil rekomendasi</p>
                            </div>
                        </div>

                        @error('image')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image Preview Box --}}
                    <div class="mt-4 flex flex-col items-center">
                        <span class="block text-xs font-bold text-slate-500 dark:text-slate-400 self-start mb-1">Preview Image (Katalog)</span>
                        <div class="w-[180px] h-[180px] bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden shadow-sm flex items-center justify-center relative">
                            <img id="image-preview" src="{{ asset($template->image_path) }}" data-default="{{ asset($template->image_path) }}" alt="Preview" class="w-full h-full object-contain">
                        </div>
                    </div>

                    {{-- Upload Area: Desain Transparan Overlay DEPAN --}}
                    <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-700 space-y-4">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Ganti Desain Transparan DEPAN <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                        
                        <div class="relative group flex justify-center px-4 py-6 border-2 border-slate-200 dark:border-slate-700 border-dashed rounded-xl hover:border-indigo-500 dark:hover:border-indigo-500 transition-colors duration-200 cursor-pointer bg-slate-50/50 dark:bg-slate-900/30">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-10 w-10 text-slate-400 dark:text-slate-600 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <div class="flex text-sm text-slate-600 dark:text-slate-400 justify-center">
                                    <label for="design_front" class="relative cursor-pointer rounded-md font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 focus-within:outline-none">
                                        <span>Unggah Desain Depan (design_front_path)</span>
                                        <input id="design_front" name="design_front" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg, image/svg+xml">
                                    </label>
                                </div>
                                <p class="text-xs text-slate-400 dark:text-slate-500">Pola transparan sisi depan</p>
                            </div>
                        </div>

                        @error('design_front')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Design Front Preview Box --}}
                    <div class="mt-4 flex flex-col items-center">
                        <span class="block text-xs font-bold text-slate-500 dark:text-slate-400 self-start mb-1">Preview Desain Depan</span>
                        <div class="w-[180px] h-[180px] bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden shadow-sm flex items-center justify-center relative bg-checkerboard">
                            @php $frontSrc = $template->design_front_path ?? $template->design_path; @endphp
                            @if($frontSrc)
                                <img id="design-front-preview" src="{{ asset($frontSrc) }}" data-default="{{ asset($frontSrc) }}" alt="Design Front Preview" class="w-full h-full object-contain">
                            @else
                                <div id="design-front-placeholder" class="text-center p-4">
                                    <p class="text-[11px] text-slate-400 dark:text-slate-600 font-semibold">Belum ada desain depan</p>
                                </div>
                                <img id="design-front-preview" src="#" alt="Design Front Preview" class="w-full h-full object-contain hidden">
                            @endif
                        </div>
                    </div>

                    {{-- Upload Area: Desain Transparan Overlay BELAKANG --}}
                    <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-700 space-y-4">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Ganti Desain Transparan BELAKANG <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                        
                        <div class="relative group flex justify-center px-4 py-6 border-2 border-slate-200 dark:border-slate-700 border-dashed rounded-xl hover:border-purple-500 dark:hover:border-purple-500 transition-colors duration-200 cursor-pointer bg-slate-50/50 dark:bg-slate-900/30">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-10 w-10 text-slate-400 dark:text-slate-600 group-hover:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <div class="flex text-sm text-slate-600 dark:text-slate-400 justify-center">
                                    <label for="design_back" class="relative cursor-pointer rounded-md font-bold text-purple-600 dark:text-purple-400 hover:text-purple-500 focus-within:outline-none">
                                        <span>Unggah Desain Belakang (design_back_path)</span>
                                        <input id="design_back" name="design_back" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg, image/svg+xml">
                                    </label>
                                </div>
                                <p class="text-xs text-slate-400 dark:text-slate-500">Pola transparan sisi belakang</p>
                            </div>
                        </div>

                        @error('design_back')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Design Back Preview Box --}}
                    <div class="mt-4 flex flex-col items-center">
                        <span class="block text-xs font-bold text-slate-500 dark:text-slate-400 self-start mb-1">Preview Desain Belakang</span>
                        <div class="w-[180px] h-[180px] bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden shadow-sm flex items-center justify-center relative bg-checkerboard">
                            @php $backSrc = $template->design_back_path ?? $template->design_path; @endphp
                            @if($backSrc)
                                <img id="design-back-preview" src="{{ asset($backSrc) }}" data-default="{{ asset($backSrc) }}" alt="Design Back Preview" class="w-full h-full object-contain">
                            @else
                                <div id="design-back-placeholder" class="text-center p-4">
                                    <p class="text-[11px] text-slate-400 dark:text-slate-600 font-semibold">Belum ada desain belakang</p>
                                </div>
                                <img id="design-back-preview" src="#" alt="Design Back Preview" class="w-full h-full object-contain hidden">
                            @endif
                        </div>
                    </div>

                    {{-- Status Checkbox --}}
                    <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-700">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="is_active" value="1" class="w-4 h-4 rounded-md text-emerald-600 focus:ring-emerald-500 focus:border-emerald-500 border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm transition-all duration-200 @error('is_active') border-red-500 @enderror" {{ old('is_active', $template->is_active ? '1' : '0') == '1' ? 'checked' : '' }}>
                            <div class="ml-3">
                                <span class="block text-sm font-bold text-slate-900 dark:text-white group-hover:text-emerald-500 transition-colors">Checkbox Aktif</span>
                                <span class="block text-xs text-slate-400 dark:text-slate-500 font-semibold">Tentukan apakah template langsung aktif di katalog.</span>
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
                    <h3 class="font-bold text-slate-900 dark:text-white text-base pb-3 border-b border-slate-100 dark:border-slate-700">Informasi Template</h3>

                    {{-- Template Name --}}
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Template <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $template->name) }}" placeholder="Contoh: Jersey Esport Pro Sleek" class="w-full px-4 py-3 text-sm bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:bg-white dark:focus:bg-slate-950 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 dark:text-white transition-all duration-200 @error('name') border-red-500 ring-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        @error('name')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Dropdown Attributes --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Category Selector --}}
                        <div>
                            <label for="category" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kategori <span class="text-rose-500">*</span></label>
                            <select name="category" id="category" class="w-full px-4 py-3 text-sm bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:bg-white dark:focus:bg-slate-950 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 dark:text-white transition-all duration-200 capitalize @error('category') border-red-500 ring-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <option value="" disabled>Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $template->category) === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Theme Selector --}}
                        <div>
                            <label for="theme" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tema <span class="text-rose-500">*</span></label>
                            <select name="theme" id="theme" class="w-full px-4 py-3 text-sm bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:bg-white dark:focus:bg-slate-950 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 dark:text-white transition-all duration-200 capitalize @error('theme') border-red-500 ring-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <option value="" disabled>Pilih Tema</option>
                                @foreach($themes as $themeOption)
                                    <option value="{{ $themeOption }}" {{ old('theme', $template->theme) === $themeOption ? 'selected' : '' }}>{{ $themeOption }}</option>
                                @endforeach
                            </select>
                            @error('theme')
                                <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Color Selector --}}
                        <div>
                            <label for="color" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Warna <span class="text-rose-500">*</span></label>
                            <select name="color" id="color" class="w-full px-4 py-3 text-sm bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:bg-white dark:focus:bg-slate-950 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 dark:text-white transition-all duration-200 capitalize @error('color') border-red-500 ring-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <option value="" disabled>Pilih Warna</option>
                                @foreach($colors as $col)
                                    <option value="{{ $col }}" {{ old('color', $template->color) === $col ? 'selected' : '' }}>{{ ucfirst($col) }}</option>
                                @endforeach
                            </select>
                            @error('color')
                                <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" placeholder="Tuliskan deskripsi detail template di sini..." class="w-full px-4 py-3 text-sm bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:bg-white dark:focus:bg-slate-950 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 dark:text-white transition-all duration-200 @error('description') border-red-500 ring-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('description', $template->description) }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-700">
                        <a href="{{ route('admin.templates.index') }}" class="px-6 py-3 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-900 text-slate-700 dark:text-slate-300 font-bold text-xs rounded-xl hover:shadow-sm transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                            Perbarui Template
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function handlePreview(inputId, previewId, placeholderId) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                const placeholder = document.getElementById(placeholderId);
                const defaultSrc = preview ? preview.getAttribute('data-default') : null;

                if (input && preview) {
                    input.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                preview.src = event.target.result;
                                preview.classList.remove('hidden');
                                if (placeholder) placeholder.classList.add('hidden');
                            }
                            reader.readAsDataURL(file);
                        } else {
                            if (defaultSrc) {
                                preview.src = defaultSrc;
                                preview.classList.remove('hidden');
                                if (placeholder) placeholder.classList.add('hidden');
                            } else {
                                preview.src = '#';
                                preview.classList.add('hidden');
                                if (placeholder) placeholder.classList.remove('hidden');
                            }
                        }
                    });
                }
            }

            handlePreview('image', 'image-preview', null);
            handlePreview('design_front', 'design-front-preview', 'design-front-placeholder');
            handlePreview('design_back', 'design-back-preview', 'design-back-placeholder');
        });
    </script>
    @endpush
</x-admin-layout>
