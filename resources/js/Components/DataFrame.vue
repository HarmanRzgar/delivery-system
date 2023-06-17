<template>
    <div>
        <ul>
            <li class="p-20 text-md" v-for="item in items" :key="item.id">{{ item.name }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        items: {
            type: Array,
            required: true
        }
    }
};
</script>

<style>

</style>
