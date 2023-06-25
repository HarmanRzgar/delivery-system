<template>
    <div>
        <Head title="Orders" />

        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orders</h2>
            </template>
            <div class="py-12 flex">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold mb-4">Order Items</h2>
                            <div v-for="(order, index) in orders" :key="index" class="mb-4">
                                <h3 class="font-semibold mb-2">Order ID: {{ order.id }}</h3>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <!-- Add more table headers as needed -->
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="(item, i) in orderLists[order.id]" :key="i">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ item.name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ item.price }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ item.quantity }}</td>
                                        <!-- Display other item properties as needed -->
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>

<script>
import axios from 'axios';
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    components: {
      AuthenticatedLayout, Head,
    },
    data() {
        return {
            orders: [],
            orderLists: {},
        };
    },
    mounted() {
        this.fetchOrders();
    },
    methods: {
        fetchOrders() {
            axios.get('/orders').then(response => {
                this.orders = response.data.orders;
                this.orderLists = response.data.orderLists;
            }).catch(error => {
                console.log(error);
            });
        },
    },
};
</script>

<style scoped>
/* Add Tailwind CSS classes here or import your main Tailwind CSS file */
</style>
