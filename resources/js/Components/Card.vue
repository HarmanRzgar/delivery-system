<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div v-for="item in items" :key="item.id" class="flex">
            <div class="m-4  w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                <a href="#">
                    <img class="p-6 rounded-lg rounded-md" :src="item.image" alt="product image" />
                </a>
                <div class="px-5 pb-5 grid gap-4">
                    <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white truncate">{{ item.userId }}</h5>
                    </a>
                    <div class="description text-sm text-gray-400 break-words overflow-hidden line-clamp-3">{{ item.description }}</div>
                    <div class="flex items-center justify-between">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ item.price }}</span>
                        <a @click="onCreateOrder(item)" href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        items: {
            type: Object,
            required: true,
            responsive: true
        },
        onCreateOrder: {
            type: Function,
            required: false
        }
    }
};
</script>
