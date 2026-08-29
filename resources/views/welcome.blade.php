<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Visual Configurator - Platform Personalisasi Pakaian Custom</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Tailwind CSS Play CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Plus Jakarta Sans', 'sans-serif'],
                            outfit: ['Outfit', 'sans-serif'],
                        },
                    }
                }
            }
        </script>
        <style>
            .glow-blue {
                box-shadow: 0 0 50px -12px rgba(37, 99, 235, 0.2);
            }
            .glow-cyan {
                box-shadow: 0 0 50px -12px rgba(6, 182, 212, 0.2);
            }
        </style>
    </head>
    <body class="bg-white text-gray-900 font-sans antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden">

        {{-- Background Gradient Blobs --}}
        <div class="absolute inset-0 overflow-hidden -z-10 pointer-events-none">
            <div class="absolute -top-24 left-1/4 w-[650px] h-[650px] bg-sky-400/15 rounded-full blur-[180px]"></div>
            <div class="absolute top-1/3 -right-20 w-[700px] h-[700px] bg-blue-600/10 rounded-full blur-[200px]"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-cyan-500/10 rounded-full blur-[150px]"></div>
        </div>

        {{-- Navbar: Logo | Beranda | Fitur Utama | Cara Kerja | Masuk | Buat Akun --}}
        <nav class="border-b border-gray-200/80 bg-white/80 backdrop-blur-md sticky top-0 z-50 transition-all duration-300 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

                {{-- Logo --}}
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>

                    <span class="font-outfit font-extrabold text-xl tracking-tight text-gray-900">
                        Visual Configurator
                    </span>
                </a>

                {{-- Navigation: Beranda | Fitur Utama | Cara Kerja --}}
                <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-700">
                    <a href="#" class="hover:text-blue-600 transition-colors">
                        Beranda
                    </a>
                    <a href="#features" class="hover:text-blue-600 transition-colors">
                        Fitur Utama
                    </a>
                    <a href="#how-it-works" class="hover:text-blue-600 transition-colors">
                        Cara Kerja
                    </a>
                </div>

                {{-- Navigation Right: Masuk | Buat Akun --}}
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ auth()->user()->role === 'admin' ? url('/admin/dashboard') : url('/dashboard') }}"
                                class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-900 text-sm font-semibold transition-all duration-200 border border-gray-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors">
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition-all duration-200 hover:-translate-y-0.5">
                                    Buat Akun
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

            </div>
        </nav>

        {{-- Hero Section --}}
        <section id="hero" class="max-w-7xl mx-auto px-6 pt-16 pb-20 text-center md:pt-24 md:pb-28 relative">
            <div class="max-w-4xl mx-auto space-y-6">
                
                {{-- Judul --}}
                <h1 class="font-outfit text-4xl sm:text-6xl font-extrabold tracking-tight text-gray-900 leading-tight">
                    Personalisasi Pakaian Custom Anda
                    <br class="hidden sm:inline">
                    <span class="bg-gradient-to-r from-blue-700 via-sky-500 to-cyan-400 bg-clip-text text-transparent drop-shadow-[0_4px_12px_rgba(37,99,235,0.25)]">
                        Dengan Visual Configurator Berbasis Web
                    </span>
                </h1>

                {{-- Deskripsi --}}
                <p class="text-gray-600 text-lg sm:text-xl max-w-3xl mx-auto font-normal leading-relaxed">
                    Rancang dan sesuaikan pakaian custom Anda secara interaktif. Dapatkan rekomendasi desain otomatis berbasis kustomisasi Anda dan unduh hasil akhir siap cetak.
                </p>

                {{-- Tombol "Mulai Desain" --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-4">
                    <a href="{{ route('designs.create') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white font-bold rounded-xl shadow-xl shadow-blue-500/20 hover:shadow-blue-500/35 transition-all duration-300 hover:-translate-y-0.5 text-center flex items-center justify-center gap-2 text-base">
                        Mulai Desain
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Visual Showcase Preview --}}
            <div class="mt-16 relative max-w-5xl mx-auto rounded-3xl border border-gray-200/80 bg-white/40 p-4 md:p-6 shadow-2xl overflow-hidden glow-blue backdrop-blur-md transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-b from-blue-600/5 to-transparent -z-10 rounded-3xl"></div>
                <div class="flex items-center gap-2 pb-4 mb-4 border-b border-gray-200/80">
                    <span class="w-3.5 h-3.5 rounded-full bg-rose-500 shadow-sm shadow-rose-500/30"></span>
                    <span class="w-3.5 h-3.5 rounded-full bg-amber-500 shadow-sm shadow-amber-500/30"></span>
                    <span class="w-3.5 h-3.5 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/30"></span>
                    <span class="text-xs text-gray-500 font-semibold pl-2 tracking-wide font-outfit">Visual Configurator Workspace</span>
                </div>
                
                {{-- Main Mock Workspace Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 bg-white/95 rounded-2xl p-6 text-left border border-gray-100 shadow-sm">
                    {{-- Left panel mockup --}}
                    <div class="lg:col-span-3 space-y-4">
                        <div class="p-4 bg-slate-50/50 rounded-xl space-y-2 border border-slate-100 shadow-sm">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tab Aktif</p>
                            <div class="flex gap-2 text-xs">
                                <span class="flex-1 py-1.5 bg-blue-600 rounded-lg text-white font-bold text-center shadow-sm">✨ Elemen</span>
                                <span class="flex-1 py-1.5 bg-slate-100/80 rounded-lg text-slate-600 text-center font-medium">💡 Rekomendasi</span>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50/50 rounded-xl space-y-3 border border-slate-100 shadow-sm">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kustomisasi Teks</p>
                            <input type="text" value="GARUDA FC" readonly class="w-full bg-white border border-slate-200 rounded-lg py-2 px-3 text-xs font-semibold text-slate-800 focus:outline-none">
                            <div class="flex gap-2 justify-start items-center">
                                <span class="w-6 h-6 rounded-full bg-rose-600 cursor-pointer shadow-inner"></span>
                                <span class="w-6 h-6 rounded-full bg-blue-600 cursor-pointer shadow-inner"></span>
                                <span class="w-6 h-6 rounded-full bg-amber-500 cursor-pointer shadow-inner"></span>
                                <span class="w-6 h-6 border border-slate-200 rounded-full bg-white cursor-pointer shadow-inner"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Center Canvas mockup --}}
                    <div class="lg:col-span-6 bg-slate-50/30 border border-slate-100 rounded-2xl h-[360px] flex items-center justify-center p-6 relative overflow-hidden shadow-inner">
                        <div class="absolute inset-0 bg-gradient-to-tr from-slate-200/20 to-transparent"></div>
                        
                        {{-- Mock T-shirt --}}
                        <div class="relative w-72 h-72 flex items-center justify-center">
                            <img src="/mockups/front.png" class="w-full h-full object-contain brightness-95 contrast-105 filter drop-shadow-2xl" alt="T-Shirt Mockup">
                            
                            {{-- Overlay custom graphic --}}
                            <div class="absolute inset-0 flex items-center justify-center p-12">
                                <div class="w-32 h-32 border-2 border-dashed border-blue-600/80 rounded-lg flex flex-col items-center justify-center p-2 relative bg-blue-50/20 backdrop-blur-[1px]">
                                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-blue-600 text-[8px] px-1.5 py-0.5 rounded font-bold text-white uppercase tracking-wider shadow-sm">Selected</div>
                                    <img src="/templates/minimalis.png" class="w-16 h-16 object-contain" alt="Custom Graphic">
                                    <span class="text-[10px] font-extrabold text-blue-600 mt-2 uppercase tracking-wider">GARUDA FC</span>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Perspective side toggle helper --}}
                        <div class="absolute bottom-4 right-4 flex gap-1 bg-white p-1 rounded-lg border border-slate-200/80 text-[10px] shadow-sm">
                            <span class="px-2.5 py-1 bg-blue-600 text-white rounded font-bold">Depan</span>
                            <span class="px-2.5 py-1 text-slate-600 font-semibold">Belakang</span>
                        </div>
                    </div>

                    {{-- Right Object inspector mockup --}}
                    <div class="lg:col-span-3 space-y-4">
                        <div class="p-4 bg-slate-50/50 rounded-xl space-y-3 border border-slate-100 shadow-sm">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Urutan Layer</p>
                            <div class="space-y-2">
                                <div class="p-2.5 bg-white rounded-lg border border-slate-200/80 text-xs flex justify-between items-center hover:bg-slate-50 transition-colors cursor-pointer shadow-sm">
                                    <span class="text-slate-600 font-semibold">⬆️ Bawa Ke Depan</span>
                                </div>
                                <div class="p-2.5 bg-white rounded-lg border border-slate-200/80 text-xs flex justify-between items-center hover:bg-slate-50 transition-colors cursor-pointer shadow-sm">
                                    <span class="text-slate-600 font-semibold">⬇️ Kirim Ke Belakang</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-blue-50/60 border border-blue-100 rounded-xl shadow-sm">
                            <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mb-1">Status Sistem</p>
                            <p class="text-xs text-blue-800 leading-normal font-medium">Semua aset desain dikompresi & siap diekspor dalam resolusi tinggi transparan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Fitur Utama Section --}}
        <section id="features" class="border-t border-slate-100 bg-slate-50/50 py-24 relative">
            <div class="max-w-7xl mx-auto px-6 space-y-16">
                {{-- Header --}}
                <div class="text-center max-w-2xl mx-auto space-y-4">
                    <h2 class="font-outfit text-3xl sm:text-4xl font-extrabold text-gray-900">
                        Fitur Utama
                    </h2>
                    <p class="text-slate-600 text-base leading-relaxed">
                        Fitur unggulan yang memudahkan proses pembuatan dan personalisasi desain pakaian Anda.
                    </p>
                </div>

                {{-- Feature Cards (3 items requested: Visual Configurator, Rekomendasi Desain, Export PNG) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- 1. Visual Configurator --}}
                    <div class="group bg-white hover:bg-slate-50/80 border border-slate-200/80 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 shadow-sm hover:shadow-blue-500/10 hover:border-blue-200 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 bg-blue-600/10 rounded-2xl flex items-center justify-center mb-6 border border-blue-600/20 group-hover:bg-blue-600 group-hover:text-white text-blue-600 transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </div>
                            <h3 class="font-outfit font-bold text-xl text-gray-900 mb-3">Visual Configurator</h3>
                            <p class="text-slate-600 text-sm leading-relaxed font-medium">
                                Mengatur posisi, ukuran, rotasi, dan penempatan elemen desain secara interaktif pada mockup pakaian 2-sisi (depan & belakang).
                            </p>
                        </div>
                    </div>

                    {{-- 2. Rekomendasi Desain --}}
                    <div class="group bg-white hover:bg-slate-50/80 border border-slate-200/80 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 shadow-sm hover:shadow-cyan-500/10 hover:border-cyan-200 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 bg-cyan-500/10 rounded-2xl flex items-center justify-center mb-6 border border-cyan-500/20 group-hover:bg-cyan-500 group-hover:text-white text-cyan-500 transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 01-2 2h-0a2 2 0 01-2-2v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <h3 class="font-outfit font-bold text-xl text-gray-900 mb-3">Rekomendasi Desain</h3>
                            <p class="text-slate-600 text-sm leading-relaxed font-medium">
                                Mendapatkan rekomendasi desain dan template secara otomatis berbasis atribut kategori, tema, dan warna pilihan Anda.
                            </p>
                        </div>
                    </div>

                    {{-- 3. Export PNG --}}
                    <div class="group bg-white hover:bg-slate-50/80 border border-slate-200/80 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 shadow-sm hover:shadow-emerald-500/10 hover:border-emerald-200 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center mb-6 border border-emerald-500/20 group-hover:bg-emerald-500 group-hover:text-white text-emerald-500 transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </div>
                            <h3 class="font-outfit font-bold text-xl text-gray-900 mb-3">Export PNG</h3>
                            <p class="text-slate-600 text-sm leading-relaxed font-medium">
                                Mengekspor hasil akhir desain dalam format file PNG transparan beresolusi tinggi yang siap digunakan untuk proses cetak DTF.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Cara Kerja Section --}}
        <section id="how-it-works" class="bg-white py-24 border-t border-slate-100 relative">
            <div class="max-w-7xl mx-auto px-6 space-y-16">
                <div class="text-center max-w-2xl mx-auto space-y-4">
                    <h2 class="font-outfit text-3xl sm:text-4xl font-extrabold text-gray-900">
                        Cara Kerja
                    </h2>
                    <p class="text-slate-600 text-base leading-relaxed">
                        Langkah-langkah sederhana untuk membuat desain pakaian custom hingga siap diekspor.
                    </p>
                </div>

                {{-- 4 Steps requested: Pilih Produk, Kustomisasi Desain, Dapatkan Rekomendasi, Simpan / Export --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    {{-- Step 1: Pilih Produk --}}
                    <div class="relative space-y-4 p-6 bg-slate-50/60 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:bg-white transition-all duration-300">
                        <div class="text-5xl font-extrabold font-outfit text-blue-600/25">01</div>
                        <h4 class="font-bold text-gray-900 text-lg">Pilih Produk</h4>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium">Pilih jenis produk pakaian custom yang ingin Anda personalisasikan.</p>
                    </div>

                    {{-- Step 2: Kustomisasi Desain --}}
                    <div class="relative space-y-4 p-6 bg-slate-50/60 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:bg-white transition-all duration-300">
                        <div class="text-5xl font-extrabold font-outfit text-cyan-500/25">02</div>
                        <h4 class="font-bold text-gray-900 text-lg">Kustomisasi Desain</h4>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium">Atur warna, pola motif, teks, dan tata letak secara visual pada canvas interaktif.</p>
                    </div>

                    {{-- Step 3: Dapatkan Rekomendasi --}}
                    <div class="relative space-y-4 p-6 bg-slate-50/60 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:bg-white transition-all duration-300">
                        <div class="text-5xl font-extrabold font-outfit text-sky-400/25">03</div>
                        <h4 class="font-bold text-gray-900 text-lg">Dapatkan Rekomendasi</h4>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium">Temukan rekomendasi desain terbaik yang disesuaikan dengan preferensi Anda.</p>
                    </div>

                    {{-- Step 4: Simpan / Export --}}
                    <div class="relative space-y-4 p-6 bg-slate-50/60 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:bg-white transition-all duration-300">
                        <div class="text-5xl font-extrabold font-outfit text-blue-600/25">04</div>
                        <h4 class="font-bold text-gray-900 text-lg">Simpan / Export</h4>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium">Simpan hasil desain ke akun Anda dan ekspor file PNG transparan beresolusi tinggi.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="max-w-7xl mx-auto px-6 py-20">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 via-sky-600 to-cyan-500 p-10 md:p-16 text-center text-white shadow-2xl glow-blue">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-cyan-400/20 rounded-full blur-2xl"></div>
                
                <div class="max-w-3xl mx-auto space-y-6 relative z-10">
                    <h2 class="font-outfit text-3xl md:text-5xl font-extrabold text-white leading-tight">
                        Siap Mewujudkan Desain Pakaian Anda?
                    </h2>
                    <p class="text-blue-50 text-base md:text-lg font-medium max-w-2xl mx-auto leading-relaxed">
                        Mulai rancang pakaian custom impian Anda sekarang juga menggunakan Visual Configurator interaktif dan rekomendasi desain cerdas.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('designs.create') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-white hover:bg-slate-100 text-blue-600 font-extrabold rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-0.5 text-base">
                            Mulai Desain Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="border-t border-slate-200/80 bg-slate-50/80 py-12 text-slate-500 text-sm">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
                <div class="space-y-2 max-w-lg">
                    <p class="font-bold text-slate-800 text-base">Visual Configurator</p>
                    <p class="text-slate-600 font-semibold text-xs leading-normal">
                        Visual Configurator untuk Personalisasi Desain Pakaian Custom
                    </p>
                    <p class="text-slate-500 text-xs leading-relaxed">
                        Platform berbasis web yang membantu pengguna merancang desain pakaian custom secara interaktif melalui Visual Configurator dan rekomendasi template menggunakan metode Content-Based Filtering.
                    </p>
                </div>
                <div class="flex flex-col items-center md:items-end gap-3 text-xs">
                    <div class="flex gap-6 font-semibold text-slate-600">
                        <a href="#" class="hover:text-blue-600 transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-blue-600 transition-colors">Terms of Use</a>
                        <a href="mailto:support@willykonveksi.com" class="hover:text-blue-600 transition-colors">Hubungi Kami</a>
                    </div>
                    <p class="text-slate-400 text-[11px] mt-2 font-medium">Konveksi Willy &copy; {{ date('Y') }}</p>
                </div>
            </div>
        </footer>

    </body>
</html>
