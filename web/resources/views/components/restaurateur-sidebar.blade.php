<aside class="w-72 bg-sidebar border-r border-gray-100 flex flex-col justify-between hidden lg:flex h-full shadow-card z-20">
    <div class="h-24 flex items-center px-8 border-b border-gray-50">
        <a href="/" class="flex items-center gap-2">
            <div class="w-8 h-8 bg-brand-500 rounded-lg flex items-center justify-center text-white">
                <i class="ph-bold ph-fork-knife text-lg"></i>
            </div>
            <span class="text-xl font-bold tracking-tight text-gray-900">YouCo'<span class="text-brand-500">Done</span>.</span>
        </a>
    </div>

    <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto">
        
        <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Gestion</p>

        <a href="{{ route('restaurateur.dashboard') }}" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-2xl font-semibold transition-all group {{ request()->routeIs('restaurateur.dashboard') ? 'bg-brand-50 text-brand-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="{{ request()->routeIs('restaurateur.dashboard') ? 'ph-fill' : 'ph-bold' }} ph-squares-four text-xl"></i>
            <span>Tableau de bord</span>
        </a>

        <a href="{{ route('restaurants.index') }}" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-2xl font-semibold transition-all group {{ request()->routeIs('restaurants.*') ? 'bg-brand-50 text-brand-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="{{ request()->routeIs('restaurants.*') ? 'ph-fill' : 'ph-bold' }} ph-storefront text-xl"></i>
            <span>Mes Restaurants</span>
        </a>

        <a href="{{ route('reservations.index') }}" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-2xl font-semibold transition-all group {{ request()->routeIs('reservations.*') ? 'bg-brand-50 text-brand-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="{{ request()->routeIs('reservations.*') ? 'ph-fill' : 'ph-bold' }} ph-calendar-check text-xl"></i>
            <span>Réservations</span>
        </a>

        <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mt-8 mb-2">Compte</p>

          <a href="{{ route('restaurant.profile') }}" 
              class="flex items-center gap-3 px-4 py-3.5 rounded-2xl font-semibold transition-all group {{ request()->routeIs('restaurant.profile') ? 'bg-brand-50 text-brand-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="ph-bold ph-user text-xl"></i>
            <span>Mon Profil</span>
        </a>
    </nav>

    <div class="p-4 border-t border-gray-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-2xl hover:bg-red-50 text-gray-500 hover:text-red-500 transition cursor-pointer text-left">
                <i class="ph-bold ph-sign-out text-xl"></i>
                <span class="font-bold text-sm">Se déconnecter</span>
            </button>
        </form>
    </div>
</aside>