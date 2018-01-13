<template>
    <modal @close="$emit('close')">
        <div slot="header">Confirm</div>
        <slot></slot>
        <div slot="footer" class="flex justify-between">
            <button class="btn-secondary" @click="$emit('close')">Cancel</button>
            <button class="btn-green" @click="$emit('ok')">Ok</button>
        </div>
    </modal>
</template>