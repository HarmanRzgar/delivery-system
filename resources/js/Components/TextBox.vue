<template>
    <ul class="">
        <li v-for="item in items" :key="item.key">

<div class="bg-gray-800 w-32 p-4 m-4 text-white rounded-md hover:bg-gray-100 hover:text-gray-900 border border-gray-600 border-2 transition ">
<h2 class="text-sm">
    {{item.title}}
</h2>
<h6 class="text-xl">
    {{item.price}}
</h6>
</div></li>
    </ul>
</template>

<script>
export default {
    props: {
        items: {
            type: Object,
            required: true
        }
    }
};
</script>
