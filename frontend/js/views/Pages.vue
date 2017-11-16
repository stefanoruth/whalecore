<template>
    <div class="container">
        <table border="1" class="table is-striped is-fullwidth">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Template</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="page in pages" :key="page.id">
                    <td>{{page.title}}</td>
                    <td>{{page.slug}}</td>
                    <td>{{page.template.title}}</td>
                    <td>
                        <router-link :to="{name: 'page.edit', params: {id: page.id}}">Edit</router-link>
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
            pages: []
        };
    },
    mounted() {
        axios.get(route("pages.index")).then(response => {
            this.pages = response.data;
        });
    }
};
</script>
