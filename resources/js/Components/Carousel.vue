<template>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div
                v-for="user in users"
                :key="user.id"
                class="swiper-slide"
            >
                <!-- Your existing card component code goes here -->
                <!-- Replace 'user' with 'shop' in the code for consistency -->
                <div class="break-words m-4 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-center break-words">

                        <a href="#">
                            <img class="p-6 rounded-lg rounded-md" :src="user.image" alt="product image" />
                        </a>
                        <div class="px-5 pb-5 grid gap-4 break-words">
                            <a href="#" class="break-words">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-100 dark:text-white truncate">{{ user.id }}</h5>
                            </a>
                            <div class="flex items-center justify-between flex-col gap-6">
                                <span class="text-lg font-bold text-gray-900 dark:text-white overflow-wrap break-word flex flex-col break-words">{{ user.name}}'s shop</span>
                                <div class="whitespace-nowrap break-words">

                                    <NavLink :href="`/shops/${user.id}`" >Visit shop</NavLink>

                                </div>
                            </div>
                        </div>

                </div>
            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

    </div>
</template>

<script>
import Swiper from 'swiper';
import 'swiper/swiper-bundle.css';
import CardFront from "@/Components/CardFront.vue";
import NavLink from "@/Components/NavLink.vue";

export default {
    components: {NavLink, CardFront},
    props: {
        users: {
            type: Array,
            required: true,
        },
    },
    computed: {

    },
    mounted() {
        // Initialize the Swiper carousel after component mount
        this.initSwiper();

    },
    methods: {

        initSwiper() {
            // Initialize the Swiper carousel
            new Swiper('.swiper-container', {
                slidesPerView: 3,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    // Define breakpoints for different screen sizes
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
            });
        },
    },
};
</script>
