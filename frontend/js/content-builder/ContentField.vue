<template>
    <div v-if="field.type == 'repeater' || field.type == 'section'" class="field card">
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
                <template v-if="field.dir == 'columns'">
                    <div class="columns" style="overflow-x:auto;">
                        <div v-for="(dataField, i) in content[field.id]" :key="i" class="column is-narrow">
                            <div class="card">
                                <div class="card-content">
                                    <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :baseContent="baseContent[field.id][0]" :content="content[field.id][i]"></content-field>
                                </div>
                                <div class="card-footer">
                                    <div class="card-footer-item">
                                        <button class="button is-danger is-small" @click="removeField(i)">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div v-for="(dataField, i) in content[field.id]" :key="i" class="card">
                        <div class="card-content">
                            <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :baseContent="baseContent[field.id][0]" :content="content[field.id][i]"></content-field>
                        </div>
                        <div class="card-footer">
                            <div class="card-footer-item">
                                <button class="button is-danger is-small" @click="removeField(i)">X</button>
                            </div>
                        </div>
                    </div>
                </template>                
            </div>
            <div class="card-footer" v-show="openChilds">
                <div class="card-footer-item">
                    <button class="button is-primary is-small" @click="addCopy">Add Copy</button>
                </div>
            </div>
        </template>

        <template v-if="field.type == 'section'">
            <div class="card-content" v-show="openChilds">
                <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :baseContent="baseContent[field.id]" :content="content[field.id]"></content-field>
            </div>
        </template>
    </div>

    <content-field-simple v-else :field="field" :content="content"></content-field-simple>
</template>

<script>
    export default {
        props: [
            'field',
            'content',
            'baseContent',
        ],

        data() {
            return {
                openChilds: true,
            };
        },

        methods: {
            addCopy() {
                if (this.field.max !== null && this.content[this.field.id].length >= this.field.max) {
                    return;
                }

                var base = JSON.parse(JSON.stringify(this.baseContent[this.field.id][0]));
                this.content[this.field.id].push(base);
            },

            removeField(key) {
                this.content[this.field.id].splice(key, 1);
            },
        }
    }
</script>