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