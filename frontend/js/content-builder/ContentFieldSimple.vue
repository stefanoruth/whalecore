<template>
    <div class="field">
        <label class="label is-small">{{ field.title }}</label>
        <p class="help">{{ field.description }}</p>
        <div class="control">

            <input v-if="field.type == 'text'" class="input is-small" type="text" v-model="content[field.id]" :placeholder="field.placeholder">

            <div v-else-if="field.type == 'image'" class="file is-small has-name">
                <label class="file-label">
                    <input class="file-input" type="file">
                    <span class="file-cta">
                        <span class="file-label">Choose a file…</span>
                    </span>
                    <span class="file-name">Screen Shot 2017-07-29 at 15.54.25.png</span>
                </label>
            </div>

            <textarea v-else-if="field.type == 'textarea'" class="textarea is-small" v-model="content[field.id]"></textarea>

            <div v-else-if="field.type == 'select'" class="select">
                <select v-model="content[field.id]">
                    <option v-for="(value, i) in field.values" :key="i" :value="value.key">{{ value.label }}</option>
                </select>
            </div>

            
            <div v-else-if="field.type == 'multi-select'" class="select is-multiple">
                <select multiple size="5">
                    <option v-for="(value, i) in field.values" :key="i" :value="value.key">{{ value.label }}</option>
                </select>
            </div>

            <div v-else-if="field.type == 'radio'" class="control">
                <label v-for="(value, i) in field.values" :key="i" class="radio"><input type="radio" v-model="content[field.id]" v-bind:value="value.key">{{ value.label }}</label>
            </div>
            
            <label v-else-if="field.type == 'checkbox'" class="checkbox"><input type="checkbox" v-model="content[field.id]">{{ field.title }}</label>
            
            <div v-else>Not yet whaled</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'field',
            'indentifier',
            'content',
        ],
    }
</script>