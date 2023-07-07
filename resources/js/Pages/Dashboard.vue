<!--<script>-->
<!--import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';-->
<!--import { Head } from '@inertiajs/vue3';-->
<!--import List from '@/Components/List.vue';-->
<!--import TextBox from '@/Components/TextBox.vue'-->
<!--import BarChart from '@/Components/BarChart.vue'-->
<!--import DataTable from "vue3-easy-data-table";-->
<!--import axios from 'axios';-->



<!--import { Bar } from 'vue-chartjs'-->
<!--import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'-->
<!--export default {-->
<!--    components: { TextBox, AuthenticatedLayout, BarChart, DataTable, Head},-->
<!--    data() {-->
<!--        return {-->
<!--    //         ListItems: [-->
<!--    //     {id: 1 ,title: 'Revenue', price: '22$'},-->
<!--    //     {id: 1 ,title: 'Sales by #', price: '23'},-->
<!--    //     {id: 1 ,title: 'Increase from yesterday', price: '2.5%'}-->
<!--    // ],-->

<!--            orders: [],-->
<!--            orderLists: {},-->
<!--}},-->
<!--    mounted() {-->
<!--        // this.fetchCartItems();-->
<!--        this.fetchOrders();-->
<!--    },-->
<!--    // computed: {-->
<!--    //-->
<!--    //     myStyles () {-->
<!--    //         return {-->
<!--    //             height: `1111100px`,-->
<!--    //             position: 'relative'-->
<!--    //         }-->
<!--    //     }-->
<!--    // },-->
<!--    methods: {-->
<!--        // fetchCartItems() {-->
<!--        //     // Make an API request to retrieve the cart items-->
<!--        //     axios.get('/cartItems')-->
<!--        //         .then(response => {-->
<!--        //             this.cartItems = response.data;-->
<!--        //         })-->
<!--        //         .catch(error => {-->
<!--        //             console.error(error.response.data);-->
<!--        //         });-->
<!--        // },-->
<!--        fetchOrders() {-->
<!--            axios.get('/ordersseller')-->
<!--                .then(response => {-->
<!--                    this.orders = response.data.orders;-->
<!--                    this.orderLists = response.data.orderLists;-->
<!--                })-->
<!--                .catch(error => {-->
<!--                    console.error(error.response.data);-->
<!--                });-->
<!--    },-->
<!--},}-->

<!--</script>-->
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
            user: [],
            undeliveredOrders: [],
        };
    },
    mounted() {
        this.fetchOrders();
        this.UserData();
    },
    methods: {
        UserData() {
            axios.get('/user')
                .then(response => {
                    this.user = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        acceptItem(itemId) {
            axios.put('/orders/' + itemId, { phase: 'accept' })
                .then(response => {
                   console.log(response.data);
                })
                .catch(error => {
                    console.log(error.data);
                });
        },
        rejectItem(itemId) {
            axios.put('/orders/' + itemId, { phase: 'reject' })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        deliverItem(itemId) {
            axios.put('/orders/' + itemId, { phase: 'deliver' })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        doneItem(itemId) {
            axios.put('/orders/' + itemId, { phase: 'done' })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },

        fetchOrders() {
            axios.get('/ordersseller').then(response => {
                console.log(response.data);
                this.orders = response.data.orders;
                this.orderLists = response.data.orderLists;
                this.undeliveredOrders = response.data.undeliveredOrders;
                console.log(error);
            }).catch(error => {
                console.log(error.data);
            });
        },
    },
};
</script>
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12 flex">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-4">Orders</h2>
                        <div v-for="(order, index) in orders" :key="index" class="mb-4 border-2 border-gray-800 p-6 rounded-md" v-if="user.role_id === 4">
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
                            <div class="flex flex-row m-1 border-y-2 border-gray-600 p-2 items-center justify-between ">
                                <h3>Total: {{order.total_sum}}</h3>

                                <button @click="downloadOrderAsPDF(order)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">
                                    Print invoice
                                </button>
                            </div><div class="justify-between flex p-4" v-if="order.phase === 1" >
                            <button @click="acceptItem(order.id)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">
                                Accept
                            </button>
                            <button @click="rejectItem(order.id)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">
                                Reject
                            </button>
                        </div>
                            <div  class="justify-between flex p-4" v-if="order.phase === 2">
                                Preparing....
                            </div>
                            <div  class="justify-between flex p-4" v-if="order.phase === 3">
                                Delivering...
                            </div>
                            <div  class="justify-between flex p-4" v-if="order.phase === 4">
                                Delivered.
                            </div>
                            <div  class="justify-between flex p-4" v-if="order.phase === 5">
                                Cancelled
                            </div>
                            <div  class="justify-between flex p-4" v-if="order.phase === 6">
                                Rejected
                            </div>
                        </div>
                        <div v-for="(order, index) in orders" :key="index" class="mb-4 border-2 border-gray-800 p-6 rounded-md" v-if="user.role_id === 3">
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
                            <div class="flex flex-row m-1 border-y-2 border-gray-600 p-2 items-center justify-between ">
                                <h3>Total: {{order.total_sum}}</h3>

                                <button @click="downloadOrderAsPDF(order)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">
                                    Print invoice
                                </button>
                            </div>
                            <div class="justify-between flex p-4" v-if="order.phase === 3" >
                                <button @click="doneItem(order.id)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">
                                    Done
                                </button>

                            </div>
                            <div class="justify-between flex p-4" v-if="order.phase === 4" >
                              Done.
                            </div>
<!--                            <div  class="justify-between flex p-4" v-else>-->
<!--                                Preparing....-->
<!--                            </div>-->
                        </div>
                        <div v-for="(order, index) in undeliveredOrders" :key="index" class="mb-4 border-2 border-gray-800 p-6 rounded-md" v-if="user.role_id === 3">
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
                            <div class="flex flex-row m-1 border-y-2 border-gray-600 p-2 items-center justify-between ">
                                <h3>Total: {{order.total_sum}}</h3>

                                <button @click="downloadOrderAsPDF(order)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">
                                    Print invoice
                                </button>
                            </div><div class="justify-between flex p-4" v-if="order.phase === 2" >
                            <button @click="deliverItem(order.id)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">
                                Accept
                            </button>

                        </div>
<!--                            <div class="justify-between flex p-4" v-if="order.phase === 3" >-->
<!--                                <button @click="DoneItem(order.id)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">-->
<!--                                    Done-->
<!--                                </button>-->

<!--                            </div>-->
<!--                            <div class="justify-between flex p-4" v-if="order.phase === 4" >-->
<!--                                <button @click="DoneItem(order.id)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">-->
<!--                                    Done-->
<!--                                </button>-->

<!--                            </div>-->
<!--                            <div  class="justify-between flex p-4" v-else>-->
<!--                                Preparing....-->
<!--                            </div>-->
<!--                            <div  class="justify-between flex p-4" v-else>-->
<!--                                Preparing....-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

