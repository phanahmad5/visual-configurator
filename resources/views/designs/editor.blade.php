<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 sm:gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="text-slate-500 hover:text-slate-700 transition-colors p-1.5 bg-slate-100 hover:bg-slate-200 rounded-xl shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="flex-1 min-w-0">
                    <input type="text" id="designNameInput" value="{{ $design ? $design->name : 'Desain Tanpa Nama' }}" 
                           class="text-base sm:text-lg font-bold text-slate-800 bg-transparent border-b border-transparent hover:border-slate-300 focus:border-indigo-500 focus:ring-0 px-1 py-0.5 rounded transition-all w-full max-w-[160px] xs:max-w-[200px] sm:max-w-md truncate"
                           placeholder="Masukkan nama desain..." required>
                    <p class="text-[10px] text-slate-400 mt-0.5 flex items-center gap-1" id="savedStatus">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Semua perubahan siap disimpan
                    </p>
                </div>
            </div>
            
            <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap justify-end">
                <!-- Dropdown Ekspor PNG (300 DPI & DTF) -->
                <div class="relative inline-block text-left" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all">
                        <span>📥 Ekspor </span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 rounded-2xl bg-white shadow-2xl ring-1 ring-black/5 z-50 py-1.5 divide-y divide-slate-100" style="display: none;">
                        <!-- Siap Cetak DTF -->
                        <div class="p-1.5">
                            <div class="px-2.5 py-1 text-[10px] font-extrabold text-emerald-700 bg-emerald-50 rounded-lg flex items-center gap-1.5 mb-1.5">
                                <span>🎯</span> SIAP CETAK DTF (300 DPI)
                            </div>
                            <button type="button" id="exportDTFFrontBtn" class="w-full text-left px-3 py-2 text-xs text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 rounded-xl flex items-center justify-between font-semibold transition-all">
                                <span class="flex items-center gap-2">👕 DTF Sisi Depan</span>
                                <span class="text-[9px] font-bold text-emerald-700 bg-emerald-100/80 px-1.5 py-0.5 rounded-md">Transparan</span>
                            </button>
                            <button type="button" id="exportDTFBackBtn" class="w-full text-left px-3 py-2 text-xs text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 rounded-xl flex items-center justify-between font-semibold transition-all">
                                <span class="flex items-center gap-2">👕 DTF Sisi Belakang</span>
                                <span class="text-[9px] font-bold text-emerald-700 bg-emerald-100/80 px-1.5 py-0.5 rounded-md">Transparan</span>
                            </button>
                        </div>
                        <!-- Mockup Visual -->
                        <div class="p-1.5">
                            <div class="px-2.5 py-1 text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-1">
                                🖼️ Mockup Baju (300 DPI HD)
                            </div>
                            <button type="button" id="exportPNGFrontBtn" class="w-full text-left px-3 py-1.5 text-xs text-slate-700 hover:bg-slate-50 rounded-xl flex items-center justify-between font-medium transition-all">
                                <span>👕 Mockup Depan</span>
                                <span class="text-[10px] text-slate-400 font-mono">300 DPI</span>
                            </button>
                            <button type="button" id="exportPNGBackBtn" class="w-full text-left px-3 py-1.5 text-xs text-slate-700 hover:bg-slate-50 rounded-xl flex items-center justify-between font-medium transition-all">
                                <span>👕 Mockup Belakang</span>
                                <span class="text-[10px] text-slate-400 font-mono">300 DPI</span>
                            </button>
                            <button type="button" id="exportPNGCombinedBtn" class="w-full text-left px-3 py-1.5 text-xs text-slate-900 hover:bg-indigo-50 hover:text-indigo-700 rounded-xl flex items-center justify-between font-bold transition-all mt-0.5">
                                <span>✨ Mockup Depan + Belakang</span>
                                <span class="text-[10px] text-indigo-600 font-bold bg-indigo-50 px-1.5 py-0.5 rounded-md">Ultra HD</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Dropdown Ekspor SVG -->
                <div class="relative inline-block text-left" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all">
                        <span>📐 SVG</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-2xl bg-white shadow-2xl ring-1 ring-black/5 z-50 py-1.5" style="display: none;">
                        <button type="button" id="exportSVGFrontBtn" class="w-full text-left px-4 py-2 text-xs text-slate-700 hover:bg-teal-50 hover:text-teal-800 rounded-xl flex items-center gap-2 font-semibold transition-all">📐 Vector Depan</button>
                        <button type="button" id="exportSVGBackBtn" class="w-full text-left px-4 py-2 text-xs text-slate-700 hover:bg-teal-50 hover:text-teal-800 rounded-xl flex items-center gap-2 font-semibold transition-all">📐 Vector Belakang</button>
                    </div>
                </div>

                <button type="button" id="saveBtn" class="inline-flex items-center gap-1.5 sm:gap-2 px-3.5 sm:px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-100 hover:shadow-lg transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    <span>Simpan</span>
                </button>
            </div>
        </div>
    </x-slot>

    @push('styles')
    <!-- Premium Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Anton&family=Archivo+Black&family=Bebas+Neue&family=Black+Ops+One&family=Bungee&family=Cinzel&family=Inter:wght@400;600;800&family=Kaushan+Script&family=League+Spartan:wght@400;700&family=Montserrat:wght@400;700&family=Orbitron:wght@400;700&family=Oswald:wght@400;700&family=Permanent+Marker&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@400;600;700&family=Rye&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'Jersey M54';
            font-style: normal;
            font-weight: 400;
            src: local('Jersey M54'), url('https://fonts.cdnfonts.com/s/2139/Jersey M54.woff') format('woff');
        }
        @font-face {
            font-family: 'Varsity';
            font-style: normal;
            font-weight: 400;
            src: local('Varsity Regular'), url('https://fonts.cdnfonts.com/s/2121/varsity_regular.woff') format('woff');
        }
        @font-face {
            font-family: 'Brusher';
            font-style: normal;
            font-weight: 400;
            src: local('brusher'), url('https://fonts.cdnfonts.com/s/30879/Brusher.woff') format('woff');
        }

        .studio-grid {
            background-color: #f8fafc;
            background-image: radial-gradient(#cbd5e1 1.2px, transparent 1.2px), radial-gradient(#cbd5e1 1.2px, #f8fafc 1.2px);
            background-size: 24px 24px;
            background-position: 0 0, 12px 12px;
        }

        .canvas-container {
            margin: 0 auto !important;
            box-shadow: 0 10px 25px -5px rgb(0 0 0 / 0.05), 0 8px 10px -6px rgb(0 0 0 / 0.05);
            border-radius: 1rem;
            overflow: hidden;
            background: white;
            transition: all 0.2s ease;
        }

        /* Collapsible elements transition */
        .sidebar-transition {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Hide scrollbars but keep scroll function */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .shirt-color-btn {
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 9999px;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.2s ease;
            outline: none;
        }
        .shirt-color-btn:hover {
            transform: scale(1.15);
        }

        #motifGrid button {
            aspect-ratio: 1 / 1;
            width: 100%;
            height: auto;
            padding: 0.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            transition: all 0.2s;
            overflow: hidden;
        }
        #motifGrid button:hover {
            border-color: #6366f1;
            background-color: #f1f5f9;
        }
        #motifGrid button img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.2s;
        }
        #motifGrid button:hover img {
            transform: scale(1.08);
        }

        #patternGrid button {
            aspect-ratio: 1 / 1;
            width: 100%;
            height: auto;
            padding: 0.375rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            transition: all 0.2s;
            overflow: hidden;
        }
        #patternGrid button:hover {
            border-color: #6366f1;
            background-color: #f1f5f9;
        }
        #patternGrid button canvas {
            max-width: 100%;
            max-height: 1.75rem;
            display: block;
        }
    </style>
    @endpush

    <!-- Parent container to control full-screen layout -->
    <div class="h-[calc(100vh-105px)] sm:h-[calc(100vh-125px)] lg:h-[calc(100vh-135px)] flex overflow-hidden bg-slate-100 select-none relative" x-data="{ leftOpen: window.innerWidth >= 1024, rightOpen: window.innerWidth >= 1024, mobileView: 'front' }">
        
        <!-- Mobile Backdrop Overlay Kiri -->
        <div x-show="leftOpen" 
             @click="leftOpen = false" 
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 lg:hidden" 
             style="display: none;"></div>

        <!-- SIDEBAR KIRI: ELEMEN & REKOMENDASI -->
        <div x-show="leftOpen"
             x-transition:enter="transition ease-out duration-200 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-150 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed lg:relative inset-y-0 left-0 z-50 w-80 max-w-[85vw] bg-white border-r border-slate-200 flex flex-col h-full shadow-2xl lg:shadow-none shrink-0"
             style="display: none;">
            <div class="p-4 flex flex-col gap-4 h-full overflow-hidden w-full bg-white">
                <!-- Tab Menu (Elemen vs Rekomendasi) -->
                <div class="flex items-center justify-between border-b border-slate-100 pb-2 shrink-0">
                    <div class="flex gap-2 flex-1">
                        <button id="tabElements" class="flex-1 pb-2 text-xs font-bold border-b-2 border-indigo-600 text-indigo-600 transition-all text-center">
                            ✨ Elemen
                        </button>
                        <button id="tabRecommendations" class="flex-1 pb-2 text-xs font-bold border-b-2 border-transparent text-slate-400 hover:text-slate-700 transition-all text-center">
                            💡 Rekomendasi
                        </button>
                    </div>
                    <button @click="leftOpen = false" class="lg:hidden p-1 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-100 transition-colors ml-2" title="Tutup">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- SECTION 1: ELEMEN (CATEGORIZED SUB-TABS) -->
                <div id="elementsSection" class="flex-1 flex flex-col gap-4 overflow-hidden">
                    <!-- Pills Category Switcher -->
                    <div class="flex p-1 bg-slate-100 rounded-xl gap-0.5 shrink-0 overflow-x-auto no-scrollbar">
                        <button type="button" data-subtab="produk" class="subtab-btn flex-1 py-1.5 px-2 text-[10px] font-bold rounded-lg text-center transition-all bg-white text-indigo-600 shadow-sm whitespace-nowrap">
                            Produk
                        </button>
                        <button type="button" data-subtab="teks" class="subtab-btn flex-1 py-1.5 px-2 text-[10px] font-bold rounded-lg text-center transition-all text-slate-500 hover:text-slate-800 whitespace-nowrap">
                            Teks
                        </button>
                        <button type="button" data-subtab="gambar" class="subtab-btn flex-1 py-1.5 px-2 text-[10px] font-bold rounded-lg text-center transition-all text-slate-500 hover:text-slate-800 whitespace-nowrap">
                            Gambar
                        </button>
                        <button type="button" data-subtab="motif" class="subtab-btn flex-1 py-1.5 px-2 text-[10px] font-bold rounded-lg text-center transition-all text-slate-500 hover:text-slate-800 whitespace-nowrap">
                            Motif
                        </button>
                        <button type="button" data-subtab="pola" class="subtab-btn flex-1 py-1.5 px-2 text-[10px] font-bold rounded-lg text-center transition-all text-slate-500 hover:text-slate-800 whitespace-nowrap">
                            Bentuk
                        </button>
                    </div>

                    <!-- Sub-tabs Content container -->
                    <div class="flex-1 overflow-y-auto pr-0.5 space-y-4 no-scrollbar">
                        <!-- Subtab: Produk -->
                        <div id="subtabContentProduk" class="subtab-content flex flex-col gap-4">
                            <div>
                                <h3 class="font-bold text-slate-800 text-xs mb-1.5 uppercase tracking-wider">Pilih Jenis Model</h3>
                                <div class="flex flex-col gap-2">
                                    <label class="flex items-center gap-3 p-3 bg-slate-50 hover:bg-slate-100 rounded-xl cursor-pointer border border-slate-200 transition-all">
                                        <input type="radio" name="product_model" value="tshirt" checked class="text-indigo-600 focus:ring-indigo-500">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-slate-800">Kaos Polos (SVG)</span>
                                            <span class="text-[9px] text-slate-400">Mockup Kaos SVG bersih mudah diwarnai</span>
                                        </div>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 bg-slate-50 hover:bg-slate-100 rounded-xl cursor-pointer border border-slate-200 transition-all">
                                        <input type="radio" name="product_model" value="jersey" class="text-indigo-600 focus:ring-indigo-500">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-slate-800">Jersey Sport (SVG)</span>
                                            <span class="text-[9px] text-slate-400">Mockup Jersey kerah & strip aksen</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <hr class="border-slate-100">

                            <!-- Warna Kaos (T-shirt mode) -->
                            <div id="tshirtColorSection" class="flex flex-col gap-3">
                                <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider">Pilihan Warna Kaos</h3>
                                <div class="grid grid-cols-6 gap-2">
                                    <button type="button" class="shirt-color-btn bg-white" data-color="putih" title="Putih"></button>
                                    <button type="button" class="shirt-color-btn bg-slate-800" data-color="hitam" title="Hitam"></button>
                                    <button type="button" class="shirt-color-btn bg-slate-400" data-color="abu-abu" title="Abu-abu"></button>
                                    <button type="button" class="shirt-color-btn bg-rose-600" data-color="merah" title="Merah"></button>
                                    <button type="button" class="shirt-color-btn bg-rose-950" data-color="marun" title="Marun"></button>
                                    <button type="button" class="shirt-color-btn bg-blue-900" data-color="navy" title="Navy"></button>
                                    <button type="button" class="shirt-color-btn bg-blue-600" data-color="biru" title="Biru"></button>
                                    <button type="button" class="shirt-color-btn bg-emerald-600" data-color="hijau" title="Hijau"></button>
                                    <button type="button" class="shirt-color-btn bg-emerald-950" data-color="army" title="Hijau Army"></button>
                                    <button type="button" class="shirt-color-btn bg-amber-500" data-color="kuning" title="Kuning"></button>
                                    <button type="button" class="shirt-color-btn bg-orange-600" data-color="oranye" title="Oranye"></button>
                                    <button type="button" class="shirt-color-btn bg-violet-600" data-color="ungu" title="Ungu"></button>
                                </div>
                                <div class="flex items-center gap-3 bg-slate-50 p-2.5 rounded-xl border border-slate-200 mt-2">
                                    <span class="text-[9px] font-bold text-slate-400 uppercase">Custom HEX:</span>
                                    <input type="color" id="customColorPicker" value="#ffffff" class="w-8 h-8 border-0 rounded-lg cursor-pointer p-0 bg-transparent">
                                    <input type="text" id="customColorHex" value="#FFFFFF" class="w-20 text-xs border-slate-200 rounded-lg py-1 px-2 uppercase focus:ring-0 focus:border-indigo-500 font-mono">
                                </div>
                            </div>

                            <!-- Warna Jersey (Jersey mode) -->
                            <div id="jerseyColorSection" class="hidden flex-col gap-3">
                                <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider">Kustomisasi Jersey</h3>

                                <!-- Pilih Bentuk Kerah -->
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Bentuk Kerah</label>
                                    <div class="grid grid-cols-5 gap-1">
                                        <button type="button" data-collar="oneck" class="collar-btn flex flex-col items-center gap-0.5 p-1.5 bg-white border-2 border-indigo-500 rounded-xl transition-all hover:shadow-sm" title="O-Neck (Crew Neck)">
                                            <svg viewBox="0 0 48 36" class="w-full h-5">
                                                <path d="M 8,14 Q 24,28 40,14" stroke="currentColor" stroke-width="2.5" fill="none" opacity="0.6"/>
                                                <path d="M 8,14 Q 24,24 40,14 L 43,10 Q 24,22 5,10 Z" fill="currentColor" opacity="0.3"/>
                                            </svg>
                                            <span class="text-[7px] font-bold text-slate-500 leading-tight">O-Neck</span>
                                        </button>
                                        <button type="button" data-collar="vneck" class="collar-btn flex flex-col items-center gap-0.5 p-1.5 bg-white border-2 border-slate-200 rounded-xl transition-all hover:shadow-sm hover:border-slate-300" title="V-Neck">
                                            <svg viewBox="0 0 48 36" class="w-full h-5">
                                                <path d="M 8,12 L 24,30 L 40,12" stroke="currentColor" stroke-width="2.5" fill="none" opacity="0.6"/>
                                                <path d="M 8,12 L 24,30 L 40,12 L 43,8 Q 24,28 5,8 Z" fill="currentColor" opacity="0.3"/>
                                            </svg>
                                            <span class="text-[7px] font-bold text-slate-500 leading-tight">V-Neck</span>
                                        </button>
                                        <button type="button" data-collar="polo" class="collar-btn flex flex-col items-center gap-0.5 p-1.5 bg-white border-2 border-slate-200 rounded-xl transition-all hover:shadow-sm hover:border-slate-300" title="Polo">
                                            <svg viewBox="0 0 48 36" class="w-full h-5">
                                                <path d="M 8,16 Q 24,24 40,16" stroke="currentColor" stroke-width="2" fill="none" opacity="0.5"/>
                                                <path d="M 18,14 L 10,6 L 12,10 L 20,18 Z" fill="currentColor" opacity="0.4"/>
                                                <path d="M 30,14 L 38,6 L 36,10 L 28,18 Z" fill="currentColor" opacity="0.4"/>
                                                <rect x="22" y="17" width="4" height="14" rx="0.5" fill="currentColor" opacity="0.2"/>
                                                <circle cx="24" cy="22" r="1.2" fill="currentColor" opacity="0.5"/>
                                                <circle cx="24" cy="28" r="1.2" fill="currentColor" opacity="0.5"/>
                                            </svg>
                                            <span class="text-[7px] font-bold text-slate-500 leading-tight">Polo</span>
                                        </button>
                                        
                                        <button type="button" data-collar="henley" class="collar-btn flex flex-col items-center gap-0.5 p-1.5 bg-white border-2 border-slate-200 rounded-xl transition-all hover:shadow-sm hover:border-slate-300" title="Henley">
                                            <svg viewBox="0 0 48 36" class="w-full h-5">
                                                <path d="M 8,14 Q 24,28 40,14" stroke="currentColor" stroke-width="2.5" fill="none" opacity="0.6"/>
                                                <path d="M 8,14 Q 24,24 40,14 L 43,10 Q 24,22 5,10 Z" fill="currentColor" opacity="0.3"/>
                                                <rect x="22" y="20" width="4" height="12" rx="0.5" fill="currentColor" opacity="0.2"/>
                                                <circle cx="24" cy="24" r="1" fill="currentColor" opacity="0.5"/>
                                                <circle cx="24" cy="28" r="1" fill="currentColor" opacity="0.5"/>
                                                <circle cx="24" cy="32" r="1" fill="currentColor" opacity="0.5"/>
                                            </svg>
                                            <span class="text-[7px] font-bold text-slate-500 leading-tight">Henley</span>
                                        </button>
                                    </div>
                                </div>
<!--warna kaos-->
                                <div class="space-y-3">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">1. Warna Badan (Body)</label>
                                        <div class="flex items-center gap-2.5">
                                            <div class="relative w-9 h-9 rounded-xl border border-slate-300 shadow-2xs overflow-hidden shrink-0 cursor-pointer hover:border-indigo-500 transition-colors bg-white">
                                                <input type="color" id="inputJerseyBgColor" value="#ffffff" class="absolute -top-2 -left-2 w-14 h-14 border-0 cursor-pointer p-0 bg-transparent">
                                            </div>
                                            <input type="text" id="hexJerseyBgColor" value="#FFFFFF" class="flex-1 text-xs border border-slate-200 rounded-xl uppercase py-2 px-3 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-mono font-bold text-slate-700 bg-white">
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">2. Warna Kerah (Collar)</label>
                                        <div class="flex items-center gap-2.5">
                                            <div class="relative w-9 h-9 rounded-xl border border-slate-300 shadow-2xs overflow-hidden shrink-0 cursor-pointer hover:border-indigo-500 transition-colors bg-white">
                                                <input type="color" id="inputJerseyCollarColor" value="#ffffff" class="absolute -top-2 -left-2 w-14 h-14 border-0 cursor-pointer p-0 bg-transparent">
                                            </div>
                                            <input type="text" id="hexJerseyCollarColor" value="#FFFFFF" class="flex-1 text-xs border border-slate-200 rounded-xl uppercase py-2 px-3 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-mono font-bold text-slate-700 bg-white">
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">3. Warna Aksen (Accent)</label>
                                        <div class="flex items-center gap-2.5">
                                            <div class="relative w-9 h-9 rounded-xl border border-slate-300 shadow-2xs overflow-hidden shrink-0 cursor-pointer hover:border-indigo-500 transition-colors bg-white">
                                                <input type="color" id="inputJerseyAccentColor" value="#ffffff" class="absolute -top-2 -left-2 w-14 h-14 border-0 cursor-pointer p-0 bg-transparent">
                                            </div>
                                            <input type="text" id="hexJerseyAccentColor" value="#FFFFFF" class="flex-1 text-xs border border-slate-200 rounded-xl uppercase py-2 px-3 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-mono font-bold text-slate-700 bg-white">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subtab: Teks -->
                        <div id="subtabContentTeks" class="subtab-content hidden flex-col gap-3">
                            <h3 class="font-bold text-slate-800 text-xs mb-1.5 uppercase tracking-wider">Tambah Teks ke Canvas</h3>
                            <button id="addHeadingBtn" class="w-full py-3 px-4 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-left rounded-xl transition-all text-base font-bold text-slate-800">
                                Tambah Judul
                            </button>
                            <button id="addSubheadingBtn" class="w-full py-2.5 px-4 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-left rounded-xl transition-all text-sm font-semibold text-slate-700">
                                Tambah Subjudul
                            </button>
                            <button id="addBodyTextBtn" class="w-full py-2 px-4 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-left rounded-xl transition-all text-xs text-slate-600">
                                Tambah Teks Biasa
                            </button>
                        </div>

                        <!-- Subtab: Gambar -->
                        <div id="subtabContentGambar" class="subtab-content hidden flex-col gap-3">
                            <h3 class="font-bold text-slate-800 text-xs mb-1.5 uppercase tracking-wider">Unggah Gambar</h3>
                            <label class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 hover:border-indigo-500 rounded-2xl p-5 cursor-pointer bg-slate-50 hover:bg-indigo-50/10 transition-all group">
                                <svg class="w-8 h-8 text-slate-400 group-hover:text-indigo-600 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-bold text-slate-600 group-hover:text-indigo-600 transition-colors">Pilih File Gambar</span>
                                <span class="text-[9px] text-slate-400 mt-1">PNG, JPG, JPEG (maks. 5MB)</span>
                                <input type="file" id="imageUploadInput" class="hidden" accept="image/png, image/jpeg, image/jpg">
                            </label>
                        </div>

                        <!-- Subtab: Motif -->
                        <div id="subtabContentMotif" class="subtab-content hidden flex-col gap-3">
                            <h3 class="font-bold text-slate-800 text-xs mb-1 uppercase tracking-wider">Motif Kreatif</h3>

                            <!-- Mode Penerapan Motif -->
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-2.5 flex flex-col gap-1.5">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Mode Penerapan:</span>
                                <div class="flex p-0.5 bg-slate-200 rounded-lg gap-0.5">
                                    <button type="button" id="motifModePattern" class="flex-1 py-1.5 px-1.5 text-[10px] font-bold rounded-md transition-all bg-indigo-600 text-white shadow-sm" title="Motif memenuhi seluruh kaos mengikuti bentuknya">
                                        🎽 Isi Kaos
                                    </button>
                                    <button type="button" id="motifModeElement" class="flex-1 py-1.5 px-1.5 text-[10px] font-bold rounded-md transition-all text-slate-500 hover:text-slate-700" title="Tambahkan motif sebagai elemen bebas">
                                        🖼️ Elemen Bebas
                                    </button>
                                </div>
                                <p id="motifModeDesc" class="text-[9px] text-slate-400 leading-tight">Motif akan memenuhi & mengikuti bentuk siluet kaos.</p>
                            </div>

                            <div class="flex flex-wrap gap-1" id="motifCategoryFilters">
                                <button type="button" data-category="" class="motif-filter-btn px-2 py-0.5 text-[9px] font-bold rounded bg-indigo-600 text-white transition-all">Semua</button>
                                <button type="button" data-category="geometris" class="motif-filter-btn px-2 py-0.5 text-[9px] font-bold rounded bg-slate-100 text-slate-500 hover:bg-slate-200 transition-all capitalize">Geometris</button>
                                <button type="button" data-category="floral" class="motif-filter-btn px-2 py-0.5 text-[9px] font-bold rounded bg-slate-100 text-slate-500 hover:bg-slate-200 transition-all capitalize">Floral</button>
                                <button type="button" data-category="abstrak" class="motif-filter-btn px-2 py-0.5 text-[9px] font-bold rounded bg-slate-100 text-slate-500 hover:bg-slate-200 transition-all capitalize">Abstrak</button>
                                <button type="button" data-category="tribal" class="motif-filter-btn px-2 py-0.5 text-[9px] font-bold rounded bg-slate-100 text-slate-500 hover:bg-slate-200 transition-all capitalize">Tribal</button>
                                <button type="button" data-category="sporty" class="motif-filter-btn px-2 py-0.5 text-[9px] font-bold rounded bg-slate-100 text-slate-500 hover:bg-slate-200 transition-all capitalize">Sporty</button>
                            </div>
                            <div class="grid grid-cols-4 gap-2" id="motifGrid">
                                <div class="col-span-4 text-center py-4 text-[10px] text-slate-400">Memuat motif...</div>
                            </div>
                        </div>

                        <!-- Subtab: Pola (Bentuk) -->
                        <div id="subtabContentPola" class="subtab-content hidden flex-col gap-3">
                            <h3 class="font-bold text-slate-800 text-xs mb-1 uppercase tracking-wider">Pola Background</h3>
                            <div class="flex items-center gap-3 bg-slate-50 p-2.5 rounded-xl border border-slate-200 mb-2">
                                <span class="text-[9px] font-bold text-slate-400 uppercase">Warna Pola:</span>
                                <input type="color" id="patternColorInput" value="#374151" class="w-8 h-8 border-0 rounded-lg cursor-pointer p-0 bg-transparent">
                                <span id="patternColorVal" class="text-xs font-mono text-slate-600 uppercase font-bold">#374151</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2" id="patternGrid">
                                <button type="button" id="btnPatternStripes" title="Diagonal Stripes">
                                    <canvas id="canvasPatternStripes" class="w-8 h-8"></canvas>
                                    <span class="text-[8px] text-slate-500 mt-1 font-semibold">Stripes</span>
                                </button>
                                <button type="button" id="btnPatternHexagon" title="Hexagon Honeycomb">
                                    <canvas id="canvasPatternHexagon" class="w-8 h-8"></canvas>
                                    <span class="text-[8px] text-slate-500 mt-1 font-semibold">Hex</span>
                                </button>
                                <button type="button" id="btnPatternCross" title="Cross Matrix">
                                    <canvas id="canvasPatternCross" class="w-8 h-8"></canvas>
                                    <span class="text-[8px] text-slate-500 mt-1 font-semibold">Cross</span>
                                </button>
                                <button type="button" id="btnPatternDots" title="Polkadot Pattern">
                                    <canvas id="canvasPatternDots" class="w-8 h-8"></canvas>
                                    <span class="text-[8px] text-slate-500 mt-1 font-semibold">Dots</span>
                                </button>
                                <button type="button" id="btnPatternCheckered" title="Pola Catur">
                                    <canvas id="canvasPatternCheckered" class="w-8 h-8"></canvas>
                                    <span class="text-[8px] text-slate-500 mt-1 font-semibold">Catur</span>
                                </button>
                                <button type="button" id="btnPatternChevron" title="Pola Zigzag">
                                    <canvas id="canvasPatternChevron" class="w-8 h-8"></canvas>
                                    <span class="text-[8px] text-slate-500 mt-1 font-semibold">Chevron</span>
                                </button>
                                <button type="button" id="btnPatternWaves" title="Pola Gelombang">
                                    <canvas id="canvasPatternWaves" class="w-8 h-8"></canvas>
                                    <span class="text-[8px] text-slate-500 mt-1 font-semibold">Waves</span>
                                </button>
                                <button type="button" id="btnPatternGrid" title="Pola Kotak">
                                    <canvas id="canvasPatternGrid" class="w-8 h-8"></canvas>
                                    <span class="text-[8px] text-slate-500 mt-1 font-semibold">Grid</span>
                                </button>
                                <button type="button" id="btnPatternStars" title="Pola Bintang">
                                    <canvas id="canvasPatternStars" class="w-8 h-8"></canvas>
                                    <span class="text-[8px] text-slate-500 mt-1 font-semibold">Stars</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: REKOMENDASI (TEMPLATES SEARCH) -->
                <div id="recommendationsSection" class="hidden flex-1 flex-col gap-2.5 overflow-hidden">

                    <!-- Filter Form Card -->
                    <div id="recFilterCard" class="flex flex-col gap-2.5 shrink-0 bg-slate-50/90 p-3.5 rounded-2xl border border-slate-200 shadow-2xs transition-all duration-200">
                        <!-- Title & Description -->
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <span class="text-sm">💡</span>
                                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-wider">Rekomendasi Desain</h4>
                                </div>
                                <p class="text-[10px] text-slate-500 leading-relaxed">
                                    Pilih preferensi desain, lalu sistem akan mencari template paling sesuai.
                                </p>
                            </div>
                            <button type="button" id="closeRecFilterBtn" class="hidden text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-200 transition-colors" title="Sembunyikan Form">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <!-- 1. KATEGORI (Selectable Dropdown) -->
                        <div class="flex flex-col gap-1">
                            <label for="recCategory" class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Kategori Pakaian</label>
                            <div class="relative">
                                <select id="recCategory" class="w-full text-xs border-slate-200 rounded-xl py-2 px-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white font-semibold text-slate-700 appearance-none pr-8 cursor-pointer">
                                    <option value="kaos">👕 Kaos Polos</option>
                                    <option value="jersey">🎽 Jersey Sport</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>

                        <!-- 2. TEMA DESAIN (Dynamic Dropdown) -->
                        <div class="flex flex-col gap-1">
                            <label for="recTheme" class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Tema Desain</label>
                            <div class="relative">
                                <select id="recTheme" class="w-full text-xs border-slate-200 rounded-xl py-2 px-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white font-semibold text-slate-700 appearance-none pr-8 cursor-pointer">
                                    <option value="">-- Pilih Tema Desain --</option>
                                    @if(isset($themes) && count($themes) > 0)
                                        @foreach($themes as $themeItem)
                                            <option value="{{ strtolower($themeItem) }}">{{ ucfirst($themeItem) }}</option>
                                        @endforeach
                                    @else
                                        <option value="minimalis">Minimalis</option>
                                        <option value="retro">Retro</option>
                                        <option value="kasual">Kasual</option>
                                        <option value="sporty">Sporty</option>
                                        <option value="vintage">Vintage</option>
                                    @endif
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>

                        <!-- 3. WARNA (Pilihan Mandiri / Selectable Dropdown) -->
                        <div class="flex flex-col gap-1">
                            <label for="recColor" class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Pilih Warna Pakaian</label>
                            <div class="relative">
                                <select id="recColor" class="w-full text-xs border-slate-200 rounded-xl py-2 px-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white font-semibold text-slate-700 appearance-none pr-8 cursor-pointer">
                                    <option value="putih">⚪ Putih</option>
                                    <option value="hitam">⚫ Hitam</option>
                                    <option value="merah">🔴 Merah</option>
                                    <option value="biru">🔵 Biru</option>
                                    <option value="hijau">🟢 Hijau</option>
                                    <option value="kuning">🟡 Kuning</option>
                                    <option value="abu-abu">🔘 Abu-abu</option>
                                    <option value="marun">🍷 Marun</option>
                                    <option value="navy">⚓ Navy</option>
                                    <option value="army">🌲 Army</option>
                                    <option value="oranye">🟠 Oranye</option>
                                    <option value="ungu">🟣 Ungu</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Validation Message Area -->
                        <div id="recValidationMsg" class="hidden text-[10px] font-semibold text-rose-600 bg-rose-50 border border-rose-200 rounded-xl p-2.5 flex items-center gap-1.5">
                            <span>⚠️</span>
                            <span id="recValidationText">Silakan pilih tema desain terlebih dahulu.</span>
                        </div>

                        <!-- Tombol Cari Rekomendasi -->
                        <button id="findRecommendationsBtn" type="button" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all shadow-md shadow-indigo-200 flex items-center justify-center gap-1.5 cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            <span>Cari Rekomendasi</span>
                        </button>
                    </div>

                    <!-- Compact Filter Summary & Ubah Button Bar (muncul saat hasil aktif) -->
                    <div id="recFilterSummaryBar" class="hidden items-center justify-between p-2 bg-indigo-50/70 border border-indigo-100 rounded-xl shadow-2xs shrink-0">
                        <div class="flex items-center gap-1 flex-wrap min-w-0" id="recSummaryChips">
                            <!-- Dynamic Chips -->
                        </div>
                        <button type="button" id="editRecFilterBtn" class="shrink-0 text-[10px] font-bold text-indigo-700 hover:text-indigo-900 bg-white hover:bg-indigo-50 border border-indigo-200 px-2 py-1 rounded-lg transition-all shadow-2xs flex items-center gap-1 cursor-pointer">
                            <span>✏️ Ubah</span>
                        </button>
                    </div>

                    <!-- Hasil Rekomendasi (Mengisi Penuh Tinggi Sidebar) -->
                    <div class="flex-1 flex flex-col overflow-hidden min-h-0">
                        <div id="recommendationResults" class="flex-1 overflow-y-auto space-y-3 pr-0.5 no-scrollbar">
                            <div class="h-full flex flex-col items-center justify-center text-center py-8 gap-3">
                                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-xl shadow-2xs">💡</div>
                                <div class="max-w-[210px]">
                                    <p class="text-xs font-bold text-slate-700 mb-1">Rekomendasi Desain</p>
                                    <p class="text-[10px] text-slate-400 leading-relaxed">Pilih preferensi di atas,<br>lalu klik <strong class="text-slate-600 font-semibold">Cari Rekomendasi</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER SIDEBAR: BERSINKAN CANVAS -->
                <div class="mt-auto pt-2 shrink-0 border-t border-slate-100">
                    <button id="clearCanvasBtn" class="w-full py-2.5 px-4 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-2">
                        🗑️ Bersihkan Canvas Sisi Aktif
                    </button>
                </div>
            </div>
        </div>

        <!-- COLLAPSE/EXPAND TABS ARROW LEFT -->
        <button @click="leftOpen = !leftOpen" class="absolute bottom-4 sm:bottom-6 left-3 sm:left-6 z-30 p-2 sm:p-2.5 bg-white text-slate-600 border border-slate-200 rounded-full shadow-lg hover:bg-slate-50 transition-all outline-none" title="Toggle Sidebar Elemen">
            <svg :class="leftOpen ? 'rotate-180' : ''" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>

        <!-- AREA UTAMA (KANVAS EDITOR) -->
        <div class="flex-1 bg-slate-100 flex flex-col relative overflow-hidden h-full">
            
            <!-- Mobile Bar: Tombol Buka Drawer & Switcher Sisi Canvas -->
            <div class="lg:hidden flex items-center justify-between px-3 py-2 bg-white border-b border-slate-200 shrink-0 gap-2 z-20 shadow-xs">
                <button type="button" @click="leftOpen = true" class="flex-1 inline-flex items-center justify-center gap-1.5 px-2.5 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-xl text-xs font-bold border border-indigo-200/80 transition-all">
                    <span>✨ Elemen</span>
                </button>

                <!-- Mobile View Switcher (Depan / Belakang) -->
                <div class="flex p-0.5 bg-slate-100 rounded-xl shrink-0 border border-slate-200">
                    <button type="button" @click="mobileView = 'front'" :class="mobileView === 'front' ? 'bg-white text-indigo-600 shadow-xs font-bold' : 'text-slate-500 font-semibold'" class="px-2.5 py-1 text-[10px] rounded-lg transition-all">
                        Depan
                    </button>
                    <button type="button" @click="mobileView = 'back'" :class="mobileView === 'back' ? 'bg-white text-indigo-600 shadow-xs font-bold' : 'text-slate-500 font-semibold'" class="px-2.5 py-1 text-[10px] rounded-lg transition-all">
                        Belakang
                    </button>
                </div>

                <button type="button" @click="rightOpen = true" class="flex-1 inline-flex items-center justify-center gap-1.5 px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold border border-slate-200 transition-all">
                    <span>⚙️ Properti</span>
                </button>
            </div>

            <!-- Guest Warning Glassmorphic banner -->
            @guest
                <div id="guestBanner" class="absolute top-4 left-4 right-4 bg-white/75 backdrop-blur-md border border-slate-200 rounded-2xl py-2 px-4 flex items-center justify-between gap-4 shadow-sm z-30 text-[11px] font-bold text-slate-700">
                    <div class="flex items-center gap-2">
                        <span class="text-sm">💡</span>
                        <p>Anda mendesain sebagai <strong>Tamu</strong>. Daftar akun agar hasil kustomisasi tersimpan permanen.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-2.5 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-[10px]">Login</a>
                        <button type="button" id="closeGuestBannerBtn" class="text-slate-400 hover:text-slate-700"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>
                </div>
            @endguest

            <!-- WORKSPACE AREA: AUTO SCALES BOTH CANVASES -->
            <div id="editorWorkspace" class="flex-1 flex items-center justify-center studio-grid p-2 sm:p-6 relative overflow-auto select-none">
                
                <!-- Inner container holding dual canvas wrapper side-by-side or tabbed on mobile -->
                <div id="canvasesContainer" class="flex flex-col lg:flex-row items-center justify-center gap-6 lg:gap-10 select-none transition-transform duration-200 transform scale-100 my-auto max-w-full">
                    
                    <!-- SISI DEPAN -->
                    <div :class="mobileView === 'front' ? 'flex' : 'hidden lg:flex'" class="flex-col items-center">
                        <span class="text-[11px] font-extrabold text-slate-400 mb-2 tracking-widest bg-slate-200/55 px-3 py-1 rounded-full uppercase">DEPAN</span>
                        <div id="frontCanvasWrapper" class="canvas-wrapper p-2 bg-white rounded-3xl shadow-xl border-2 border-transparent transition-all cursor-pointer">
                            <canvas id="frontCanvas" width="400" height="400"></canvas>
                        </div>
                    </div>

                    <!-- SISI BELAKANG -->
                    <div :class="mobileView === 'back' ? 'flex' : 'hidden lg:flex'" class="flex-col items-center">
                        <span class="text-[11px] font-extrabold text-slate-400 mb-2 tracking-widest bg-slate-200/55 px-3 py-1 rounded-full uppercase">BELAKANG</span>
                        <div id="backCanvasWrapper" class="canvas-wrapper p-2 bg-white rounded-3xl shadow-xl border-2 border-transparent transition-all cursor-pointer">
                            <canvas id="backCanvas" width="400" height="400"></canvas>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Floating Toolbars: Zoom & History Controls -->
            <div class="absolute bottom-4 sm:bottom-6 left-1/2 transform -translate-x-1/2 z-20 flex items-center gap-2 sm:gap-3 bg-white/90 backdrop-blur-md px-3 sm:px-4 py-1.5 sm:py-2 rounded-2xl shadow-xl border border-slate-200/80 max-w-[90vw]">
                <!-- Undo -->
                <button type="button" id="undoBtn" class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-slate-100 rounded-lg transition-all" title="Undo (Ctrl+Z)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.334 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" /></svg>
                </button>
                <!-- Redo -->
                <button type="button" id="redoBtn" class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-slate-100 rounded-lg transition-all" title="Redo (Ctrl+Y)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.934 12.8a1 1 0 000-1.6l-5.334-4A1 1 0 005 8v8a1 1 0 001.6.8l5.334-4zM19.934 12.8a1 1 0 000-1.6l-5.334-4A1 1 0 0013 8v8a1 1 0 001.6.8l5.334-4z" /></svg>
                </button>
                
                <span class="w-px h-4 bg-slate-200"></span>

                <!-- Zoom controls -->
                <button type="button" id="zoomOutBtn" class="p-1 text-slate-500 hover:text-indigo-600 hover:bg-slate-100 rounded-lg transition-all" title="Zoom Out">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                </button>
                <span id="zoomPercent" class="text-xs font-extrabold text-slate-700 min-w-[36px] text-center select-none font-mono">100%</span>
                <button type="button" id="zoomInBtn" class="p-1 text-slate-500 hover:text-indigo-600 hover:bg-slate-100 rounded-lg transition-all" title="Zoom In">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                </button>
            </div>

        </div>

        <!-- COLLAPSE/EXPAND TABS ARROW RIGHT -->
        <button @click="rightOpen = !rightOpen" class="absolute bottom-4 sm:bottom-6 right-3 sm:right-6 z-30 p-2 sm:p-2.5 bg-white text-slate-600 border border-slate-200 rounded-full shadow-lg hover:bg-slate-50 transition-all outline-none" title="Toggle Sidebar Properti">
            <svg :class="rightOpen ? 'rotate-180' : ''" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </button>

        <!-- Mobile Backdrop Overlay Kanan -->
        <div x-show="rightOpen" 
             @click="rightOpen = false" 
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 lg:hidden" 
             style="display: none;"></div>

        <!-- SIDEBAR KANAN: INSPECTOR/PROPERTI -->
        <div x-show="rightOpen"
             x-transition:enter="transition ease-out duration-200 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-150 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed lg:relative inset-y-0 right-0 z-40 w-80 max-w-[85vw] bg-white border-l border-slate-200 flex flex-col h-full shadow-2xl lg:shadow-none shrink-0"
             style="display: none;">
            <div class="p-4 flex flex-col gap-4 h-full overflow-hidden w-full bg-white">
                <div class="shrink-0 flex items-center justify-between pb-2 border-b border-slate-100">
                    <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider">Properti Objek</h3>
                    <div class="flex items-center gap-2">
                        <span id="activeObjectTypeBadge" class="hidden items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold"></span>
                        <button @click="rightOpen = false" class="lg:hidden p-1.5 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-100 transition-colors" title="Tutup">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                </div>

                <div id="inspectorContainer" class="flex-1 flex flex-col overflow-hidden">
                    <!-- Empty State: Belum ada objek terpilih -->
                    <div id="inspectorEmptyState" class="h-full flex flex-col items-center justify-center text-center py-12">
                        <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center text-2xl mb-4 shadow-sm">
                            💡
                        </div>
                        <h4 class="font-bold text-slate-700 text-xs mb-1">Belum ada objek yang dipilih</h4>
                        <p class="text-[10px] text-slate-400 max-w-[200px] leading-relaxed">Klik salah satu objek (teks, motif, pola) di canvas aktif untuk menyesuaikan pengaturannya.</p>
                    </div>

                    <!-- Accordion Form: Objek Terpilih -->
                    <div id="inspectorForm" class="hidden flex-col gap-4 h-full overflow-y-auto no-scrollbar">
                        <!-- Accordion Container -->
                        <div class="space-y-2 flex-1 overflow-y-auto pr-0.5 no-scrollbar">
                            
                            <!-- Accordion 1: Transformasi -->
                            <div class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50/50">
                                <button type="button" class="accordion-toggle w-full px-4 py-3 bg-white flex justify-between items-center text-xs font-bold text-slate-700 hover:bg-slate-50 transition-all select-none">
                                    <span>📐 DIMENSI & POSISI</span>
                                    <svg class="w-3.5 h-3.5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </button>
                                <div class="accordion-content px-4 py-3 space-y-3 bg-white border-t border-slate-100 hidden">
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">POSISI X (PX)</label>
                                            <input type="number" id="inputPosX" class="w-full text-xs border-slate-200 rounded-lg p-1.5 focus:ring-0 focus:border-indigo-500 font-mono">
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">POSISI Y (PX)</label>
                                            <input type="number" id="inputPosY" class="w-full text-xs border-slate-200 rounded-lg p-1.5 focus:ring-0 focus:border-indigo-500 font-mono">
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">LEBAR (PX)</label>
                                            <input type="number" id="inputWidth" class="w-full text-xs border-slate-200 rounded-lg p-1.5 focus:ring-0 focus:border-indigo-500 font-mono">
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">TINGGI (PX)</label>
                                            <input type="number" id="inputHeight" class="w-full text-xs border-slate-200 rounded-lg p-1.5 focus:ring-0 focus:border-indigo-500 font-mono">
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">SCALE X</label>
                                            <input type="number" step="0.01" id="inputScaleX" class="w-full text-xs border-slate-200 rounded-lg p-1.5 focus:ring-0 focus:border-indigo-500 font-mono">
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">SCALE Y</label>
                                            <input type="number" step="0.01" id="inputScaleY" class="w-full text-xs border-slate-200 rounded-lg p-1.5 focus:ring-0 focus:border-indigo-500 font-mono">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <label class="text-[9px] font-bold text-slate-400 block">ROTASI</label>
                                            <span id="rotationVal" class="text-xs font-bold text-slate-700 font-mono">0°</span>
                                        </div>
                                        <input type="range" id="inputRotation" min="0" max="360" value="0" class="w-full accent-indigo-600">
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion 2: Tampilan & Gaya -->
                            <div class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50/50">
                                <button type="button" class="accordion-toggle w-full px-4 py-3 bg-white flex justify-between items-center text-xs font-bold text-slate-700 hover:bg-slate-50 transition-all select-none">
                                    <span>🎨 TAMPILAN & WARNA</span>
                                    <svg class="w-3.5 h-3.5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </button>
                                <div class="accordion-content px-4 py-3 space-y-3 bg-white border-t border-slate-100 hidden">
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <label class="text-[9px] font-bold text-slate-400 block">OPACITY</label>
                                            <span id="opacityVal" class="text-xs font-bold text-slate-700 font-mono">100%</span>
                                        </div>
                                        <input type="range" id="inputOpacity" min="0" max="100" value="100" class="w-full accent-indigo-600">
                                    </div>

                                    <!-- Text specific properties container -->
                                    <div id="textProperties" class="hidden flex-col gap-3">
                                        <div>
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">ISI TEKS</label>
                                            <textarea id="textInput" rows="2" class="w-full text-xs border-slate-200 rounded-lg p-1.5 focus:ring-0 focus:border-indigo-500"></textarea>
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">JENIS HURUF</label>
                                            <select id="fontFamilySelect" class="w-full text-xs border-slate-200 rounded-lg p-1.5 focus:ring-0 focus:border-indigo-500">
                                                <option value="Figtree">Figtree</option>
                                                <option value="Bebas Neue">Bebas Neue (Streetwear)</option>
                                                <option value="Anton">Anton (Bold)</option>
                                                <option value="League Spartan">League Spartan (Minimal)</option>
                                                <option value="Archivo Black">Archivo Black (Urban)</option>
                                                <option value="Montserrat">Montserrat (Modern)</option>
                                                <option value="Poppins">Poppins (Modern)</option>
                                                <option value="Inter">Inter (Clean)</option>
                                                <option value="Oswald">Oswald (Fashion)</option>
                                                <option value="Cinzel">Cinzel (Premium)</option>
                                                <option value="Playfair Display">Playfair Display (Luxury)</option>
                                                <option value="Orbitron">Orbitron (Futuristik)</option>
                                                <option value="Jersey M54">Jersey M54 (Sport)</option>
                                                <option value="Varsity">Varsity (College)</option>
                                                <option value="Brusher">Brusher (Outdoor)</option>
                                                <option value="Kaushan Script">Kaushan Script (Casual)</option>
                                                <option value="Permanent Marker">Permanent Marker (Graffiti)</option>
                                                <option value="Rye">Rye (Vintage)</option>
                                                <option value="Alfa Slab One">Alfa Slab One (Retro)</option>
                                                <option value="Black Ops One">Black Ops One (Military)</option>
                                                <option value="Bungee">Bungee (Street)</option>
                                            </select>
                                        </div>
                                        <div>
                                            <div class="flex justify-between items-center mb-1">
                                                <label class="text-[9px] font-bold text-slate-400 block">UKURAN HURUF</label>
                                                <span id="fontSizeVal" class="text-xs font-bold text-slate-700 font-mono">24 px</span>
                                            </div>
                                            <input type="range" id="fontSizeRange" min="10" max="120" value="24" class="w-full accent-indigo-600">
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">WARNA TEKS</label>
                                            <div class="flex items-center gap-2">
                                                <input type="color" id="textColorInput" value="#000000" class="w-8 h-8 border-0 rounded-lg cursor-pointer p-0 bg-transparent">
                                                <input type="text" id="textColorHex" value="#000000" class="flex-1 text-xs border-slate-200 rounded-lg py-1 px-2 uppercase focus:ring-0 focus:border-indigo-500 font-mono">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image specific properties container -->
                                    <div id="imageProperties" class="hidden flex-col gap-3">
                                        <label class="flex items-center gap-2 cursor-pointer select-none">
                                            <input type="checkbox" id="imageTintEnable" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                            <span class="text-xs font-semibold text-slate-700">Aktifkan Filter Warna</span>
                                        </label>
                                        <div id="imageTintControls" class="hidden flex-col gap-2">
                                            <label class="text-[9px] font-bold text-slate-400 block mb-1">WARNA FILTER TINT</label>
                                            <div class="flex items-center gap-2">
                                                <input type="color" id="imageTintColorInput" value="#6366f1" class="w-8 h-8 border-0 rounded-lg cursor-pointer p-0 bg-transparent">
                                                <input type="text" id="imageTintColorHex" value="#6366f1" class="flex-1 text-xs border-slate-200 rounded-lg py-1 px-2 uppercase focus:ring-0 focus:border-indigo-500 font-mono">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion 3: Tindakan & Layers -->
                            <div class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50/50">
                                <button type="button" class="accordion-toggle w-full px-4 py-3 bg-white flex justify-between items-center text-xs font-bold text-slate-700 hover:bg-slate-50 transition-all select-none">
                                    <span>🛠️ TINDAKAN & LAYER</span>
                                    <svg class="w-3.5 h-3.5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </button>
                                <div class="accordion-content px-4 py-3 space-y-3 bg-white border-t border-slate-100 hidden">
                                    <div class="grid grid-cols-2 gap-2">
                                        <button type="button" id="layerFrontBtn" class="py-2 px-3 border border-slate-200 hover:bg-slate-50 text-[10px] font-bold rounded-xl text-slate-700 flex items-center justify-center gap-1 transition-all">
                                            🔼 Layer Depan
                                        </button>
                                        <button type="button" id="layerBackBtn" class="py-2 px-3 border border-slate-200 hover:bg-slate-50 text-[10px] font-bold rounded-xl text-slate-700 flex items-center justify-center gap-1 transition-all">
                                            🔽 Layer Belakang
                                        </button>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <button type="button" id="lockBtn" class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all">
                                            🔒 Kunci Objek
                                        </button>
                                        <button type="button" id="duplicateBtn" class="w-full py-2 bg-slate-100 hover:bg-slate-200 border border-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all">
                                            👥 Duplikat Objek
                                        </button>
                                        <button type="button" id="deleteObjectBtn" class="w-full py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all">
                                            🗑️ Hapus Objek
                                        </button>
                                    </div>
                                    <div class="border-t border-slate-100 pt-3">
                                        <h4 class="font-bold text-slate-400 text-[9px] mb-2 tracking-wider uppercase">🥞 SUSUNAN LAYER</h4>
                                        <div id="layersList" class="flex flex-col gap-1.5 max-h-36 overflow-y-auto pr-0.5 no-scrollbar">
                                            <!-- Dynamically generated list -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Save Design Auth Modal for Guests -->
    <div id="saveAuthModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-2xl max-w-md w-full p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out" id="saveAuthModalContent">
            <button type="button" id="closeSaveAuthModalBtn" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 text-indigo-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Simpan ke Riwayat Akun?</h3>
                <p class="text-xs text-slate-500 mb-6 leading-relaxed">Anda belum masuk. Masuk atau daftar akun terlebih dahulu untuk menyimpan kustomisasi desain ini secara permanen. Draf desain saat ini akan kami simpan sementara.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <button type="button" id="modalRegisterBtn" class="w-full sm:flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-sm text-xs transition-all">
                        Daftar Baru
                    </button>
                    <button type="button" id="modalLoginBtn" class="w-full sm:flex-1 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-all">
                        Masuk Akun
                    </button>
                    <button type="button" id="modalCancelBtn" class="w-full sm:w-auto py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold rounded-xl text-xs transition-all">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Load Fabric.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup CSRF token for AJAX requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Model ID if edit
            const designId = "{{ $design ? $design->id : '' }}";
            
            // Database initial values
            // mockup_side no longer exists in DB — always default to 'front'
            const dbMockupSide = 'front';
            const dbShirtColor = @json($design ? $design->shirt_color : 'putih');
            const dbProductType = @json($design ? $design->product_type : 'tshirt');
            const dbCanvasData = @json($design ? $design->canvas_data : null);

            // Active State variables
            let currentSide = 'front'; // Defaults to front canvas
            let currentColor = 'putih';
            let currentModel = 'tshirt'; 
            let canvasZoom = 1.0;

            // SVG / Jersey settings (3 Customizable Colors: Badan, Kerah, Aksen)
            let jerseyBgColor = '#ffffff';
            let jerseyCollarColor = '#ffffff';
            let jerseyAccentColor = '#ffffff';
            let currentCollarType = 'oneck';

            // Collar type to SVG URL mapping
            function getJerseySvgUrl(side) {
                const map = {
                    'oneck':    { front: '/assets/mockups/jersey/front.svg',          back: '/assets/mockups/jersey/back.svg' },
                    'vneck':    { front: '/assets/mockups/jersey/front-vneck.svg',    back: '/assets/mockups/jersey/back.svg' },
                    'polo':     { front: '/assets/mockups/jersey/front-polo.svg',     back: '/assets/mockups/jersey/back-polo.svg' },
                    'shanghai': { front: '/assets/mockups/jersey/front-shanghai.svg', back: '/assets/mockups/jersey/back-shanghai.svg' },
                    'henley':   { front: '/assets/mockups/jersey/front-henley.svg',   back: '/assets/mockups/jersey/back.svg' },
                };
                const urls = map[currentCollarType] || map['oneck'];
                return side === 'front' ? urls.front : urls.back;
            }

            // Canvas states for front and back per model in memory
            let canvasStates = {
                tshirt: { front: null, back: null },
                jersey: { front: null, back: null }
            };

            // Initialize canvasStates and restore variables from DB values
            if (dbCanvasData) {
                if (dbCanvasData.tshirt || dbCanvasData.jersey) {
                    canvasStates.tshirt = dbCanvasData.tshirt || { front: null, back: null };
                    canvasStates.jersey = dbCanvasData.jersey || { front: null, back: null };
                    currentModel = dbProductType || 'tshirt';
                    currentColor = dbShirtColor || 'putih';
                    if (currentModel === 'jersey') {
                        jerseyBgColor = dbShirtColor || '#ffffff';
                    }
                } else if (dbCanvasData.front || dbCanvasData.back ||
                    dbCanvasData.front_canvas_json || dbCanvasData.back_canvas_json) {
                    currentModel = dbProductType || 'tshirt';
                    currentColor = dbShirtColor || 'putih';
                    if (currentModel === 'jersey') {
                        jerseyBgColor = dbShirtColor || '#ffffff';
                    }
                    canvasStates[currentModel] = {
                        front: dbCanvasData.front || dbCanvasData.front_canvas_json,
                        back: dbCanvasData.back || dbCanvasData.back_canvas_json
                    };
                } else {
                    currentModel = (dbCanvasData.objects && dbCanvasData.objects.some(o => o.isJerseyTemplate)) ? 'jersey' : 'tshirt';
                    currentColor = dbShirtColor || 'putih';
                    if (currentModel === 'jersey') {
                        jerseyBgColor = dbShirtColor || '#ffffff';
                    }
                    canvasStates[currentModel] = {
                        front: dbCanvasData,
                        back: null
                    };
                }
            }

            // History stack for Undo/Redo per side
            let history = {
                front: { undoStack: [], redoStack: [] },
                back: { undoStack: [], redoStack: [] }
            };
            let isProcessingHistory = false;

            // Fabric.js canvas instances
            let frontCanvas = null;
            let backCanvas = null;
            let activeCanvas = null; // Reference to currently active canvas

            // ==========================================
            // CORE CANVAS FUNCTIONS
            // ==========================================

            /**
             * Initialize Fabric.js Canvases & Event Bindings
             */
            function initCanvases() {
                frontCanvas = new fabric.Canvas('frontCanvas', {
                    preserveObjectStacking: true,
                    width: 400,
                    height: 400
                });

                backCanvas = new fabric.Canvas('backCanvas', {
                    preserveObjectStacking: true,
                    width: 400,
                    height: 400
                });

                // Set initial active canvas to frontCanvas
                activeCanvas = frontCanvas;
                currentSide = 'front';
                document.getElementById('frontCanvasWrapper').classList.add('border-indigo-500', 'ring-4', 'ring-indigo-100');

                // Bind events for Front Canvas
                bindCanvasEvents(frontCanvas, 'front');

                // Bind events for Back Canvas
                bindCanvasEvents(backCanvas, 'back');
            }

            function bindCanvasEvents(c, side) {
                // Focus canvas on mouse click
                c.on('mouse:down', () => {
                    setActiveSide(side);
                });

                c.on('object:added', () => {
                    adjustLayers(c);
                    refreshLayers();
                    pushStateToHistory(c, side);
                });
                c.on('object:removed', () => {
                    refreshLayers();
                    pushStateToHistory(c, side);
                });
                c.on('object:modified', () => {
                    refreshLayers();
                    updateInspector();
                    pushStateToHistory(c, side);
                });
                c.on('selection:created', () => {
                    if (activeCanvas === c) {
                        updateInspector();
                        refreshLayers();
                    }
                });
                c.on('selection:updated', () => {
                    if (activeCanvas === c) {
                        updateInspector();
                        refreshLayers();
                    }
                });
                c.on('selection:cleared', () => {
                    if (activeCanvas === c) {
                        updateInspector();
                        refreshLayers();
                    }
                });
                c.on('text:changed', (e) => {
                    const activeObj = c.getActiveObject();
                    if (activeObj && activeObj === e.target) {
                        const textInput = document.getElementById('textInput');
                        if (textInput) textInput.value = activeObj.text;
                        refreshLayers();
                    }
                });
                c.on('mouse:dblclick', (options) => {
                    if (options.target && (options.target.type === 'i-text' || options.target.type === 'text')) {
                        options.target.enterEditing();
                        options.target.selectAll();
                    }
                });
            }

            /**
             * Switch active selection and highlight border
             */
            function setActiveSide(side) {
                if (currentSide === side && activeCanvas !== null) return;

                currentSide = side;
                activeCanvas = (side === 'front') ? frontCanvas : backCanvas;

                const frontWrapper = document.getElementById('frontCanvasWrapper');
                const backWrapper = document.getElementById('backCanvasWrapper');

                if (side === 'front') {
                    frontWrapper.classList.remove('border-transparent');
                    frontWrapper.classList.add('border-indigo-500', 'ring-4', 'ring-indigo-100');
                    backWrapper.classList.remove('border-indigo-500', 'ring-4', 'ring-indigo-100');
                    backWrapper.classList.add('border-transparent');

                    // Discard active object selection on back canvas
                    backCanvas.discardActiveObject().renderAll();
                } else {
                    backWrapper.classList.remove('border-transparent');
                    backWrapper.classList.add('border-indigo-500', 'ring-4', 'ring-indigo-100');
                    frontWrapper.classList.remove('border-indigo-500', 'ring-4', 'ring-indigo-100');
                    frontWrapper.classList.add('border-transparent');

                    // Discard active object selection on front canvas
                    frontCanvas.discardActiveObject().renderAll();
                }

                // Update properties inspector and layer list
                updateInspector();
                refreshLayers();
            }

            /**
             * Setup Toolbar Actions & Bindings
             */
            function initToolbar() {
                // Save Design
                const saveBtn = document.getElementById('saveBtn');
                if (saveBtn) saveBtn.addEventListener('click', saveDesign);

                // Models selector radio buttons
                document.querySelectorAll('input[name="product_model"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        changeProduct(this.value);
                    });
                });

                // Color picker inputs
                const customColorPicker = document.getElementById('customColorPicker');
                const customColorHex = document.getElementById('customColorHex');
                if (customColorPicker && customColorHex) {
                    customColorPicker.addEventListener('input', function() {
                        customColorHex.value = this.value.toUpperCase();
                        changeShirtColor(this.value);
                    });
                    customColorHex.addEventListener('input', function() {
                        let color = this.value;
                        if (!color.startsWith('#')) color = '#' + color;
                        if (/^#[0-9A-F]{6}$/i.test(color)) {
                            customColorPicker.value = color;
                            changeShirtColor(color);
                        }
                    });
                }

                // Zoom controls
                const zoomInBtn = document.getElementById('zoomInBtn');
                if (zoomInBtn) zoomInBtn.addEventListener('click', () => updateZoom(canvasZoom + 0.1));

                const zoomOutBtn = document.getElementById('zoomOutBtn');
                if (zoomOutBtn) zoomOutBtn.addEventListener('click', () => updateZoom(canvasZoom - 0.1));

                // Undo & Redo buttons
                const undoBtn = document.getElementById('undoBtn');
                if (undoBtn) undoBtn.addEventListener('click', () => undo());
                
                const redoBtn = document.getElementById('redoBtn');
                if (redoBtn) redoBtn.addEventListener('click', () => redo());

                // Inspector action buttons
                const layerFrontBtn = document.getElementById('layerFrontBtn');
                if (layerFrontBtn) layerFrontBtn.addEventListener('click', bringForward);

                const layerBackBtn = document.getElementById('layerBackBtn');
                if (layerBackBtn) layerBackBtn.addEventListener('click', sendBackward);

                const lockBtn = document.getElementById('lockBtn');
                if (lockBtn) lockBtn.addEventListener('click', lockObject);

                const duplicateBtn = document.getElementById('duplicateBtn');
                if (duplicateBtn) duplicateBtn.addEventListener('click', duplicateObject);

                const deleteObjectBtn = document.getElementById('deleteObjectBtn');
                if (deleteObjectBtn) deleteObjectBtn.addEventListener('click', deleteSelected);

                const clearCanvasBtn = document.getElementById('clearCanvasBtn');
                if (clearCanvasBtn) {
                    clearCanvasBtn.addEventListener('click', () => {
                        if (confirm(`Apakah Anda yakin ingin menghapus semua objek di sisi ${currentSide === 'front' ? 'DEPAN' : 'BELAKANG'}?`)) {
                            const objects = activeCanvas.getObjects();
                            for (let i = objects.length - 1; i >= 0; i--) {
                                const obj = objects[i];
                                if (!obj.isJerseyTemplate && !obj.isTshirtTemplate) {
                                    activeCanvas.remove(obj);
                                }
                            }
                            activeCanvas.discardActiveObject();
                            activeCanvas.renderAll();
                            updateInspector();
                            refreshLayers();
                        }
                    });
                }

                // Text Addition
                const addHeadingBtn = document.getElementById('addHeadingBtn');
                if (addHeadingBtn) addHeadingBtn.addEventListener('click', () => addText('heading'));

                const addSubheadingBtn = document.getElementById('addSubheadingBtn');
                if (addSubheadingBtn) addSubheadingBtn.addEventListener('click', () => addText('subheading'));

                const addBodyTextBtn = document.getElementById('addBodyTextBtn');
                if (addBodyTextBtn) addBodyTextBtn.addEventListener('click', () => addText('body'));

                // Image Upload
                const imageUploadInput = document.getElementById('imageUploadInput');
                if (imageUploadInput) {
                    imageUploadInput.addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        if (file) {
                            uploadImage(file);
                            imageUploadInput.value = ''; 
                        }
                    });
                }

                // Tshirt Predefined Colors
                document.querySelectorAll('.shirt-color-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const color = this.getAttribute('data-color');
                        changeShirtColor(color);
                    });
                });

                // Motif Mode Toggle (Isi Kaos vs Elemen Bebas)
                let motifApplyMode = 'pattern'; // 'pattern' | 'element'
                const motifModePattern = document.getElementById('motifModePattern');
                const motifModeElement = document.getElementById('motifModeElement');
                const motifModeDesc = document.getElementById('motifModeDesc');

                function setMotifMode(mode) {
                    motifApplyMode = mode;
                    if (mode === 'pattern') {
                        motifModePattern.classList.add('bg-indigo-600', 'text-white', 'shadow-sm');
                        motifModePattern.classList.remove('text-slate-500', 'hover:text-slate-700');
                        motifModeElement.classList.remove('bg-indigo-600', 'text-white', 'shadow-sm');
                        motifModeElement.classList.add('text-slate-500', 'hover:text-slate-700');
                        if (motifModeDesc) motifModeDesc.textContent = 'Motif akan memenuhi & mengikuti bentuk siluet kaos.';
                    } else {
                        motifModeElement.classList.add('bg-indigo-600', 'text-white', 'shadow-sm');
                        motifModeElement.classList.remove('text-slate-500', 'hover:text-slate-700');
                        motifModePattern.classList.remove('bg-indigo-600', 'text-white', 'shadow-sm');
                        motifModePattern.classList.add('text-slate-500', 'hover:text-slate-700');
                        if (motifModeDesc) motifModeDesc.textContent = 'Motif ditambahkan sebagai elemen bebas yang dapat dipindah.';
                    }
                }

                if (motifModePattern) motifModePattern.addEventListener('click', () => setMotifMode('pattern'));
                if (motifModeElement) motifModeElement.addEventListener('click', () => setMotifMode('element'));

                // Expose motifApplyMode so addMotifToCanvas can read it
                window._getMotifApplyMode = () => motifApplyMode;

                // Motif Category Filters
                document.querySelectorAll('.motif-filter-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('.motif-filter-btn').forEach(b => {
                            b.classList.remove('bg-indigo-600', 'text-white');
                            b.classList.add('bg-slate-100', 'text-slate-500', 'hover:bg-slate-200');
                        });
                        this.classList.remove('bg-slate-100', 'text-slate-500', 'hover:bg-slate-200');
                        this.classList.add('bg-indigo-600', 'text-white');

                        const category = this.getAttribute('data-category');
                        loadMotifs(category);
                    });
                });

                // Pattern Color Input
                const patternColorInput = document.getElementById('patternColorInput');
                const patternColorVal = document.getElementById('patternColorVal');
                if (patternColorInput) {
                    patternColorInput.addEventListener('input', function() {
                        if (patternColorVal) patternColorVal.innerText = this.value.toUpperCase();
                        drawPatternPreviews(this.value);
                    });
                }

                // Pattern Selection Buttons
                document.getElementById('btnPatternStripes').addEventListener('click', () => addPatternToCanvas('stripes'));
                document.getElementById('btnPatternHexagon').addEventListener('click', () => addPatternToCanvas('hexagon'));
                document.getElementById('btnPatternCross').addEventListener('click', () => addPatternToCanvas('cross'));
                document.getElementById('btnPatternDots').addEventListener('click', () => addPatternToCanvas('dots'));
                document.getElementById('btnPatternCheckered').addEventListener('click', () => addPatternToCanvas('checkered'));
                document.getElementById('btnPatternChevron').addEventListener('click', () => addPatternToCanvas('chevron'));
                document.getElementById('btnPatternWaves').addEventListener('click', () => addPatternToCanvas('waves'));
                document.getElementById('btnPatternGrid').addEventListener('click', () => addPatternToCanvas('grid'));
                document.getElementById('btnPatternStars').addEventListener('click', () => addPatternToCanvas('stars'));

                // Element Subtabs selector
                const subtabButtons = document.querySelectorAll('.subtab-btn');
                const subtabContents = document.querySelectorAll('.subtab-content');
                subtabButtons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const targetSubtab = this.getAttribute('data-subtab');
                        subtabButtons.forEach(b => {
                            b.classList.remove('bg-white', 'text-indigo-600', 'shadow-sm');
                            b.classList.add('text-slate-500', 'hover:text-slate-800');
                        });
                        this.classList.add('bg-white', 'text-indigo-600', 'shadow-sm');
                        this.classList.remove('text-slate-500', 'hover:text-slate-800');

                        subtabContents.forEach(content => {
                            const subId = `subtabContent${targetSubtab.charAt(0).toUpperCase() + targetSubtab.slice(1)}`;
                            if (content.id === subId) {
                                content.classList.remove('hidden');
                                content.classList.add('flex');
                            } else {
                                content.classList.remove('flex');
                                content.classList.add('hidden');
                            }
                        });
                    });
                });

                // Tab Switch: Elemen vs Rekomendasi
                const tabElements = document.getElementById('tabElements');
                const tabRecommendations = document.getElementById('tabRecommendations');
                const elementsSection = document.getElementById('elementsSection');
                const recommendationsSection = document.getElementById('recommendationsSection');
                if (tabElements && tabRecommendations) {
                    tabElements.addEventListener('click', () => {
                        tabElements.classList.add('border-indigo-600', 'text-indigo-600');
                        tabElements.classList.remove('border-transparent', 'text-slate-400', 'hover:text-slate-700');
                        tabRecommendations.classList.remove('border-indigo-600', 'text-indigo-600');
                        tabRecommendations.classList.add('border-transparent', 'text-slate-400', 'hover:text-slate-700');
                        elementsSection.classList.remove('hidden');
                        elementsSection.classList.add('flex');
                        recommendationsSection.classList.add('hidden');
                        recommendationsSection.classList.remove('flex');
                    });
                    tabRecommendations.addEventListener('click', () => {
                        tabRecommendations.classList.add('border-indigo-600', 'text-indigo-600');
                        tabRecommendations.classList.remove('border-transparent', 'text-slate-400', 'hover:text-slate-700');
                        tabElements.classList.remove('border-indigo-600', 'text-indigo-600');
                        tabElements.classList.add('border-transparent', 'text-slate-400', 'hover:text-slate-700');
                        recommendationsSection.classList.remove('hidden');
                        recommendationsSection.classList.add('flex');
                        elementsSection.classList.add('hidden');
                        elementsSection.classList.remove('flex');

                        syncRecommendationPreferences();
                    });
                }

                // Recommendations Search & Filter Controls
                const findRecommendationsBtn = document.getElementById('findRecommendationsBtn');
                if (findRecommendationsBtn) findRecommendationsBtn.addEventListener('click', loadRecommendations);

                const editRecFilterBtn = document.getElementById('editRecFilterBtn');
                if (editRecFilterBtn) editRecFilterBtn.addEventListener('click', expandRecommendationFilter);

                const closeRecFilterBtn = document.getElementById('closeRecFilterBtn');
                if (closeRecFilterBtn) closeRecFilterBtn.addEventListener('click', collapseRecommendationFilter);

                // Text settings inputs binding
                const textInput = document.getElementById('textInput');
                if (textInput) {
                    textInput.addEventListener('input', function() {
                        const activeObj = activeCanvas.getActiveObject();
                        if (activeObj && (activeObj.type === 'i-text' || activeObj.type === 'text')) {
                            activeObj.set('text', this.value);
                            activeCanvas.renderAll();
                            refreshLayers();
                        }
                    });
                }

                const fontFamilySelect = document.getElementById('fontFamilySelect');
                if (fontFamilySelect) {
                    fontFamilySelect.addEventListener('change', function() {
                        const activeObj = activeCanvas.getActiveObject();
                        if (activeObj && (activeObj.type === 'i-text' || activeObj.type === 'text')) {
                            const font = this.value;
                            activeObj.set('fontFamily', font);
                            activeCanvas.renderAll();
                            refreshLayers();
                            if (document.fonts) {
                                document.fonts.load(`1em "${font}"`).then(() => activeCanvas.renderAll());
                            }
                        }
                    });
                }

                const fontSizeRange = document.getElementById('fontSizeRange');
                const fontSizeVal = document.getElementById('fontSizeVal');
                if (fontSizeRange) {
                    fontSizeRange.addEventListener('input', function() {
                        if (fontSizeVal) fontSizeVal.innerText = this.value + ' px';
                        const activeObj = activeCanvas.getActiveObject();
                        if (activeObj && (activeObj.type === 'i-text' || activeObj.type === 'text')) {
                            activeObj.set('fontSize', parseInt(this.value));
                            activeCanvas.renderAll();
                        }
                    });
                }

                const textColorInput = document.getElementById('textColorInput');
                const textColorHex = document.getElementById('textColorHex');
                if (textColorInput && textColorHex) {
                    textColorInput.addEventListener('input', function() {
                        textColorHex.value = this.value.toUpperCase();
                        const activeObj = activeCanvas.getActiveObject();
                        if (activeObj && (activeObj.type === 'i-text' || activeObj.type === 'text')) {
                            activeObj.set('fill', this.value);
                            activeCanvas.renderAll();
                        }
                    });
                    textColorHex.addEventListener('input', function() {
                        let color = this.value;
                        if (!color.startsWith('#')) color = '#' + color;
                        if (/^#[0-9A-F]{6}$/i.test(color)) {
                            textColorInput.value = color;
                            const activeObj = activeCanvas.getActiveObject();
                            if (activeObj && (activeObj.type === 'i-text' || activeObj.type === 'text')) {
                                activeObj.set('fill', color);
                                activeCanvas.renderAll();
                            }
                        }
                    });
                }

                // Image Tint bindings
                const imageTintEnable = document.getElementById('imageTintEnable');
                const imageTintControls = document.getElementById('imageTintControls');
                const imageTintColorInput = document.getElementById('imageTintColorInput');
                const imageTintColorHex = document.getElementById('imageTintColorHex');
                if (imageTintEnable) {
                    imageTintEnable.addEventListener('change', function() {
                        if (this.checked) {
                            if (imageTintControls) imageTintControls.classList.remove('hidden');
                            applyColorFilterToActiveImage(imageTintColorInput.value, true);
                        } else {
                            if (imageTintControls) imageTintControls.classList.add('hidden');
                            applyColorFilterToActiveImage(null, false);
                        }
                    });
                    imageTintColorInput.addEventListener('input', function() {
                        if (imageTintColorHex) imageTintColorHex.value = this.value.toUpperCase();
                        applyColorFilterToActiveImage(this.value, true);
                    });
                    imageTintColorHex.addEventListener('input', function() {
                        let color = this.value;
                        if (!color.startsWith('#')) color = '#' + color;
                        if (/^#[0-9A-F]{6}$/i.test(color)) {
                            if (imageTintColorInput) imageTintColorInput.value = color;
                            applyColorFilterToActiveImage(color, true);
                        }
                    });
                }

                // Dimension and transformation inputs
                const posInputs = ['inputPosX', 'inputPosY', 'inputWidth', 'inputHeight', 'inputScaleX', 'inputScaleY'];
                posInputs.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) {
                        el.addEventListener('input', function() {
                            const activeObj = activeCanvas.getActiveObject();
                            if (!activeObj) return;

                            const val = parseFloat(this.value) || 0;
                            if (id === 'inputPosX') activeObj.set('left', val);
                            else if (id === 'inputPosY') activeObj.set('top', val);
                            else if (id === 'inputScaleX') activeObj.set('scaleX', val);
                            else if (id === 'inputScaleY') activeObj.set('scaleY', val);
                            else if (id === 'inputWidth') activeObj.set('scaleX', val / activeObj.width);
                            else if (id === 'inputHeight') activeObj.set('scaleY', val / activeObj.height);

                            activeObj.setCoords();
                            activeCanvas.renderAll();
                        });
                    }
                });

                const inputRotation = document.getElementById('inputRotation');
                const rotationVal = document.getElementById('rotationVal');
                if (inputRotation) {
                    inputRotation.addEventListener('input', function() {
                        if (rotationVal) rotationVal.innerText = this.value + '°';
                        const activeObj = activeCanvas.getActiveObject();
                        if (activeObj) {
                            activeObj.set('angle', parseFloat(this.value)).setCoords();
                            activeCanvas.renderAll();
                        }
                    });
                }

                const inputOpacity = document.getElementById('inputOpacity');
                const opacityVal = document.getElementById('opacityVal');
                if (inputOpacity) {
                    inputOpacity.addEventListener('input', function() {
                        if (opacityVal) opacityVal.innerText = this.value + '%';
                        const activeObj = activeCanvas.getActiveObject();
                        if (activeObj) {
                            activeObj.set('opacity', parseFloat(this.value) / 100);
                            activeCanvas.renderAll();
                        }
                    });
                }

                // Export buttons binding
                const exportDTFFrontBtn = document.getElementById('exportDTFFrontBtn');
                if (exportDTFFrontBtn) exportDTFFrontBtn.addEventListener('click', () => exportDTFSidePNG(frontCanvas, 'depan'));

                const exportDTFBackBtn = document.getElementById('exportDTFBackBtn');
                if (exportDTFBackBtn) exportDTFBackBtn.addEventListener('click', () => exportDTFSidePNG(backCanvas, 'belakang'));

                const exportPNGFrontBtn = document.getElementById('exportPNGFrontBtn');
                if (exportPNGFrontBtn) exportPNGFrontBtn.addEventListener('click', () => exportSidePNG(frontCanvas, 'depan'));

                const exportPNGBackBtn = document.getElementById('exportPNGBackBtn');
                if (exportPNGBackBtn) exportPNGBackBtn.addEventListener('click', () => exportSidePNG(backCanvas, 'belakang'));

                const exportPNGCombinedBtn = document.getElementById('exportPNGCombinedBtn');
                if (exportPNGCombinedBtn) exportPNGCombinedBtn.addEventListener('click', exportCombinedPNG);

                const exportSVGFrontBtn = document.getElementById('exportSVGFrontBtn');
                if (exportSVGFrontBtn) exportSVGFrontBtn.addEventListener('click', () => exportSideSVG(frontCanvas, 'depan'));

                const exportSVGBackBtn = document.getElementById('exportSVGBackBtn');
                if (exportSVGBackBtn) exportSVGBackBtn.addEventListener('click', () => exportSideSVG(backCanvas, 'belakang'));

                // Accordions toggle listeners
                document.querySelectorAll('.accordion-toggle').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const content = this.nextElementSibling;
                        const icon = this.querySelector('svg');
                        content.classList.toggle('hidden');
                        icon.classList.toggle('rotate-180');
                    });
                });
                // Open first accordion by default
                const firstAccordion = document.querySelector('.accordion-content');
                if (firstAccordion) {
                    firstAccordion.classList.remove('hidden');
                    const firstIcon = firstAccordion.previousElementSibling.querySelector('svg');
                    if (firstIcon) firstIcon.classList.add('rotate-180');
                }

                // Auth Modal Close & Binds
                const closeSaveAuthModalBtn = document.getElementById('closeSaveAuthModalBtn');
                const modalCancelBtn = document.getElementById('modalCancelBtn');
                const modalLoginBtn = document.getElementById('modalLoginBtn');
                const modalRegisterBtn = document.getElementById('modalRegisterBtn');
                const designNameInput = document.getElementById('designNameInput');

                if (closeSaveAuthModalBtn) closeSaveAuthModalBtn.addEventListener('click', hideSaveAuthModal);
                if (modalCancelBtn) modalCancelBtn.addEventListener('click', hideSaveAuthModal);
                if (modalLoginBtn && designNameInput) {
                    modalLoginBtn.addEventListener('click', () => {
                        const designName = designNameInput.value.trim();
                        localStorage.setItem('pending_design', JSON.stringify({
                            name: designName,
                            canvas_data: getPayloadCanvasData()
                        }));
                        window.location.href = "{{ route('login') }}";
                    });
                }
                if (modalRegisterBtn && designNameInput) {
                    modalRegisterBtn.addEventListener('click', () => {
                        const designName = designNameInput.value.trim();
                        localStorage.setItem('pending_design', JSON.stringify({
                            name: designName,
                            canvas_data: getPayloadCanvasData()
                        }));
                        window.location.href = "{{ route('register') }}";
                    });
                }

                // Guest Banner Close
                const closeGuestBannerBtn = document.getElementById('closeGuestBannerBtn');
                const guestBanner = document.getElementById('guestBanner');
                if (closeGuestBannerBtn && guestBanner) {
                    closeGuestBannerBtn.addEventListener('click', () => {
                        guestBanner.classList.add('hidden');
                    });
                }

                // Collar Type Selector Buttons
                document.querySelectorAll('.collar-btn').forEach(btn => {
                    btn.addEventListener('click', async function() {
                        const collarType = this.getAttribute('data-collar');
                        if (collarType) await changeCollarType(collarType);
                    });
                });

                // Jersey Color Customizer Inputs (3 Customizable Colors: Badan, Kerah, Aksen)
                const jerseyColorBindings = [
                    { inputId: 'inputJerseyBgColor', hexId: 'hexJerseyBgColor', targetClass: 'jersey-bg' },
                    { inputId: 'inputJerseyCollarColor', hexId: 'hexJerseyCollarColor', targetClass: 'jersey-collar' },
                    { inputId: 'inputJerseyAccentColor', hexId: 'hexJerseyAccentColor', targetClass: 'jersey-accent' }
                ];

                jerseyColorBindings.forEach(binding => {
                    const picker = document.getElementById(binding.inputId);
                    const hexInput = document.getElementById(binding.hexId);

                    if (picker && hexInput) {
                        ['input', 'change'].forEach(evtType => {
                            picker.addEventListener(evtType, function() {
                                hexInput.value = this.value.toUpperCase();
                                updateJerseyColorGlobally(binding.targetClass, this.value);
                            });
                        });

                        hexInput.addEventListener('input', function() {
                            let val = this.value.trim();
                            if (!val.startsWith('#')) val = '#' + val;
                            if (/^#[0-9A-F]{6}$/i.test(val)) {
                                picker.value = val;
                                updateJerseyColorGlobally(binding.targetClass, val);
                            }
                        });

                        hexInput.addEventListener('blur', function() {
                            let val = this.value.trim();
                            if (!val.startsWith('#')) val = '#' + val;
                            if (/^#[0-9A-F]{6}$/i.test(val)) {
                                this.value = val.toUpperCase();
                                picker.value = val;
                                updateJerseyColorGlobally(binding.targetClass, val);
                            } else {
                                this.value = picker.value.toUpperCase();
                            }
                        });
                    }
                });

                // Keyboard Shortcuts
                document.addEventListener('keydown', function(e) {
                    if (['INPUT', 'TEXTAREA', 'SELECT'].includes(document.activeElement.tagName)) return;

                    if (e.key === 'Delete' || e.key === 'Backspace') {
                        e.preventDefault();
                        deleteSelected();
                    }

                    if (e.ctrlKey || e.metaKey) {
                        const key = e.key.toLowerCase();
                        if (key === 'z') {
                            e.preventDefault();
                            undo();
                        } else if (key === 'y') {
                            e.preventDefault();
                            redo();
                        } else if (key === 'd') {
                            e.preventDefault();
                            duplicateObject();
                        } else if (key === 'l') {
                            e.preventDefault();
                            lockObject();
                        }
                    }

                    if (e.key === '[') {
                        e.preventDefault();
                        sendBackward();
                    } else if (e.key === ']') {
                        e.preventDefault();
                        bringForward();
                    }
                });

                // Pre-fetch default motifs in background for instant loading when clicking Elemen
                setTimeout(() => {
                    loadMotifs('');
                }, 200);
            }

            /**
             * Save Design Payload generator helper
             */
            function getPayloadCanvasData() {
                const serializeCanvas = (c) => {
                    return c.toJSON([
                        'selectable', 'evented', 'isJerseyTemplate', 'isTshirtTemplate', 
                        'className', 'id', 'title', 'lockMovementX', 'lockMovementY', 
                        'lockScalingX', 'lockScalingY', 'lockRotation', 'hasControls', 'hasBorders',
                        'isTemplateLayer', 'templateId', 'templateName', 'objectType',
                        'templateDesign', 'isTemplateDesign', 'source', 'side'
                    ]);
                };
                canvasStates[currentModel] = {
                    front: serializeCanvas(frontCanvas),
                    back: serializeCanvas(backCanvas)
                };
                return {
                    tshirt: canvasStates.tshirt,
                    jersey: canvasStates.jersey,
                    front: canvasStates[currentModel].front,
                    back: canvasStates[currentModel].back
                };
            }

            /**
             * Save entire workspace side-by-side design to DB
             */
            async function saveDesign() {
                const designNameInput = document.getElementById('designNameInput');
                const designName = designNameInput ? designNameInput.value.trim() : '';
                if (!designName) {
                    alert('Silakan isi nama desain terlebih dahulu!');
                    if (designNameInput) designNameInput.focus();
                    return;
                }

                const savedStatus = document.getElementById('savedStatus');
                const saveBtn = document.getElementById('saveBtn');

                if (savedStatus) savedStatus.innerText = 'Menyimpan ke database...';
                if (saveBtn) {
                    saveBtn.disabled = true;
                    saveBtn.classList.add('opacity-70', 'cursor-not-allowed');
                }

                // Discard object selections
                frontCanvas.discardActiveObject().renderAll();
                backCanvas.discardActiveObject().renderAll();

                // Create a side-by-side combined png thumbnail image representation
                const combinedPNG = await getCombinedBase64PNG();
                const canvasDataPayload = getPayloadCanvasData();

                const isAuthenticated = @json(auth()->check());
                if (!isAuthenticated) {
                    localStorage.setItem('pending_design', JSON.stringify({
                        name: designName,
                        canvas_data: canvasDataPayload
                    }));
                    showSaveAuthModal();
                    
                    if (savedStatus) savedStatus.innerText = 'Semua perubahan siap disimpan';
                    if (saveBtn) {
                        saveBtn.disabled = false;
                        saveBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                    }
                    return;
                }

                const isNew = designId === "";
                const url = isNew ? "{{ route('designs.store') }}" : "/designs/" + designId;
                const method = isNew ? 'POST' : 'PUT';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            name: designName,
                            product_type: currentModel,
                            shirt_color: (currentModel === 'tshirt') ? currentColor : jerseyBgColor,
                            canvas_data: canvasDataPayload,
                            export_image: combinedPNG
                        })
                    });

                    if (!response.ok) throw new Error('Gagal menyimpan desain.');
                    const data = await response.json();
                    
                    if (data.success) {
                        if (savedStatus) savedStatus.innerText = 'Tersimpan pada ' + new Date().toLocaleTimeString();
                        alert(data.message);

                        if (isNew && data.redirect) {
                            window.location.href = data.redirect;
                        }
                    } else {
                        if (savedStatus) savedStatus.innerText = 'Gagal menyimpan perubahan';
                        alert('Error: ' + data.message);
                    }
                } catch (error) {
                    console.error('Save Error:', error);
                    if (savedStatus) savedStatus.innerText = 'Terjadi kesalahan saat menyimpan';
                    alert('Terjadi kesalahan: ' + error.message);
                } finally {
                    if (saveBtn) {
                        saveBtn.disabled = false;
                        saveBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                    }
                }
            }

            /**
             * Load Saved Design States on Load
             */
            function loadDesign() {
                syncRecommendationPreferences();
                updateModelToggleUI();
                loadDesignForCurrentModel();
            }

            function loadDesignForCurrentModel() {
                isProcessingHistory = true;
                
                // Clear canvases
                frontCanvas.clear();
                backCanvas.clear();

                const modelState = canvasStates[currentModel] || { front: null, back: null };

                const loadFrontPromise = new Promise(resolve => {
                    if (modelState.front) {
                        let filteredState = { objects: [] };
                        if (modelState.front.objects) {
                            filteredState.objects = modelState.front.objects.filter(obj => !obj.isJerseyTemplate && !obj.isTshirtTemplate);
                        }
                        frontCanvas.loadFromJSON(filteredState, () => {
                            restoreMockupTemplate(frontCanvas, 'front', resolve);
                        });
                    } else {
                        restoreMockupTemplate(frontCanvas, 'front', resolve);
                    }
                });

                const loadBackPromise = new Promise(resolve => {
                    if (modelState.back) {
                        let filteredState = { objects: [] };
                        if (modelState.back.objects) {
                            filteredState.objects = modelState.back.objects.filter(obj => !obj.isJerseyTemplate && !obj.isTshirtTemplate);
                        }
                        backCanvas.loadFromJSON(filteredState, () => {
                            restoreMockupTemplate(backCanvas, 'back', resolve);
                        });
                    } else {
                        restoreMockupTemplate(backCanvas, 'back', resolve);
                    }
                });

                return Promise.all([loadFrontPromise, loadBackPromise]).then(() => {
                    isProcessingHistory = false;
                    initHistory(frontCanvas, 'front');
                    initHistory(backCanvas, 'back');
                    setActiveSide('front');
                });
            }

            /**
             * Generate side-by-side combined png thumbnail of the design
             */
            function getCombinedBase64PNG() {
                return new Promise(resolve => {
                    const tempCanvas = document.createElement('canvas');
                    tempCanvas.width = 800;
                    tempCanvas.height = 400;
                    const ctx = tempCanvas.getContext('2d');

                    // Background color
                    ctx.fillStyle = '#f8fafc';
                    ctx.fillRect(0, 0, 800, 400);

                    const frontData = frontCanvas.toDataURL({ format: 'png', quality: 0.95 });
                    const backData = backCanvas.toDataURL({ format: 'png', quality: 0.95 });

                    const imgFront = new Image();
                    imgFront.onload = function() {
                        ctx.drawImage(imgFront, 0, 0, 400, 400);

                        const imgBack = new Image();
                        imgBack.onload = function() {
                            ctx.drawImage(imgBack, 400, 0, 400, 400);
                            resolve(tempCanvas.toDataURL('image/png'));
                        };
                        imgBack.src = backData;
                    };
                    imgFront.src = frontData;
                });
            }

            // ==========================================
            // HIGH RESOLUTION (300 DPI) EXPORT & DTF READY
            // ==========================================

            /**
             * CRC32 lookup table & calculation for PNG metadata injection
             */
            const crc32Table = (() => {
                let c;
                const table = new Uint32Array(256);
                for (let n = 0; n < 256; n++) {
                    c = n;
                    for (let k = 0; k < 8; k++) {
                        c = ((c & 1) ? (0xEDB88320 ^ (c >>> 1)) : (c >>> 1));
                    }
                    table[n] = c >>> 0;
                }
                return table;
            })();

            function getCrc32(buf) {
                let crc = -1;
                for (let i = 0; i < buf.length; i++) {
                    crc = (crc >>> 8) ^ crc32Table[(crc ^ buf[i]) & 0xFF];
                }
                return (crc ^ (-1)) >>> 0;
            }

            /**
             * Inject 300 DPI (pHYs chunk) metadata into PNG Data URL
             * Ensures graphic & RIP software (Photoshop, Illustrator, AcroRIP, CorelDRAW)
             * directly recognize the image as 300 DPI.
             */
            function addDpiToPngBase64(base64Data, dpi = 300) {
                try {
                    const parts = base64Data.split(',');
                    const raw = atob(parts[1] || parts[0]);
                    const len = raw.length;
                    const bytes = new Uint8Array(len);
                    for (let i = 0; i < len; i++) {
                        bytes[i] = raw.charCodeAt(i);
                    }

                    // Validate PNG signature: 89 50 4E 47 0D 0A 1A 0A
                    if (bytes[0] !== 0x89 || bytes[1] !== 0x50 || bytes[2] !== 0x4E || bytes[3] !== 0x47) {
                        return base64Data;
                    }

                    // 1 inch = 0.0254 meters -> pixels per meter (300 DPI = ~11811 ppm)
                    const ppm = Math.round(dpi / 0.0254);

                    let offset = 8;
                    let physOffset = -1;
                    let ihdrEnd = -1;

                    while (offset + 8 <= len) {
                        const chunkLength = ((bytes[offset] << 24) >>> 0) | (bytes[offset + 1] << 16) | (bytes[offset + 2] << 8) | bytes[offset + 3];
                        const chunkType = String.fromCharCode(bytes[offset + 4], bytes[offset + 5], bytes[offset + 6], bytes[offset + 7]);

                        if (chunkType === 'IHDR') {
                            ihdrEnd = offset + 8 + chunkLength + 4;
                        } else if (chunkType === 'pHYs') {
                            physOffset = offset;
                            break;
                        }

                        offset += 8 + chunkLength + 4;
                    }

                    // Build 21-byte pHYs chunk (4 length + 4 type + 9 data + 4 crc)
                    const physChunk = new Uint8Array(21);
                    const view = new DataView(physChunk.buffer);

                    view.setUint32(0, 9); // Data length = 9
                    physChunk[4] = 0x70; physChunk[5] = 0x48; physChunk[6] = 0x59; physChunk[7] = 0x73; // 'pHYs'
                    view.setUint32(8, ppm); // X pixels per unit (meter)
                    view.setUint32(12, ppm); // Y pixels per unit (meter)
                    physChunk[16] = 1; // Unit: meter

                    // Calculate CRC32 over 'pHYs' + 9 bytes data
                    const crc = getCrc32(physChunk.subarray(4, 17));
                    view.setUint32(17, crc);

                    let resultBytes;
                    if (physOffset !== -1) {
                        resultBytes = new Uint8Array(bytes.length);
                        resultBytes.set(bytes.subarray(0, physOffset), 0);
                        resultBytes.set(physChunk, physOffset);
                        resultBytes.set(bytes.subarray(physOffset + 21), physOffset + 21);
                    } else if (ihdrEnd !== -1) {
                        resultBytes = new Uint8Array(bytes.length + 21);
                        resultBytes.set(bytes.subarray(0, ihdrEnd), 0);
                        resultBytes.set(physChunk, ihdrEnd);
                        resultBytes.set(bytes.subarray(ihdrEnd), ihdrEnd + 21);
                    } else {
                        return base64Data;
                    }

                    let binary = '';
                    const chunkSz = 8192;
                    for (let i = 0; i < resultBytes.length; i += chunkSz) {
                        binary += String.fromCharCode.apply(null, resultBytes.subarray(i, i + chunkSz));
                    }
                    return 'data:image/png;base64,' + btoa(binary);
                } catch (e) {
                    console.warn('Gagal menyisipkan metadata 300 DPI:', e);
                    return base64Data;
                }
            }

            /**
             * Download high-resolution transparent PNG (300 DPI) for DTF Printing
             * Only exports artworks/designs/text/logos/patterns with transparent background (no shirt mockup outline)
             */
            function exportDTFSidePNG(c, sideLabel) {
                c.discardActiveObject().renderAll();

                const originalZoom = c.getZoom();
                c.setZoom(1.0);
                const originalVpt = c.viewportTransform;
                c.viewportTransform = [1, 0, 0, 1, 0, 0];

                const originalBgColor = c.backgroundColor;
                c.setBackgroundColor(null, c.renderAll.bind(c));

                // Sembunyikan mockup dasar kaos/jersey agar background transparan murni untuk cetak DTF
                const templateObj = c.getObjects().find(o => o.isJerseyTemplate || o.isTshirtTemplate);
                if (templateObj) templateObj.set('visible', false);
                c.renderAll();

                try {
                    // Multiplier 8 menghasilkan resolusi ultra-tajam 3200 x 3200 px (300 DPI siap cetak DTF)
                    let dataURL = c.toDataURL({
                        format: 'png',
                        quality: 1.0,
                        multiplier: 8,
                        enableRetinaScaling: false
                    });

                    // Sisipkan metadata 300 DPI (pHYs chunk)
                    dataURL = addDpiToPngBase64(dataURL, 300);

                    const designName = (document.getElementById('designNameInput')?.value.trim() || 'desain').replace(/[^a-z0-9]/gi, '_').toLowerCase();
                    const link = document.createElement('a');
                    link.download = `${designName}_DTF_${sideLabel}_300DPI_${Date.now()}.png`;
                    link.href = dataURL;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } catch (err) {
                    console.error(err);
                    alert('Gagal mengekspor PNG DTF 300 DPI: ' + err.message);
                } finally {
                    if (templateObj) templateObj.set('visible', true);
                    c.setBackgroundColor(originalBgColor, c.renderAll.bind(c));
                    c.setZoom(originalZoom);
                    c.viewportTransform = originalVpt;
                    c.renderAll();
                }
            }

            /**
             * Download high-resolution PNG (300 DPI) with shirt mockup preview
             */
            function exportSidePNG(c, sideLabel) {
                c.discardActiveObject().renderAll();

                const originalZoom = c.getZoom();
                c.setZoom(1.0);
                const originalVpt = c.viewportTransform;
                c.viewportTransform = [1, 0, 0, 1, 0, 0];

                const originalBgColor = c.backgroundColor;
                c.setBackgroundColor(null, c.renderAll.bind(c));

                const templateObj = c.getObjects().find(o => o.isJerseyTemplate || o.isTshirtTemplate);
                if (templateObj) templateObj.set('visible', true);
                c.renderAll();

                try {
                    // Multiplier 8 menghasilkan resolusi ultra-tajam 3200 x 3200 px (300 DPI HD Mockup)
                    let dataURL = c.toDataURL({
                        format: 'png',
                        quality: 1.0,
                        multiplier: 8,
                        enableRetinaScaling: false
                    });

                    // Sisipkan metadata 300 DPI (pHYs chunk)
                    dataURL = addDpiToPngBase64(dataURL, 300);

                    const designName = (document.getElementById('designNameInput')?.value.trim() || 'desain').replace(/[^a-z0-9]/gi, '_').toLowerCase();
                    const link = document.createElement('a');
                    link.download = `${designName}_mockup_${sideLabel}_300DPI_${Date.now()}.png`;
                    link.href = dataURL;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } catch (err) {
                    console.error(err);
                    alert('Gagal mengekspor PNG Mockup: ' + err.message);
                } finally {
                    c.setBackgroundColor(originalBgColor, c.renderAll.bind(c));
                    c.setZoom(originalZoom);
                    c.viewportTransform = originalVpt;
                    c.renderAll();
                }
            }

            /**
             * Download combined PNG showing mockup products side-by-side (300 DPI Ultra HD)
             */
            async function exportCombinedPNG() {
                try {
                    // Multiplier 6 per sisi -> 2400x2400 per sisi -> Total 4800 x 2400 px
                    const mult = 6;
                    const sideW = 400 * mult;
                    const sideH = 400 * mult;

                    frontCanvas.discardActiveObject().renderAll();
                    backCanvas.discardActiveObject().renderAll();

                    const origFrontZoom = frontCanvas.getZoom();
                    const origBackZoom = backCanvas.getZoom();
                    const origFrontVpt = frontCanvas.viewportTransform;
                    const origBackVpt = backCanvas.viewportTransform;

                    frontCanvas.setZoom(1.0);
                    frontCanvas.viewportTransform = [1, 0, 0, 1, 0, 0];
                    backCanvas.setZoom(1.0);
                    backCanvas.viewportTransform = [1, 0, 0, 1, 0, 0];

                    const frontData = frontCanvas.toDataURL({ format: 'png', quality: 1.0, multiplier: mult });
                    const backData = backCanvas.toDataURL({ format: 'png', quality: 1.0, multiplier: mult });

                    frontCanvas.setZoom(origFrontZoom);
                    frontCanvas.viewportTransform = origFrontVpt;
                    backCanvas.setZoom(origBackZoom);
                    backCanvas.viewportTransform = origBackVpt;
                    frontCanvas.renderAll();
                    backCanvas.renderAll();

                    const tempCanvas = document.createElement('canvas');
                    tempCanvas.width = sideW * 2;
                    tempCanvas.height = sideH;
                    const ctx = tempCanvas.getContext('2d');

                    // Background color
                    ctx.fillStyle = '#f8fafc';
                    ctx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);

                    const imgFront = new Image();
                    await new Promise((resolve) => {
                        imgFront.onload = resolve;
                        imgFront.src = frontData;
                    });
                    ctx.drawImage(imgFront, 0, 0, sideW, sideH);

                    const imgBack = new Image();
                    await new Promise((resolve) => {
                        imgBack.onload = resolve;
                        imgBack.src = backData;
                    });
                    ctx.drawImage(imgBack, sideW, 0, sideW, sideH);

                    let combinedUrl = tempCanvas.toDataURL('image/png');
                    combinedUrl = addDpiToPngBase64(combinedUrl, 300);

                    const designName = (document.getElementById('designNameInput')?.value.trim() || 'desain').replace(/[^a-z0-9]/gi, '_').toLowerCase();
                    const link = document.createElement('a');
                    link.download = `${designName}_mockup_kombinasi_300DPI_${Date.now()}.png`;
                    link.href = combinedUrl;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } catch (err) {
                    console.error(err);
                    alert('Gagal mengekspor kombinasi: ' + err.message);
                }
            }

            /**
             * Download vector SVG of specific canvas side
             */
            function exportSideSVG(c, sideLabel) {
                c.discardActiveObject().renderAll();
                try {
                    const svgContent = c.toSVG({
                        width: c.width,
                        height: c.height,
                        viewBox: { x: 0, y: 0, width: c.width, height: c.height }
                    });
                    const designName = (document.getElementById('designNameInput')?.value.trim() || 'desain').replace(/[^a-z0-9]/gi, '_').toLowerCase();
                    const blob = new Blob([svgContent], { type: 'image/svg+xml;charset=utf-8' });
                    const blobURL = URL.createObjectURL(blob);
                    
                    const link = document.createElement('a');
                    link.download = `${designName}_${sideLabel}_${Date.now()}.svg`;
                    link.href = blobURL;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(blobURL);
                } catch (err) {
                    console.error(err);
                    alert('Gagal mengekspor SVG: ' + err.message);
                }
            }

            /**
             * Undo logic on active side canvas
             */
            function undo() {
                const sideHistory = history[currentSide];
                if (sideHistory.undoStack.length <= 1) return;

                isProcessingHistory = true;
                const currentState = sideHistory.undoStack.pop();
                sideHistory.redoStack.push(currentState);

                const previousState = sideHistory.undoStack[sideHistory.undoStack.length - 1];
                const stateObj = JSON.parse(previousState);

                activeCanvas.clear();
                const filtered = stateObj.objects.filter(obj => !obj.isJerseyTemplate && !obj.isTshirtTemplate);

                activeCanvas.loadFromJSON({ objects: filtered }, () => {
                    restoreMockupTemplate(activeCanvas, currentSide, () => {
                        isProcessingHistory = false;
                        updateInspector();
                        refreshLayers();
                    });
                });
            }

            /**
             * Redo logic on active side canvas
             */
            function redo() {
                const sideHistory = history[currentSide];
                if (sideHistory.redoStack.length === 0) return;

                isProcessingHistory = true;
                const nextState = sideHistory.redoStack.pop();
                sideHistory.undoStack.push(nextState);
                const stateObj = JSON.parse(nextState);

                activeCanvas.clear();
                const filtered = stateObj.objects.filter(obj => !obj.isJerseyTemplate && !obj.isTshirtTemplate);

                activeCanvas.loadFromJSON({ objects: filtered }, () => {
                    restoreMockupTemplate(activeCanvas, currentSide, () => {
                        isProcessingHistory = false;
                        updateInspector();
                        refreshLayers();
                    });
                });
            }

            /**
             * Recolor Tshirt/Jersey Mockup on both sides
             */
            function changeShirtColor(color) {
                if (!color) return;

                const colorMap = {
                    'merah': '#e11d48', 'biru': '#2563eb', 'hitam': '#111212', 'putih': '#ffffff',
                    'hijau': '#16a34a', 'kuning': '#eab308', 'abu-abu': '#94a3b8', 'marun': '#881337',
                    'navy': '#1e3a8a', 'army': '#064e3b', 'oranye': '#ea580c', 'ungu': '#7c3aed'
                };
                
                const hexColor = colorMap[color.toLowerCase()] || color;
                currentColor = hexColor;
                if (currentModel === 'jersey') {
                    jerseyBgColor = hexColor;
                }

                if (currentModel === 'tshirt') {
                    if (frontCanvas) changeTshirtColor(frontCanvas, hexColor);
                    if (backCanvas) changeTshirtColor(backCanvas, hexColor);
                } else if (currentModel === 'jersey') {
                    updateJerseyColorGlobally('jersey-bg', hexColor);
                }

                // Highlight color button
                document.querySelectorAll('.shirt-color-btn').forEach(btn => {
                    const btnColor = btn.getAttribute('data-color');
                    if (btnColor === color || (btnColor && colorMap[btnColor.toLowerCase()] === hexColor)) {
                        btn.classList.add('ring-2', 'ring-indigo-600', 'ring-offset-2');
                    } else {
                        btn.classList.remove('ring-2', 'ring-indigo-600', 'ring-offset-2');
                    }
                });

                const customPicker = document.getElementById('customColorPicker');
                const customHex = document.getElementById('customColorHex');
                if (customPicker && customHex) {
                    customPicker.value = hexColor;
                    customHex.value = hexColor.toUpperCase();
                }

                syncRecommendationPreferences();
            }

            // In-memory Caching for API requests to ensure instant loading over Ngrok / Mobile Network
            const motifCache = {};
            const templateCache = {};

            /**
             * Load Custom Motifs list from API with instant memory cache
             */
            async function loadMotifs(category = '') {
                const motifGrid = document.getElementById('motifGrid');
                if (!motifGrid) return;

                if (motifCache[category]) {
                    renderMotifs(motifCache[category]);
                    return;
                }

                motifGrid.innerHTML = `
                    <div class="col-span-4 flex justify-center py-4">
                        <svg class="animate-spin h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                `;

                let url = '/api/motifs';
                if (category) url += `?category=${encodeURIComponent(category)}`;

                try {
                    const response = await fetch(url);
                    if (!response.ok) throw new Error('Gagal memuat motif');
                    const data = await response.json();

                    if (data.success && data.data) {
                        motifCache[category] = data.data;
                        renderMotifs(data.data);
                    } else {
                        motifGrid.innerHTML = `<div class="col-span-4 text-center py-4 text-[10px] text-slate-400">Tidak ada motif.</div>`;
                    }
                } catch (err) {
                    console.error(err);
                    motifGrid.innerHTML = `<div class="col-span-4 text-center py-4 text-[10px] text-rose-500">Gagal memuat.</div>`;
                }
            }

            function renderMotifs(motifs) {
                const motifGrid = document.getElementById('motifGrid');
                if (!motifGrid) return;

                if (motifs && motifs.length > 0) {
                    motifGrid.innerHTML = '';
                    motifs.forEach(motif => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        // Support kolom baru (name, image_front) dan kolom lama (nama, path_file) sebagai fallback
                        const motifName = motif.name || motif.nama || 'Motif';
                        const motifSrc  = motif.image_front || motif.path_file || '';
                        btn.className = 'aspect-square bg-slate-50 border border-slate-200 hover:border-indigo-500 rounded-xl p-1.5 flex items-center justify-center transition-all group';
                        btn.title = motifName;
                        btn.innerHTML = `<img src="${motifSrc}" class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform" loading="lazy" alt="${motifName}">`;
                        btn.addEventListener('click', () => addMotifToCanvas(motifSrc));
                        motifGrid.appendChild(btn);
                    });
                } else {
                    motifGrid.innerHTML = `<div class="col-span-4 text-center py-4 text-[10px] text-slate-400">Tidak ada motif.</div>`;
                }
            }

            // ==========================================
            // RECOMMENDATION SYSTEM (Weighted Attribute Matching)
            // ==========================================

            const ATTRIBUTE_WEIGHTS = {
                category: 0.50,
                theme: 0.30,
                color: 0.20
            };

            const COLOR_HEX_TO_NAME_MAP = {
                '#ffffff': 'putih',
                '#111212': 'hitam',
                '#0f0f0f': 'hitam',
                '#000000': 'hitam',
                '#94a3b8': 'abu-abu',
                '#e11d48': 'merah',
                '#881337': 'marun',
                '#1e3a8a': 'navy',
                '#2563eb': 'biru',
                '#16a34a': 'hijau',
                '#064e3b': 'army',
                '#eab308': 'kuning',
                '#ea580c': 'oranye',
                '#7c3aed': 'ungu'
            };

            const COLOR_NAME_TO_HEX_MAP = {
                'putih': '#ffffff',
                'hitam': '#111212',
                'abu-abu': '#94a3b8',
                'merah': '#e11d48',
                'marun': '#881337',
                'navy': '#1e3a8a',
                'biru': '#2563eb',
                'hijau': '#16a34a',
                'army': '#064e3b',
                'kuning': '#eab308',
                'oranye': '#ea580c',
                'ungu': '#7c3aed'
            };

            function normalizeValue(value) {
                return String(value || '')
                    .trim()
                    .toLowerCase();
            }

            function calculateRecommendationScore(template, preference) {
                const categoryMatch =
                    normalizeValue(template.category) ===
                    normalizeValue(preference.category) ? 1 : 0;

                const themeMatch =
                    normalizeValue(template.theme) ===
                    normalizeValue(preference.theme) ? 1 : 0;

                const colorMatch =
                    normalizeValue(template.color) ===
                    normalizeValue(preference.color) ? 1 : 0;

                const score =
                    (categoryMatch * ATTRIBUTE_WEIGHTS.category) +
                    (themeMatch * ATTRIBUTE_WEIGHTS.theme) +
                    (colorMatch * ATTRIBUTE_WEIGHTS.color);

                return {
                    score: Number(score.toFixed(2)),
                    percentage: Math.round(score * 100),
                    matches: {
                        category: categoryMatch,
                        theme: themeMatch,
                        color: colorMatch
                    }
                };
            }

            function getCurrentColorPreference() {
                const lower = normalizeValue(currentColor);
                if (COLOR_NAME_TO_HEX_MAP[lower]) {
                    return { name: lower, hex: COLOR_NAME_TO_HEX_MAP[lower] };
                }
                if (COLOR_HEX_TO_NAME_MAP[lower]) {
                    return { name: COLOR_HEX_TO_NAME_MAP[lower], hex: lower };
                }
                // Custom Hex fallback
                return {
                    name: lower.startsWith('#') ? (COLOR_HEX_TO_NAME_MAP[lower.toLowerCase()] || lower) : lower,
                    hex: lower.startsWith('#') ? lower : '#ffffff'
                };
            }

            let hasLoadedRecommendations = false;

            function collapseRecommendationFilter() {
                const recFilterCard = document.getElementById('recFilterCard');
                const recFilterSummaryBar = document.getElementById('recFilterSummaryBar');
                const closeRecFilterBtn = document.getElementById('closeRecFilterBtn');

                if (recFilterCard) recFilterCard.classList.add('hidden');
                if (recFilterSummaryBar) {
                    recFilterSummaryBar.classList.remove('hidden');
                    recFilterSummaryBar.classList.add('flex');
                }
                if (closeRecFilterBtn && hasLoadedRecommendations) {
                    closeRecFilterBtn.classList.remove('hidden');
                }
            }

            function expandRecommendationFilter() {
                const recFilterCard = document.getElementById('recFilterCard');
                const recFilterSummaryBar = document.getElementById('recFilterSummaryBar');

                if (recFilterCard) recFilterCard.classList.remove('hidden');
                if (recFilterSummaryBar) {
                    recFilterSummaryBar.classList.add('hidden');
                    recFilterSummaryBar.classList.remove('flex');
                }
            }

            function updateRecommendationFilterSummary(category, color, theme) {
                const recSummaryChips = document.getElementById('recSummaryChips');
                if (!recSummaryChips) return;

                const categoryLabels = { kaos: '👕 Kaos', jersey: '🎽 Jersey' };
                const colorLabels = {
                    putih: '⚪ Putih', hitam: '⚫ Hitam', merah: '🔴 Merah',
                    biru: '🔵 Biru', hijau: '🟢 Hijau', kuning: '🟡 Kuning',
                    'abu-abu': '🔘 Abu', marun: '🍷 Marun', navy: '⚓ Navy',
                    army: '🌲 Army', oranye: '🟠 Oranye', ungu: '🟣 Ungu'
                };

                const catText = category ? (categoryLabels[category.toLowerCase()] || category) : 'Kaos';
                const colText = color ? (colorLabels[color.toLowerCase()] || color) : 'Semua Warna';
                const thmText = theme ? (theme.charAt(0).toUpperCase() + theme.slice(1)) : 'Semua Tema';

                recSummaryChips.innerHTML = `
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-indigo-100 text-indigo-700">${catText}</span>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-white text-slate-700 border border-slate-200">${thmText}</span>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-white text-slate-700 border border-slate-200">${colText}</span>
                `;
            }

            function syncRecommendationPreferences() {
                // Always force recCategory to match currentModel
                const recCategory = document.getElementById('recCategory');
                const recColor = document.getElementById('recColor');

                if (recCategory) {
                    recCategory.value = (currentModel === 'jersey') ? 'jersey' : 'kaos';
                }

                if (recColor && !recColor.value) {
                    const pref = getCurrentColorPreference();
                    if (pref && pref.name && recColor.querySelector(`option[value="${pref.name}"]`)) {
                        recColor.value = pref.name;
                    }
                }
            }

            function resetRecommendationsForModelChange() {
                // Force sync category
                syncRecommendationPreferences();

                // Reset recommendation state so user must search again
                hasLoadedRecommendations = false;

                // Clear results area
                const recommendationResults = document.getElementById('recommendationResults');
                if (recommendationResults) {
                    recommendationResults.innerHTML = `
                        <div class="h-full flex flex-col items-center justify-center text-center py-12 gap-3">
                            <div class="text-3xl">🔄</div>
                            <p class="text-xs font-bold text-slate-700">Kategori berubah!</p>
                            <p class="text-[10px] text-slate-400">Pilih preferensi dan cari rekomendasi untuk
                            <span class="font-bold text-indigo-600">${(currentModel === 'jersey') ? 'Jersey Sport' : 'Kaos Polos'}</span>.</p>
                        </div>
                    `;
                }

                // Show filter form and hide summary bar
                const recFilterCard = document.getElementById('recFilterCard');
                const recFilterSummaryBar = document.getElementById('recFilterSummaryBar');
                const recThemeSelect = document.getElementById('recTheme');

                if (recFilterCard) recFilterCard.classList.remove('hidden');
                if (recFilterSummaryBar) {
                    recFilterSummaryBar.classList.add('hidden');
                    recFilterSummaryBar.classList.remove('flex');
                }
                // Reset tema agar user memilih ulang
                if (recThemeSelect) recThemeSelect.value = '';
            }

            async function loadRecommendations() {
                const recCategory = document.getElementById('recCategory')?.value || (currentModel === 'jersey' ? 'jersey' : 'kaos');
                const recColor    = document.getElementById('recColor')?.value || 'putih';
                const recThemeSelect = document.getElementById('recTheme');
                const recTheme    = recThemeSelect?.value || '';

                const recValidationMsg     = document.getElementById('recValidationMsg');
                const recValidationText    = document.getElementById('recValidationText');
                const recommendationResults = document.getElementById('recommendationResults');
                const findBtn              = document.getElementById('findRecommendationsBtn');

                // Validasi: Tema wajib dipilih
                if (!recTheme) {
                    if (recValidationMsg) {
                        recValidationMsg.classList.remove('hidden');
                        if (recValidationText) recValidationText.textContent = 'Silakan pilih tema desain terlebih dahulu.';
                    }
                    if (recThemeSelect) {
                        recThemeSelect.classList.add('border-rose-400', 'ring-2', 'ring-rose-200');
                        recThemeSelect.focus();
                        setTimeout(() => {
                            recThemeSelect.classList.remove('border-rose-400', 'ring-2', 'ring-rose-200');
                        }, 2500);
                    }
                    return;
                }

                if (recValidationMsg) {
                    recValidationMsg.classList.add('hidden');
                }

                // Sembunyikan form filter dan tampilkan bar ringkasan preferensi
                updateRecommendationFilterSummary(recCategory, recColor, recTheme);
                collapseRecommendationFilter();

                if (findBtn) {
                    findBtn.disabled = true;
                    findBtn.innerHTML = `
                        <svg class="animate-spin h-3.5 w-3.5 text-white mr-1" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Mencari Rekomendasi...</span>
                    `;
                }

                recommendationResults.innerHTML = `
                    <div class="h-full flex flex-col items-center justify-center text-center py-12 gap-3">
                        <svg class="animate-spin h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p class="text-xs text-slate-500 font-medium">Menghitung kesesuaian template...</p>
                    </div>
                `;

                const preference = {
                    category: recCategory,
                    theme: recTheme,
                    color: recColor
                };

                const cacheKey = `${preference.category}_${preference.color}_${preference.theme}`;
                if (templateCache[cacheKey]) {
                    hasLoadedRecommendations = true;
                    if (findBtn) {
                        findBtn.disabled = false;
                        findBtn.innerHTML = `
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            <span>Cari Rekomendasi</span>
                        `;
                    }
                    renderRecommendations(templateCache[cacheKey], preference);
                    return;
                }

                try {
                    const response = await fetch("{{ route('recommendations.get') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(preference)
                    });

                    if (!response.ok) throw new Error('Gagal mengambil data rekomendasi');
                    const resultJson = await response.json();

                    let rawTemplates = (resultJson.success && resultJson.data) ? resultJson.data : [];

                    // Hitung dan verifikasi dengan Weighted Attribute Matching di JavaScript
                    const processedTemplates = rawTemplates.map(tpl => {
                        const scoreResult = calculateRecommendationScore(tpl, preference);
                        return {
                            ...tpl,
                            score: scoreResult.score,
                            percentage: scoreResult.percentage,
                            matches: scoreResult.matches
                        };
                    });

                    // Urutkan dari score tertinggi ke score terendah
                    processedTemplates.sort((a, b) => {
                        if (b.score === a.score) {
                            return (a.id || 0) - (b.id || 0);
                        }
                        return b.score - a.score;
                    });

                    hasLoadedRecommendations = true;
                    templateCache[cacheKey] = processedTemplates;
                    renderRecommendations(processedTemplates, preference);

                } catch (err) {
                    console.error('[RECOMMENDATION ERROR]', err);
                    recommendationResults.innerHTML = `
                        <div class="h-full flex flex-col items-center justify-center py-12 text-center gap-2">
                            <div class="text-2xl">⚠️</div>
                            <p class="text-xs text-rose-500 font-bold">Gagal memuat rekomendasi.</p>
                            <p class="text-[10px] text-slate-400">Silakan coba beberapa saat lagi.</p>
                        </div>
                    `;
                } finally {
                    if (findBtn) {
                        findBtn.disabled = false;
                        findBtn.innerHTML = `
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            <span>Cari Rekomendasi</span>
                        `;
                    }
                }
            }

            function renderRecommendations(templates, preference) {
                const recommendationResults = document.getElementById('recommendationResults');
                if (!recommendationResults) return;

                // 1. Cek apakah ada template dengan skor > 0
                const maxScore = templates.length > 0 ? Math.max(...templates.map(t => t.score)) : 0;
                let displayTemplates = templates;

                if (maxScore > 0) {
                    // Template dengan score 0% tidak perlu ditampilkan jika ada template dengan skor lebih tinggi
                    displayTemplates = templates.filter(t => t.score > 0);
                }

                // 2. Jika semua template 0% atau tidak ada data
                if (displayTemplates.length === 0 || maxScore === 0) {
                    recommendationResults.innerHTML = `
                        <div class="flex flex-col items-center justify-center py-10 gap-3 text-center px-4">
                            <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center text-xl shadow-2xs">🔍</div>
                            <p class="text-xs font-bold text-slate-700 leading-snug">Belum ditemukan template yang sesuai.</p>
                            <p class="text-[10px] text-slate-400 leading-relaxed">Coba ubah pilihan kategori, tema, atau warna pakaian.</p>
                            <button type="button" onclick="expandRecommendationFilter()" class="mt-1 px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-[10px] font-bold rounded-lg border border-indigo-200 transition-all cursor-pointer">
                                ✏️ Ubah Preferensi
                            </button>
                        </div>
                    `;
                    return;
                }

                // 3. Tampilkan maksimal 5 rekomendasi terbaik
                const topRecommendations = displayTemplates.slice(0, 5);

                recommendationResults.innerHTML = '';

                // Header Preferensi Pencarian & Count
                const prefCategoryLabel = (preference.category === 'jersey') ? 'Jersey' : 'Kaos';
                const prefThemeLabel    = preference.theme ? (preference.theme.charAt(0).toUpperCase() + preference.theme.slice(1)) : '-';
                const prefColorLabel    = preference.color ? (preference.color.charAt(0).toUpperCase() + preference.color.slice(1)) : '-';

                const headerDiv = document.createElement('div');
                headerDiv.className = 'p-2 bg-indigo-50/80 border border-indigo-100 rounded-xl mb-2.5';
                headerDiv.innerHTML = `
                    <div class="flex items-center justify-between">
                        <span class="text-[9px] font-extrabold uppercase tracking-wider text-indigo-800 flex items-center gap-1">
                            <span>✨</span> HASIL REKOMENDASI
                        </span>
                        <span class="text-[9px] font-bold text-indigo-700 bg-white px-2 py-0.5 rounded-full border border-indigo-200 shadow-2xs">${topRecommendations.length} Terpilih</span>
                    </div>
                `;
                recommendationResults.appendChild(headerDiv);

                // Render Kartu Setiap Rekomendasi
                topRecommendations.forEach((tpl, idx) => {
                    const previewFront = tpl.preview_front || tpl.image_path || '/assets/mockups/tshirt/front.svg';
                    const previewBack  = tpl.preview_back  || tpl.preview_front || tpl.image_path || '/assets/mockups/tshirt/back.svg';

                    const matches = tpl.matches || { category: 0, theme: 0, color: 0 };
                    const percentage = tpl.percentage !== undefined ? tpl.percentage : Math.round(tpl.score * 100);

                    // Badge Kesesuaian Color Styling
                    let scoreBadgeClass = 'bg-slate-100 text-slate-700 border-slate-200';
                    if (percentage >= 80) {
                        scoreBadgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-300';
                    } else if (percentage >= 50) {
                        scoreBadgeClass = 'bg-amber-50 text-amber-700 border-amber-300';
                    }

                    const card = document.createElement('div');
                    card.className = 'bg-white border border-slate-200 hover:border-indigo-400 rounded-2xl p-3 shadow-2xs hover:shadow-md transition-all duration-200 space-y-2.5';

                    card.innerHTML = `
                        <!-- Preview Mockup Depan & Belakang -->
                        <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xl border border-slate-100">
                            <div class="flex-1 flex flex-col items-center justify-center p-1 bg-white rounded-lg border border-slate-100 min-h-[75px]">
                                <img src="${previewFront}" class="max-h-16 w-auto object-contain" alt="${tpl.name} Depan" onerror="this.src='/assets/mockups/tshirt/front.svg'" loading="lazy">
                                <span class="text-[8px] font-bold text-slate-400 uppercase mt-1">Depan</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center justify-center p-1 bg-white rounded-lg border border-slate-100 min-h-[75px]">
                                <img src="${previewBack}" class="max-h-16 w-auto object-contain" alt="${tpl.name} Belakang" onerror="this.src='/assets/mockups/tshirt/back.svg'" loading="lazy">
                                <span class="text-[8px] font-bold text-slate-400 uppercase mt-1">Belakang</span>
                            </div>
                        </div>

                        <!-- Template Title & Tags -->
                        <div>
                            <div class="flex items-start justify-between gap-1.5 mb-1">
                                <h5 class="text-xs font-bold text-slate-900 leading-snug line-clamp-1">${tpl.name}</h5>
                                <span class="text-[9px] font-mono font-bold px-1.5 py-0.5 rounded-md bg-slate-100 text-slate-600 shrink-0">#${idx + 1}</span>
                            </div>
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <span class="text-[8px] font-bold px-1.5 py-0.5 rounded bg-indigo-50 text-indigo-700 capitalize">${tpl.category || 'Kaos'}</span>
                                <span class="text-[8px] font-bold px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 capitalize">${tpl.theme || '-'}</span>
                                <span class="text-[8px] font-bold px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 capitalize">${tpl.color || '-'}</span>
                            </div>
                        </div>

                        <!-- Weighted Attribute Breakdown (Kategori 50%, Tema 30%, Warna 20%) -->
                        <div class="bg-slate-50/80 rounded-xl p-2 border border-slate-100 text-[10px] space-y-1">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500 font-medium">Kategori (50%)</span>
                                <span class="${matches.category ? 'text-emerald-600 font-bold' : 'text-slate-400 font-medium'} flex items-center gap-1">
                                    ${matches.category ? '✓ 50%' : '✕ 0%'}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500 font-medium">Tema (30%)</span>
                                <span class="${matches.theme ? 'text-emerald-600 font-bold' : 'text-slate-400 font-medium'} flex items-center gap-1">
                                    ${matches.theme ? '✓ 30%' : '✕ 0%'}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500 font-medium">Warna (20%)</span>
                                <span class="${matches.color ? 'text-emerald-600 font-bold' : 'text-slate-400 font-medium'} flex items-center gap-1">
                                    ${matches.color ? '✓ 20%' : '✕ 0%'}
                                </span>
                            </div>
                        </div>

                        <!-- Kesesuaian Score -->
                        <div class="flex items-center justify-between px-0.5">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Kesesuaian</span>
                            <span class="text-xs font-black px-2.5 py-0.5 rounded-lg border ${scoreBadgeClass}">
                                ${percentage}%
                            </span>
                        </div>

                        <!-- Tombol Terapkan Template -->
                        <button type="button" class="apply-template-btn w-full py-2 px-3 bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all shadow-sm flex items-center justify-center gap-1.5 cursor-pointer" data-template='${JSON.stringify(tpl).replace(/'/g, "&apos;")}'>
                            <span>🎨 Terapkan Template</span>
                        </button>
                    `;

                    recommendationResults.appendChild(card);
                });

                // Attach event listener ke setiap tombol Terapkan Template
                document.querySelectorAll('.apply-template-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        try {
                            const tplData = JSON.parse(this.getAttribute('data-template'));
                            applyTemplate(tplData);

                            // Feedback visual tombol
                            const originalHTML = this.innerHTML;
                            this.innerHTML = '<span>✅ Template Diterapkan!</span>';
                            this.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                            this.classList.add('bg-emerald-600', 'hover:bg-emerald-700');

                            setTimeout(() => {
                                this.innerHTML = originalHTML;
                                this.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                                this.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                            }, 2000);
                        } catch (e) {
                            console.error('Gagal membaca data template:', e);
                        }
                    });
                });
            }

            /**
             * Add Text Object to Active Canvas
             */
            function addText(type) {
                let size = 16;
                let text = 'Teks';
                let isBold = false;

                if (type === 'heading') {
                    size = 32;
                    text = 'Masukkan Judul';
                    isBold = true;
                } else if (type === 'subheading') {
                    size = 22;
                    text = 'Masukkan Subjudul';
                    isBold = true;
                } else {
                    size = 14;
                    text = 'Teks biasa...';
                }

                createTextObject(text, size, isBold);
            }

            /**
             * Add custom image file to active canvas with transparency auto-crop and shirt clipping
             */
            function uploadImage(file) {
                if (!file) return;

                const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak valid! Harap unggah gambar raster PNG, JPG, atau JPEG.');
                    return;
                }

                const maxSize = 5 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal ukuran gambar adalah 5MB.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (event) => {
                    const tempImg = new Image();
                    tempImg.onload = () => {
                        const width = tempImg.naturalWidth || tempImg.width;
                        const height = tempImg.naturalHeight || tempImg.height;

                        if (!width || !height) return;

                        // Temporary canvas to analyze non-transparent pixel bounds
                        const tempCanvas = document.createElement('canvas');
                        tempCanvas.width = width;
                        tempCanvas.height = height;
                        const ctx = tempCanvas.getContext('2d');
                        ctx.drawImage(tempImg, 0, 0);

                        let minX = width;
                        let minY = height;
                        let maxX = -1;
                        let maxY = -1;

                        try {
                            const imgData = ctx.getImageData(0, 0, width, height);
                            const data = imgData.data;

                            // Scan pixels for non-transparent area (alpha > 10)
                            for (let y = 0; y < height; y++) {
                                for (let x = 0; x < width; x++) {
                                    const alpha = data[(y * width + x) * 4 + 3];
                                    if (alpha > 10) {
                                        if (x < minX) minX = x;
                                        if (x > maxX) maxX = x;
                                        if (y < minY) minY = y;
                                        if (y > maxY) maxY = y;
                                    }
                                }
                            }
                        } catch (err) {
                            console.warn('Gagal membaca data pixel gambar, menggunakan ukuran asli:', err);
                        }

                        // Fallback if no visible non-transparent pixels were found
                        if (maxX === -1 || maxY === -1 || minX >= maxX || minY >= maxY) {
                            minX = 0;
                            minY = 0;
                            maxX = width - 1;
                            maxY = height - 1;
                        }

                        // Add small padding (4px) so bounding box doesn't touch the logo edges directly
                        const padding = 4;
                        const cropMinX = Math.max(0, minX - padding);
                        const cropMinY = Math.max(0, minY - padding);
                        const cropMaxX = Math.min(width - 1, maxX + padding);
                        const cropMaxY = Math.min(height - 1, maxY + padding);
                        const cropWidth = cropMaxX - cropMinX + 1;
                        const cropHeight = cropMaxY - cropMinY + 1;

                        // Create cropped canvas containing only the visible logo region
                        const cropCanvas = document.createElement('canvas');
                        cropCanvas.width = cropWidth;
                        cropCanvas.height = cropHeight;
                        const cropCtx = cropCanvas.getContext('2d');
                        cropCtx.drawImage(
                            tempCanvas,
                            cropMinX, cropMinY, cropWidth, cropHeight,
                            0, 0, cropWidth, cropHeight
                        );

                        const croppedDataURL = cropCanvas.toDataURL('image/png');

                        // Create Fabric.js image object from cropped PNG
                        fabric.Image.fromURL(croppedDataURL, (img) => {
                            if (!img || !activeCanvas) return;

                            // Scale to max 25% of canvas dimension, avoiding over-stretching small images (max ratio = 1)
                            const maxDim = Math.min(activeCanvas.width, activeCanvas.height) * 0.25;
                            const ratio = Math.min(maxDim / img.width, maxDim / img.height, 1);

                            img.set({
                                left: activeCanvas.width / 2,
                                top: activeCanvas.height / 2,
                                originX: 'center',
                                originY: 'center',
                                scaleX: ratio,
                                scaleY: ratio,
                                selectable: true,
                                evented: true,
                                hasControls: true,
                                hasBorders: true,
                                objectType: 'user-image',
                                side: currentSide || 'front'
                            });

                            // Log image dimensions for debugging bounding box size
                            console.log('Uploaded image dimensions:', {
                                width: img.width,
                                height: img.height,
                                scaleX: img.scaleX,
                                scaleY: img.scaleY,
                                scaledWidth: img.getScaledWidth(),
                                scaledHeight: img.getScaledHeight()
                            });

                            // DO NOT set clipPath directly on logo img object!
                            // Absolute clipPath objects in Fabric.js distort and inflate selection bounding boxes.

                            // Movement constraint: Keep logo center within reasonable shirt printing bounds
                            img.on('moving', () => {
                                const minLeft = activeCanvas.width * 0.15;
                                const maxLeft = activeCanvas.width * 0.85;
                                const minTop = activeCanvas.height * 0.12;
                                const maxTop = activeCanvas.height * 0.85;

                                if (img.left < minLeft) img.left = minLeft;
                                if (img.left > maxLeft) img.left = maxLeft;
                                if (img.top < minTop) img.top = minTop;
                                if (img.top > maxTop) img.top = maxTop;
                            });

                            setupObjectControls(img);
                            activeCanvas.add(img);
                            adjustLayers(activeCanvas);
                            img.setCoords();
                            activeCanvas.setActiveObject(img);
                            activeCanvas.requestRenderAll();

                            if (typeof refreshLayers === 'function') {
                                refreshLayers();
                            }
                            if (typeof updateInspector === 'function') {
                                updateInspector();
                            }
                        });
                    };
                    tempImg.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }

            /**
             * Delete active canvas object
             */
            function deleteSelected() {
                const activeObj = activeCanvas.getActiveObject();
                if (activeObj) {
                    if (activeObj.isJerseyTemplate || activeObj.isTshirtTemplate) return;
                    activeCanvas.remove(activeObj);
                    activeCanvas.discardActiveObject();
                    activeCanvas.renderAll();
                }
            }

            /**
             * Duplicate active canvas object
             */
            function duplicateObject() {
                const activeObj = activeCanvas.getActiveObject();
                if (!activeObj) return;
                if (activeObj.isJerseyTemplate || activeObj.isTshirtTemplate) return;

                activeObj.clone((clonedObj) => {
                    activeCanvas.discardActiveObject();
                    clonedObj.set({
                        left: clonedObj.left + 15,
                        top: clonedObj.top + 15,
                        evented: true
                    });

                    if (clonedObj.type === 'activeSelection') {
                        clonedObj.canvas = activeCanvas;
                        clonedObj.forEachObject(obj => {
                            activeCanvas.add(obj);
                        });
                        clonedObj.setCoords();
                    } else {
                        setupObjectControls(clonedObj);
                        activeCanvas.add(clonedObj);
                    }

                    adjustLayers(activeCanvas);
                    activeCanvas.setActiveObject(clonedObj);
                    activeCanvas.requestRenderAll();
                    refreshLayers();
                });
            }

            /**
             * Lock active canvas object
             */
            function lockObject() {
                const activeObj = activeCanvas.getActiveObject();
                if (!activeObj) return;
                if (activeObj.isJerseyTemplate || activeObj.isTshirtTemplate) return;

                const isLocked = !activeObj.lockMovementX;
                activeObj.set({
                    lockMovementX: isLocked,
                    lockMovementY: isLocked,
                    lockScalingX: isLocked,
                    lockScalingY: isLocked,
                    lockRotation: isLocked,
                    hasControls: !isLocked,
                    hasBorders: !isLocked
                });

                activeCanvas.discardActiveObject();
                activeCanvas.setActiveObject(activeObj);
                activeCanvas.requestRenderAll();
                updateInspector();
            }

            /**
             * Bring active object forward
             */
            function bringForward() {
                const activeObj = activeCanvas.getActiveObject();
                if (activeObj) {
                    if (activeObj.isJerseyTemplate || activeObj.isTshirtTemplate) return;
                    activeObj.bringToFront();
                    adjustLayers(activeCanvas);
                    refreshLayers();
                }
            }

            /**
             * Send active object backward
             */
            function sendBackward() {
                const activeObj = activeCanvas.getActiveObject();
                if (activeObj) {
                    if (activeObj.isJerseyTemplate || activeObj.isTshirtTemplate) return;
                    activeObj.sendToBack();
                    adjustLayers(activeCanvas);
                    refreshLayers();
                }
            }

            /**
             * Refresh active canvas layer list in inspector
             */
            function refreshLayers() {
                const layersList = document.getElementById('layersList');
                if (!layersList) return;

                layersList.innerHTML = '';
                const objects = activeCanvas.getObjects();
                const activeObject = activeCanvas.getActiveObject();

                for (let i = objects.length - 1; i >= 0; i--) {
                    const obj = objects[i];
                    if (obj.isJerseyTemplate || obj.isTshirtTemplate) continue;
                    
                    const isActive = (activeObject === obj);
                    let label = 'Objek';
                    let icon = '📦';

                    if (obj.type === 'i-text' || obj.type === 'text') {
                        const textPreview = obj.text ? (obj.text.length > 15 ? obj.text.substring(0, 15) + '...' : obj.text) : 'Teks';
                        label = textPreview;
                        icon = '✍️';
                    } else if (obj.type === 'image') {
                        label = obj.title || 'Gambar';
                        icon = '🖼️';
                    } else if (obj.type === 'rect') {
                        label = 'Pola Kaos';
                        icon = '🏁';
                    }

                    const item = document.createElement('div');
                    item.className = `flex items-center justify-between p-2 rounded-xl text-xs cursor-pointer transition-all border ${
                        isActive 
                            ? 'bg-indigo-50 border-indigo-200 text-indigo-900 font-semibold shadow-sm' 
                            : 'bg-slate-50 border-slate-100 hover:bg-slate-100 text-slate-700'
                    }`;

                    item.innerHTML = `
                        <div class="flex items-center gap-2 truncate">
                            <span class="text-sm">${icon}</span>
                            <span class="truncate">${label}</span>
                        </div>
                        <span class="text-[9px] text-slate-400 font-mono">Layer ${i + 1}</span>
                    `;

                    item.addEventListener('click', (e) => {
                        e.stopPropagation();
                        activeCanvas.setActiveObject(obj);
                        activeCanvas.renderAll();
                        updateInspector();
                        refreshLayers();
                    });

                    layersList.appendChild(item);
                }

                const baseItem = document.createElement('div');
                baseItem.className = 'flex items-center gap-2 p-2 rounded-xl text-xs bg-slate-50 border border-slate-100 text-slate-400 select-none opacity-80';
                baseItem.innerHTML = `
                    <span class="text-sm">${currentModel === 'jersey' ? '🎽' : '👕'}</span>
                    <span class="font-bold">${currentModel === 'jersey' ? 'Jersey' : 'Kaos'} Dasar (${currentSide === 'front' ? 'Depan' : 'Belakang'})</span>
                `;
                layersList.appendChild(baseItem);
            }

            // ==========================================
            // HELPERS & UTILITIES
            // ==========================================

            function pushStateToHistory(c, side) {
                if (isProcessingHistory) return;

                const currentState = JSON.stringify(c.toObject([
                    'selectable', 'evented', 'isJerseyTemplate', 'isTshirtTemplate', 
                    'className', 'id', 'title', 'lockMovementX', 'lockMovementY', 
                    'lockScalingX', 'lockScalingY', 'lockRotation', 'hasControls', 'hasBorders',
                    'isTemplateLayer', 'templateId', 'templateName', 'objectType',
                    'templateDesign', 'isTemplateDesign', 'source', 'side'
                ]));
                
                const sideHistory = history[side];
                if (sideHistory.undoStack.length === 0 || sideHistory.undoStack[sideHistory.undoStack.length - 1] !== currentState) {
                    sideHistory.undoStack.push(currentState);
                    if (sideHistory.undoStack.length > 30) {
                        sideHistory.undoStack.shift();
                    }
                    sideHistory.redoStack = []; 
                }
            }

            function initHistory(c, side) {
                history[side].undoStack = [];
                history[side].redoStack = [];
                const initialState = JSON.stringify(c.toObject([
                    'selectable', 'evented', 'isJerseyTemplate', 'isTshirtTemplate', 
                    'className', 'id', 'title', 'lockMovementX', 'lockMovementY', 
                    'lockScalingX', 'lockScalingY', 'lockRotation', 'hasControls', 'hasBorders',
                    'isTemplateLayer', 'templateId', 'templateName', 'objectType',
                    'templateDesign', 'isTemplateDesign', 'source', 'side'
                ]));
                history[side].undoStack.push(initialState);
            }

            function updateZoom(newZoom) {
                canvasZoom = Math.min(Math.max(newZoom, 0.5), 2.0);
                const zoomPercent = document.getElementById('zoomPercent');
                if (zoomPercent) {
                    zoomPercent.innerText = Math.round(canvasZoom * 100) + '%';
                }
                
                // Set zoom on both canvases
                frontCanvas.zoomToPoint(new fabric.Point(frontCanvas.width / 2, frontCanvas.height / 2), canvasZoom);
                backCanvas.zoomToPoint(new fabric.Point(backCanvas.width / 2, backCanvas.height / 2), canvasZoom);
                frontCanvas.renderAll();
                backCanvas.renderAll();
            }

            /**
             * Switch selected product model (Tshirt vs Jersey) globally
             */
            function changeProduct(type) {
                if (currentModel === type) return;

                // Save current canvas state into canvasStates[currentModel]
                const serializeCanvas = (c) => {
                    return c.toJSON([
                        'selectable', 'evented', 'isJerseyTemplate', 'isTshirtTemplate', 
                        'className', 'id', 'title', 'lockMovementX', 'lockMovementY', 
                        'lockScalingX', 'lockScalingY', 'lockRotation', 'hasControls', 'hasBorders',
                        'isTemplateLayer', 'templateId', 'templateName', 'objectType',
                        'templateDesign', 'isTemplateDesign', 'source', 'side'
                    ]);
                };
                canvasStates[currentModel] = {
                    front: serializeCanvas(frontCanvas),
                    back: serializeCanvas(backCanvas)
                };

                currentModel = type;

                // Sync UI color forms
                updateModelToggleUI();

                // Reset recommendations when model changes so user must search for the correct category
                resetRecommendationsForModelChange();

                // Load design state for new currentModel
                return loadDesignForCurrentModel();
            }

            function updateModelToggleUI() {
                const tshirtColorSection = document.getElementById('tshirtColorSection');
                const jerseyColorSection = document.getElementById('jerseyColorSection');

                if (currentModel === 'tshirt') {
                    tshirtColorSection.classList.remove('hidden');
                    jerseyColorSection.classList.add('hidden');
                    jerseyColorSection.classList.remove('flex');
                    document.querySelector('input[name="product_model"][value="tshirt"]').checked = true;
                } else {
                    tshirtColorSection.classList.add('hidden');
                    jerseyColorSection.classList.remove('hidden');
                    jerseyColorSection.classList.add('flex');
                    document.querySelector('input[name="product_model"][value="jersey"]').checked = true;

                    // Sync inputs with state values (3 Customizable Colors)
                    const bgPicker = document.getElementById('inputJerseyBgColor');
                    const bgHex = document.getElementById('hexJerseyBgColor');
                    if (bgPicker) bgPicker.value = jerseyBgColor;
                    if (bgHex) bgHex.value = jerseyBgColor.toUpperCase();

                    const collarPicker = document.getElementById('inputJerseyCollarColor');
                    const collarHex = document.getElementById('hexJerseyCollarColor');
                    if (collarPicker) collarPicker.value = jerseyCollarColor;
                    if (collarHex) collarHex.value = jerseyCollarColor.toUpperCase();

                    const accentPicker = document.getElementById('inputJerseyAccentColor');
                    const accentHex = document.getElementById('hexJerseyAccentColor');
                    if (accentPicker) accentPicker.value = jerseyAccentColor;
                    if (accentHex) accentHex.value = jerseyAccentColor.toUpperCase();
                }
            }

            function setupObjectControls(obj) {
                if (!obj) return;
                obj.set({
                    cornerColor: '#4f46e5',
                    cornerStrokeColor: '#ffffff',
                    borderColor: '#6366f1',
                    borderScaleFactor: 2,
                    cornerSize: 10,
                    cornerStyle: 'circle',
                    transparentCorners: false,
                    borderDashArray: null,
                    padding: 4
                });

                if (obj.type === 'image') {
                    obj.setControlsVisibility({
                        mt: false, mb: false, ml: false, mr: false,
                        mtr: true, tl: true, tr: true, bl: true, br: true
                    });
                }
            }

            function deleteSelected() {
                if (!activeCanvas) return;
                const activeObj = activeCanvas.getActiveObject();
                if (activeObj && !activeObj.isJerseyTemplate && !activeObj.isTshirtTemplate) {
                    activeCanvas.remove(activeObj);
                    activeCanvas.discardActiveObject();
                    activeCanvas.renderAll();
                    refreshLayers();
                    updateInspector();
                }
            }

            function duplicateObject() {
                if (!activeCanvas) return;
                const activeObj = activeCanvas.getActiveObject();
                if (activeObj && !activeObj.isJerseyTemplate && !activeObj.isTshirtTemplate) {
                    activeObj.clone((cloned) => {
                        cloned.set({
                            left: activeObj.left + 15,
                            top: activeObj.top + 15
                        });
                        if (cloned.type === 'activeSelection') {
                            cloned.canvas = activeCanvas;
                            cloned.forEachObject((obj) => {
                                activeCanvas.add(obj);
                            });
                            cloned.setCoords();
                        } else {
                            setupObjectControls(cloned);
                            activeCanvas.add(cloned);
                        }
                        activeCanvas.setActiveObject(cloned);
                        adjustLayers(activeCanvas);
                        activeCanvas.renderAll();
                        refreshLayers();
                        updateInspector();
                    });
                }
            }

            function bringForward() {
                if (!activeCanvas) return;
                const activeObj = activeCanvas.getActiveObject();
                if (activeObj && !activeObj.isJerseyTemplate && !activeObj.isTshirtTemplate) {
                    activeCanvas.bringForward(activeObj);
                    adjustLayers(activeCanvas);
                    activeCanvas.renderAll();
                    refreshLayers();
                }
            }

            function sendBackward() {
                if (!activeCanvas) return;
                const activeObj = activeCanvas.getActiveObject();
                if (activeObj && !activeObj.isJerseyTemplate && !activeObj.isTshirtTemplate) {
                    activeCanvas.sendBackwards(activeObj);
                    adjustLayers(activeCanvas);
                    activeCanvas.renderAll();
                    refreshLayers();
                }
            }

            function lockObject() {
                if (!activeCanvas) return;
                const activeObj = activeCanvas.getActiveObject();
                if (activeObj) {
                    const isLocked = !activeObj.lockMovementX;
                    activeObj.set({
                        lockMovementX: isLocked,
                        lockMovementY: isLocked,
                        lockRotation: isLocked,
                        lockScalingX: isLocked,
                        lockScalingY: isLocked,
                        hasControls: !isLocked
                    });
                    activeCanvas.renderAll();
                    updateInspector();
                }
            }

            function restoreMockupTemplate(c, side, callback) {
                if (currentModel === 'tshirt') {
                    const svgUrl = side === 'front' ? '/assets/mockups/tshirt/front.svg' : '/assets/mockups/tshirt/back.svg';
                    loadTshirtTemplate(c, svgUrl, side, () => {
                        const colorMap = {
                            'merah': '#e11d48', 'biru': '#2563eb', 'hitam': '#111212', 'putih': '#ffffff',
                            'hijau': '#16a34a', 'kuning': '#eab308', 'abu-abu': '#94a3b8', 'marun': '#881337',
                            'navy': '#1e3a8a', 'army': '#064e3b', 'oranye': '#ea580c', 'ungu': '#7c3aed'
                        };
                        const hexColor = colorMap[currentColor.toLowerCase()] || currentColor || '#ffffff';
                        changeTshirtColor(c, hexColor);

                        const customPicker = document.getElementById('customColorPicker');
                        const customHex = document.getElementById('customColorHex');
                        if (customPicker && customHex) {
                            customPicker.value = hexColor;
                            customHex.value = hexColor.toUpperCase();
                        }

                        c.getObjects().forEach(obj => {
                            if (obj.className === 'jersey-pattern' || obj.className === 'motif-pattern' || (obj.type === 'rect' && obj.fill && obj.fill.source) || obj.objectType === 'template-design' || obj.isTemplateDesign || obj.isTemplateLayer) {
                                applyPatternClipping(c, obj, side);
                            }
                            if (!obj.isTshirtTemplate && !obj.isJerseyTemplate) setupObjectControls(obj);
                        });

                        c.zoomToPoint(new fabric.Point(c.width / 2, c.height / 2), canvasZoom);
                        adjustLayers(c);
                        c.renderAll();
                        if (callback) callback();
                    });
                } else {
                    const svgUrl = getJerseySvgUrl(side);
                    loadJerseyTemplate(c, svgUrl, side, () => {
                        updateJerseyColor(c, 'jersey-bg', jerseyBgColor);
                        updateJerseyColor(c, 'jersey-sleeve', jerseySleeveColor);
                        updateJerseyColor(c, 'jersey-collar', jerseyCollarColor);
                        updateJerseyColor(c, 'jersey-accent', jerseyAccentColor);

                        c.getObjects().forEach(obj => {
                            if (obj.className === 'jersey-pattern' || obj.className === 'motif-pattern' || (obj.type === 'rect' && obj.fill && obj.fill.source) || obj.objectType === 'template-design' || obj.isTemplateDesign || obj.isTemplateLayer) {
                                applyPatternClipping(c, obj, side);
                            }
                            if (!obj.isTshirtTemplate && !obj.isJerseyTemplate) setupObjectControls(obj);
                        });

                        c.zoomToPoint(new fabric.Point(c.width / 2, c.height / 2), canvasZoom);
                        adjustLayers(c);
                        c.renderAll();
                        if (callback) callback();
                    });
                }
            }

            function loadJerseyTemplate(c, svgUrl, side, callback) {
                const existingObjects = c.getObjects().filter(o => o.isJerseyTemplate || o.isTshirtTemplate || o.objectType === 'jersey-base');
                existingObjects.forEach(o => c.remove(o));

                fabric.loadSVGFromURL(svgUrl, function(objects, options) {
                    const group = fabric.util.groupSVGElements(objects, options);
                    group.set({
                        left: c.width / 2, top: c.height / 2, originX: 'center', originY: 'center',
                        selectable: false, evented: false, hasControls: false, hasBorders: false,
                        lockMovementX: true, lockMovementY: true, lockRotation: true, lockScalingX: true, lockScalingY: true,
                        isJerseyTemplate: true,
                        objectType: 'jersey-base',
                        objectCaching: false
                    });
                    const scale = Math.min(c.width / group.width, c.height / group.height) * 0.90;
                    group.scale(scale);
                    c.add(group);
                    adjustLayers(c);
                    c.renderAll();
                    if (callback) callback(group);
                }, function(el, obj) {
                    if (el && el.getAttribute) {
                        const cls = el.getAttribute('class');
                        if (cls) obj.className = cls;
                        const id = el.getAttribute('id');
                        if (id) obj.id = id;
                    }
                });
            }

            function loadTshirtTemplate(c, svgUrl, side, callback) {
                const existingObjects = c.getObjects().filter(o => o.isJerseyTemplate || o.isTshirtTemplate || o.objectType === 'jersey-base');
                existingObjects.forEach(o => c.remove(o));

                fabric.loadSVGFromURL(svgUrl, function(objects, options) {
                    const group = fabric.util.groupSVGElements(objects, options);
                    group.set({
                        left: c.width / 2, top: c.height / 2, originX: 'center', originY: 'center',
                        selectable: false, evented: false, hasControls: false, hasBorders: false,
                        lockMovementX: true, lockMovementY: true, lockRotation: true, lockScalingX: true, lockScalingY: true,
                        isTshirtTemplate: true,
                        objectType: 'jersey-base',
                        objectCaching: false
                    });
                    const scale = Math.min(c.width / group.width, c.height / group.height) * 0.90;
                    group.scale(scale);
                    c.add(group);
                    adjustLayers(c);
                    c.renderAll();
                    if (callback) callback(group);
                }, function(el, obj) {
                    if (el && el.getAttribute) {
                        const cls = el.getAttribute('class');
                        if (cls) obj.className = cls;
                        const id = el.getAttribute('id');
                        if (id) obj.id = id;
                    }
                });
            }

            function updateJerseyColorGlobally(targetClass, hexColor) {
                if (!hexColor) return;

                if (targetClass === 'jersey-bg') {
                    jerseyBgColor = hexColor;
                    currentColor = hexColor;
                    const bgPicker = document.getElementById('inputJerseyBgColor');
                    const bgHex = document.getElementById('hexJerseyBgColor');
                    if (bgPicker) bgPicker.value = hexColor;
                    if (bgHex) bgHex.value = hexColor.toUpperCase();
                    syncRecommendationPreferences();
                } else if (targetClass === 'jersey-collar') {
                    jerseyCollarColor = hexColor;
                    const collarPicker = document.getElementById('inputJerseyCollarColor');
                    const collarHex = document.getElementById('hexJerseyCollarColor');
                    if (collarPicker) collarPicker.value = hexColor;
                    if (collarHex) collarHex.value = hexColor.toUpperCase();
                } else if (targetClass === 'jersey-accent') {
                    jerseyAccentColor = hexColor;
                    const accentPicker = document.getElementById('inputJerseyAccentColor');
                    const accentHex = document.getElementById('hexJerseyAccentColor');
                    if (accentPicker) accentPicker.value = hexColor;
                    if (accentHex) accentHex.value = hexColor.toUpperCase();
                }

                if (frontCanvas) updateJerseyColor(frontCanvas, targetClass, hexColor);
                if (backCanvas) updateJerseyColor(backCanvas, targetClass, hexColor);
            }

            /**
              * Change Jersey Collar Type
              */
            async function changeCollarType(collarType) {
                if (collarType === currentCollarType && currentModel === 'jersey') return;
                currentCollarType = collarType;

                // Update collar button UI
                document.querySelectorAll('.collar-btn').forEach(btn => {
                    if (btn.getAttribute('data-collar') === collarType) {
                        btn.classList.add('border-indigo-500');
                        btn.classList.remove('border-slate-200');
                    } else {
                        btn.classList.remove('border-indigo-500');
                        btn.classList.add('border-slate-200');
                    }
                });

                // Reload jersey template on both canvases with new collar and await them
                await Promise.all([
                    reloadJerseyCollar(frontCanvas, 'front'),
                    reloadJerseyCollar(backCanvas, 'back')
                ]);
            }

            function reloadJerseyCollar(c, side) {
                return new Promise(resolve => {
                    if (!c) {
                        resolve();
                        return;
                    }
                    const svgUrl = getJerseySvgUrl(side);
                    loadJerseyTemplate(c, svgUrl, side, () => {
                        updateJerseyColor(c, 'jersey-bg', jerseyBgColor);
                        updateJerseyColor(c, 'jersey-collar', jerseyCollarColor);
                        updateJerseyColor(c, 'jersey-accent', jerseyAccentColor);

                        c.getObjects().forEach(obj => {
                            if (obj.className === 'jersey-pattern' || obj.className === 'motif-pattern' || (obj.type === 'rect' && obj.fill && obj.fill.source) || obj.objectType === 'template-design' || obj.isTemplateDesign || obj.isTemplateLayer) {
                                applyPatternClipping(c, obj, side);
                            }
                            if (!obj.isTshirtTemplate && !obj.isJerseyTemplate) setupObjectControls(obj);
                        });

                        adjustLayers(c);
                        c.renderAll();
                        resolve();
                    });
                });
            }

            function updateJerseyColor(c, targetClass, hexColor) {
                if (!c) return;
                const templateGroup = c.getObjects().find(o => o.isJerseyTemplate || o.objectType === 'jersey-base');
                if (!templateGroup) return;

                const applyFill = (obj) => {
                    if ((obj.className && obj.className.includes(targetClass)) || (obj.id && obj.id.includes(targetClass))) {
                        obj.set('fill', hexColor);
                        obj.dirty = true;
                    }
                    if (obj.getObjects) {
                        obj.getObjects().forEach(applyFill);
                    }
                };

                applyFill(templateGroup);
                templateGroup.dirty = true;
                c.requestRenderAll();
            }

            function changeTshirtColor(c, hexColor) {
                if (!c) return;
                const templateGroup = c.getObjects().find(o => o.isTshirtTemplate || o.objectType === 'jersey-base');
                if (!templateGroup) return;

                let applied = false;
                const applyColor = (obj) => {
                    if ((obj.className && obj.className.includes('tshirt-base')) || (obj.id && obj.id.includes('tshirt-base'))) {
                        obj.set('fill', hexColor);
                        applied = true;
                    } else if (obj.getObjects) {
                        obj.getObjects().forEach(applyColor);
                    }
                };

                applyColor(templateGroup);

                if (!applied && templateGroup.getObjects) {
                    const firstPath = templateGroup.getObjects().find(o => o.type === 'path') || templateGroup.getObjects()[0];
                    if (firstPath) {
                        firstPath.set('fill', hexColor);
                    }
                }

                templateGroup.dirty = true;
                c.renderAll();
            }

            function findBgChild(parentObj, className) {
                if (!parentObj) return null;
                if (parentObj.className && parentObj.className.includes(className)) return parentObj;
                if (parentObj.getObjects) {
                    for (let child of parentObj.getObjects()) {
                        let res = findBgChild(child, className);
                        if (res) return res;
                    }
                }
                return null;
            }

            function createPathClipFromObject(childObj, templateGroup, callback) {
                if (!childObj) {
                    if (callback) callback(null);
                    return null;
                }

                childObj.clone(function(clonedPath) {
                    if (!clonedPath) {
                        if (callback) callback(null);
                        return;
                    }

                    const groupMatrix = templateGroup ? templateGroup.calcTransformMatrix() : (childObj.group ? childObj.group.calcTransformMatrix() : fabric.util.createNullMatrix());
                    const childMatrix = childObj.calcOwnMatrix ? childObj.calcOwnMatrix() : childObj.calcTransformMatrix();
                    const absoluteMatrix = fabric.util.multiplyTransformMatrices(groupMatrix, childMatrix);
                    const transform = fabric.util.qrDecompose(absoluteMatrix);

                    clonedPath.set({
                        fill: '#000000',
                        strokeWidth: 0,
                        stroke: null,
                        originX: 'center',
                        originY: 'center',
                        absolutePositioned: true,
                        left: transform.translateX,
                        top: transform.translateY,
                        scaleX: transform.scaleX,
                        scaleY: transform.scaleY,
                        angle: transform.angle
                    });

                    if (callback) callback(clonedPath);
                });
            }

            function getJerseyClipPath(c, callback) {
                const templateGroup = c.getObjects().find(o => o.isJerseyTemplate || o.objectType === 'jersey-base');
                if (!templateGroup) {
                    if (callback) callback(null);
                    return null;
                }

                // 1. First prioritize 'jersey-body' (the main torso)
                let bgChild = findBgChild(templateGroup, 'jersey-body');

                // 2. Fallback: find path with largest area among all 'jersey-bg' paths
                if (!bgChild && templateGroup.getObjects) {
                    const bgPaths = templateGroup.getObjects().filter(o => o.type === 'path' && ((o.className && o.className.includes('jersey-bg')) || (o.id && o.id.includes('jersey-bg'))));
                    if (bgPaths.length > 0) {
                        bgPaths.sort((a, b) => (b.width * (b.scaleX || 1) * b.height * (b.scaleY || 1)) - (a.width * (a.scaleX || 1) * a.height * (a.scaleY || 1)));
                        bgChild = bgPaths[0];
                    }
                }

                // 3. Fallback: find any jersey-bg
                if (!bgChild) {
                    bgChild = findBgChild(templateGroup, 'jersey-bg');
                }

                if (!bgChild) {
                    if (callback) callback(null);
                    return null;
                }

                return createPathClipFromObject(bgChild, templateGroup, callback);
            }

            function getTshirtClipPath(c, side, callback) {
                const templateGroup = c.getObjects().find(o => o.isTshirtTemplate || o.objectType === 'jersey-base');
                if (!templateGroup) {
                    if (callback) callback(null);
                    return null;
                }

                let bgChild = findBgChild(templateGroup, 'tshirt-base');
                if (!bgChild) {
                    if (templateGroup.getObjects) {
                        bgChild = templateGroup.getObjects().find(o => o.type === 'path') || templateGroup.getObjects()[0];
                    } else if (templateGroup.type === 'path') {
                        bgChild = templateGroup;
                    }
                }
                if (!bgChild) {
                    if (callback) callback(null);
                    return null;
                }

                return createPathClipFromObject(bgChild, templateGroup, callback);
            }

            function applyPatternClipping(c, patternObj, side) {
                if (currentModel === 'jersey') {
                    getJerseyClipPath(c, function(clipPath) {
                        patternObj.set({ clipPath: clipPath || null });
                        c.renderAll();
                    });
                } else {
                    getTshirtClipPath(c, side, function(clipPath) {
                        patternObj.set({ clipPath: clipPath || null });
                        c.renderAll();
                    });
                }
            }

            function adjustLayers(c) {
                if (!c || !c._objects) return;
                c._objects.sort((a, b) => {
                    const getLayerIndex = (obj) => {
                        // 0: BACKGROUND & JERSEY BASE / MOCKUP
                        if (obj.objectType === 'jersey-base' || obj.isJerseyTemplate || obj.isTshirtTemplate) return 0;
                        // 1: DESIGN TEMPLATE
                        if (obj.objectType === 'template-design' || obj.isTemplateDesign || obj.isTemplateLayer || obj.className === 'jersey-pattern' || obj.className === 'motif-pattern' || (obj.type === 'rect' && obj.fill instanceof fabric.Pattern)) return 1;
                        // 2: USER IMAGE
                        if (obj.objectType === 'user-image') return 2;
                        // 3: LOGO
                        if (obj.objectType === 'logo' || (obj.type === 'image' && obj.objectType !== 'template-design' && !obj.isTemplateDesign && !obj.isTemplateLayer && obj.objectType !== 'user-image')) return 3;
                        // 4: TEXT
                        if (obj.objectType === 'text' || obj.type === 'i-text' || obj.type === 'text') return 4;
                        // Default
                        return 2.5;
                    };
                    return getLayerIndex(a) - getLayerIndex(b);
                });
                c.renderAll();
            }

            function loadFabricImage(src, callback) {
                const opts = {};
                if (src && !src.startsWith('data:')) opts.crossOrigin = 'anonymous';
                fabric.Image.fromURL(src, callback, opts);
            }

            function removeFakeTransparency(imageSrc, callback) {
                const tempImg = new Image();
                tempImg.crossOrigin = 'anonymous';
                tempImg.onload = function() {
                    const width = tempImg.naturalWidth || tempImg.width;
                    const height = tempImg.naturalHeight || tempImg.height;

                    if (!width || !height) {
                        callback(imageSrc);
                        return;
                    }

                    const tempCanvas = document.createElement('canvas');
                    tempCanvas.width = width;
                    tempCanvas.height = height;
                    const ctx = tempCanvas.getContext('2d');
                    ctx.drawImage(tempImg, 0, 0);

                    let imgData;
                    try {
                        imgData = ctx.getImageData(0, 0, width, height);
                    } catch (err) {
                        console.warn('[RECOMMENDATION] getImageData failed:', err);
                        callback(imageSrc);
                        return;
                    }

                    const data = imgData.data;
                    let hasNativeAlpha = false;

                    for (let i = 3; i < data.length; i += 4) {
                        if (data[i] === 0) {
                            hasNativeAlpha = true;
                            break;
                        }
                    }

                    const isCheckerboardColor = (r, g, b, a) => {
                        if (a === 0) return true;
                        if (r >= 235 && g >= 235 && b >= 235) return true;
                        if (r >= 170 && r <= 235 && g >= 170 && g <= 235 && b >= 170 && b <= 235) {
                            return Math.abs(r - g) <= 15 && Math.abs(g - b) <= 15 && Math.abs(r - b) <= 15;
                        }
                        return false;
                    };

                    if (!hasNativeAlpha) {
                        const visited = new Uint8Array(width * height);
                        const queue = [];

                        for (let x = 0; x < width; x++) {
                            queue.push(x, 0);
                            queue.push(x, height - 1);
                        }
                        for (let y = 1; y < height - 1; y++) {
                            queue.push(0, y);
                            queue.push(width - 1, y);
                        }

                        let head = 0;
                        while (head < queue.length) {
                            const px = queue[head++];
                            const py = queue[head++];
                            const idx = py * width + px;

                            if (visited[idx]) continue;
                            visited[idx] = 1;

                            const p = idx * 4;
                            const r = data[p], g = data[p + 1], b = data[p + 2], a = data[p + 3];

                            if (isCheckerboardColor(r, g, b, a)) {
                                data[p + 3] = 0;

                                if (px > 0 && !visited[idx - 1]) queue.push(px - 1, py);
                                if (px < width - 1 && !visited[idx + 1]) queue.push(px + 1, py);
                                if (py > 0 && !visited[idx - width]) queue.push(px, py - 1);
                                if (py < height - 1 && !visited[idx + width]) queue.push(px, py + 1);
                            }
                        }

                        for (let i = 0; i < data.length; i += 4) {
                            const r = data[i], g = data[i + 1], b = data[i + 2], a = data[i + 3];
                            if (a > 0 && (r >= 240 && g >= 240 && b >= 240)) {
                                data[i + 3] = 0;
                            }
                        }
                    }

                    ctx.putImageData(imgData, 0, 0);

                    let minX = width, minY = height, maxX = -1, maxY = -1;
                    for (let y = 0; y < height; y++) {
                        for (let x = 0; x < width; x++) {
                            const alpha = data[(y * width + x) * 4 + 3];
                            if (alpha > 10) {
                                if (x < minX) minX = x;
                                if (x > maxX) maxX = x;
                                if (y < minY) minY = y;
                                if (y > maxY) maxY = y;
                            }
                        }
                    }

                    if (maxX === -1 || maxY === -1 || minX >= maxX || minY >= maxY) {
                        minX = 0;
                        minY = 0;
                        maxX = width - 1;
                        maxY = height - 1;
                    }

                    const padding = 4;
                    const cropMinX = Math.max(0, minX - padding);
                    const cropMinY = Math.max(0, minY - padding);
                    const cropMaxX = Math.min(width - 1, maxX + padding);
                    const cropMaxY = Math.min(height - 1, maxY + padding);
                    const cropWidth = cropMaxX - cropMinX + 1;
                    const cropHeight = cropMaxY - cropMinY + 1;

                    const cropCanvas = document.createElement('canvas');
                    cropCanvas.width = cropWidth;
                    cropCanvas.height = cropHeight;
                    const cropCtx = cropCanvas.getContext('2d');
                    cropCtx.drawImage(
                        tempCanvas,
                        cropMinX, cropMinY, cropWidth, cropHeight,
                        0, 0, cropWidth, cropHeight
                    );

                    callback(cropCanvas.toDataURL('image/png'));
                };
                tempImg.onerror = () => callback(imageSrc);
                tempImg.src = imageSrc;
            }

            function removeExistingTemplateDesign(canvas) {
                if (!canvas) return;
                const existingLayers = canvas.getObjects().filter(o =>
                    o.templateDesign === true || o.isTemplateDesign === true || o.isTemplateLayer === true || o.objectType === 'template-design'
                );
                existingLayers.forEach(oldLayer => canvas.remove(oldLayer));
            }

            function createJerseyClipPath(canvas, side, callback) {
                if (!canvas) {
                    if (callback) callback(null);
                    return null;
                }
                const activeSide = side || currentSide || 'front';
                if (currentModel === 'jersey') {
                    return getJerseyClipPath(canvas, callback);
                } else {
                    return getTshirtClipPath(canvas, activeSide, callback);
                }
            }

            function loadTransparentDesign(path, callback) {
                if (!path) {
                    console.error('[Template] Design file path is null or empty.');
                    if (callback) callback(null);
                    return;
                }
                loadFabricImage(path, function(img) {
                    if (!img || !img.width || !img.height) {
                        console.error('[Template] Design file not found or invalid:', path);
                        if (callback) callback(null);
                        return;
                    }
                    if (callback) callback(img);
                });
            }

            async function applyTemplateToCanvas(templateOrPath, optionalColor) {
                let template = {};
                if (typeof templateOrPath === 'string') {
                    template = {
                        id: null,
                        name: 'Template',
                        // Backward compat: path string langsung
                        design_front_path: templateOrPath,
                        design_back_path: templateOrPath,
                        color: optionalColor || ''
                    };
                } else {
                    template = templateOrPath || {};
                }

                // ============================================================
                // STEP 1 — Tentukan model (kaos / jersey)
                // ============================================================
                const categoryLower = (template.category || '').toLowerCase();
                let targetModel = 'tshirt';
                if (categoryLower === 'jersey') {
                    targetModel = 'jersey';
                } else if (categoryLower === 'kaos' || categoryLower === 'tshirt') {
                    targetModel = 'tshirt';
                } else {
                    // Fallback deteksi dari path preview
                    const checkPath = (template.preview_front || template.design_front_path || template.image_path || '').toLowerCase();
                    targetModel = checkPath.includes('jersey') ? 'jersey' : 'tshirt';
                }

                // Ganti canvas model jika berbeda
                if (currentModel !== targetModel) {
                    await changeProduct(targetModel);
                }

                // ============================================================
                // STEP 2 — Terapkan design_data (LAYER BERLAYER) ke canvas
                // ============================================================
                const designData = template.design_data || {};

                // A. Bentuk Kerah (collar_type) JIKA JERSEY — Await pergantian kerah
                if (targetModel === 'jersey' && designData.collar_type) {
                    if (currentCollarType !== designData.collar_type) {
                        await changeCollarType(designData.collar_type);
                    }
                }

                // B. Warna Badan (base_color) — prioritas dari design_data, fallback dari template.color
                let baseHex = designData.base_color || null;
                if (!baseHex && template.color) {
                    const colorMap = {
                        'merah':'#e11d48','biru':'#2563eb','hitam':'#111212','putih':'#ffffff',
                        'hijau':'#16a34a','kuning':'#eab308','abu-abu':'#94a3b8','marun':'#881337',
                        'navy':'#1e3a8a','army':'#064e3b','oranye':'#ea580c','ungu':'#7c3aed'
                    };
                    baseHex = colorMap[template.color.toLowerCase()] || template.color;
                }
                if (baseHex) changeShirtColor(baseHex);

                // C. Warna Kerah (.jersey-collar)
                if (designData.collar_color) {
                    updateJerseyColorGlobally('jersey-collar', designData.collar_color);
                }

                // D. Warna Aksen (.jersey-accent) — sleeve cuff & piping
                if (designData.accent_color) {
                    updateJerseyColorGlobally('jersey-accent', designData.accent_color);
                }

                // E. Motif/Stripe Pattern — jika ada path motif di design_data
                if (designData.stripe_pattern) {
                    addMotifToCanvas(designData.stripe_pattern);
                }

                // ============================================================
                // STEP 3 — Tentukan path overlay desain (front & back)
                // ============================================================
                // Gunakan kolom BARU preview_front/preview_back (sebagai referensi visual)
                // Atau kolom lama design_front_path / design_back_path
                let frontDesignPath = template.design_front_path || template.preview_front || template.designFrontPath;
                let backDesignPath  = template.design_back_path  || template.preview_back  || template.designBackPath;

                // Jika kedua path kosong, gunakan preview_front sebagai fallback
                if (!frontDesignPath && !backDesignPath) {
                    const fallback = template.preview_front || template.image_path || template.imagePath;
                    frontDesignPath = fallback;
                    backDesignPath  = fallback;
                } else {
                    if (!frontDesignPath) frontDesignPath = template.preview_front || template.image_path;
                    if (!backDesignPath)  backDesignPath  = template.preview_back  || template.preview_front || template.image_path;
                }

                // Log informasi layer yang diterapkan
                console.log('[TEMPLATE LAYER APPLY]', {
                    name: template.name,
                    model: targetModel,
                    base_color: designData.base_color,
                    accent_color: designData.accent_color,
                    collar_type: designData.collar_type,
                    collar_color: designData.collar_color,
                    sleeve_color: designData.sleeve_color,
                    stripe_pattern: designData.stripe_pattern,
                    frontPath: frontDesignPath,
                    backPath: backDesignPath,
                });

                // Helper function untuk menerapkan desain ke satu canvas (DEPAN atau BELAKANG)
                const applyToSide = (targetCanvas, side, designPath) => {
                    return new Promise(async (resolve) => {
                        if (!targetCanvas || !designPath) {
                            resolve(false);
                            return;
                        }

                        // Pastikan mockup canvas (tshirt/jersey) sudah termuat di canvas target
                        let templateGroup = targetCanvas.getObjects().find(o =>
                            o.objectType === 'jersey-base' || o.isJerseyTemplate || o.isTshirtTemplate
                        );

                        if (!templateGroup) {
                            await new Promise(res => restoreMockupTemplate(targetCanvas, side, res));
                            templateGroup = targetCanvas.getObjects().find(o =>
                                o.objectType === 'jersey-base' || o.isJerseyTemplate || o.isTshirtTemplate
                            );
                        }

                        if (!templateGroup) {
                            console.error(`[Template] Base mockup not found on ${side} canvas.`);
                            resolve(false);
                            return;
                        }

                        // Hapus HANYA layer template design lama (logo, text, user image TETAP DI-PRESERVE)
                        removeExistingTemplateDesign(targetCanvas);

                        // Dimensi mockup & center position
                        const groupWidth = templateGroup.getScaledWidth ? templateGroup.getScaledWidth() : (templateGroup.width * (templateGroup.scaleX || 1));
                        const groupHeight = templateGroup.getScaledHeight ? templateGroup.getScaledHeight() : (templateGroup.height * (templateGroup.scaleY || 1));
                        const centerX = templateGroup.left !== undefined ? templateGroup.left : targetCanvas.width / 2;
                        const centerY = templateGroup.top !== undefined ? templateGroup.top : targetCanvas.height / 2;

                        loadTransparentDesign(designPath, function(img) {
                            if (!img) {
                                console.error(`[Template] Design image not found for ${side}: ${designPath}`);
                                resolve(false);
                                return;
                            }

                            // Skala proporsional agar pattern memenuhi area badan kaos/jersey secara penuh
                            const scaleX = groupWidth / img.width;
                            const scaleY = groupHeight / img.height;
                            const scale = Math.max(scaleX, scaleY);

                            img.set({
                                left: centerX,
                                top: centerY,
                                originX: 'center',
                                originY: 'center',
                                scaleX: scale,
                                scaleY: scale,
                                selectable: true,
                                evented: true,
                                hasControls: true,
                                hasBorders: true,
                                objectType: 'template-design',
                                templateDesign: true,
                                isTemplateDesign: true,
                                isTemplateLayer: true,
                                templateId: template.id || null,
                                templateName: template.name || '',
                                source: 'design_path',
                                side: side
                            });

                            setupObjectControls(img);

                            // Pasang clipping mask siluet kaos/jersey
                            createJerseyClipPath(targetCanvas, side, function(clipPath) {
                                if (clipPath) {
                                    img.set({ clipPath: clipPath });
                                }

                                targetCanvas.add(img);
                                adjustLayers(targetCanvas);
                                img.setCoords();
                                targetCanvas.renderAll();
                                resolve(true);
                            });
                        });
                    });
                };

                // Terapkan ke KEDUA CANVAS (frontCanvas dan backCanvas) secara otomatis
                const [frontSuccess, backSuccess] = await Promise.all([
                    applyToSide(frontCanvas || activeCanvas, 'front', frontDesignPath),
                    applyToSide(backCanvas || activeCanvas, 'back', backDesignPath)
                ]);

                // Logging debugging sesuai petunjuk
                console.log('[TEMPLATE APPLY]', {
                    templateId: template.id,
                    templateName: template.name,
                    model: targetModel,
                    frontDesign: frontDesignPath,
                    backDesign: backDesignPath,
                    frontCanvasWidth: frontCanvas.getWidth(),
                    frontCanvasHeight: frontCanvas.getHeight(),
                    backCanvasWidth: backCanvas.getWidth(),
                    backCanvasHeight: backCanvas.getHeight(),
                    frontObjectsCount: frontCanvas.getObjects().length,
                    backObjectsCount: backCanvas.getObjects().length,
                    frontMockupFound: !!frontCanvas.getObjects().find(o => o.isJerseyTemplate || o.isTshirtTemplate),
                    backMockupFound: !!backCanvas.getObjects().find(o => o.isJerseyTemplate || o.isTshirtTemplate)
                });

                if (typeof refreshLayers === 'function') refreshLayers();
                if (typeof updateInspector === 'function') updateInspector();

                // Pertahankan sisi yang sedang aktif dipilih user
                if (typeof setActiveSide === 'function') {
                    setActiveSide(currentSide || 'front');
                }
            }

            function applyTemplate(templateOrPath, optionalColor) {
                applyTemplateToCanvas(templateOrPath, optionalColor);
            }

            function applyRecommendedTemplate(template) {
                applyTemplateToCanvas(template);
            }

            function addText(type = 'heading') {
                let defaultText = 'TAMBAH JUDUL';
                let fontSize = 28;
                let isBold = true;

                if (type === 'subheading') {
                    defaultText = 'Subjudul Desain';
                    fontSize = 20;
                    isBold = false;
                } else if (type === 'body') {
                    defaultText = 'Teks Tambahan';
                    fontSize = 14;
                    isBold = false;
                }

                const textObj = new fabric.IText(defaultText, {
                    left: activeCanvas.width / 2,
                    top: activeCanvas.height / 2,
                    originX: 'center',
                    originY: 'center',
                    fontFamily: 'Inter',
                    fontSize: fontSize,
                    fontWeight: isBold ? 'bold' : 'normal',
                    fill: '#1e293b',
                    objectType: 'text',
                    side: currentSide || 'front'
                });
                setupObjectControls(textObj);
                activeCanvas.add(textObj);
                adjustLayers(activeCanvas);
                activeCanvas.setActiveObject(textObj);
                activeCanvas.renderAll();
                refreshLayers();
            }

            function addTextToCanvas(text) {
                addText('heading');
            }

            function addMotifToCanvas(path) {
                const mode = (typeof window._getMotifApplyMode === 'function') ? window._getMotifApplyMode() : 'pattern';

                if (mode === 'pattern') {
                    // MODE 1: Motif di-tile memenuhi & clip ke bentuk kaos
                    const tempImg = new Image();
                    tempImg.crossOrigin = 'anonymous';
                    tempImg.onload = function() {
                        // Buat tile canvas dari gambar motif
                        // Ukuran tile: sesuaikan agar motif terlihat proporsional di kaos
                        const tileSize = Math.round(activeCanvas.width * 0.15); // ~15% lebar canvas per tile
                        const tileCanvas = document.createElement('canvas');
                        tileCanvas.width = tileSize;
                        tileCanvas.height = tileSize;
                        const tileCtx = tileCanvas.getContext('2d');
                        tileCtx.drawImage(tempImg, 0, 0, tileSize, tileSize);

                        fabric.util.loadImage(tileCanvas.toDataURL('image/png'), function(tileImg) {
                            if (!tileImg || !activeCanvas) return;

                            // Hapus motif lama (kelas jersey-pattern atau motif-pattern)
                            const existingMotif = activeCanvas.getObjects().find(o => o.className === 'jersey-pattern' || o.className === 'motif-pattern');
                            if (existingMotif) activeCanvas.remove(existingMotif);

                            const rect = new fabric.Rect({
                                width: activeCanvas.width,
                                height: activeCanvas.height,
                                left: activeCanvas.width / 2,
                                top: activeCanvas.height / 2,
                                originX: 'center',
                                originY: 'center',
                                className: 'motif-pattern',
                                side: currentSide || 'front',
                                fill: new fabric.Pattern({
                                    source: tileImg,
                                    repeat: 'repeat'
                                }),
                                selectable: true,
                                evented: true,
                                hasControls: true,
                                hasBorders: true
                            });

                            // Terapkan clip path siluet kaos
                            applyPatternClipping(activeCanvas, rect, currentSide);

                            setupObjectControls(rect);
                            activeCanvas.add(rect);
                            activeCanvas.setActiveObject(rect);
                            adjustLayers(activeCanvas);
                            activeCanvas.renderAll();
                            refreshLayers();
                            updateInspector();
                        }, { crossOrigin: 'anonymous' });
                    };
                    tempImg.onerror = function() {
                        console.error('[Motif] Gagal memuat gambar motif:', path);
                    };
                    // Pastikan path menggunakan crossOrigin-friendly URL
                    tempImg.src = path;
                } else {
                    // MODE 2: Motif sebagai elemen bebas
                    loadFabricImage(path, function(img) {
                        if (!img || !activeCanvas) return;

                        let targetWidth = activeCanvas.width * 0.3;
                        let ratio = Math.min(targetWidth / img.width, 1);

                        img.set({
                            left: activeCanvas.width / 2,
                            top: activeCanvas.height / 2,
                            originX: 'center',
                            originY: 'center',
                            scaleX: ratio,
                            scaleY: ratio,
                            objectType: 'logo',
                            side: currentSide || 'front'
                        });

                        setupObjectControls(img);
                        activeCanvas.add(img);
                        adjustLayers(activeCanvas);
                        img.setCoords();
                        activeCanvas.setActiveObject(img);
                        activeCanvas.requestRenderAll();
                        refreshLayers();
                    });
                }
            }

            /**
             * Update property values inside inspector panel
             */
            function updateInspector() {
                const activeObj = activeCanvas.getActiveObject();
                
                const inspectorEmptyState = document.getElementById('inspectorEmptyState');
                const inspectorForm = document.getElementById('inspectorForm');
                const activeObjectTypeBadge = document.getElementById('activeObjectTypeBadge');
                
                const textProperties = document.getElementById('textProperties');
                const textInput = document.getElementById('textInput');
                const fontFamilySelect = document.getElementById('fontFamilySelect');
                const fontSizeRange = document.getElementById('fontSizeRange');
                const fontSizeVal = document.getElementById('fontSizeVal');
                const textColorInput = document.getElementById('textColorInput');
                const textColorHex = document.getElementById('textColorHex');

                const imageProperties = document.getElementById('imageProperties');
                const imageTintEnable = document.getElementById('imageTintEnable');
                const imageTintControls = document.getElementById('imageTintControls');
                const imageTintColorInput = document.getElementById('imageTintColorInput');
                const imageTintColorHex = document.getElementById('imageTintColorHex');

                if (!activeObj) {
                    if (inspectorEmptyState) inspectorEmptyState.classList.remove('hidden');
                    if (inspectorForm) inspectorForm.classList.add('hidden');
                    if (activeObjectTypeBadge) activeObjectTypeBadge.classList.add('hidden');
                    return;
                }

                if (inspectorEmptyState) inspectorEmptyState.classList.add('hidden');
                if (inspectorForm) inspectorForm.classList.remove('hidden');
                if (activeObjectTypeBadge) activeObjectTypeBadge.classList.remove('hidden');

                // Bind general transform attributes
                document.getElementById('inputPosX').value = Math.round(activeObj.left);
                document.getElementById('inputPosY').value = Math.round(activeObj.top);
                document.getElementById('inputWidth').value = Math.round(activeObj.width * activeObj.scaleX);
                document.getElementById('inputHeight').value = Math.round(activeObj.height * activeObj.scaleY);
                document.getElementById('inputScaleX').value = activeObj.scaleX.toFixed(2);
                document.getElementById('inputScaleY').value = activeObj.scaleY.toFixed(2);
                
                const roundedAngle = Math.round(activeObj.angle);
                document.getElementById('inputRotation').value = roundedAngle;
                document.getElementById('rotationVal').innerText = roundedAngle + '°';

                const opacityPct = Math.round(activeObj.opacity * 100);
                document.getElementById('inputOpacity').value = opacityPct;
                document.getElementById('opacityVal').innerText = opacityPct + '%';

                // Sync lock button UI
                const lockBtn = document.getElementById('lockBtn');
                if (activeObj.lockMovementX) {
                    lockBtn.innerHTML = '🔓 Unlock Objek';
                    lockBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                    lockBtn.classList.add('bg-slate-600', 'hover:bg-slate-700');
                } else {
                    lockBtn.innerHTML = '🔒 Lock Objek';
                    lockBtn.classList.remove('bg-slate-600', 'hover:bg-slate-700');
                    lockBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                }

                // Category-specific inspector panels
                if (activeObj.type === 'i-text' || activeObj.type === 'text') {
                    if (activeObjectTypeBadge) {
                        activeObjectTypeBadge.innerText = 'Teks';
                        activeObjectTypeBadge.className = 'inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700';
                    }
                    if (textProperties) textProperties.classList.remove('hidden');
                    if (imageProperties) imageProperties.classList.add('hidden');

                    if (textInput) textInput.value = activeObj.text || '';
                    if (fontFamilySelect) fontFamilySelect.value = activeObj.fontFamily || 'Figtree';
                    if (fontSizeRange) fontSizeRange.value = activeObj.fontSize || 24;
                    if (fontSizeVal) fontSizeVal.innerText = (activeObj.fontSize || 24) + ' px';
                    if (textColorInput) textColorInput.value = activeObj.fill || '#000000';
                    if (textColorHex) textColorHex.value = (activeObj.fill || '#000000').toUpperCase();

                } else if (activeObj.type === 'image') {
                    const isTemplateDesign = activeObj.objectType === 'template-design' || activeObj.isTemplateDesign;
                    if (activeObjectTypeBadge) {
                        if (isTemplateDesign) {
                            activeObjectTypeBadge.innerText = activeObj.templateName ? `[ ${activeObj.templateName} ]` : '[ Desain Template ]';
                            activeObjectTypeBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200';
                        } else {
                            activeObjectTypeBadge.innerText = activeObj.objectType === 'logo' ? 'Motif / Logo' : 'Gambar';
                            activeObjectTypeBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-teal-50 text-teal-700 border border-teal-200';
                        }
                    }
                    if (textProperties) textProperties.classList.add('hidden');
                    if (imageProperties) imageProperties.classList.remove('hidden');

                    const filter = activeObj.filters.find(f => f instanceof fabric.Image.filters.BlendColor);
                    const isTinted = !!filter;
                    if (imageTintEnable) imageTintEnable.checked = isTinted;
                    
                    if (imageTintControls) {
                        if (isTinted) {
                            imageTintControls.classList.remove('hidden');
                            if (imageTintColorInput) imageTintColorInput.value = filter.color || '#6366f1';
                            if (imageTintColorHex) imageTintColorHex.value = (filter.color || '#6366f1').toUpperCase();
                        } else {
                            imageTintControls.classList.add('hidden');
                        }
                    }
                } else {
                    if (activeObjectTypeBadge) {
                        activeObjectTypeBadge.innerText = 'Bentuk';
                        activeObjectTypeBadge.className = 'inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-50 text-slate-700';
                    }
                    if (textProperties) textProperties.classList.add('hidden');
                    if (imageProperties) imageProperties.classList.add('hidden');
                }
            }

            function applyColorFilterToActiveImage(hexColor, enabled) {
                const activeObj = activeCanvas.getActiveObject();
                if (activeObj && activeObj.type === 'image') {
                    activeObj.filters = activeObj.filters.filter(f => !(f instanceof fabric.Image.filters.BlendColor));
                    if (enabled && hexColor) {
                        activeObj.filters.push(new fabric.Image.filters.BlendColor({
                            color: hexColor, mode: 'multiply', alpha: 1.0
                        }));
                    }
                    activeObj.applyFilters();
                    activeCanvas.renderAll();
                }
            }

            function showSaveAuthModal() {
                const saveAuthModal = document.getElementById('saveAuthModal');
                const saveAuthModalContent = document.getElementById('saveAuthModalContent');
                if (saveAuthModal && saveAuthModalContent) {
                    saveAuthModal.classList.remove('hidden');
                    saveAuthModal.classList.add('flex');
                    setTimeout(() => {
                        saveAuthModalContent.classList.remove('scale-95', 'opacity-0');
                        saveAuthModalContent.classList.add('scale-100', 'opacity-100');
                    }, 10);
                }
            }

            function hideSaveAuthModal() {
                const saveAuthModal = document.getElementById('saveAuthModal');
                const saveAuthModalContent = document.getElementById('saveAuthModalContent');
                if (saveAuthModalContent && saveAuthModal) {
                    saveAuthModalContent.classList.remove('scale-100', 'opacity-100');
                    saveAuthModalContent.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        saveAuthModal.classList.remove('flex');
                        saveAuthModal.classList.add('hidden');
                    }, 300);
                }
            }

            function checkPendingDesignRecovery() {
                const pendingDesignStr = localStorage.getItem('pending_design');
                if (pendingDesignStr && !designId) {
                    try {
                        const pendingDesign = JSON.parse(pendingDesignStr);
                        setTimeout(() => {
                            if (confirm(`Kami menemukan draf desain '${pendingDesign.name}' yang belum disimpan dari sesi sebelumnya. Ingin memulihkan draf tersebut ke kanvas?`)) {
                                const designNameInput = document.getElementById('designNameInput');
                                if (designNameInput) designNameInput.value = pendingDesign.name;
                                canvasStates = pendingDesign.canvas_data;
                                loadDesign();
                            } else {
                                if (confirm('Hapus draf sementara tersebut?')) {
                                    localStorage.removeItem('pending_design');
                                }
                            }
                        }, 500);
                    } catch (e) {
                        console.error('Gagal memulihkan draf:', e);
                    }
                }
            }

            // ==========================================
            // SHAPES / PATTERNS SYSTEM
            // ==========================================

            function drawPatternPreviews(color = '#374151') {
                // Stripes
                const canvasStripes = document.getElementById('canvasPatternStripes');
                if (canvasStripes) {
                    canvasStripes.width = 32;
                    canvasStripes.height = 32;
                    const ctx = canvasStripes.getContext('2d');
                    ctx.clearRect(0, 0, 32, 32);
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 4;
                    ctx.beginPath();
                    for (let i = -32; i < 64; i += 12) {
                        ctx.moveTo(i, 0);
                        ctx.lineTo(i + 32, 32);
                    }
                    ctx.stroke();
                }

                // Hexagon
                const canvasHex = document.getElementById('canvasPatternHexagon');
                if (canvasHex) {
                    canvasHex.width = 32;
                    canvasHex.height = 32;
                    const ctx = canvasHex.getContext('2d');
                    ctx.clearRect(0, 0, 32, 32);
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 1.5;
                    ctx.beginPath();
                    const size = 5;
                    const drawHex = (x, y, r) => {
                        ctx.moveTo(x + r * Math.cos(0), y + r * Math.sin(0));
                        for (let i = 1; i <= 6; i++) {
                            ctx.lineTo(x + r * Math.cos(i * Math.PI / 3), y + r * Math.sin(i * Math.PI / 3));
                        }
                    };
                    const w = size * Math.sqrt(3);
                    const h = size * 1.5;
                    for (let y = -size; y < 32 + size; y += h) {
                        const shift = (Math.floor(y / h) % 2) * (w / 2);
                        for (let x = -w; x < 32 + w; x += w) {
                            drawHex(x + shift, y, size);
                        }
                    }
                    ctx.stroke();
                }

                // Cross
                const canvasCross = document.getElementById('canvasPatternCross');
                if (canvasCross) {
                    canvasCross.width = 32;
                    canvasCross.height = 32;
                    const ctx = canvasCross.getContext('2d');
                    ctx.clearRect(0, 0, 32, 32);
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 2;
                    ctx.beginPath();
                    for (let y = 6; y < 32; y += 12) {
                        for (let x = 6; x < 32; x += 12) {
                            ctx.moveTo(x, y - 4);
                            ctx.lineTo(x, y + 4);
                            ctx.moveTo(x - 4, y);
                            ctx.lineTo(x + 4, y);
                        }
                    }
                    ctx.stroke();
                }

                // Dots
                const canvasDots = document.getElementById('canvasPatternDots');
                if (canvasDots) {
                    canvasDots.width = 32;
                    canvasDots.height = 32;
                    const ctx = canvasDots.getContext('2d');
                    ctx.clearRect(0, 0, 32, 32);
                    ctx.fillStyle = color;
                    for (let y = 6; y < 32; y += 10) {
                        for (let x = 6; x < 32; x += 10) {
                            ctx.beginPath();
                            ctx.arc(x, y, 2.5, 0, Math.PI * 2);
                            ctx.fill();
                        }
                    }
                }

                // Checkered
                const canvasCheck = document.getElementById('canvasPatternCheckered');
                if (canvasCheck) {
                    canvasCheck.width = 32;
                    canvasCheck.height = 32;
                    const ctx = canvasCheck.getContext('2d');
                    ctx.clearRect(0, 0, 32, 32);
                    ctx.fillStyle = color;
                    ctx.fillRect(0, 0, 8, 8);
                    ctx.fillRect(8, 8, 8, 8);
                    ctx.fillRect(16, 0, 8, 8);
                    ctx.fillRect(0, 16, 8, 8);
                    ctx.fillRect(16, 16, 8, 8);
                    ctx.fillRect(24, 8, 8, 8);
                    ctx.fillRect(8, 24, 8, 8);
                    ctx.fillRect(24, 24, 8, 8);
                }

                // Chevron
                const canvasChevron = document.getElementById('canvasPatternChevron');
                if (canvasChevron) {
                    canvasChevron.width = 32;
                    canvasChevron.height = 32;
                    const ctx = canvasChevron.getContext('2d');
                    ctx.clearRect(0, 0, 32, 32);
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 2.5;
                    ctx.beginPath();
                    for (let y = 0; y < 40; y += 10) {
                        ctx.moveTo(0, y);
                        ctx.lineTo(16, y - 8);
                        ctx.lineTo(32, y);
                    }
                    ctx.stroke();
                }

                // Waves
                const canvasWaves = document.getElementById('canvasPatternWaves');
                if (canvasWaves) {
                    canvasWaves.width = 32;
                    canvasWaves.height = 32;
                    const ctx = canvasWaves.getContext('2d');
                    ctx.clearRect(0, 0, 32, 32);
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 2;
                    ctx.beginPath();
                    for (let y = 4; y < 40; y += 12) {
                        ctx.moveTo(0, y);
                        ctx.bezierCurveTo(8, y - 6, 8, y + 6, 16, y);
                        ctx.bezierCurveTo(24, y - 6, 24, y + 6, 32, y);
                    }
                    ctx.stroke();
                }

                // Grid
                const canvasGrid = document.getElementById('canvasPatternGrid');
                if (canvasGrid) {
                    canvasGrid.width = 32;
                    canvasGrid.height = 32;
                    const ctx = canvasGrid.getContext('2d');
                    ctx.clearRect(0, 0, 32, 32);
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 1.5;
                    ctx.beginPath();
                    for (let x = 0; x <= 32; x += 8) {
                        ctx.moveTo(x, 0);
                        ctx.lineTo(x, 32);
                        ctx.moveTo(0, x);
                        ctx.lineTo(32, x);
                    }
                    ctx.stroke();
                }

                // Stars
                const canvasStars = document.getElementById('canvasPatternStars');
                if (canvasStars) {
                    canvasStars.width = 32;
                    canvasStars.height = 32;
                    const ctx = canvasStars.getContext('2d');
                    ctx.clearRect(0, 0, 32, 32);
                    ctx.fillStyle = color;
                    const drawStar = (cx, cy, spikes, outerRadius, innerRadius) => {
                        let rot = Math.PI / 2 * 3;
                        let x = cx;
                        let y = cy;
                        let step = Math.PI / spikes;
                        ctx.beginPath();
                        ctx.moveTo(cx, cy - outerRadius);
                        for (let i = 0; i < spikes; i++) {
                            x = cx + Math.cos(rot) * outerRadius;
                            y = cy + Math.sin(rot) * outerRadius;
                            ctx.lineTo(x, y);
                            rot += step;
                            x = cx + Math.cos(rot) * innerRadius;
                            y = cy + Math.sin(rot) * innerRadius;
                            ctx.lineTo(x, y);
                            rot += step;
                        }
                        ctx.lineTo(cx, cy - outerRadius);
                        ctx.closePath();
                        ctx.fill();
                    };
                    drawStar(8, 8, 5, 5, 2.5);
                    drawStar(24, 8, 5, 5, 2.5);
                    drawStar(8, 24, 5, 5, 2.5);
                    drawStar(24, 24, 5, 5, 2.5);
                }
            }

            function addPatternToCanvas(type) {
                const color = document.getElementById('patternColorInput').value;
                const patternCanvas = document.createElement('canvas');
                const ctx = patternCanvas.getContext('2d');

                if (type === 'stripes') {
                    patternCanvas.width = 24;
                    patternCanvas.height = 24;
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 4;
                    ctx.beginPath();
                    ctx.moveTo(0, 24);
                    ctx.lineTo(24, 0);
                    ctx.stroke();
                } else if (type === 'hexagon') {
                    const size = 10;
                    const w = size * Math.sqrt(3);
                    const h = size * 1.5;
                    patternCanvas.width = w;
                    patternCanvas.height = size * 3;
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 1.5;
                    ctx.beginPath();
                    const drawHex = (x, y, r) => {
                        ctx.moveTo(x + r * Math.cos(0), y + r * Math.sin(0));
                        for (let i = 1; i <= 6; i++) {
                            ctx.lineTo(x + r * Math.cos(i * Math.PI / 3), y + r * Math.sin(i * Math.PI / 3));
                        }
                    };
                    drawHex(w/2, 0, size);
                    drawHex(w/2, h*2, size);
                    drawHex(0, h, size);
                    drawHex(w, h, size);
                    ctx.stroke();
                } else if (type === 'cross') {
                    patternCanvas.width = 20;
                    patternCanvas.height = 20;
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 2;
                    ctx.beginPath();
                    ctx.moveTo(10, 3);
                    ctx.lineTo(10, 17);
                    ctx.moveTo(3, 10);
                    ctx.lineTo(17, 10);
                    ctx.stroke();
                } else if (type === 'dots') {
                    patternCanvas.width = 16;
                    patternCanvas.height = 16;
                    ctx.fillStyle = color;
                    ctx.beginPath();
                    ctx.arc(8, 8, 3, 0, Math.PI * 2);
                    ctx.fill();
                } else if (type === 'checkered') {
                    patternCanvas.width = 20;
                    patternCanvas.height = 20;
                    ctx.fillStyle = color;
                    ctx.fillRect(0, 0, 10, 10);
                    ctx.fillRect(10, 10, 10, 10);
                } else if (type === 'chevron') {
                    patternCanvas.width = 30;
                    patternCanvas.height = 15;
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 2.5;
                    ctx.beginPath();
                    ctx.moveTo(0, 15);
                    ctx.lineTo(15, 0);
                    ctx.lineTo(30, 15);
                    ctx.stroke();
                } else if (type === 'waves') {
                    patternCanvas.width = 40;
                    patternCanvas.height = 20;
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 2;
                    ctx.beginPath();
                    ctx.moveTo(0, 10);
                    ctx.bezierCurveTo(10, 0, 10, 20, 20, 10);
                    ctx.bezierCurveTo(30, 0, 30, 20, 40, 10);
                    ctx.stroke();
                } else if (type === 'grid') {
                    patternCanvas.width = 20;
                    patternCanvas.height = 20;
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 1.5;
                    ctx.beginPath();
                    ctx.moveTo(0, 0);
                    ctx.lineTo(20, 0);
                    ctx.moveTo(0, 0);
                    ctx.lineTo(0, 20);
                    ctx.stroke();
                } else if (type === 'stars') {
                    patternCanvas.width = 25;
                    patternCanvas.height = 25;
                    ctx.fillStyle = color;
                    const drawStar = (cx, cy, spikes, outerRadius, innerRadius) => {
                        let rot = Math.PI / 2 * 3;
                        let x = cx;
                        let y = cy;
                        let step = Math.PI / spikes;
                        ctx.beginPath();
                        ctx.moveTo(cx, cy - outerRadius);
                        for (let i = 0; i < spikes; i++) {
                            x = cx + Math.cos(rot) * outerRadius;
                            y = cy + Math.sin(rot) * outerRadius;
                            ctx.lineTo(x, y);
                            rot += step;
                            x = cx + Math.cos(rot) * innerRadius;
                            y = cy + Math.sin(rot) * innerRadius;
                            ctx.lineTo(x, y);
                            rot += step;
                        }
                        ctx.lineTo(cx, cy - outerRadius);
                        ctx.closePath();
                        ctx.fill();
                    };
                    drawStar(12.5, 12.5, 5, 8, 4);
                }

                const dataUrl = patternCanvas.toDataURL();
                fabric.util.loadImage(dataUrl, function(img) {
                    // Remove existing pattern on active canvas
                    const existing = activeCanvas.getObjects().find(o => o.className === 'jersey-pattern' || o.className === 'motif-pattern');
                    if (existing) activeCanvas.remove(existing);

                    const rect = new fabric.Rect({
                        width: activeCanvas.width,
                        height: activeCanvas.height,
                        left: activeCanvas.width / 2,
                        top: activeCanvas.height / 2,
                        originX: 'center',
                        originY: 'center',
                        className: 'jersey-pattern',
                        side: currentSide || 'front',
                        fill: new fabric.Pattern({
                            source: img,
                            repeat: 'repeat'
                        })
                    });
                    
                    applyPatternClipping(activeCanvas, rect, currentSide);
                    
                    setupObjectControls(rect);
                    activeCanvas.add(rect);
                    activeCanvas.setActiveObject(rect);
                    activeCanvas.renderAll();
                    adjustLayers(activeCanvas);
                }, { crossOrigin: 'anonymous' });
            }

            // ==========================================
            // RESPONSIVE WORKSPACE AUTO-SCALING
            // ==========================================

            function resizeWorkspaces() {
                const workspace = document.getElementById('editorWorkspace');
                const container = document.getElementById('canvasesContainer');
                if (!workspace || !container) return;

                const availableWidth = workspace.clientWidth - 48; 
                const availableHeight = workspace.clientHeight - 48; 

                // Original design size of the side-by-side canvases structure is approx 860px wide, 460px high
                const originalWidth = 880;
                const originalHeight = 480;

                const scaleX = availableWidth / originalWidth;
                const scaleY = availableHeight / originalHeight;
                const scale = Math.min(scaleX, scaleY, 1.0); 

                container.style.transform = `scale(${scale})`;
                container.style.transformOrigin = 'center center';
            }

            // Resize Observer to trigger whenever panels open/close or viewport changes
            if (typeof ResizeObserver !== 'undefined') {
                const workspace = document.getElementById('editorWorkspace');
                if (workspace) {
                    const ro = new ResizeObserver(() => {
                        resizeWorkspaces();
                    });
                    ro.observe(workspace);
                }
            }
            window.addEventListener('resize', resizeWorkspaces);
            setTimeout(resizeWorkspaces, 150);

            // ==========================================
            // INITIAL EXECUTION LOGIC
            // ==========================================

            // 1. Initialize canvases
            initCanvases();

            // 2. Setup toolbar button bindings
            initToolbar();

            // 3. Render patterns previews
            drawPatternPreviews('#374151');

            // 4. Initial load of Custom Motifs grid
            loadMotifs();

            // 5. Load design state
            loadDesign();

            // 6. Sync initial recommendation preferences (category & color)
            syncRecommendationPreferences();

            // 7. Check for pending local guest drafts
            checkPendingDesignRecovery();
        });
    </script>
    @endpush
</x-app-layout>
