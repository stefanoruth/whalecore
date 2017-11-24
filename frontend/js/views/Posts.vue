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
                <tr v-for="post in posts" :key="post.id">
                    <td>{{post.title}}</td>
                    <td>{{post.slug}}</td>
                    <td>{{post.template.title}}</td>
                    <td>
                        <router-link :to="{name: 'post.edit', params: {id: post.id}}">Edit</router-link>
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
            posts: []
        };
    },
    mounted() {
        axios.get(route('items.index'), {params:{type:'post'}}).then(response => {
            this.posts = response.data.data;
        });
    }
};
</script>
