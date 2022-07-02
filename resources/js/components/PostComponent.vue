<template>
    <div>
        <img v-bind:src="path" alt="" />
    </div>
</template>

<script>
export default {
    props: ['message'],
    data()
    {
        return {

            path: this.message.path,
        }
    }
}
</script>
