<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex item-center p-3 text-xl border-2 border-indigo-400 text-sm font-medium leading-5 text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out rounded-md bg-indigo-600 focus:bg-indigo-800 p-4'
        : 'inline-flex item-center p-3 text-xl border-2 border-transparent text-sm font-medium leading-5 text-gray-100 hover:text-gray-100 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 p-4 transition duration-150 ease-in-out rounded-md bg-indigo-400 hover:bg-indigo-800'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
