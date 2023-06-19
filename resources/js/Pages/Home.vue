<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Card from "@/Components/Card.vue";
import TextBox from "@/Components/TextBox.vue";
import BarChart from "@/Components/BarChart.vue";


export default {
    components: {AuthenticatedLayout, Card},
    data() {
        return {
            items: [],
        }},
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/data')
                .then(response => {
                    this.items = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
    ,}
</script>

<template>
    <Head title="Shops" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Welcome home!</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">See the shops fam!</div>

                                    </div><card :items="items"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
