<script setup>

</script>


<script>
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
// import {useCartsStore} from "@/store/cartsStore.js";


export default {

    components: {
        AuthenticatedLayout, Head
    },
    data() {
        return {
            cartItems: [], // Initialize with an empty array
        };
    },
    // computed: {
    //     carts(){
    //         const cartsStore = useCartsStore();
    //         return cartsStore.carts;
    //     }
    // },
    mounted() {
        this.fetchCartItems();
    },
    methods: {
        deleteData(e) {
            e.preventDefault();
            axios.delete('/cart-del')
                .then( (response) => {
                    console.log('test');
                    this.fetchCartItems();
                    console.log('after');

                })
                .catch((error) => {
                    console.log(error);
                    // Handle error, such as displaying an error message
                })
        },

        fetchCartItems() {
            console.log('here?')
            // Make an API request to retrieve the cart items
            axios.get('/cartItems')
                .then(response => {
                    this.cartItems = response.data;
                })
                .catch(error => {
                    console.error(error.response.data);
                });
        },
        placeOrder() {
            // Make an API request to place the order with the current cart items
            axios
                .post('/place-order', {cartItems: this.cartItems})
                .then((response) => {
                    // Handle the successful order placement
                    console.log(response.data);

                    // Reset the cart or perform additional actions
                    // ...
                })
                .catch((error) => {
                    // Handle the error
                    console.error(error.response.data);
                });

        },

    },
};
</script>
<template>
    <Head title="Cart"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cart</h2>
        </template>
        <div class="py-12 flex">
            <div class="max-w-7xl mx-auto sm:px-1 lg:px-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-4">Cart Items</h2>
                        <div v-if="!cartItems.length">Cart is empty...</div>
                        <table class="min-w-full divide-y divide-gray-200 flex flex-col " v-else>
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <!--                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total for item</th>-->
                                <!--                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overall total</th>-->
                                <!-- Add more table headers as needed -->
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in cartItems" :key="item.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ item.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ item.price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ item.quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ item.total_sum }}</td>
                                <!-- Display other item properties as needed -->
                            </tr>

                            </tbody>
                            <div class="w-full flex justify-between gap-2">
                                <button @click="placeOrder"
                                        class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold  px-4 rounded mt-4">
                                    Place Order
                                </button>
                                <button @click="deleteData"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded mt-4">
                                    Empty Cart
                                </button>
                            </div>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
