<template>
    <div class="col-12 col-lg-8">

        <table class="table table-cart">
            <tbody valign="middle" v-if="listItems">
                <tr v-for="(item, key) in listItems" :key="item.id">
                    <td>
                        <a class="item-remove" href="#"><i class="ti-close"></i></a>
                    </td>
                    
                    <td>
                        <a href="#">
                            <img :src="item.storeitem.image_url" alt="...">
                        </a>
                    </td>

                    <td>
                        <h5>{{ item.storeitem.name }}</h5>
                        <p>Superior Sports Watch</p>
                    </td>

                    <td>
                        <label>Quantity</label>
                        <input class="form-control form-control-sm" type="number" min=0 placeholder="Quantity" :value="item.quantity"  @change="handleChange($event, key)">
                    </td>

                    <td>
                        <h4 class="price">${{ item.storeitem.price }}</h4>
                    </td>
                </tr>                  
            </tbody>
        </table>

    </div>
</template>

<script>

import { store as centralStore } from "../store";

export default {

    props: ['list_items'],
    
    data() {
        return {
            stateStore: centralStore,
            listItems: JSON.parse(this.list_items)
        }
    },

    methods: {
        handleChange($e, key) {           
            this.listItems[key].quantity = $e.target.value
            this.updatePrice()
        },
        updatePrice() {
            const total = this.listItems.reduce( (currentItem, nextItem) => {
                return currentItem.storeitem.price*currentItem.quantity + nextItem.storeitem.price*nextItem.quantity
            } )

            this.stateStore.state.total = total
        }
    },

    mounted() {
        this.stateStore.state.listItems = this.listItems
        this.updatePrice()
    }
}
</script>

<style lang="css">

</style>