<template>
<div>
    <b-table hover striped :items="data" ></b-table>
</div>
</template>

<script>
export default{
    data() {
        return {
            keys: '',
            data: ''
        }
    },
    methods: {
        getItems()
        {
            axios.get('/api/v1/items').then(response => {
                // console.log(Object.keys(response.data[0]));
                this.keys = Object.keys(response.data[0]);
                this.data = response.data;
            });
        }
    },
    created()
    {
        this.getItems();
    }
}
</script>
