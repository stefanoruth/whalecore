<template>
    <div>
        <h1>{{ indentifier }} - {{ field.title }}</h1>
        <input type="text" :placeholder="field.placeholder">
        <p>{{ field.description }}</p>
        <div>
            <content-field v-for="(subField, key) in field.fields" :key="key" :field="subField" :indentifier="indentifier+'.'+key"></content-field>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['field', 'indentifier'],
    }
</script>