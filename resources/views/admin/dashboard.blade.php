<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <h2 class="font-bold text-xl text-slate-900 leading-tight">
                {{ __('Dashboard Admin') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-7">

        {{-- Metric / KPI Cards Section --}}
        <div>
            <h3 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2.5">
                <span class="w-1 h-5 bg-emerald-500 rounded-full inline-block"></span>
                Metrik
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Stat Card 1: Pengguna -->
                <div class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-slate-200 p-5 hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 bg-blue-50 group-hover:bg-blue-600 rounded-xl flex items-center justify-center transition-colors duration-200 shrink-0">
                            <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Pengguna</span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $users_count ?? '-' }}</p>
                    <p class="text-[11px] text-slate-500 font-medium mt-1">Terdaftar dalam sistem</p>
                </div>

                <!-- Stat Card 2: Template -->
                <div class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-slate-200 p-5 hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 bg-emerald-50 group-hover:bg-emerald-600 rounded-xl flex items-center justify-center transition-colors duration-200 shrink-0">
                            <svg class="w-5 h-5 text-emerald-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Template</span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $templates_count ?? '-' }}</p>
                    <p class="text-[11px] text-emerald-600 font-semibold mt-1">Katalog siap pakai</p>
                </div>

                <!-- Stat Card 3: Desain -->
                <div class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-slate-200 p-5 hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 bg-indigo-50 group-hover:bg-indigo-600 rounded-xl flex items-center justify-center transition-colors duration-200 shrink-0">
                            <svg class="w-5 h-5 text-indigo-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Desain</span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $designs_count ?? '-' }}</p>
                    <p class="text-[11px] text-indigo-600 font-semibold mt-1">Kustomisasi pengguna</p>
                </div>

                <!-- Stat Card 4: Motif -->
                <div class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-slate-200 p-5 hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 bg-amber-50 group-hover:bg-amber-600 rounded-xl flex items-center justify-center transition-colors duration-200 shrink-0">
                            <svg class="w-5 h-5 text-amber-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Motif</span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $motifs_count ?? '-' }}</p>
                    <p class="text-[11px] text-amber-600 font-semibold mt-1">Motif pendukung</p>
                </div>
            </div>
        </div>

        {{-- Recent Activity Section --}}
        <div>
            <h3 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2.5">
                <span class="w-1 h-5 bg-emerald-500 rounded-full inline-block"></span>
                Aktivitas Terbaru
            </h3>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="divide-y divide-slate-100">
                    @forelse($recent_activities ?? [] as $activity)
                        <div class="p-4 sm:px-6 flex items-center justify-between hover:bg-slate-50/80 transition-colors">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0
                                    @if(($activity['icon'] ?? '') === 'design') bg-indigo-50 text-indigo-600
                                    @elseif(($activity['icon'] ?? '') === 'template') bg-emerald-50 text-emerald-600
                                    @else bg-blue-50 text-blue-600 @endif">
                                    @if(($activity['icon'] ?? '') === 'design')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    @elseif(($activity['icon'] ?? '') === 'template')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @endif
                                </div>
                                <p class="text-sm text-slate-700 font-medium truncate">
                                    {{ $activity['description'] }}
                                </p>
                            </div>
                            <span class="text-xs text-slate-400 font-medium shrink-0 ml-4">
                                {{ $activity['time'] }}
                            </span>
                        </div>
                    @empty
                        <div class="p-4 sm:px-6 flex items-center justify-between hover:bg-slate-50/80 transition-colors">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-700 font-medium">User membuat desain baru</p>
                            </div>
                            <span class="text-xs text-slate-400 font-medium">2 menit lalu</span>
                        </div>

                        <div class="p-4 sm:px-6 flex items-center justify-between hover:bg-slate-50/80 transition-colors">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-700 font-medium">Template baru ditambahkan</p>
                            </div>
                            <span class="text-xs text-slate-400 font-medium">10 menit lalu</span>
                        </div>

                        <div class="p-4 sm:px-6 flex items-center justify-between hover:bg-slate-50/80 transition-colors">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-700 font-medium">User mengedit desain</p>
                            </div>
                            <span class="text-xs text-slate-400 font-medium">20 menit lalu</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
