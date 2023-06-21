<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Shops" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cart</h2>
        </template>

        <div class="py-12 flex ">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6"> List
                        <div class="p-6 text-gray-100 flex gap-6 bg-indigo-600 rounded-md">
                            <ul>
                                <li>Cucumber slices</li>
                                <li>Delights</li>
                                <li>Pineapple Pizza</li>
                                <li>deep fried Red rabbit </li>
                            </ul>
                            <ul>
                                <li>Cucumber slices</li>
                                <li>Delights</li>
                                <li>Pineapple Pizza</li>
                                <li>deep fried Red rabbit </li>
                            </ul>
                        </div>
                        <button type="submit" class="bg-gray-800  hover:bg-gray-500 transition text-gray-100 hover:text-gray-900 rounded-md m-4 flex p-4">Start Order</button>
                    </div>
                </div>
            </div>
        </div>

        <img src="" alt="" srcset="">


    </AuthenticatedLayout>
</template>
