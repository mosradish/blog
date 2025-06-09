<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <div class="w-full px-[10%] mx-auto bg-white text-center align-middle flex justify-between h-16">
        <div class="flex">
            <!-- Logo -->
            <a href="{{ route('posts.index') }}">
                <div class="w-16 block z-20">
                    <x-application-logo/>
                </div>
            </a>
            @auth
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                        {{ __('Posts') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

            @endauth
        </div>

        @auth
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()?->name ?? 'ゲスト' }}</div>

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

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        @else
            <!-- ゲストユーザー（未ログイン）の場合 -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('register')" :active="request()->routeIs('dashboard')">
                    {{ __('Register') }}
                </x-nav-link>
                <x-nav-link :href="route('login')" :active="request()->routeIs('dashboard')">
                    {{ __('Login') }}
                </x-nav-link>
            </div>
        @endauth

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="absolute z-20 inline-flex items-center justify-center right-4 p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="w-[100vw] left-0 z-10 bg-white absolute hidden sm:hidden">
            <div class="w-full">
                <div class="w-16 left-[10%] absolute z-20">
                    <x-application-logo/>
                </div>
                <ul class="list-none divide-y divide-gray-200 flex flex-wrap">
                    @auth
                        <li class="h-16 border-gray-200 w-full place-content-center">
                            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-center align-middle">
                                {{ __('Dashboard') }}
                            </x-responsive-nav-link>
                        </li>
                    @else
                        <li class="h-16 border-gray-200 w-full place-content-center">
                            <x-nav-link :href="route('register')" :active="request()->routeIs('dashboard')">
                                {{ __('Register') }}
                            </x-nav-link>
                        </li>
                        <li class="h-16 border-gray-200 w-full place-content-center">
                            <x-nav-link :href="route('login')" :active="request()->routeIs('dashboard')">
                                {{ __('Login') }}
                            </x-nav-link>
                        </li>
                    @endauth
                    <!-- Responsive Settings Options -->
                    <li class="h-16 w-full place-content-center">
                        <h2 class=" font-semibold text-xl text-gray-800">{{ Auth::user()?->name ?? 'ゲスト' }}</h2>
                    </li>

                    @auth
                        <li class="h-16 w-full place-content-center">
                            <x-responsive-nav-link :href="route('profile.edit')" class="text-center align-middle">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
                        </li>

                        <li class="h-16 w-full place-content-center">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                                    class="text-center align-middle">
                                    {{ __('Log Out') }}

                                </x-responsive-nav-link>
                            </form>
                        </li>
                    @endauth
                </ul>

            </div>

        </div>
    </div>
</nav>
