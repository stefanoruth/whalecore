<template>
    <div class="container">
        <table border="1" class="table is-striped is-fullwidth">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>                   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="template in templates" :key="template.id">
                    <td>{{template.title}}</td>
                    <td>{{template.type.name}}</td>            
                    <td>
                        <router-link :to="{name: 'template.edit', params: {id: template.id}}">Edit</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            templates: []
        };
    },
    mounted() {
        axios.get(route("templates.index")).then(response => {
            this.templates = response.data.data;
        });
    }
};
</script>
