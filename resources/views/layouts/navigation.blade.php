<header class="bg-slate-950 text-white">
    <nav x-data="{ open: false }">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="uppercase">orange drink's</a>
                </div>

                <div x-data="searchComponent()" x-ref="searchContainer" class="relative">
                    <input
                        type="text"
                        placeholder="Pesquisar bebidas..."
                        x-model="query"
                        @input.debounce.300ms="search"
                        class="border rounded p-2 text-black"
                        x-init="init()" />

                    <div x-show="results.length > 0" class="absolute mt-2 bg-white border rounded shadow-lg max-h-60 overflow-y-auto">
                        <template x-for="product in results" :key="product.id">
                            <a :href="`/products/${product.id}`" class="p-2 hover:bg-gray-100 text-black">
                                <span x-text="product.name"></span>
                            </a>
                        </template>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 lg:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Atendimento
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Seu carrinho
                    </x-nav-link>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()?->name }}</div>

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

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <a href="/" class="uppercase">orange drink's</a>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()?->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()?->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    function searchComponent() {
        return {
            query: '',
            results: [],
            search() {
                if (this.query.length < 2) {
                    this.results = [];
                    return;
                }

                fetch(`/search-products?query=${encodeURIComponent(this.query)}`)
                    .then(response => response.json())
                    .then(data => {
                        this.results = data.slice(0, 4);
                    })
                    .catch(error => console.error('Erro ao buscar produtos:', error));
            },
            init() {
                this.query = '';
                this.results = [];
            }
        };
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener('click', (event) => {
            document.querySelectorAll('[x-data]').forEach((el) => {
                const searchContainer = el.querySelector('[x-ref="searchContainer"]');

                if (searchContainer && !searchContainer.contains(event.target)) {
                    const alpineData = searchContainer.__x_data;
                    if (alpineData) {
                        alpineData.results = [];
                        alpineData.query = '';
                    }
                }
            });
        });
    });
</script>
