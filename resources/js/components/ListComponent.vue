<template>
    <div>
        <h1>Items on user_id: 1</h1>
        <div class='drop-zone'
             @drop="onDrop($event, 1)"
             @dragover.prevent
             @dragenter.prevent
        >
            <div
                v-for='item in items'
                v-if="item.user_id == 1"
                :key='item.id'
                class='drag-el'
                draggable
                @dragstart="startDrag($event, item)"
            >
                {{ item.name }}
            </div>
        </div>
        <h1>Items on user_id: 2</h1>
        <div class='drop-zone'
             id="stepTwo"
             @drop="onDrop($event, 2)"
             @dragover.prevent
             @dragenter.prevent
        >
            <div
                class="drag-el"
                v-for="item in items"
                v-if="item.user_id == 2"
                :key="item.id"
                draggable
                @dragstart="startDrag($event, item)"
            >
                {{ item.name }}
            </div>
        </div>
    </div>
</template>
<style scoped>
.drop-zone {
    background-color: #eee;
    margin-bottom: 10px;
    padding: 10px;
}

.drag-el {
    background-color: #fff;
    margin-bottom: 10px;
    padding: 5px;
}

</style>
<script>
export default {
    data() {
        return {
            items: '',
        }
    },
    created()
    {
        this.getItems();
    },
    methods: {
        getItems(){
            axios.get('/allitems')
                .then((response)=>{
                    this.items = response.data;
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        startDrag(evt, item) {
            evt.dataTransfer.dropEffect = 'move'
            evt.dataTransfer.effectAllowed = 'move'
            evt.dataTransfer.setData('itemID', item.id)
        },
        onDrop(evt, list) {
            const itemID = evt.dataTransfer.getData('itemID')
            // const item = this.items.find(item => item.id == itemID)
            // item.list = list
            window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            axios.post('/items/' + itemID, {user_id: list, _token: csrfToken})
                .then(response => {
                    console.log(response);
                })
            this.getItems();
        }
    },
    computed: {
        listOne() {
            return this.items.filter(item => item.list === 1)
        },
        listTwo() {
            return this.items.filter(item => item.list === 2)
        }
    }
}
</script>
