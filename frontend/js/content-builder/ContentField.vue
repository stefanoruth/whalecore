<template>
    <div v-if="field.type == 'repeater'" class="field">
        <label class="label">{{ field.title }}</label>
        <p class="help">{{ field.description }}</p>

        <div class="column">
            <div v-for="i in content[field.id]">
                <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :parent="nameKey" :content="content" :parentType="field.type" :indentifier="i"></content-field>
                <hr>
            </div>
        </div>
        <button class="button" @click="addCopy">Add Copy</button>
    </div>

    <div v-else-if="field.type == 'section'" class="field">
        <label class="label">{{ field.title }}</label>
        <p class="help">{{ field.description }}</p>
        <div class="column">
            <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :parent="nameKey" :content="content" :parentType="field.type" :indentifier="key"></content-field>
        </div>
    </div>

    <div v-else class="field">
        <label class="label">{{ field.title }}</label>
        <p class="help">{{ field.description }}</p>
        <div class="control">

            <input v-if="field.type == 'text'" class="input" type="text" :name="fieldKey" :placeholder="field.placeholder">
            <div v-else-if="field.type == 'image'" class="file has-name">
                <label class="file-label">
                    <input class="file-input" type="file" :name="fieldKey">
                    <span class="file-cta">
                        <span class="file-label">Choose a file…</span>
                    </span>
                    <span class="file-name">Screen Shot 2017-07-29 at 15.54.25.png</span>
                </label>
            </div>
            <textarea v-else-if="field.type == 'textarea'" :name="fieldKey" class="textarea"></textarea>
            <div v-else>Not yet whaled: {{ fieldKey }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'field',
            'indentifier',
            'parent',
            'parentType',
            'content',
        ],

        data() {
            return {
                input: null,
            };
        },

        computed: {
            fieldKey: function() {
                if (typeof this.parent !== 'undefined') {
                    return this.parent+this.nameKey;
                }
                return this.nameKey;
            },

            nameKey: function() {
                if (typeof this.parent === 'undefined') {
                    return this.indentifier+'['+this.field.id+']';
                }

                if (typeof this.parent !== 'undefined' && this.parentType == 'repeater') {
                    return '['+this.indentifier+']['+this.field.id+']';
                }

                return '['+this.field.id+']';
            },
        },

        methods: {
            addCopy() {
                var base = this.content[this.field.id][0];
                this.content[this.field.id].push(base);
            },
        }
    }
</script>