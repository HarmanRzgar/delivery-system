<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import List from '@/Components/List.vue';
import TextBox from '@/Components/TextBox.vue'
import BarChart from '@/Components/BarChart.vue'
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
export default {
    components: { TextBox, AuthenticatedLayout, BarChart},
    data() {
        return {
            ListItems: [
        {id: 1 ,title: 'Revenue', price: '22$'},
        {id: 1 ,title: 'Sales by #', price: '23'},
        {id: 1 ,title: 'Increase from yesterday', price: '2.5%'}
    ]
}},
    computed: {
        myStyles () {
            return {
                height: `1111100px`,
                position: 'relative'
            }
        }
    }}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-6 sm:py-12">
            <div class="sm:max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex flex-col sm:flex-row w-full justify-center">

                    <BarChart ref="bar"  :style="myStyles"/>

                    <TextBox :items="ListItems" />

                    <div class="flex flex-col bg-gray-800 rounded-md p-5 sm:max-w-7xl mx-auto sm:px-6 lg:px-8 m-2 sm:m-4 border border-gray-500 border-2">
                        <h1 class="bg-gray-800 w-full p-2 text-white border-gray-600 border-b-2">Sales today</h1>
                        <ul class="focus:bg-gray-100 transition sm:max-w-7xl">
                            <li class="flex flex-row bg-gray-800 w-full sm:w-48 p-4 text-gray-100 sm:text-white rounded-sm hover:bg-gray-100 hover:text-gray-900 border-gray-600 border-b-2 transition justify-between">
                                <h2>Name </h2>
                                <h2>Value</h2>
                            </li>
                            <li class="flex flex-row bg-gray-800 w-full sm:w-48 p-4 text-gray-100 sm:text-white rounded-sm hover:bg-gray-100 hover:text-gray-900 border-gray-600 border-b-2 transition justify-between">
                                <h2>Name </h2>
                                <h2>Value</h2>
                            </li>
                            <li class="flex flex-row bg-gray-800 w-full sm:w-48 p-4 text-gray-100 sm:text-white rounded-sm hover:bg-gray-100 hover:text-gray-900 border-gray-600 border-b-2 transition justify-between">
                                <h2>Name </h2>
                                <h2>Value</h2>
                            </li>
                            <li class="flex flex-row bg-gray-800 w-full sm:w-48 p-4 text-gray-100 sm:text-white rounded-sm hover:bg-gray-100 hover:text-gray-900 border-gray-600 border-b-2 transition justify-between">
                                <h2>Name </h2>
                                <h2>Value</h2>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>

