<template>
    <div>
        <div class="p-4 border" v-if="field.type == 'repeater' || field.type == 'section'">
            <div class="flex">
                <div class="text-lg uppercase flex-1">{{ field.title }}</div>
                <div class="cursor-pointer flex items-center" @click="openChilds = !openChilds">
                    <svg class="fill-current h-4 w-4 text-grey-darker" v-if="!openChilds" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    <svg class="fill-current h-4 w-4 text-grey-darker" v-if="openChilds" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/></svg>
                </div>
            </div>
        </div>

        <div v-if="field.type == 'repeater' || field.type == 'section'" v-show="openChilds">
            <div v-if="field.type == 'section'" class="p-4 border-l border-r border-b">
                <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :baseContent="baseContent[field.id]" :content="content[field.id]" :lang="lang"></content-field>
            </div>

            <div v-else class="border-b border-l border-r">
                <div v-if="field.dir == 'columns'" class="flex overflow-x-scroll">
                    <div v-for="(dataField, i) in content[field.id]" :key="i" class="p-2 w-1/3 flex-none">
                        <div class="p-4 border">
                            <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :baseContent="baseContent[field.id][0]" :content="content[field.id][i]" :lang="lang"></content-field>
                            <div class="flex justify-center">
                                <button class="btn-red" @click="removeField(i)">X</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else v-for="(dataField, i) in content[field.id]" :key="i" class="p-4 border-b flex">
                    <div class="flex-1 mr-4">
                        <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :baseContent="baseContent[field.id][0]" :content="content[field.id][i]" :lang="lang"></content-field>
                    </div>
                    <div class="flex items-start">
                        <button class="btn-red" @click="removeField(i)">X</button>
                    </div>
                </div>

                <div class="flex justify-center p-2">
                    <button class="btn-blue" @click="addCopy">Add Copy</button>
                </div>
            </div>                
        </div>

        <content-field-simple v-else :field="field" :content="content" :lang="lang"></content-field-simple>
    </div>
</template>

<script>
    export default {
        props: [
            'field',
            'content',
            'baseContent',
            'lang',
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