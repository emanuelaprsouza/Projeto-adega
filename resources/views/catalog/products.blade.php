<x-app-layout>
    <div
        class="min-h-screen bg-primary"
        x-data="{
            products: @js($products),
            categories: @js($categories),
            cart: [],
            addToCart(product) {
                fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: product.id })
                })
                .then(response => {
                    if (response.status === 401) {
                        // Redireciona para a página de login
                        window.location.href = response.json().then(data => data.redirect);
                    } else if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erro inesperado ao adicionar ao carrinho');
                    }
                })
                .then(data => {
                    if (data && data.message) {
                        alert(data.message);
                        this.cart.push(product);
                    }
                })
                .catch(error => console.error('Erro ao adicionar ao carrinho:', error));
            }
        }">
        <div class="bg-slate-950 text-white flex justify-between py-4 px-10">
            <template x-for="category in categories" :key="category.id">
                <a href="#" x-text="category.name.toUpperCase()"></a>
            </template>
        </div>
        <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10 p-10">
            <template x-for="product in products" :key="product.id">
                <li class="flex flex-col items-center border border-solid border-black gap-4 p-4 text-white">
                    <a :href="`/products/${product.id}`" class="flex flex-col items-center w-full h-full gap-4">
                        <img :src="product.media[0].original_url" x-show="product.media[0].original_url" class="w-32 h-32 object-cover mt-2">
                        <div class="h-full flex flex-col items-center justify-between">
                            <p><strong x-text="product.name.toUpperCase()"></strong></p>
                            <p class="text-2xl font-bold">R$<span x-text="product.price"></span></p>
                        </div>
                    </a>
                    <button class="bg-white p-2 text-black" type="button" @click="addToCart(product)">Adicionar ao carrinho</button>
                </li>
            </template>
        </ul>
    </div>
</x-app-layout>
