<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700 shadow">
    <!-- Primary Navigation Menu -->
    <div class="w-full px-[10%] bg-white dark:bg-gray-900 text-center flex h-16">
        <div class="w-full flex relative">
            <!-- Logo -->
            <a href="{{ route('posts.index') }}">
                <div class="w-16 absolute z-20 rounded dark:bg-white">
                    <x-application-logo />
                </div>
            </a>

            @auth
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
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
                </div>
            @endauth

            @auth
                <!-- Settings Dropdown -->
                <div class="hidden w-full flex sm:flex sm:items-center sm:ms-6 justify-end">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-200 bg-white dark:bg-gray-900 hover:text-gray-700 dark:hover:text-white focus:outline-none">
                                <div>{{ Auth::user()?->name ?? 'ゲスト' }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); if (confirm('本当にログアウトしますか？')) this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <!-- Guest -->
                <div class="w-full flex hidden justify-end space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-nav-link>
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="absolute right-0 z-20 inline-flex items-center justify-center py-2 rounded-md text-gray-400 dark:text-gray-200 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': ! open }"
                class="w-[100vw] left-0 z-10 fixed hidden sm:hidden bg-white dark:bg-gray-900 text-gray-800 dark:text-white">

                <ul class="fixed mt-16 w-full list-none divide-y divide-white dark:divide-gray-600 flex flex-wrap bg-gray-100 dark:bg-gray-900 opacity-95">
                    <li class="h-16 w-full flex items-center justify-center">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-white">
                            {{ Auth::user()?->name ?? 'ゲスト' }}
                        </h2>
                    </li>

                    @auth
                        <li class="h-16 w-full flex items-center justify-center">
                            <x-responsive-nav-link
                                :href="route('dashboard')"
                                :active="request()->routeIs('dashboard')"
                                class="text-center text-gray-800 dark:text-white">
                                {{ __('Dashboard') }}
                            </x-responsive-nav-link>
                        </li>
                    @else
                        <li class="h-16 flex w-full justify-between px-4">
                            <x-responsive-nav-link
                                :href="route('register')"
                                :active="request()->routeIs('register')"
                                class="h-12 w-28 flex items-center justify-center text-white bg-blue-500 rounded hover:underline dark:hover:bg-blue-600">
                                Register
                            </x-responsive-nav-link>

                            <x-responsive-nav-link
                                :href="route('login')"
                                :active="request()->routeIs('login')"
                                class="h-12 w-28 flex items-center justify-center text-white bg-blue-500 rounded hover:underline dark:hover:bg-blue-600">
                                Login
                            </x-responsive-nav-link>
                        </li>
                    @endauth

                    @auth
                        <li class="h-16 flex items-center w-full justify-between px-4">
                            <x-responsive-nav-link
                                :href="route('profile.edit')"
                                :active="request()->routeIs('profile.edit')"
                                class="h-12 w-28 flex items-center justify-center text-white bg-blue-500 rounded hover:underline dark:hover:bg-blue-600 dark:text-white">
                                Profile
                            </x-responsive-nav-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); if (confirm('本当にログアウトしますか？')) this.closest('form').submit();"
                                    class="h-12 w-28 flex items-center justify-center text-white bg-red-500 rounded hover:underline dark:hover:bg-red-600 dark:text-white">
                                    Logout
                                </x-responsive-nav-link>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>

        </div>
    </div>
</nav>
