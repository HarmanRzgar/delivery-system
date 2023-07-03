<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Card from "@/Components/Card.vue";
import TextBox from "@/Components/TextBox.vue";
import BarChart from "@/Components/BarChart.vue";
import axios from 'axios';
import Carousel from "@/Components/Carousel.vue";


export default {

    components: {Carousel, AuthenticatedLayout, Card},
    data() {
        return {
            items: [],
            user_id: [],
            item_price: '',
            shops: [],
        }},
    mounted() {
        this.fetchData();
        this.fetchShops();
    },
    methods: {
        fetchShops() {
            axios.get('/shopsdata')
                .then(response => {
                    this.shops = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchData() {
            axios.get('/data')
                .then(response => {
                    this.items = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        UserData() {
            axios.get('/user')
                .then(response => {
                    this.user_id = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        onCreateOrder() {
            this.$inertia.post('/ordered', {
                user_id: this.user_id,
                item_price: this.item_price,
            });
        },
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
                    <carousel :users="shops"/>
                </div>
<!--                <card :items="items" @click="onCreateOrder"/>-->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
