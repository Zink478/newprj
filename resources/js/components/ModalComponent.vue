<template>
    <div>
        <b-modal :id="`edit-modal-${item.id}`"
                v-show="modal"
                 @ok="editItem(item.id)"
        >
            <template #modal-title>
                Modify <strong>{{item.name}}'s</strong> data
            </template>
            <div class="d-block text-center">
                <form @submit.prevent="editItem(item.id)">
                    <label>Name:</label>
                    <input type="text" :placeholder="item.name" v-model="formEdit.name">
                    <label>Price</label>
                    <input type="text" :placeholder="item.price" v-model="formEdit.price">



                    <!--                            <button @click="$bvModal.hide('edit-modal-'+item.id)">Save</button>-->

                </form>
                <p>
                    This
                    <b-button v-b-popover="'Defapt, nu este '+item.name+'!'" title="Popover">Button</b-button>
                    triggers a popover on click.
                </p>
            </div>

        </b-modal>
    </div>
</template>

<script>

export default {
        props:
            [
              'item', 'modal', 'message'
            ],

    data()
    {
      return {
          formEdit: {
              name: '',
              price: ''
          }
      }
    },
    methods:
        {
            editItem(id)
            {
                window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                axios.post('/items/' + id, {name: this.formEdit.name, price: this.formEdit.price, _token: csrfToken})
                    .then(response => {
                        this.$notify({
                            group: 'foo',
                            title: 'Important message',
                            text: '<h4> Item was edited! </h4>',
                            type: 'success',
                            duration: 5000
                        });
                        this.message();
                        // this.formEdit.name = this.formEdit.price = '';
                    })
                    .catch((error) => console.log(error));
                // this.getItems();
            },
            //     test(item) {
            //     console.log(item);
            // }
        },


}
</script>
