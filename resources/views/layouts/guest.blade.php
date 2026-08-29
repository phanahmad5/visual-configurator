<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Visual Configurator - Platform Personalisasi Pakaian Custom">

        <title>{{ config('app.name', 'Visual Configurator') }} — Autentikasi</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN & Scripts -->
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
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .input-field {
                transition: all 0.2s ease;
            }
            .input-field:focus {
                transform: translateY(-1px);
                box-shadow: 0 4px 20px rgba(37, 99, 235, 0.15);
            }
            .btn-primary {
                background: linear-gradient(135deg, #2563eb, #06b6d4);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            .btn-primary::before {
                content: '';
                position: absolute;
                top: 0; left: -100%;
                width: 100%; height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: 0.5s;
            }
            .btn-primary:hover::before {
                left: 100%;
            }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(37, 99, 235, 0.35);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-900 text-gray-900 selection:bg-blue-600 selection:text-white min-h-screen flex flex-col justify-between relative overflow-x-hidden bg-cover bg-center bg-no-repeat"
      style="background-image: url('/images/bg.png');">

        {{-- Background Glow Blobs --}}
        <div class="absolute inset-0 overflow-hidden -z-10 pointer-events-none">
            <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-sky-400/10 rounded-full blur-[160px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[160px]"></div>
        </div>

        {{-- Main Container --}}
        <div class="flex-1 flex flex-col items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
            
          

            {{-- Form Card --}}
            <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100">
                {{ $slot }}
            </div>

        </div>


    </body>
</html>
