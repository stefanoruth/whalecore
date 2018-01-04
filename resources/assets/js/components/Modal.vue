<template>
    <div class="fixed pin flex">
        <div class="bg-blue absolute pin opacity-75" @click="$emit('close')"></div>
        <div class="flex flex-1 justify-center items-center" @click.stop>
            <div class="bg-white border shadow relative">
                <header class="border-b text-xl py-2 px-4" v-if="$slots.header != null">
                    <slot name="header"></slot>
                </header>
                <main class="py-2 px-4">
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
                if (this.show && e.keyCode == 27) {
                    this.$emit('close');
                }
            });
        },
    };
</script>