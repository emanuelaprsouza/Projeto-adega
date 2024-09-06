<x-app-layout>
    <div class="min-h-screen bg-primary flex flex-col lg:flex-row items-center justify-between p-10 text-white" x-data="{ product: @js($product) }" x-init="console.log(product)">
        <div class="flex-1">
            <img :src="product.media[0].original_url" x-show="product.media[0].original_url" class="w-full h-auto object-cover mt-2">
        </div>
        <div class="w-1/2 flex flex-col items-center gap-10">
            <p><strong x-text="product.name.toUpperCase()"></strong></p>
            <p>R$<span x-text="product.price"></span></p>
            <button class="bg-white p-2 text-black" type="button">Adicionar ao carrinho</button>
        </div>
    </div>
</x-app-layout>
