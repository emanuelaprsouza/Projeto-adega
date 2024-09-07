<x-app-layout>
    <div x-data="checkout()" class="min-h-screen bg-primary p-10">
        <form @submit.prevent="submitForm" class="flex flex-col">
            <div class="mb-10">
                <h2 class="text-2xl font-bold">Checkout</h2>
            </div>

            <div class="h-10"></div>

            <!-- Step Navigation -->
            <div class="">
                <button type="button" @click="currentStep = 1" :class="{'bg-primary border border-solid border-black': currentStep === 1}" class="px-4 py-2">Endereço</button>
                <button type="button" @click="currentStep = 2" :class="{'bg-primary border border-solid border-black': currentStep === 2}" class="px-4 py-2">Pagamento</button>
                <button type="button" @click="currentStep = 3" :class="{'bg-primary border border-solid border-black': currentStep === 3}" class="px-4 py-2">Revisão</button>
            </div>

            <!-- Step 1: Endereço -->
            <div x-show="currentStep === 1" class="border border-solid border-black p-10 flex flex-col gap-4">
                <h3>Endereço de Entrega</h3>
                <div class="mt-4 flex flex-col gap-4">
                    <div class="flex flex-col">
                        <label for="street">Rua:</label>
                        <input type="text" x-model="street" id="street" class="form-input" placeholder="Rua" required />
                    </div>
                    <div class="flex flex-col">
                        <label for="number">Número:</label>
                        <input type="text" x-model="number" id="number" class="form-input" placeholder="Número" required />
                    </div>
                </div>

                <div class="mt-4 flex flex-col">
                    <label for="complement">Complemento:</label>
                    <input type="text" x-model="complement" id="complement" placeholder="Complemento" class="form-input" required />
                </div>

                <div class="mt-4 flex flex-col">
                    <label for="district">Bairro:</label>
                    <input type="text" x-model="district" id="district" class="form-input" placeholder="Bairro" required />
                </div>

                <div class="mt-4 flex flex-col">
                    <label for="city">Cidade:</label>
                    <input type="text" x-model="city" id="city" class="form-input" placeholder="Cidade" required />
                </div>

                <div class="mt-4 flex flex-col">
                    <label for="state">Estado:</label>
                    <input type="text" x-model="state" id="state" class="form-input" placeholder="Estado" required />
                </div>

                <div class="flex items-center justify-center">
                    <button type="button" @click="nextStep" class="bg-black text-white font-bold px-10 py-2 mt-4">Próximo</button>
                </div>
            </div>

            <!-- Step 2: Pagamento -->
            <div x-show="currentStep === 2" class="border border-solid border-black p-10 flex flex-col gap-4">
                <h3>Pagamento</h3>

                <!-- Campo de Método de Pagamento -->
                <div class="mt-4 flex flex-col">
                    <label for="payment_method">Método de Pagamento:</label>
                    <select x-model="payment_method" id="payment_method" class="form-select" required>
                        <template x-for="payment in payments" :key="payment.id">
                            <option :value="payment.id" x-text="payment.name"></option>
                        </template>
                    </select>
                </div>

                <!-- Campo de Referência -->
                <div class="mt-4 flex flex-col">
                    <label for="reference">Referência:</label>
                    <input type="text" x-model="reference" id="reference" class="form-input" placeholder="Referência do pagamento" required />
                </div>

                <!-- Campo de Provedor -->
                <div class="mt-4 flex flex-col">
                    <label for="provider">Provedor:</label>
                    <input type="text" x-model="provider" id="provider" class="form-input" placeholder="Nome do provedor de pagamento" required />
                </div>

                <!-- Campo de Valor -->
                <div class="mt-4 flex flex-col">
                    <label for="amount">Valor:</label>
                    <input type="number" x-model="amount" id="amount" class="form-input" placeholder="Valor do pagamento" step="0.01" required />
                </div>

                <!-- Campo de Moeda -->
                <div class="mt-4 flex flex-col">
                    <label for="currency">Moeda:</label>
                    <input type="text" x-model="currency" id="currency" class="form-input" placeholder="Código da moeda (ex: BRL, USD)" maxlength="3" required />
                </div>

                <div class="flex gap-4 items-center justify-center">
                    <button type="button" @click="prevStep" class="border border-solid border-black px-10 py-2 mt-4">Voltar</button>
                    <button type="button" @click="nextStep" class="bg-black text-white px-10 py-2 mt-4">Próximo</button>
                </div>
            </div>


            <!-- Step 3: Revisão -->
            <div x-show="currentStep === 3" class="border border-solid border-black p-10">
                <h3>Revisão e Confirmação</h3>
                <p><strong>Endereço:</strong> <span x-text="address"></span></p>
                <p><strong>Método de Pagamento:</strong> <span x-text="getPaymentName()"></span></p>

                <!-- Exibição dos itens do carrinho -->
                <div>
                    <h3>Itens no Carrinho</h3>
                    <template x-for="item in cart.items" :key="item.id">
                        <div class="flex justify-between items-center">
                            <span x-text="item.name"></span>
                            <span x-text="item.quantity"></span>
                            <span x-text="item.price"></span>
                        </div>
                    </template>
                </div>

                <div class="flex gap-4 items-center justify-center">
                    <button type="button" @click="prevStep" class="border border-solid border-black px-10 py-2 mt-4">Voltar</button>
                    <button type="submit" class="bg-black text-white px-10 py-2 mt-4">Confirmar e Pagar</button>
                </div>
            </div>
        </form>

        <div x-show="message" x-text="message" class="mt-4 text-green-500"></div>
    </div>
</x-app-layout>

<script>
function checkout() {
    return {
        currentStep: 1,
        cart: @json($cart),
        payments: @json(App\Models\Payment::all()),
        payment_method: null,
        reference: '',
        provider: '',
        amount: '',
        currency: 'BRL', // Exemplo com BRL como padrão
        address: '',
        message: '',

        nextStep() {
            if (this.currentStep < 3) {
                this.currentStep++;
            }
        },
        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
            }
        },
        getPaymentName() {
            let payment = this.payments.find(payment => payment.id === this.payment_method);
            return payment ? payment.name : '';
        },
        async submitForm() {
            try {
                let response = await fetch('{{ route('checkout.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        payment_method: this.payment_method,
                        reference: this.reference,
                        provider: this.provider,
                        amount: this.amount,
                        currency: this.currency,
                        address: this.address,
                    }),
                });

                let data = await response.json();

                if (response.ok) {
                    this.message = 'Pedido realizado com sucesso!';
                } else {
                    this.message = 'Erro: ' + (data.message || 'não foi possível processar o pedido.');
                }
            } catch (error) {
                this.message = 'Erro ao conectar com o servidor.';
            }
        },
    };
}
</script>
