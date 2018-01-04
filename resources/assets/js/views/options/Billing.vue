<template>
    <div class="border-b py-3 flex h-full">
        <h2 class="italic text-grey text-lg">Billing</h2>
        <div class="flex my-3">
            <div class="flex-1"></div>
            <div class="flex-1 flex justify-end"></div>
        </div>
    </div>
    <!-- <div>
        <div class="card">
            <div class="card-header">
                <div class="card-header-title">Billing</div>
            </div>
            <div class="card-content">
                <table class="table is-fullwidth is-striped">
                    <tr v-for="(invoice, i) in invoices" :key="i">
                        <td>{{ invoice.date }}</td>
                        <td>{{ invoice.total }}</td>
                        <td><a :href="showInvoice(invoice.id)" target="_blank">Invoice</a></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <div class="card-footer-item">
                    <form :action="paymentLink" method="POST" id="stripeForm">
                        <input type="hidden" name="_token" :value="token">
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
    export default {
        data() {
            return {
                invoices: [],
            }
        },

        computed: {
            paymentLink() {
                return route('subscriptions.store');
            },

            token() {
                return document.head.querySelector('meta[name="csrf-token"]').content;
            },
        },

        mounted() {
            axios.get(route('subscriptions.index')).then(response => {
                this.invoices = response.data.invoices;
            });

            let tag = document.createElement('script');
            tag.src = "https://checkout.stripe.com/checkout.js";
            tag.className = 'stripe-button';
            tag.dataset['amount'] = 50000;
            tag.dataset['key'] = 'pk_test_azNOh1V3Y2k6vTSM0Y0FNNCV';
            tag.dataset['name'] = 'Whalecore';
            tag.dataset['description'] = 'Basic Subscription';
            tag.dataset['image'] = 'https://stripe.com/img/documentation/checkout/marketplace.png';
            tag.dataset['locale'] = 'auto';
            tag.dataset['zipCode'] = true;
            tag.dataset['currency'] = 'dkk';
            tag.dataset['label'] = 'Subscribe';

            document.getElementById('stripeForm').appendChild(tag);
        },

        methods: {
            showInvoice(id) {
                return route('subscriptions.show', id);
            }
        }
    }
</script>
