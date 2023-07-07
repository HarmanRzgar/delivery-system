<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);



</script>
<script>
import DataTable from "vue3-easy-data-table";
import Footer from "@/Components/Footer.vue";

export default {
    components: {Footer},

    data() {
        return {
            user: [],
        };
    },
    mounted() {
        this.UserData();
    },
    methods: {

        UserData() {
            axios.get('/user')
                .then(response => {
                    this.user = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },

    }
};
</script>

<template>
    <div class="flex flex-column">
        <div class="min-h-screen bg-gray-100 flex w-full">
            <nav
                class="top-0 fixed h-screen bg-white border-b border-gray-100 transition transform z-50"
                :class="{ 'w-90': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }"
            >  <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 X ">
                    <div class="flex justify-between h-16 flex flex-row">
                        <div class="flex flex-column align-center">
                            <!-- Logo -->


                            <!-- Navigation Links -->

                        </div>

                        <div class="hidden sm:flex items-center ">
                            <!-- Settings Dropdown -->

                        </div>

                        <!-- Hamburger -->
                        <div class=" flex items-center block justify-center m-l-40">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,

                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="block"
                >
                    <div class="pt-2 pb-3 space-y-1 sm:-my-px my-px sm:ml-1 ml-1 transition w-fit">

                        <ResponsiveNavLink :href="route('home')" :active="route().current('home')">
                            Home
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')" v-if="user.role_id === 4 || 3">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('shops')" :active="route().current('shops')">
                            Shops
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('cart')" :active="route().current('cart')">
                            Cart
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('order')" :active="route().current('order')">
                            Order
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <div class="block right flex-1 ">
                <header
                    class="bg-white border-b border-gray-300 flex w-full fixed z-20"
                    v-if="$slots.header"
                >
                <div class="ml-6 mb-3 flex items-center block justify-center">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        :class="{
                                            hidden: showingNavigationDropdown,

                                        }"
                        class="inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{
                                            hidden: showingNavigationDropdown,

                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 items-center">
                    <slot name="header" class="flex items-center"/>

                </div>
                <div class="shrink-0 flex items-center">
                    <Link :href="route('dashboard')">
                        <ApplicationLogo
                            class="block h-9 w-9 fill-current text-gray-800 m-6"
                        />
                    </Link>
                </div>
            </header>

            <!-- Page Content -->
                <main class="h-full items flex justify-center  z-0 mt-12 ">

                <div >
                <slot />

                </div>
            </main>
                <Footer class="" />
         </div>
        </div>
    </div>
</template>
