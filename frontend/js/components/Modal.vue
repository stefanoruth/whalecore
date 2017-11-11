<template>
    <div class="flex fixed pin justify-center items-center z-40 py-8" v-show="show">
        <div class="absolute pin bg-black-transparent" @click="close" ></div>
        <div class="bg-blue-lightest z-50 rounded p-6 max-w-md max-h-full overflow-auto" @click.stop>
            <slot></slot>
        </div>
        <button class="text-white absolute pin-t pin-r mr-4 mt-4 z-50" @click="close">X</button>
    </div>
</template>

<script>
    export default {
        props: ['show'],
        mounted() {
            document.addEventListener("keydown", (e) => {
                if (this.show && e.keyCode == 27) {
                    this.close();
                }
            });
        },
        methods: {
            close() {
                this.$emit('close');
            }
        }
    }
</script>