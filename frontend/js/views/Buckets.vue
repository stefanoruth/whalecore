<template>
    <div class="container mx-auto">
        <table border="1" class="w-full">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Template</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="bucket in buckets" :key="bucket.id">
                    <td>{{bucket.title}}</td>
                    <td>{{bucket.template.title}}</td>
                    <td>
                        <a href="#">Edit</a>
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
        axios.get(route("buckets.index")).then(response => {
            this.buckets = response.data;
        });
    }
};
</script>
