<template>
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div v-for="item in items" :key="item.id" class="flex">
                <div class="m-4 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                    <a href="#">
                        <img class="p-6 rounded-lg rounded-md" :src="item.image" alt="product image" />
                    </a>
                    <div class="px-5 pb-5 grid gap-4">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white truncate">{{ item.name }}</h5>
                        </a>
                        <div class="description text-sm text-gray-400 break-words overflow-hidden line-clamp-3">{{ item.description }}</div>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ item.price }}</span>
                            <a @click="openModal(item)" href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quantity Modal -->
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <h2 class="text-xl font-semibold mb-4">Choose Quantity</h2>
                <div class="flex items-center">
                    <label for="quantity" class="mr-2">Quantity:</label>
                    <input type="number" id="quantity" v-model="quantity" min="1" class="border-gray-300 rounded-md p-2 w-20" />
                </div>
                <div class="flex justify-end mt-6">
                    <button @click="closeModal" class="text-gray-600 hover:text-gray-800">Cancel</button>
                    <button @click="addToCart" class="text-white bg-blue-700 hover:bg-blue-800 ml-4 py-2 px-4 rounded-lg">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        items: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            showModal: false,
            selectedItemId: null,
            quantity: 1,
            owner: [],
        };
    },
    methods: {
        openModal(item) {
            this.selectedItemId = item.id;
            this.showModal = true;
        },
        closeModal() {
            this.selectedItemId = null;
            this.quantity = 1;
            this.showModal = false;
        },
        addToCart() {
            const selectedItem = this.items.find(item => item.id === this.selectedItemId);
            const order = {
                item_id: selectedItem.id,
                name: selectedItem.name,
                price: selectedItem.price,
                quantity: parseInt(this.quantity),

            };

            // Make the API request to store the order
            axios.post('/ordered', order)
                .then(response => {
                    // Handle the response
                    console.log(response.data);

                    // Reset the selected item and quantity
                    this.closeModal();
                })
                .catch(error => {
                    // Handle the error
                    console.error(error.response.data);
                });
        },


    },
};
</script>
