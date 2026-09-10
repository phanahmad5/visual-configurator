<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight leading-tight">
                {{ __('Kelola Motif') }}
            </h2>
            <a href="{{ route('admin.motifs.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-sm font-bold shadow-md shadow-emerald-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Motif
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-700 text-sm font-semibold flex items-center gap-3 shadow-sm animate-fade-in">
                <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center text-emerald-600 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        {{-- Search and Filters (Dark Navy Styling) --}}
        <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-sm p-4">
            <form action="{{ route('admin.motifs.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                <div class="relative w-full sm:max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari berdasarkan nama atau kategori motif..." class="w-full pl-10 pr-4 py-3 text-sm bg-slate-800 border border-slate-700 rounded-xl focus:bg-slate-850 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 text-white placeholder-slate-400 transition-all duration-200" autocomplete="off">
                </div>
                <div class="flex gap-2 w-full sm:w-auto shrink-0">
                    @if($search)
                        <a href="{{ route('admin.motifs.index') }}" class="w-full sm:w-auto text-center px-5 py-3 border border-slate-700 hover:bg-slate-800 text-slate-300 font-bold text-xs rounded-xl transition-all duration-200">
                            Reset
                        </a>
                    @endif
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-sm">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- Dark Table Card Container (#1E293B) --}}
        <div class="bg-slate-800 rounded-2xl border border-slate-700 shadow-md overflow-hidden">
            @if($motifs->isEmpty())
                <div class="p-16 text-center">
                    <div class="w-20 h-20 bg-slate-900/60 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-slate-700">
                        <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="font-extrabold text-white text-lg">Tidak ada motif ditemukan</h4>
                    <p class="text-slate-400 text-sm mt-1">Coba sesuaikan kata kunci pencarian Anda atau tambahkan motif baru.</p>
                </div>
            @else
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse min-w-[900px]">
                        <thead>
                            <tr class="bg-slate-900 border-b border-slate-700 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                <th class="px-5 py-4">NO</th>
                                <th class="px-5 py-4">PREVIEW</th>
                                <th class="px-5 py-4">NAMA MOTIF</th>
                                <th class="px-5 py-4">KATEGORI</th>
                                <th class="px-5 py-4">DESKRIPSI</th>
                                <th class="px-5 py-4">STATUS</th>
                                <th class="px-5 py-4">TANGGAL</th>
                                <th class="px-5 py-4 text-center min-w-[170px] whitespace-nowrap">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/60 text-sm text-slate-200 bg-slate-800">
                            @foreach($motifs as $motif)
                                <tr class="hover:bg-slate-750/50 hover:bg-slate-700/40 transition-colors duration-150">
                                    <td class="px-5 py-4 font-semibold text-slate-400 text-xs">
                                        {{ ($motifs->currentPage() - 1) * $motifs->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <div class="w-14 h-14 bg-slate-900 rounded-xl overflow-hidden border border-slate-700 flex items-center justify-center p-1.5 shadow-sm shrink-0" style="width: 56px; height: 56px; max-width: 56px; max-height: 56px;">
                                            <img src="{{ asset($motif->path_file) }}" alt="{{ $motif->nama }}" class="w-full h-full object-contain rounded-lg" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 font-bold text-white max-w-[200px] leading-snug">
                                        {{ $motif->nama }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold uppercase bg-slate-900 text-slate-300 border border-slate-700">
                                            {{ $motif->kategori ?? $motif->category ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 max-w-xs truncate text-slate-400 text-xs">
                                        {{ $motif->description ?? '-' }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        @if($motif->is_active)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-slate-700/50 text-slate-400 border border-slate-600/40">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-slate-400 text-xs">
                                        {{ $motif->created_at ? $motif->created_at->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-center text-xs font-bold min-w-[170px]">
                                        <div class="flex items-center justify-center gap-2 whitespace-nowrap">
                                            <a href="{{ route('admin.motifs.edit', $motif->id) }}" class="inline-flex items-center gap-1 px-3 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-xl shadow-sm hover:shadow transition-all duration-200 hover:-translate-y-0.5 font-bold whitespace-nowrap">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.motifs.destroy', $motif->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus motif ini? Berkas gambar juga akan dihapus dari server.')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-red-600 hover:bg-red-500 text-white rounded-xl shadow-sm hover:shadow transition-all duration-200 hover:-translate-y-0.5 font-bold whitespace-nowrap">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($motifs->hasPages())
                    <div class="px-6 py-4 border-t border-slate-700 bg-slate-900">
                        {{ $motifs->links() }}
                    </div>
                @endif
            @endif
        </div>

    </div>
</x-admin-layout>
