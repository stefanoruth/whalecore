<template>
    <div class="fixed pin flex">
        <div class="bg-blue absolute pin opacity-75" @click="$emit('close')"></div>
        <div class="flex flex-1 justify-center items-center" @click.stop>
            <div class="bg-white shadow rounded relative">
                <slot></slot>
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