<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', "YouCo'Done") }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            brand: {
                                500: '#FF4F18', /* Ton Orange Spécial */
                                600: '#E03E0B',
                                900: '#1a1a1a',
                            },
                            surface: '#FAFAFA'
                        },
                        fontFamily: {
                            sans: ['Plus Jakarta Sans', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
        
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            /* Force l'orange sur les focus ring de Breeze si tu n'as pas changé les composants */
            input:focus, button:focus {
                --tw-ring-color: #FF4F18 !important;
                border-color: #FF4F18 !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-white">
        @yield('content')
    </body>
</html>
