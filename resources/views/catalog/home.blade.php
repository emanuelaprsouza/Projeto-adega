<x-app-layout>
    <img src="{{ asset('images/tropical-drink.jpeg') }}" alt="Tropical drink">
    <section class="bg-primary p-4">
        <h2 class="font-bold text-2xl">Sobre</h2>
        <p class="">Se você gosta de vinhos, espumantes, cervejas e muito mais, e quer ter acesso a uma grande variedade de rótulos, a ORANGE`DRINKS é o lugar perfeito para você! Com a nossa recém-lançado adega virtual, você pode explorar uma seleção cuidadosamente curada de todo o mundo, fazer pedidos com facilidade e receber suas garrafas favoritas diretamente na sua porta. Além disso, oferecemos recomendações personalizadas, informações detalhadas sobre cada produto. Experimente a ORANGE`DRINKS e descubra uma nova forma conveniente e prazerosa de apreciar bons produtos.</p>
    </section>
    <section class="p-4 flex flex-col bg-orange-300">
        <h2 class="font-bold text-2xl mb-4">Serviços</h2>
        <div x-data="{ categories: @js($categories) }" class="w-full grid items-center justify-between grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <template x-for="category in categories" :key="category.id">
                <a :href="`/products?category_id=${category.id}`" class="border border-solid border-black p-2 flex flex-col gap-2 items-center">
                    <img class="w-32 h-auto" :src="category.media[0].original_url" alt="Destilados">
                    <p class="border border-solid border-black rounded-lg px-2 text-white">Leia mais</p>
                </a>
            </template>
        </div>
    </section>
    <section class="bg-primary p-4">
        <form @submit.prevent="submitForm" method="POST" class="flex flex-col gap-4" action="{{ route('form_save') }}">
            @csrf
            <div class="flex flex-col">
                <label for="name">Nome</label>
                <input id="name" name="name" type="text" x-model="form.name" required>
            </div>
            <div class="flex flex-col">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" x-model="form.email" required>
            </div>
            <div class="flex flex-col">
                <label for="motivo">Motivo</label>
                <select id="motivo" name="motivo" x-model="form.motivo" required>
                    <option value="duvida">Dúvida</option>
                    <option value="elogio">Elogio</option>
                    <option value="reclamacao">Reclamação</option>
                    <option value="sugestao">Sugestão</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="mensagem">Mensagem</label>
                <textarea id="mensagem" name="mensagem" x-model="form.mensagem" required></textarea>
            </div>
            <div class="w-full flex items-center justify-center">
                <button type="submit" class="bg-black text-white px-10 py-4 rounded-md uppercase font-bold">Enviar</button>
            </div>
        </form>
    </section>
</x-app-layout>
<script>
    function formData() {
        return {
            form: {
                name: '',
                email: '',
                motivo: '',
                mensagem: ''
            },
            submitForm() {
                fetch('{{ route('form_save') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(this.form)
                        })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
        }
    }
</script>
