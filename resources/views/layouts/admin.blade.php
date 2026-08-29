<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
            <!-- Mobile Sidebar Backdrop -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-40 bg-slate-950/70 backdrop-blur-sm md:hidden"
                 @click="sidebarOpen = false"
                 style="display: none;">
            </div>

            <!-- Sidebar Navigation (Fixed Position) -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
                   class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 flex flex-col justify-between border-r border-slate-800 transition-transform duration-300 ease-in-out md:translate-x-0 shrink-0 h-screen overflow-y-auto">
                
                <!-- Sidebar Header & Menu -->
                <div class="flex-1 flex flex-col min-h-0">
                    <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/80 bg-slate-950/40 shrink-0">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                            <div class="w-10 h-10 bg-gradient-to-tr from-emerald-600 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform duration-200">
                                <span class="text-white text-lg font-bold">W</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bold text-white tracking-wider text-base">Willy Configurator</span>
                            </div>
                        </a>
                        <!-- Close button for mobile -->
                        <button class="md:hidden p-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white transition-colors" @click="sidebarOpen = false" aria-label="Tutup Menu">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Sidebar Menu Nav -->
                    <nav class="flex-1 px-4 py-6 space-y-7 overflow-y-auto">
                        <div>
                            <span class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-widest block mb-3">Menu Utama</span>
                            <div class="space-y-1.5">
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500 text-white font-semibold shadow-md shadow-emerald-500/20' : 'hover:bg-slate-800/70 hover:text-white text-slate-300' }}">
                                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                                    </svg>
                                    Dashboard
                                </a>

                                <a href="{{ route('admin.templates.index') }}" 
                                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.templates.*') ? 'bg-emerald-500 text-white font-semibold shadow-md shadow-emerald-500/20' : 'hover:bg-slate-800/70 hover:text-white text-slate-300' }}">
                                    <svg class="w-5 h-5 {{ request()->routeIs('admin.templates.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Kelola Template
                                </a>

                                <a href="{{ route('admin.motifs.index') }}" 
                                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.motifs.*') ? 'bg-emerald-500 text-white font-semibold shadow-md shadow-emerald-500/20' : 'hover:bg-slate-800/70 hover:text-white text-slate-300' }}">
                                    <svg class="w-5 h-5 {{ request()->routeIs('admin.motifs.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                    </svg>
                                    Kelola Motif
                                </a>
                            </div>
                        </div>

                        <div>
                            <span class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-widest block mb-3">Navigasi Lain</span>
                            <div class="space-y-1.5">
                                <a href="{{ route('profile.edit') }}" 
                                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('profile.edit') ? 'bg-emerald-500 text-white font-semibold shadow-md shadow-emerald-500/20' : 'hover:bg-slate-800/70 hover:text-white text-slate-300' }}">
                                    <svg class="w-5 h-5 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil Saya
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- Sidebar Footer (Logout Only) -->
                <div class="p-4 border-t border-slate-800 bg-slate-950/40 shrink-0">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-xs font-semibold text-rose-400 hover:text-white hover:bg-rose-500/20 border border-rose-500/20 hover:border-rose-500/40 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 md:ml-64 flex flex-col min-w-0 min-h-screen">
                <!-- Top Navbar -->
                <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 md:px-8 shrink-0 shadow-sm sticky top-0 z-40">
                    <div class="flex items-center gap-4">
                        <!-- Toggle button for mobile -->
                        <button class="md:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors" @click="sidebarOpen = true" aria-label="Buka Menu">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        
                        <!-- Header Slot / Title -->
                        @isset($header)
                            <div>
                                {{ $header }}
                            </div>
                        @else
                            <h1 class="text-xl font-bold text-slate-900">Dashboard Admin</h1>
                        @endisset
                    </div>

                    <!-- User Name Badge -->
                    <div class="flex items-center gap-4">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                </header>

                <!-- Page Main Content -->
                <main class="flex-1 p-6 md:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
