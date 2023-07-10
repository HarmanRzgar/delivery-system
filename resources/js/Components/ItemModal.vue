
<template>
    <div class="container mx-auto m-4 z-10" v-if="user.id === users.id ">
        <div class="flex justify-center">
            <button
                @click="isOpen = true; isModalOpen = true"
                class="px-6 py-2 text-white bg-indigo-600 focus:bg-indigo-800 rounded shadow transition shadow-md shadow-gray-500"
                type="button"
            >
                New Item
            </button>

            <div
                v-show="isOpen"
                class="
          absolute
          inset-0
          flex
          items-center
          justify-center
          bg-gray-700 bg-opacity-50
        "
            >
                <div class="max-w-2xl p-6 bg-gray-100 rounded-md shadow-xl z-50 overflow-hidden">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl">Add new Item!</h3>
                        <svg
                            @click="isOpen = false"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 text-red-900 cursor-pointer"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>
                    <div class="mt-4 m-4">

                        <form @submit.prevent="submit" class="bg-gray-100 flex-col flex gap-6">
                            <input type="text" v-model="form.name" placeholder="Name" class="rounded-md">
                            <input type="text" v-model="form.price" placeholder="Price" class="rounded-md">
                            <textarea v-model="form.description" placeholder="Description" class="rounded-md resize-none	"></textarea>



                        <button
                            @click="isOpen = false"
                            class="px-6 py-2 text-indigo-800 border border-blue-600 rounded"
                        >
                            Cancel
                        </button>
                            <PrimaryButton @click="isOpen = false" class="flex justify-center w-full bg-indigo-800 focus:bg-indigo-800" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Register
                            </PrimaryButton>
                        </form>
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
         },
    },
    data() {
        return {
            isOpen: false,
            isModalOpen: false,
            url:null,
            user: [],
        };
    },
    mounted() {
        this.UserData();
    },
    watch: {
        isModalOpen(newVal) {
            if (newVal) {
                document.body.classList.add('modal-open');
            } else {
                document.body.classList.remove('modal-open');
            }
        },
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
<script setup>
import axios from "axios";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const submit = () => {
    form.post(route('items.store'), {
        onFinish: () => form.reset('name', 'price', 'description'),
        // Include the selected role in the form data
    },);
};
const form = useForm({
    name: '',
    price: '',
    description: '',

});

</script>
