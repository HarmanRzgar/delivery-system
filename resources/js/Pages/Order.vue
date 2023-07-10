<template>
    <div>
        <Head title="Orders" />

        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orders</h2>
            </template>
            <div class="py-12 sm:py-8 rounded-md">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 sm:p-6">
                            <h2 class="text-xl font-semibold mb-4">Order Items</h2>
                            <div v-for="(order, index) in orders" :key="index" class="mb-4 border-2 border-gray-800 p-4 sm:p-6 rounded-md">
                                <h3 class="font-semibold mb-2">Order ID: {{ order.id }}</h3>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <!-- Add more table headers as needed -->
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="(item, i) in orderLists[order.id]" :key="i">
                                        <td class="px-4 py-2 whitespace-nowrap">{{ item.name }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ item.price }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ item.quantity }}</td>
                                        <!-- Display other item properties as needed -->
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
                                    <h3>Total: {{ order.total_sum }}</h3>
                                    <button @click="downloadOrderAsPDF(order)" class="mt-2 sm:mt-0 sm:ml-4 bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                        Print invoice
                                    </button>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4" v-if="order.phase === 1">
                                    <span>Pending ...</span>
                                    <button @click="cancelItem(order.id)" class="mt-2 sm:mt-0 sm:ml-4 bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                        Cancel
                                    </button>
                                </div>
                                <div class="flex justify-between mt-4" v-if="order.phase === 2">
                                    <span>Preparing....</span>
                                </div>
                                <div class="flex justify-between mt-4" v-if="order.phase === 3">
                                    <span>On the way!</span>
                                </div>
                                <div class="flex justify-between mt-4" v-if="order.phase === 4">
                                    <span>Delivered!</span>
                                </div>
                                <div class="flex justify-between mt-4" v-if="order.phase === 5">
                                    <span>Cancelled.</span>
                                </div>
                                <div class="flex justify-between mt-4" v-if="order.phase === 6">
                                    <span>Rejected.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>

<!-- The remaining JavaScript code and styles remain unchanged -->



<script>
import axios from 'axios';
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable'

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
        cancelItem(itemId) {
            axios.put('/orders/' + itemId, { phase: 'cancel' })
                .then(response => {
                    console.log(response.data);
                    this.fetchOrders();
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        downloadOrderAsPDF(order) {
            const doc = new jsPDF();

            // Add order details
            doc.setFontSize(16);
            doc.setFont('helvetica', 'bold');
            doc.text(`Order ID: ${order.id}`, 10, 20);
            doc.text(`Total: $${order.total_sum}`, 10, 30);

            // Convert items to table data
            const items = this.orderLists[order.id];
            const tableData = items.map(item => [item.name, parseFloat(item.price).toFixed(2), item.quantity]);

            // Set table headers
            const tableHeaders = ['Name', 'Price', 'Quantity'];

            // Generate datatable
            autoTable(doc, {
                startY: 40,
                head: [tableHeaders],
                body: tableData,
                theme: 'grid',
                styles: {
                    fontSize: 12,
                    font: 'helvetica',

                },
                columnStyles: {
                    0: { fontStyle: 'bold' },
                },
            });

            // Save and open the PDF in a new tab
            doc.save(`order_${order.id}.pdf`);
        },



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
