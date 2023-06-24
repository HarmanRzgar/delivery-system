<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import ItemModal from "@/Components/ItemModal.vue";
import Card from "@/Components/Card.vue";
import axios from "axios";
export default {
    name: 'ItemsCreate',
    components: {Card, AuthenticatedLayout, ItemModal},
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            name: '',
            description: '',

            items: [],
            shopItems: [],

        };
    },
    mounted() {
        this.fetchData();


    },
    methods: {


        fetchData() {
            axios.get(`/data/${this.user.id}`)
                .then(response => {
                    this.items = response.data;

                    console.log(this.items);

                })
                .catch(error => {
                    console.error(error);
                });
        },



    },
}

</script>

<template>
    <Head title="Shops" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shop name</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto Qsm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-xl">{{user.name}}'s shop</div>

                    <ItemModal></ItemModal>
                    <card :items="items"/> </div>
            </div>

        </div>







    </AuthenticatedLayout>
</template>
