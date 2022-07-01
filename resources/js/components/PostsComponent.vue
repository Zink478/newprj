<template>
    <div>
        <div v-for="post in posts" :key="post.id">
            <h1>{{post.id}}</h1>
            <h2>{{post.title}}</h2>

        </div>
    </div>
</template>

<script>
export default{
    data(){
        return {
            posts: {},

        }
    },

    methods: {
        getPosts() {
            axios.get('/posts')
                .then((response) => {
                    this.posts = response.data;
                });
        },
    },
    computed: {
        this.getPosts();
    }
}

</script>
