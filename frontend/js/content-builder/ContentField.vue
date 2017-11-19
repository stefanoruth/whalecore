<template>
    <div v-if="field.type == 'repeater' || field.type == 'section'" class="card field">
        <div class="card-header">
            <div class="card-header-title">{{ field.title }}</div>
            <div class="card-header-icon" @click="openChilds = !openChilds">
                <i v-if="!openChilds" class="fa fa-angle-down" aria-hidden="true"></i>
                <i v-if="openChilds" class="fa fa-angle-up" aria-hidden="true"></i>
            </div>
        </div>
        <div class="card-content" v-if="field.description">
            <p>{{ field.description }}</p>
        </div>
        <template v-if="field.type == 'repeater'">
            <div class="card-content" v-show="openChilds">
                <div v-for="(dataField, i) in content[field.id]" class="field card">
                    <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :content="content[field.id][i]" :indentifier="i"></content-field>
                </div>
            </div>
            <div class="card-footer" v-show="openChilds">
                <div class="card-footer-item">
                    <button class="button is-primary is-small" @click="addCopy">Add Copy</button>
                </div>
            </div>
        </template>
        <template v-if="field.type == 'section'">
            <div class="card-content" v-show="openChilds">
                <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :content="content[field.id]" :indentifier="key"></content-field>
            </div>
        </template>
    </div>
<!-- 
    <div v-else-if="" class="card">
        
    </div> -->

    <content-field-simple v-else :field="field" :content="content" :indentifier="indentifier"></content-field-simple>
</template>

<script>
    export default {
        props: [
            'field',
            'indentifier',
            'content',
        ],

        data() {
            return {
                openChilds: false,
            };
        },

        methods: {
            addCopy() {
                if (this.field.max !== null && this.content[this.field.id].length >= this.field.max) {
                    return;
                }

                var base = JSON.parse(JSON.stringify(this.content[this.field.id][0]));
                this.content[this.field.id].push(base);
            },
        }
    }
</script>