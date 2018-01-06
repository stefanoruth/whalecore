<template>
    <div class="p-8 flex">
        <div class="mr-6">
            <svg class="fill-current h-6 w-6 text-grey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <slot name="icon"></slot>
            </svg>
        </div>
        <div class="flex-1">
            <div class="text-xl mb-4">
                <slot name="title"></slot>
            </div>
            <div v-if="!!$slots['desc']" class="text-grey mb-4">
                <slot name="desc"></slot>
            </div>
            <div>
                <slot></slot>
            </div>
        </div>
    </div>
</template>
