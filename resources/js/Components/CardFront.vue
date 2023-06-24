<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 break-all flex">
        <div v-for="user in users" :key="user.id" class="flex ">
            <div class="break-words m-4 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-center break-words">
                <a href="#">
                    <img class="p-6 rounded-lg rounded-md" :src="user.image" alt="product image" />
                </a>
                <div class="px-5 pb-5 grid gap-4 break-words">
                    <a href="#" class="break-words">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-100 dark:text-white truncate">{{ user.id }}</h5>
                    </a>
                    <div class="flex items-center justify-between flex-col gap-6">
                        <span class="text-lg font-bold text-gray-900 dark:text-white overflow-wrap break-word flex flex-col break-words">{{ user.email }}</span>
                        <div class="whitespace-nowrap break-words">

                            <NavLink :href="`/shops/${user.id}`" >Visit shop</NavLink>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import NavLink from "@/Components/NavLink.vue";

export default {
    components: {NavLink, ResponsiveNavLink},
    props: {
        shop: {
            type: Object,
            required: true,
        },
        users: {
            type: Object,
            required: true,
            responsive: true
        },
    },
    methods: {
        redirectToShop(shopId) {
            // Redirect to the shop's main page using the shopId
            window.location.href = `/shops/${shopId}`;
        },
    },

};

</script>
