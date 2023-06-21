<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div v-for="user in users" :key="user.id" class="flex flex-col justify-center">
            <div class="m-4 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-center">
                <a href="#">
                    <img class="p-6 rounded-lg rounded-md" :src="user.image" alt="product image" />
                </a>
                <div class="px-5 pb-5 grid gap-4">
                    <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white truncate">{{ user.id }}</h5>
                    </a>
                    <div class="flex items-center justify-between flex-col gap-6">
                        <span class="text-lg font-bold text-gray-900 dark:text-white overflow-wrap break-word flex flex-col">{{ user.email }}</span>
                        <div class="whitespace-nowrap">
                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    props: {
        users: {
            type: Object,
            required: true,
            responsive: true
        }
    },


};

</script>
