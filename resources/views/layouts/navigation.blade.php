<nav x-data="{ open: false, formOpenGestion: false, formOpenFormularios: false, profileOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link :href="route('vacunas.create')" :active="request()->routeIs('form.create')">
                        {{ __('Vacunas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('vacunas.filtros')" :active="request()->routeIs('vacunas.filtros')">
                        {{ __('Consultas Informes') }}
                    </x-nav-link>

                    @if(auth()->check() && auth()->user()->rol === 'admin')
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                            {{ __('Admin/Usuarios') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Gestion de Formularios Dropdown para pantallas grandes -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button @click="formOpenGestion = !formOpenGestion" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ __('Gestión de Formularios') }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('for-sigsa-5b.index')">
                            {{ __('Formularios FOR-SIGSA-5b') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('for-sigsa-5bA.index')">
                            {{ __('Formularios FOR-SIGSA-5bA') }}
                        </x-dropdown-link>
                        <x-responsive-nav-link :href="route('formularios-3cs.index')">
                            {{ __('Formularios FOR-SIGSA-3CS') }}
                        </x-responsive-nav-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Formularios Dropdown para pantallas grandes -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button @click="formOpenFormularios = !formOpenFormularios" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ __('Formularios') }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('for-sigsa-5b.create')">
                            {{ __('FOR-SIGSA-5b') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('for-sigsa-5bA.create')">
                            {{ __('FOR-SIGSA-5bA') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('formularios-3cs.create')">
                            {{ __('FOR-SIGSA-3CS') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Profile Dropdown para pantallas grandes -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button @click="profileOpen = !profileOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu para pantallas pequeñas -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('vacunas.create')" :active="request()->routeIs('vacunas.create')">
                {{ __('Vacunas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('vacunas.resultados')" :active="request()->routeIs('vacunas.resultados')">
                {{ __('Consultas Informes') }}
            </x-responsive-nav-link>
            @if(auth()->check() && auth()->user()->rol === 'admin')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    {{ __('Admin/Usuarios') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Gestion de Formularios -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <button @click="formOpenGestion = !formOpenGestion" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900">
                {{ __('Gestión de Formularios') }}
                <svg class="inline ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div :class="{'block': formOpenGestion, 'hidden': !formOpenGestion}" class="hidden">
                <x-responsive-nav-link :href="route('for-sigsa-5b.index')">
                    {{ __('Formularios FOR-SIGSA-5b') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('for-sigsa-5bA.index')">
                    {{ __('Formularios FOR-SIGSA-5bA') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('formularios-3cs.index')">
                    {{ __('Formularios FOR-SIGSA-3CS') }}
                </x-responsive-nav-link>
            </div>
        </div>

        <!-- Responsive Formularios -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <button @click="formOpenFormularios = !formOpenFormularios" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900">
                {{ __('Formularios') }}
                <svg class="inline ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div :class="{'block': formOpenFormularios, 'hidden': !formOpenFormularios}" class="hidden">
                <x-responsive-nav-link :href="route('for-sigsa-5b.create')">
                    {{ __('FOR-SIGSA-5b') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('for-sigsa-5bA.create')">
                    {{ __('FOR-SIGSA-5bA') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('formularios-3cs.create')">
                    {{ __('FOR-SIGSA-3CS') }}
                </x-responsive-nav-link>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <button @click="profileOpen = !profileOpen" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900">
                {{ Auth::user()->name }}
                <svg class="inline ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div :class="{'block': profileOpen, 'hidden': !profileOpen}" class="hidden">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
