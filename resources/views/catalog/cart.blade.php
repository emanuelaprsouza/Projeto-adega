<x-app-layout>
    <div class="min-h-screen bg-primary flex flex-col lg:flex-row items-center justify-between p-10 text-white gap-10" x-data="{ carts: @js($carts) }" x-init="console.log(carts)">
        <div class="flex flex-col gap-4">
            <template x-for="cart in carts" :key="cart.id">
                <div class="flex gap-4 border border-solid border-white p-4">
                    <img :src="cart.product.media[0].original_url" x-show="cart.product.media[0].original_url" class="w-32 h-32 object-cover mt-2">
                    <div class="flex items-center gap-4">
                        <p><strong x-text="cart.product.name.toUpperCase()"></strong></p>
                        <div class="flex gap-2 border border-solid border-white p-2">
                            <button class="flex items-center justify-center w-6 h-6 border border-solid bg-white border-white text-black font-bold text-2xl rounded-full">-</button>
                            <p x-text="cart.quantity"></p>
                            <button class="flex items-center justify-center w-6 h-6 border border-solid bg-white border-white text-black font-bold text-2xl rounded-full">+</button>
                        </div>
                        <p>R$ <span x-text="cart.product.price"></span></p>
                    </div>
                </div>
            </template>
        </div>
        <div class="h-96 flex-1 flex flex-col items-center justify-between border border-solid bg-white text-black p-10">
            <h2 class="text-2xl font-bold">Resumo do Pedido</h2>
            <p class="flex gap-10">Total: <span x-text="`R$ ${carts.reduce((acc, curr) => acc += curr.product.price * curr.quantity, 0)}`"></span></p>
            <a href="#" class="uppercase bg-black text-white p-4 rounded-lg">finalizar pedido</a>
        </div>
    </div>
</x-app-layout>
