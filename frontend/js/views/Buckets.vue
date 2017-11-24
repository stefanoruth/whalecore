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
                <tr v-for="bucket in buckets" :key="bucket.id">
                    <td>{{bucket.title}}</td>
                    <td>{{bucket.slug}}</td>
                    <td>{{bucket.template.title}}</td>
                    <td>
                        <router-link :to="{name: 'bucket.edit', params: {id: bucket.id}}">Edit</router-link>
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
            buckets: []
        };
    },
    mounted() {
        axios.get(route('items.index'), {params:{type:'bucket'}}).then(response => {
            this.buckets = response.data.data;
        });
    }
};
</script>
