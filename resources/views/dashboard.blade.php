<x-app-layout>
    <div class="py-8 bg-slate-50/60 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Welcome Banner (Hero Card) --}}
            <div class="relative overflow-hidden rounded-3xl p-8 sm:p-10 text-white shadow-xl"
                 style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);">
                <!-- Background subtle glow circles -->
                <div class="absolute -top-12 -right-12 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-12 -left-12 w-72 h-72 bg-black/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    <!-- Left Banner Text -->
                    <div class="lg:col-span-7 space-y-4">
                        <p class="text-white/90 text-sm font-medium flex items-center gap-1.5">
                            Selamat datang kembali 👋
                        </p>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight drop-shadow-sm">
                            {{ auth()->user()->name }}
                        </h1>
                        <p class="text-indigo-100 text-sm sm:text-base max-w-xl font-normal leading-relaxed">
                            Buat desain pakaian custom sesuai kreativitasmu dengan Visual Configurator yang mudah dan interaktif.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('designs.create') }}" 
                               class="inline-flex items-center gap-2.5 text-white text-sm font-semibold px-6 py-3 rounded-2xl transition-all duration-300 hover:scale-105 shadow-lg"
                               style="background-color: #4338ca; border: 1px solid rgba(255,255,255,0.2);">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span>Buat Desain Baru</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Banner Graphic (Jersey Preview with Floating Icons) -->
                    <div class="lg:col-span-5 relative flex items-center justify-center min-h-[220px]">
                        <div class="relative w-full max-w-[280px] sm:max-w-[320px] aspect-square flex items-center justify-center">
                            <!-- Jersey Preview Graphic -->
                            <img src="/templates/jersey/preview/bg2.png" 
                                 onerror="this.onerror=null; this.src='/mockups/jersey_front.png';" 
                                 alt="Jersey Preview" 
                                 class="w-full h-full object-contain filter drop-shadow-2xl hover:scale-105 transition-transform duration-500">

                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Cards Section --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Total Desain -->
                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-all flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0" style="background-color: #f3e8ff;">
                        <svg class="w-7 h-7" style="color: #9333ea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-0.5">Total Desain</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 leading-tight">
                            {{ $totalDesignsCount ?? $designs->count() }}
                        </h3>
                        <p class="text-[11px] font-semibold flex items-center gap-1 mt-1" style="color: #16a34a;">
                            <span>▲ 20%</span> <span class="text-slate-400 font-normal">dari bulan lalu</span>
                        </p>
                    </div>
                </div>

                <!-- Card 2: Desain Terbaru -->
                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-all flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0" style="background-color: #ffe4e6;">
                        <svg class="w-7 h-7" style="color: #e11d48;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-0.5">Desain Terbaru</p>
                        <h3 class="text-xl font-extrabold text-slate-900 leading-tight">
                            {{ isset($latestDesign) && $latestDesign ? $latestDesign->updated_at->diffForHumans() : 'Belum ada' }}
                        </h3>
                        <p class="text-[11px] font-medium text-slate-400 mt-1">
                            Baru saja disimpan
                        </p>
                    </div>
                </div>

                <!-- Card 3: Template Tersedia -->
                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-all flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0" style="background-color: #dcfce7;">
                        <svg class="w-7 h-7" style="color: #059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-0.5">Template Tersedia</p>
                        <h3 class="text-2xl font-extrabold text-slate-900 leading-tight">
                            {{ $templatesCount ?? 5 }}
                        </h3>
                        <p class="text-[11px] font-medium mt-1" style="color: #059669;">
                            Siap digunakan
                        </p>
                    </div>
                </div>
            </div>

            {{-- Akses Cepat Section --}}
            <div class="space-y-3">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Akses Cepat</h2>
                    <p class="text-xs text-slate-500">Mulai kustomisasi desain Anda dengan mudah</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Visual Configurator -->
                    <a href="{{ route('designs.create') }}" 
                       class="group rounded-2xl p-5 transition-all duration-300 flex items-center justify-between shadow-sm hover:shadow-md"
                       style="background-color: #f4f3ff; border: 1px solid #e0e7ff;">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 transition-colors duration-300"
                                 style="background-color: #e0e7ff; color: #4338ca;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 text-base">Visual Configurator</h3>
                                <p class="text-xs text-slate-500">Desain kaos dan jersey secara interaktif dengan canvas digital.</p>
                            </div>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center shadow-sm group-hover:translate-x-1 transition-transform shrink-0" style="color: #4338ca;">
                            →
                        </div>
                    </a>

                    <!-- Profil Saya -->
                    <a href="{{ route('profile.edit') }}" 
                       class="group rounded-2xl p-5 transition-all duration-300 flex items-center justify-between shadow-sm hover:shadow-md"
                       style="background-color: #fff1f2; border: 1px solid #ffe4e6;">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 transition-colors duration-300"
                                 style="background-color: #ffe4e6; color: #e11d48;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 text-base">Profil Saya</h3>
                                <p class="text-xs text-slate-500">Kelola informasi akun, alamat dan preferensi desain.</p>
                            </div>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center shadow-sm group-hover:translate-x-1 transition-transform shrink-0" style="color: #e11d48;">
                            →
                        </div>
                    </a>
                </div>
            </div>

            {{-- Riwayat Desain Anda Section --}}
            <div class="bg-white rounded-3xl border border-slate-100 p-6 sm:p-8 shadow-sm space-y-6">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Riwayat Desain Anda</h2>
                        <p class="text-xs text-slate-500">Daftar desain yang telah Anda simpan dan kustomisasi</p>
                    </div>
                    <a href="{{ route('designs.create') }}" 
                       class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 text-white text-xs font-semibold rounded-xl shadow-md transition-all hover:shadow-lg"
                       style="background-color: #4338ca; color: #ffffff;">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Buat Desain Baru</span>
                    </a>
                </div>

                @if($designs->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                            <span class="text-2xl">🎨</span>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm">Belum Ada Desain</h4>
                        <p class="text-xs text-slate-400 mt-1 mb-4">Anda belum menyimpan desain apapun ke akun Anda.</p>
                        <a href="{{ route('designs.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-bold rounded-xl transition-all">
                            Mulai Desain Sekarang
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="designsGrid">
                        @foreach($designs as $design)
                            @php
                                $previewSrc = null;
                                if (!empty($design->export_image)) {
                                    $cleanPath = ltrim($design->export_image, '/');
                                    if (str_starts_with($cleanPath, 'data:image')) {
                                        $previewSrc = $design->export_image;
                                    } else {
                                        $previewSrc = asset($cleanPath);
                                    }
                                }

                                if (!$previewSrc) {
                                    $nameLower = strtolower($design->name ?? '');
                                    if (str_contains($nameLower, 'dynamic') || str_contains($nameLower, 'brush')) {
                                        $previewSrc = asset('templates/jersey/preview/jersey_dynamic_brush.png');
                                    } elseif (str_contains($nameLower, 'elegant') || str_contains($nameLower, 'modern')) {
                                        $previewSrc = asset('templates/jersey/preview/jersey_elegant_modern.png');
                                    } elseif (str_contains($nameLower, 'minimal') || str_contains($nameLower, 'wave')) {
                                        $previewSrc = asset('templates/jersey/preview/jersey_minimal_wave.png');
                                    } elseif (str_contains($nameLower, 'tech') || str_contains($nameLower, 'geometric')) {
                                        $previewSrc = asset('templates/jersey/preview/jersey_tech_geometric.png');
                                    } elseif (str_contains($nameLower, 'urban')) {
                                        $previewSrc = asset('templates/jersey/preview/jersey_urban_style.png');
                                    } else {
                                        $previewSrc = asset('templates/jersey/preview/jersey_dynamic_brush.png');
                                    }
                                }
                            @endphp

                            <div class="group relative bg-white border border-slate-100 rounded-2xl p-4 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between" id="design-card-{{ $design->id }}">
                                <div>
                                    <!-- Image Preview Box -->
                                    <div class="w-full aspect-[4/3] rounded-xl mb-3 flex items-center justify-center p-3 border border-slate-100 relative overflow-hidden group-hover:scale-[1.02] transition-transform duration-300"
                                         style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                                        <!-- 3 dots context menu top right -->
                                        <div class="absolute top-2 right-2 z-10">
                                            <button type="button" class="p-1.5 rounded-full text-slate-400 hover:text-slate-600 hover:bg-white/80 transition-all">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <img src="{{ $previewSrc }}" 
                                             onerror="this.onerror=null; this.src='/templates/jersey/preview/jersey_dynamic_brush.png';"
                                             alt="{{ $design->name }}" 
                                             class="w-full h-full object-contain filter drop-shadow-md">
                                    </div>

                                    <!-- Title & Timestamp -->
                                    <h4 class="font-bold text-slate-900 text-sm mb-1 truncate" title="{{ $design->name }}">{{ $design->name }}</h4>
                                    <p class="text-xs text-slate-400 flex items-center gap-1.5 mb-4 font-normal">
                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $design->updated_at->diffForHumans() }}</span>
                                    </p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2 pt-2 border-t border-slate-50">
                                    <a href="{{ route('designs.edit', $design->id) }}" 
                                       class="flex-1 py-2 text-xs font-semibold rounded-xl text-center transition-colors flex items-center justify-center gap-1.5"
                                       style="background-color: #e0e7ff; color: #4338ca;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        <span>Edit Desain</span>
                                    </a>
                                    <button type="button" 
                                            class="p-2 rounded-xl transition-colors delete-design-btn" 
                                            style="background-color: #ffe4e6; color: #e11d48;"
                                            data-id="{{ $design->id }}" 
                                            data-name="{{ $design->name }}" 
                                            title="Hapus Desain">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Recover Draft Modal on Dashboard -->
    <div id="recoverDraftModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-2xl max-w-md w-full p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out" id="recoverDraftModalContent">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Desain Draf Ditemukan!</h3>
                <p class="text-sm text-slate-500 mb-6 leading-relaxed">Kami mendeteksi adanya draf desain <strong class="text-slate-800" id="draftNameText">''</strong> yang Anda buat sebagai Tamu sebelumnya. Apakah Anda ingin menyimpannya sekarang ke riwayat akun Anda?</p>
                <div class="flex gap-3 justify-center">
                    <button type="button" id="saveDraftBtn" class="flex-1 py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-md shadow-indigo-100 hover:shadow-indigo-200">
                        Ya, Simpan ke Riwayat
                    </button>
                    <button type="button" id="ignoreDraftBtn" class="py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold rounded-xl transition-all">
                        Abaikan & Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // 1. DELETE DESIGN FEATURE
            const deleteButtons = document.querySelectorAll('.delete-design-btn');
            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const designId = this.getAttribute('data-id');
                    const designName = this.getAttribute('data-name');

                    if (confirm(`Apakah Anda yakin ingin menghapus desain '${designName}' secara permanen?`)) {
                        fetch(`/designs/${designId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal menghapus desain.');
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Transition removal
                                const card = document.getElementById(`design-card-${designId}`);
                                if (card) {
                                    card.classList.add('opacity-0', 'scale-95');
                                    setTimeout(() => {
                                        card.remove();
                                        // Reload page if no cards left to display empty state
                                        const grid = document.getElementById('designsGrid');
                                        if (grid && grid.children.length === 0) {
                                            window.location.reload();
                                        }
                                    }, 300);
                                }
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(err => {
                            console.error('Delete Error:', err);
                            alert('Terjadi kesalahan: ' + err.message);
                        });
                    }
                });
            });

            // 2. RECOVER GUEST DRAFT LOGIC
            const pendingDesignStr = localStorage.getItem('pending_design');
            const recoverDraftModal = document.getElementById('recoverDraftModal');
            const recoverDraftModalContent = document.getElementById('recoverDraftModalContent');
            const draftNameText = document.getElementById('draftNameText');
            const saveDraftBtn = document.getElementById('saveDraftBtn');
            const ignoreDraftBtn = document.getElementById('ignoreDraftBtn');

            if (pendingDesignStr && recoverDraftModal) {
                try {
                    const pendingDesign = JSON.parse(pendingDesignStr);
                    draftNameText.innerText = `'${pendingDesign.name}'`;

                    // Show modal with animation
                    recoverDraftModal.classList.remove('hidden');
                    recoverDraftModal.classList.add('flex');
                    setTimeout(() => {
                        recoverDraftModalContent.classList.remove('scale-95', 'opacity-0');
                        recoverDraftModalContent.classList.add('scale-100', 'opacity-100');
                    }, 10);

                    // Save draft action
                    saveDraftBtn.addEventListener('click', function() {
                        saveDraftBtn.disabled = true;
                        saveDraftBtn.innerText = 'Menyimpan...';
                        ignoreDraftBtn.disabled = true;

                        fetch("{{ route('designs.store') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                name: pendingDesign.name,
                                canvas_data: pendingDesign.canvas_data
                            })
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal menyimpan draf ke database.');
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                localStorage.removeItem('pending_design');
                                alert('Draf desain berhasil disimpan ke riwayat akun Anda!');
                                window.location.reload(); // Reload to show draft
                            } else {
                                alert('Gagal menyimpan: ' + data.message);
                                resetModalButtons();
                            }
                        })
                        .catch(err => {
                            console.error('Save Draft Error:', err);
                            alert('Terjadi kesalahan: ' + err.message);
                            resetModalButtons();
                        });
                    });

                    // Ignore draft action
                    ignoreDraftBtn.addEventListener('click', function() {
                        if (confirm('Apakah Anda yakin ingin mengabaikan dan menghapus draf sementara ini?')) {
                            localStorage.removeItem('pending_design');
                            hideModal();
                        }
                    });

                    function hideModal() {
                        recoverDraftModalContent.classList.remove('scale-100', 'opacity-100');
                        recoverDraftModalContent.classList.add('scale-95', 'opacity-0');
                        setTimeout(() => {
                            recoverDraftModal.classList.remove('flex');
                            recoverDraftModal.classList.add('hidden');
                        }, 300);
                    }

                    function resetModalButtons() {
                        saveDraftBtn.disabled = false;
                        saveDraftBtn.innerText = 'Ya, Simpan ke Riwayat';
                        ignoreDraftBtn.disabled = false;
                    }

                } catch (e) {
                    console.error('Gagal memproses draf pending:', e);
                    localStorage.removeItem('pending_design');
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
