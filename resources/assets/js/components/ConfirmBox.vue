<template>
    <div class="modal" :class="{'is-active':show}">
        <div class="modal-background"  @click="close"></div>
        <div class="modal-card" @click.stop>
            <header class="modal-card-head">
                <p class="modal-card-title">Confirm</p>
                <button class="delete" aria-label="close" @click="close"></button>
            </header>
            <section class="modal-card-body">
                <slot></slot>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-primary" @click="$emit('ok')">Ok</button>
                <button class="button" @click="close">Cancel</button>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['show'],

        mounted() {
            document.addEventListener('keydown', e => {
                if (this.show && e.keyCode == 27) {
                    this.close();
                }
            });
        },

        methods: {
            close() {
                this.$emit("close");
            }
        }
    };
</script>