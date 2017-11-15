<template>
    <div style="border: 1px solid #000; padding: 5px;">
        <h1>{{ field.title }}</h1>
        <h2>
            <span>{{ fieldKey }}</span>
        </h2>
        <input type="text" :name="fieldKey" :placeholder="field.placeholder">
        <p>{{ field.description }}</p>
        <div v-if="field.type == 'repeater'"style="padding: 5px;">
            <div v-for="i in 3">
                <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :parent="nameKey" :parentType="field.type" :indentifier="i"></content-field>
            </div>
        </div>
        <div v-if="field.type == 'section'" style="padding: 5px;">
            <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :parent="nameKey" :parentType="field.type" :indentifier="key"></content-field>
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
        ],

        data() {
            return {
                input: null,
            };
        },

        computed: {
            fieldKey: function() {
                if (typeof parent !== 'undefined') {
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
            }
        }
    }
</script>