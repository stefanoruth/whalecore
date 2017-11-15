<template>
    <div class="container mx-auto">
        <table border="1" class="w-full">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Used in Buckets</th>
                    <th>Used on Pages</th>                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="template in templates" :key="template.id">
                    <td>{{template.title}}</td>
                    <td>{{template.buckets_count}}</td>
                    <td>{{template.pages_count}}</td>                    
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
            this.templates = response.data;
        });
    }
};
</script>
