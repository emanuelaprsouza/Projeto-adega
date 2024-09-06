<x-app-layout>
    <img src="{{ asset('images/tropical-drink.jpeg') }}" alt="Tropical drink">
    <section class="bg-orange-700 p-4">
        <h2 class="font-bold text-2xl">Sobre</h2>
        <p>Se você gosta de vinhos, champagne, cervejas e muito mais, e quer ter acesso a uma grange variedade de rótulos, a ORANGE DRINK's é o lugar perfeito para você.Com a nossa recém lançada adega virtual, você pode explorar uma seleção cuidadosamente curada de todo o mundo, fazer pedidos com facilidade e beber suas bebidas favoritas.</p>
    </section>
    <section class="p-4 flex flex-col bg-orange-300">
        <h2 class="font-bold text-2xl mb-4">Serviços</h2>
        <div class="w-full flex items-center justify-between">
            <a href="/" class="border border-solid border-black p-2 flex flex-col gap-2 items-center">
                <img class="w-32 h-auto" src="{{ asset('images/destilados.jpeg') }}" alt="Destilados">
                <p class="border border-solid border-black rounded-lg px-2 text-white">Leia mais</p>
            </a>
            <a href="/" class="border border-solid border-black p-2 flex flex-col gap-2 items-center">
                <img class="w-32 h-auto" src="{{ asset('images/espumante.jpeg') }}" alt="Espumante">
                <p class="border border-solid border-black rounded-lg px-2 text-white">Leia mais</p>
            </a>
            <a href="/" class="border border-solid border-black p-2 flex flex-col gap-2 items-center">
                <img class="w-32 h-auto" src="{{ asset('images/vinhos.jpeg') }}" alt="Vinhos">
                <p class="border border-solid border-black rounded-lg px-2 text-white">Leia mais</p>
            </a>
            <a href="/" class="border border-solid border-black p-2 flex flex-col gap-2 items-center">
                <img class="w-32 h-auto" src="{{ asset('images/cerveja.jpeg') }}" alt="Cervejas">
                <p class="border border-solid border-black rounded-lg px-2 text-white">Leia mais</p>
            </a>
            <a href="/" class="border border-solid border-black p-2 flex flex-col gap-2 items-center">
                <img class="w-32 h-auto" src="{{ asset('images/diversos.jpeg') }}" alt="Diversos">
                <p class="border border-solid border-black rounded-lg px-2 text-white">Leia mais</p>
            </a>
            <a href="/" class="border border-solid border-black p-2 flex flex-col gap-2 items-center">
                <img class="w-32 h-auto" src="{{ asset('images/acessorios.jpeg') }}" alt="Acessorios">
                <p class="border border-solid border-black rounded-lg px-2 text-white">Leia mais</p>
            </a>
        </div>
    </section>
    <section class="bg-orange-700 p-4">
        <form action="" class="flex flex-col gap-4">
            <div class="flex flex-col">
                <label for="name">Nome</label>
                <input id="name" name="name" type="text">
            </div>
            <div class="flex flex-col">
                <label for="name"></label>
                <input id="name" name="name" type="text">
            </div>
            <div class="flex flex-col">
                <label for="name">Motivo</label>
                <section class="bg-white">
                    <option value="">dúvida</option>
                </section>
            </div>
            <div class="flex flex-col">
                <label for="name">Mensagem</label>
                <textarea name="" id=""></textarea>
            </div>
        </form>
    </section>
</x-app-layout>
