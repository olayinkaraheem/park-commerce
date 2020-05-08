<template>
    <div class="col-12 col-lg-4">
            <div class="cart-section">
                <div class="flexbox">
                    <div>
                        <p><strong>Subtotal:</strong></p>
                        <!-- <p><strong>Discount:</strong></p> -->
                    </div>
                    <div>
                        <p>${{ storeState.state.total }}</p>
                        <!-- <p>$39</p> -->
                    </div>
                </div>

                <hr>
                
                <div class="flexbox">
                    <div>
                        <p><strong>Total:</strong></p>
                    </div>
                    <div>
                        <p class="fw-600">${{ newTotal ? newTotal : storeState.state.total }}</p>
                    </div>
                </div>
                
            </div>
            <div class="cart-section">
                <div class="alert alert-danger" v-if="errors"> {{ errors }}</div>
                <div class="alert alert-success" v-if="message"> {{ message }}</div>
                <div class="flexbox">
                    <input type="text" placeholder="Enter Coupon Code" class="form-control" v-model="coupon">
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-primary" type="submit" @click="applyCoupon">Apply Coupon<i class="ti-angle-right fs-9"></i></button>
            </div>
        </div>
</template>

<script>

import { store as centralStore } from "../store";

import Axios from 'axios'

export default {
    // props: ['list_items'],
    
    data() {
        return {
            // listItems: JSON.parse(this.list_items),
            storeState: centralStore,
            coupon: '',
            newTotal: '',
            errors: '',
            message: ''
        }
    },

    methods: {
        applyCoupon(){
            Axios.post('/cart/process-coupon', {
                'total_price' : this.storeState.state.total,
                'item_count' : this.storeState.state.listItems.length,
                'coupon_code' : this.coupon
            })
            .then( response => {
                if(response.data.status == 'OK') {
                    this.newTotal = response.data.data
                    this.message = response.data.message
                }
                window.setTimeout(() => {
                    this.message = ''
                }, 2500)
            })
            .catch( error => {
                const response = error.response.data;
                
                this.newTotal = response.data
                this.errors = response.message
                // console.log(this.errors)


            })
        }
    },


    mounted() {
    },

    computed: {
        
    }
}
</script>

<style lang="css">

</style>