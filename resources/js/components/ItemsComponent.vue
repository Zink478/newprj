<template>
    <div>
        <form-component :message="getItems" v-on:itemadded="addItem" :user="userid"></form-component>
        <modal-component :item="currentEditedItem" :modal="modal" :message="getItems"></modal-component>
<!--        <form-component :message="getItems" v-on:itemAdded="addItem"></form-component>-->
<!--        <div class="overflow-auto">-->
<!--            <b-pagination-->
<!--                v-model="currentPage"-->
<!--                :total-rows="rows"-->
<!--                :per-page="perPage"-->
<!--                aria-controls="my-table"-->
<!--            ></b-pagination>-->

<!--        <b-table-->
<!--            id="my-table"-->
<!--            :items="items"-->
<!--            :per-page="perPage"-->
<!--            :current-page="currentPage"-->
<!--            small-->
<!--        ></b-table>-->
<!--        </div>-->

        <table class="table">
            <tr>
                <td class="table-primary" scope="col">
                    Item name
                </td>
                <td class="table-primary" scope="col">
                    Item price
                </td>
                <td class="table-primary" scope="col">
                    Action
                </td>
            </tr>
            <tr v-for="item in items" :key="item.id" class="text-dark">
                <td @click="copy(item.name)" style="cursor: grabbing">
                    {{item.name}}
                </td>
                <td>
                    {{item.price}}
                </td>
                <td>
                    <button class="btn bg-danger text-white" @click="deleteItem(item.id)"> Delete </button>
                    <button class="btn bg-info text-white" v-b-modal:[`edit-modal-${item.id}`] @click="setEdit(item); show()">Edit Item</button>
<!--                    <button @click="show">Show Greeting</button>-->
<!--                    <button @click="modal = !modal" type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#myModal">Edit</button>-->
                </td>

            </tr>
        </table>
<!--        PAGINATION-->



<!--        END PAGINATION-->
    </div>
</template>
<script>

import ModalComponent from "./ModalComponent";
import FormComponent from "./FormComponent";

export default{
    components: {ModalComponent,FormComponent},
        computed: {
            rows() {
                return this.items.length;
            }
        },
    data() {
        return {
            currentItem: 'hi!',
            items: {},
            modal: false,
            currentEditedItem: null,
            item: null,
            // perPage: null,
            // currentPage: null,
            userid: '',
            formEdit: {
                name: '',
                price: ''
            }
        }
    },

    methods: {
        copy(item) {
            // navigator.clipboard.writeText(item);
            this.$notify({
                group: 'foo',
                title: 'Important message',
                text: '<h3>Item <strong>' + item +' </strong>was copied!</h3>',
                type: 'info',
                duration: 5000,

            });
            this.$root.copyText(item);
        },
        getItems(){
            axios.get('/allitems')
            .then((response)=>{
                this.items = response.data;
                this.getUserID();
                // this.$emit("getItems");
                // this.currentEditedItem = response.data[0];
                // console.log(firebase.auth().currentUser);
            })
            .catch((error) => {
                console.log(error)
            })
            // this.$emit('getItems', 'getItems');
            },
        getUserID()
        {
            axios.get('/getuserid').then((response) => {
                this.userid = response.data;
            })
        },
        deleteItem(id)
        {
            console.log(id)
            if(confirm("Are you sure to delete this item ?")) {
                axios.delete('/delete/' + id).then(response => {
                    this.getItems();
                    this.$notify({
                        group: 'foo',
                        title: 'Important message',
                        text: '<h4> Item was deleted! </h4>',
                        type: 'error',
                        duration: 5000,

                    });})
                .catch((error) =>
                    this.$notify({
                    group: 'foo',
                    title: 'Important message',
                    text: error.response.data.message,
                    type: 'warn',
                    duration: 5000,

                }))
            }

        },
        // editItem(id)
        // {
        //     window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        //     axios.post('/items/' + id, {name: this.formEdit.name, price: this.formEdit.price, _token: csrfToken})
        //     .then(response => {
        //         this.$notify({
        //         group: 'foo',
        //         title: 'Important message',
        //         text: '<h4> Item was edited! </h4>',
        //         type: 'success',
        //         duration: 5000
        //     });
        //         this.formEdit.name = this.formEdit.price = '';
        //     })
        //     .catch((error) => console.log(error));
        //     this.getItems();
        // },

        setEdit(item){
            this.currentEditedItem = item;
        },
        // openModal(){
        //     this.modal = !this.modal
        // },
        show(){
            this.modal = !this.modal;
        },

},

    // watch: {
    //     'message': function() {
    //         this.getItems();
    //     }
    // },
    created() {
        this.getItems()

},

}

</script>
