<template lang="html">
    <div>
        <div>
            <form @submit.prevent="saveItem" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Item name:</label>
                            <input type="text" class="form-control" v-model="item.name" placeholder="Denumire" />
                        </div>
                    </div>
                </div>
                <div class="row" id="stepOne">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Item price:</label>
                            <input type="text" class="form-control col-md-6" v-model="item.price" placeholder="Pret"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Add Item</button>
                    </div>
                </div>
                <pre>Output:
<!--            {{output}}-->
                </pre>
            </form>


        </div>

    </div>
</template>

<script lang="js">



export default {
    // import ItemsComponent
    props: [
        // 'items',
        'message'
    ],
    mounted() {
        console.log('Component mounted.')
    },
    data() {
        return {
            name: '',
            price: '',
            output: '',
            items: {},
            item: {
                name: '',
                price: ''
            }
        }
    },

    methods: {
        saveItem() {
            // let formData = new FormData();
            //
            // formData.append('name', this.name);
            // formData.append('price', this.price);
            window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            let currentObj = this;
            axios.post('/items', {name: this.item.name, price: this.item.price, _token: csrfToken})
                .then((response) => {
                    currentObj.output = response.data
                    this.$notify({
                        group: 'foo',
                        title: 'Important message',
                        text: '<h4>New item added!</h4>'
                    });
                    this.clear();
                    this.message();
                    this.name = this.price = '';
                    // this.addItem();

                    // LAST
                    // window.Echo.private('item.created')
                    //     .listen('itemAdded', (e) => {
                    //         alert('hi!')
                    //     });
                })
                .catch  (function (error) {
                    // Echo.channel('item.created')
                    //     .listen('ItemCreated', (e) => console.log('RealTimeMessage: ' + e.message));
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                });

            // this.$refs.ItemsComponent.getItems();

        },
        clear()
        {
            this.item.price = this.item.name = '';
        },
        // addItem(){
        //     this.$emit("itemAdded", {
        //         item: this.name
        //     });
        // },
        //metode
        //
    },

}
</script>
