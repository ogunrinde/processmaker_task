<template>
    <div>
        <h3 class="text-center">All Posts</h3><br/>
 
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>UUID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Code</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="record in data" :key="record.id">
                <td>{{ record.UUID }}</td>
                <td>{{ record.name }}</td>
                <td>{{ record.description }}</td>
                <td>{{ record.code }}</td>
                <td>{{ record.status }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <button class="btn btn-danger" @click="deletePost(post.id)">Edit</button>
                    </div>
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
                data: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/record')
                .then(response => {
                    this.data = response.data;
                });
        },
        methods: {
            deletePost(id) {
                this.axios
                    .delete(`http://localhost:8000/api/post/delete/${id}`)
                    .then(response => {
                        let i = this.posts.map(item => item.id).indexOf(id); // find index of your object
                        this.posts.splice(i, 1)
                    });
            }
        }
    }
</script>