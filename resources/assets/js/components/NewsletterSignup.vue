<template>
    <div>
        <div class="uppercase text-primary-darkest font-bold text-xs mb-2">Join our Newsletter</div>
        <div class="flex mb-1">
            <input class="px-4 py-2 text-black font-sans" type="email" name="email" v-model="mail" @keyup.enter="subscribe">
            <button class="uppercase text-white bg-primary-darkest px-4 py-2" @click="subscribe">Join</button>
        </div>
        <div v-if="successMsg" class="text-white text-sm">{{ successMsg }}</div>
        <div v-if="errorMsg" class="text-red text-sm">{{ errorMsg }}</div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                mail: null,
                successMsg: null,
                errorMsg: null,
            };
        },
    
        methods: {
            subscribe() {
                axios.post('mail/subscribe', {
                    mail: this.mail
                }).then(response => {
                    this.errorMsg = null;
                    this.successMsg = 'Thanks for signing up.';
                }).catch(error => {
                    this.successMsg = null;
                    this.errorMsg = error.response.data.errors.mail[0];
                });
            },
        }
    }
</script>
