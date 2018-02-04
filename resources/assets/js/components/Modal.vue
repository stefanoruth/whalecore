<template>
    <div class="fixed pin flex">
        <div class="bg-grey absolute pin" @click="$emit('close')"></div>
        <div class="flex flex-1 justify-center items-center" @click.stop>
            <div class="bg-white shadow-lg rounded relative w-full max-w-sm max-h-90 overflow-hidden flex flex-col">
                <header class="text-white bg-primary-darkest text-2xl p-4" v-if="$slots.header != null">
                    <slot name="header"></slot>
                </header>
                <main class="py-2 px-4 flex-1 overflow-hidden overflow-y-scroll">
                    <slot></slot>
                </main>
                <footer class="border-t py-2 px-4" v-if="$slots.footer != null">
                    <slot name="footer"></slot>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            document.addEventListener('keydown', e => {
                if (e.keyCode == 27) {
                    this.$emit('close');
                }
            });
        },
    };
</script>