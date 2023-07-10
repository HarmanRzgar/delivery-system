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
            shopOwner: [],
            items: [],
            shopItems: [],

        };
    },
    mounted() {
        this.fetchData();

        this.UserData();
    },
    methods: {

        UserData() {
            axios.get('/user')
                .then(response => {
                    this.shopOwner = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
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
<!--                        <div v-if="user.role_id === users ">-->
                    <ItemModal :users="user"></ItemModal>
<!--                        </div>-->
                    <card :items="items" /> </div>

            </div>

        </div>







    </AuthenticatedLayout>
</template>
