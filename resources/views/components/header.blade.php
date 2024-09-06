<header class="bg-slate-950 text-white">
    <nav class="container px-10 py-4 flex items-center justify-between">
        <a href="/" class="uppercase">orange drink's</a>
        <form x-data="{ search: '' }" @submit.prevent="performSearch" action="" class="rounded-lg bg-white">
            <input
                type="text"
                id="input-search-products"
                class="rounded-lg bg-inherit"
                placeholder="Pesquisar..."
            >
            <div x-show="search.length > 0" class="absolute bg-white border mt-2 rounded-lg w-full">
                <!-- Coloque aqui a lógica para exibir os resultados, como uma lista -->
                <p class="p-2 text-gray-700">Exemplo de Resultado para: "<span x-text="search"></span>"</p>
            </div>
        </form>
        <ul class="flex gap-4">
            <li>
                <a href="">Atendimento</a>
            </li>
            <li>
                <a href="">Seu carrinho</a>
            </li>
            <li>
                <a href="">Login</a>
            </li>
        </ul>
    </nav>
</header>
