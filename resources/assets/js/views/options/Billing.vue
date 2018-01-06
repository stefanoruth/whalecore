<template>
    <base-option>
        <template slot="icon"><path d="M9 18v-7L0 2V0h20v2l-9 9v7l5 1v1H4v-1l5-1zm2-10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></template>
        <div slot="title">Billing</div>
        <div slot="desc">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores quia libero temporibus excepturi repudiandae, qui voluptate, optio reiciendis, quam doloremque officia! Adipisci eum ex veritatis facere, voluptatem asperiores quos dolores.</div>

        <table class="mb-4">
            <tr v-for="(invoice, i) in invoices" :key="i">
                <td>{{ invoice.date }}</td>
                <td>{{ invoice.total }}</td>
                <td><a :href="showInvoice(invoice.id)" target="_blank">Invoice</a></td>
            </tr>
        </table>
        <div>
            <form :action="paymentLink" method="POST" id="stripeForm">
                <input type="hidden" name="_token" :value="token">
            </form>
        </div>
    </base-option>
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
