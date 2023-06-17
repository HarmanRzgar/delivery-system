<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import List from '@/Components/List.vue';
import TextBox from '@/Components/TextBox.vue'
import BarChart from '@/Components/BarChart.vue'

export default {
    components: { TextBox, AuthenticatedLayout, BarChart},
    data() {
        return {
            ListItems: [
        {id: 1 ,title: 'Revenue', price: '22$'},
        {id: 1 ,title: 'Sales by #', price: '23'},
        {id: 1 ,title: 'Increase from yesterday', price: '2.5%'}
    ]
}},}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="sm:max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="flex flex-row w-full justify-center">

                <BarChart ref="bar" class=""/>

                <TextBox :items="ListItems"/>
    <div class="flex flex-col bg-gray-800 rounded-md p-5 sm:max-w-7xl mx-auto sm:px-6 lg:px-8 m-4 border border-gray-500 border-2">
        <h1 class="bg-gray-800 w-full p-2 text-white border-gray-600 border-b-2">Sales today</h1>
        <ul class=" focus:bg-gray-100 transition sm:max-w-7xl">
            <li class="flex flex-row bg-gray-800 w-48 p-4 text-white rounded-sm hover:bg-gray-100 hover:text-gray-900 border-gray-600 border-b-2 transition justify-between">
                <h2>Name </h2>
                <h2>Value</h2>
            </li>
            <li class="flex flex-row bg-gray-800 w-48 p-4 text-white rounded-sm hover:bg-gray-100 hover:text-gray-900 border-gray-600 border-b-2 transition justify-between">
                <h2>Name </h2>
                <h2>Value</h2>
            </li>
            <li class="flex flex-row bg-gray-800 w-48 p-4 text-white rounded-sm hover:bg-gray-100 hover:text-gray-900 border-gray-600 border-b-2 transition justify-between">
                <h2>Name </h2>
                <h2>Value</h2>
            </li>
            <li class="flex flex-row bg-gray-800 w-48 p-4 text-white rounded-sm hover:bg-gray-100 hover:text-gray-900 border-gray-600 border-b-2 transition justify-between">
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
