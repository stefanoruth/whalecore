<template>
    <div class="mb-2">
        <p><strong>{{ field.title }}</strong></p>
        <p>{{ field.type }}</p>
        <button @click="showEdit = true">Edit</button>
        <field-edit :show="showEdit" :field="field" @close="showEdit = false" @save="showEdit = false"></field-edit>
    </div>
</template>

<script>
    import FieldEdit from './FieldEdit';

    export default {
        props: ['field'],

        data() {
            return {
                showEdit: false,
            };
        },

        components: {
            FieldEdit,
        }
    }
</script>