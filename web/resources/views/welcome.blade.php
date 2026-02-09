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
                    <a href="{{ route('client.restaurants.index') }}" class="text-gray-900 hover:text-brand-500 transition">Explorer</a>
                    <a href="{{ route('client.restaurants.index') }}" class="hover:text-brand-500 transition">Villes</a>
                    <a href="{{ route('client.restaurants.index') }}" class="hover:text-brand-500 transition">Restaurateurs</a>
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
                    <form method="POST" action="{{ route('logout') }}" class="inline">
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

    <header class="relative pt-40 pb-20 lg:pt-48 lg:pb-32 px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            
            <div class="reveal active relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-100 text-brand-500 text-xs font-bold uppercase tracking-widest mb-6">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                    Nouveau Dashboard Admin
                </div>
                
                <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight leading-[1.1] mb-8">
                    Réservez <br>
                    <span class="text-brand-500 relative">
                        l'expérience
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-brand-500 opacity-20" viewBox="0 0 200 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.00025 6.99997C25.7501 2.49994 132.5 -5.49991 198 6.99997" stroke="currentColor" stroke-width="3"/></svg>
                    </span>
                    <br> culinaire.
                </h1>
                
                <p class="text-lg text-gray-500 mb-10 max-w-md leading-relaxed">
                    Plateforme simple pour les gourmets exigeants. Trouvez, vérifiez la disponibilité et réservez votre table instantanément.
                </p>

                <div class="bg-white p-2 rounded-[2rem] shadow-float border border-gray-100 max-w-xl">
                    <form class="flex flex-col sm:flex-row items-center gap-2">
                        
                        <div class="relative w-full sm:w-1/3 group">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                <i class="ph-fill ph-map-pin text-gray-300 group-focus-within:text-brand-500 transition"></i>
                            </div>
                            <select class="block w-full pl-10 pr-3 py-4 text-sm font-semibold text-gray-900 bg-transparent rounded-full focus:outline-none focus:bg-gray-50 cursor-pointer appearance-none">
                                <option value="">Ville ?</option>
                                <option>Safi</option>
                                <option>Marrakech</option>
                            </select>
                        </div>

                        <div class="hidden sm:block w-px h-8 bg-gray-200"></div>

                        <div class="relative w-full sm:w-1/3 group">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                <i class="ph-fill ph-pizza text-gray-300 group-focus-within:text-brand-500 transition"></i>
                            </div>
                            <select class="block w-full pl-10 pr-3 py-4 text-sm font-semibold text-gray-900 bg-transparent rounded-full focus:outline-none focus:bg-gray-50 cursor-pointer appearance-none">
                                <option value="">Envie ?</option>
                                <option>Marocain</option>
                                <option>Italien</option>
                            </select>
                        </div>

                        <div class="relative w-full sm:w-auto group">
                            <input type="time" class="block w-full sm:w-32 px-4 py-4 text-sm font-semibold text-gray-900 bg-gray-50 rounded-full focus:outline-none focus:ring-2 focus:ring-brand-500" value="20:00">
                        </div>

                        <button type="submit" class="w-full sm:w-auto bg-brand-500 hover:bg-brand-600 text-white p-4 rounded-full transition shadow-lg shadow-brand-500/30 flex items-center justify-center">
                            <i class="ph-bold ph-magnifying-glass text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="reveal relative h-[600px] hidden lg:block">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-brand-500/5 rounded-full blur-3xl -z-10"></div>

                <div class="grid grid-cols-2 gap-4 h-full">
                    <div class="row-span-2 relative rounded-3xl overflow-hidden shadow-2xl group">
                        <img src="https://uploads.lebonbon.fr/source/2021/october/2024933/image0_3_866.jpg" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <p class="text-xs font-bold uppercase tracking-wider mb-1">Tendance</p>
                            <h3 class="text-2xl font-bold">Atmosphère</h3>
                        </div>
                    </div>
                    <div class="relative rounded-3xl overflow-hidden shadow-xl group">
                        <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    </div>
                    <div class="relative rounded-3xl overflow-hidden shadow-xl group bg-gray-900 flex items-center justify-center">
                        <div class="text-center">
                            <span class="block text-4xl font-bold text-white mb-1">100+</span>
                            <span class="text-gray-400 text-sm">Partenaires</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="border-y border-gray-100 bg-surface">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
            <div class="flex items-center gap-6 overflow-x-auto hide-scroll pb-2">
                <span class="text-sm font-bold text-gray-400 whitespace-nowrap">Populaires :</span>
                <button class="flex items-center gap-2 px-5 py-2 rounded-full bg-white border border-gray-200 text-sm font-semibold text-gray-700 hover:border-brand-500 hover:text-brand-500 transition shadow-sm whitespace-nowrap">
                    🌮 Mexicain
                </button>
                <button class="flex items-center gap-2 px-5 py-2 rounded-full bg-brand-500 border border-brand-500 text-sm font-semibold text-white shadow-md whitespace-nowrap">
                    🍝 Italien
                </button>
                <button class="flex items-center gap-2 px-5 py-2 rounded-full bg-white border border-gray-200 text-sm font-semibold text-gray-700 hover:border-brand-500 hover:text-brand-500 transition shadow-sm whitespace-nowrap">
                    🍣 Japonais
                </button>
                <button class="flex items-center gap-2 px-5 py-2 rounded-full bg-white border border-gray-200 text-sm font-semibold text-gray-700 hover:border-brand-500 hover:text-brand-500 transition shadow-sm whitespace-nowrap">
                    🥘 Marocain
                </button>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Sélection du Chef</h2>
                <p class="text-gray-500">Explorez les tables les mieux notées cette semaine.</p>
            </div>
            <div class="flex gap-2">
                <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition"><i class="ph-bold ph-caret-left"></i></button>
                <button class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center shadow-lg hover:bg-gray-800 transition"><i class="ph-bold ph-caret-right"></i></button>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            <div class="group reveal">
                <div class="relative h-72 rounded-[2rem] overflow-hidden mb-5">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1974&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide">Safi</span>
                        <button class="w-10 h-10 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-white transition">
                            <i class="ph-fill ph-heart text-xl"></i>
                        </button>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-start mb-1">
                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-brand-500 transition cursor-pointer">Le Riad Bleu</h3>
                        <div class="flex items-center gap-1 text-sm font-bold">
                            <i class="ph-fill ph-star text-brand-500"></i> 4.9
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">Cuisine Marocaine • $$$</p>
                    
                    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                        <div class="flex items-center gap-2 text-sm text-green-600 font-medium bg-green-50 px-2 py-1 rounded-md">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Ouvert
                        </div>
                        <a href="#" class="text-sm font-bold text-gray-900 underline decoration-gray-300 underline-offset-4 hover:decoration-brand-500 hover:text-brand-500 transition">Réserver</a>
                    </div>
                </div>
            </div>

            <div class="group reveal">
                <div class="relative h-72 rounded-[2rem] overflow-hidden mb-5">
                    <img src="https://images.unsplash.com/photo-1595295333158-4742f28fbd85?q=80&w=2080&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide">Marrakech</span>
                        <button class="w-10 h-10 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-white transition">
                            <i class="ph-fill ph-heart text-xl"></i>
                        </button>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-start mb-1">
                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-brand-500 transition cursor-pointer">Pasta & Basta</h3>
                        <div class="flex items-center gap-1 text-sm font-bold">
                            <i class="ph-fill ph-star text-brand-500"></i> 4.5
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">Italien • $$</p>
                    
                    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                        <div class="flex items-center gap-2 text-sm text-gray-500 font-medium bg-gray-100 px-2 py-1 rounded-md">
                            <span class="w-2 h-2 rounded-full bg-gray-400"></span> Fermé
                        </div>
                        <a href="#" class="text-sm font-bold text-gray-900 underline decoration-gray-300 underline-offset-4 hover:decoration-brand-500 hover:text-brand-500 transition">Réserver</a>
                    </div>
                </div>
            </div>

            <div class="group reveal">
                <div class="relative h-72 rounded-[2rem] overflow-hidden mb-5">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1981&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide">Casablanca</span>
                        <button class="w-10 h-10 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-white transition">
                            <i class="ph-fill ph-heart text-xl"></i>
                        </button>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-start mb-1">
                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-brand-500 transition cursor-pointer">Little Tokyo</h3>
                        <div class="flex items-center gap-1 text-sm font-bold">
                            <i class="ph-fill ph-star text-brand-500"></i> 4.8
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">Japonais • $$$$</p>
                    
                    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                        <div class="flex items-center gap-2 text-sm text-green-600 font-medium bg-green-50 px-2 py-1 rounded-md">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Ouvert
                        </div>
                        <a href="#" class="text-sm font-bold text-gray-900 underline decoration-gray-300 underline-offset-4 hover:decoration-brand-500 hover:text-brand-500 transition">Réserver</a>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="mt-20 flex justify-center">
            <div class="inline-flex bg-surface rounded-full p-1 border border-gray-100 shadow-sm">
                <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-900"><i class="ph-bold ph-caret-left"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-brand-500 text-white shadow-lg shadow-brand-500/30 flex items-center justify-center font-bold">1</a>
                <a href="#" class="w-10 h-10 rounded-full text-gray-500 hover:bg-white hover:text-brand-500 hover:shadow-sm flex items-center justify-center font-bold transition">2</a>
                <a href="#" class="w-10 h-10 rounded-full text-gray-500 hover:bg-white hover:text-brand-500 hover:shadow-sm flex items-center justify-center font-bold transition">3</a>
                <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-900"><i class="ph-bold ph-caret-right"></i></a>
            </div>
        </div>
    </main>

    <footer class="bg-gray-50 border-t border-gray-200 pt-16 pb-12">
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