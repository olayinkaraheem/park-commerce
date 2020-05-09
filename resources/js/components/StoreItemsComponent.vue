<template>
    <div>
        <div class="row gap-y" v-if="productStore">
            <div class="col-12 col-md-6 col-xl-4" v-for="item in productStore" :key="item.id">
                <div class="shop-item">
                    <div class="item-details">
                        <div>
                            <h5>{{ item.name }}</h5>
                            <p>Superior Sports Watch</p>
                        </div>

                        <div class="item-price"><span class="unit">$</span>{{ item.price }}</div>
                    </div>
                    <img :src="item.image_url" alt="product">
                    <button class="btn btn-xs btn-info add-to-cart" @click="updateCart(item)">Add to Cart</button>
                </div>
            </div>
		</div>
        <div v-else><p class="center">No poduct in store</p></div>
    </div>
</template>

<script>

import { store as centralStore } from "../store";
import Axios from 'axios'
export default {

    props: ['store_items'],
    
    data() {
        return {
            storeState: centralStore,
            productStore: JSON.parse(this.store_items)
        }
    },

    methods: {
        updateCart(storeItem) {
            // console.log(storeItem)
            const itemExists = this.storeState.state.listItems.find( item => {
                return item.item_id == storeItem.id
            } )

            if(itemExists) {
                const indexOfItemInStoreState = this.storeState.state.listItems.indexOf(itemExists)
                this.storeState.state.listItems[indexOfItemInStoreState].quantity++ // this will fire an updated event on every component using the store
            } else {
                Axios.post('/cart/add', {
                    'item_id': storeItem.id,
                    'quantity': 1
                })
                .then( resp => {
                    this.storeState.state.listItems.push(resp.data.new_item)
                })
                .catch( err => {
                    console.log(err.response)
                })
            }
        }
    },

    mounted() {
    //   console.log('store items mounted')
    }
}
</script>

<style lang="css">

</style>