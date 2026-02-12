<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouCo'Done - L'Art de la Réservation</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#FF4F18', /* Orange International vibrant */
                            600: '#E03E0B',
                            900: '#1a1a1a',
                        },
                        surface: '#FAFAFA' // Blanc cassé très subtil pour les sections
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'], // Police très géométrique et moderne
                    },
                    boxShadow: {
                        'float': '0 20px 50px -12px rgba(0, 0, 0, 0.1)',
                        'card': '0 10px 30px -10px rgba(0, 0, 0, 0.05)',
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Cacher la scrollbar pour les éléments horizontaux */
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }

        /* Animation d'apparition */
        .reveal { opacity: 0; transform: translateY(30px); transition: all 1s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased overflow-x-hidden">

    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-brand-500 rounded-xl flex items-center justify-center text-white rotate-3 hover:rotate-0 transition duration-300">
                        <i class="ph-bold ph-fork-knife text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-tight">YouCo'<span class="text-brand-500">Done</span>.</span>
                </a>
                @role('client')
                <div class="hidden md:flex gap-10 text-sm font-semibold text-gray-500">
                    <a href="{{ route('client.restaurants.index') }}" class="text-gray-900 hover:text-brand-500 transition">Restaurants</a>
                    <a href="{{ route('client.reservations.index') }}" class="hover:text-brand-500 transition">Mes Réservations</a>
                    <a href="{{ route('client.restaurants.index') }}" class="hover:text-brand-500 transition">Favoris</a>
                </div>
                @endrole

                <div class="flex items-center gap-4">
                    @auth
                    @role('admin')
                        <a href="{{ url('/admin') }}" class="hidden sm:block text-sm font-semibold hover:text-brand-500 transition">Dashboard</a>
                    @endrole
                    @role('restaurateur')
                        <a href="{{ url('/restaurant') }}" class="hidden sm:block text-sm font-semibold hover:text-brand-500 transition">Dashboard</a>
                        
                    @endrole
                    @role('client')
                         <a href="{{ route('profile.edit') }}" class="hidden sm:block text-sm font-semibold hover:text-brand-500 transition">Profile</a>
                    @endrole
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                            <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-full text-sm font-semibold hover:bg-brand-500 transition shadow-lg shadow-gray-900/20 hover:shadow-brand-500/30">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-sm font-semibold hover:text-brand-500 transition">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-gray-900 text-white px-6 py-3 rounded-full text-sm font-semibold hover:bg-brand-500 transition shadow-lg shadow-gray-900/20 hover:shadow-brand-500/30">
                                S'inscrire
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-24">
        @yield('content')
    </div>

    <footer class="bg-gray-50 border-t border-gray-200 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-center md:text-left">
                <span class="text-xl font-bold tracking-tight text-gray-900">YouCo'<span class="text-brand-500">Done</span>.</span>
                <p class="text-gray-400 text-sm mt-2">© 2026 YouCode Safi Project.</p>
            </div>
            <div class="flex gap-6 text-gray-400">
                <a href="#" class="hover:text-brand-500 transition"><i class="ph-fill ph-instagram-logo text-2xl"></i></a>
                <a href="#" class="hover:text-brand-500 transition"><i class="ph-fill ph-twitter-logo text-2xl"></i></a>
                <a href="#" class="hover:text-brand-500 transition"><i class="ph-fill ph-linkedin-logo text-2xl"></i></a>
            </div>
        </div>
    </footer>

    <script>
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        // Trigger once on load
        reveal();
    </script>
</body>
</html>
