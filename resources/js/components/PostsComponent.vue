<template>
    <div>
        <div class="row">
            <div v-for="post in posts" :key="post.id">
                <div class="col">
                    <post-component :message="post"></post-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PostComponent from "./PostComponent";

export default {
    components: PostComponent,
    data() {
        return {
            posts: {},

        }
    },

    methods: {
        getPosts() {
            axios.get('/posts/get')
                .then((response) => {
                    this.posts = response.data;
                });
        },
    },
    mounted() {
        this.getPosts();
    }
}

</script>
