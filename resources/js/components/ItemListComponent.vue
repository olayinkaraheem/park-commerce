<template>
    <div class="col-12 col-lg-8">

        <table class="table table-cart" v-if="listItems.length">
            <tbody valign="middle">
                <tr v-for="(item, key) in listItems" :key="item.id">
                    <td>
                        <a class="item-remove" href="#" @click="handleDelete(item.id, key)"><i class="ti-close"></i></a>
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

        <div class="text-center" v-else>Your cart is empty. Add from items below.</div>

    </div>
</template>

<script>

import { store as centralStore } from "../store";
import Axios from 'axios'

export default {

    props: ['list_items'],
    
    data() {
        return {
            storeState: centralStore,
            listItems: JSON.parse(this.list_items)
        }
    },

    methods: {
        handleChange($e, key) {           
            this.listItems[key].quantity = $e.target.value
            this.updatePrice()
        },
        updatePrice() {
            const total = this.storeState.state.listItems.reduce( (currentSum, nextItem, ind, arr) => {
                return currentSum + nextItem.storeitem.price*nextItem.quantity
            }, 0)

            this.storeState.state.total = total
        },
        handleDelete(itemId, key) {
            console.log(itemId, key)
            Axios.get(`/cart/${itemId}`)
            .then( resp => {
                console.log(resp)
                this.storeState.state.listItems.splice(key, 1)
            })
            .catch( err => {
                console.log( err.response )
            } )

            this.updatePrice()
        }
    },

    mounted() {
        this.storeState.state.listItems = this.listItems
        this.updatePrice()
    },

    updated() {
        this.listItems = this.storeState.state.listItems
        this.updatePrice()
    }
}
</script>

<style lang="css">

</style>