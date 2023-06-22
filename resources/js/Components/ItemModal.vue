<!--<template>-->

<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--    name: 'ItemsCreate',-->
<!--    components: {-->
<!--        'modal': () => import('./Modal.vue'),-->
<!--    },-->
<!--    data() {-->
<!--        return {-->
<!--            showModal: false,-->
<!--            name: '',-->
<!--            description: '',-->
<!--            image: null,-->
<!--            user_id: '',-->
<!--        };-->
<!--    },-->
<!--    methods: {-->
<!--        showModal() {-->
<!--            this.showModal = true;-->
<!--        },-->
<!--        onImageChange(event) {-->
<!--            this.image = event.target.files[0];-->
<!--        },-->
<!--    },-->
<!--};-->
<!--</script>-->
<!--<div>-->
<!--<button @click="showModal">Add Item</button>-->
<!--<modal v-if="showModal" @close="showModal = false">-->

<!--</modal>-->
<!--</div>-->
<template>
    <div class="container mx-auto" v-if="user.role_id === 4 ">
        <div class="flex justify-center">
            <button
                @click="isOpen = true"
                class="px-6 py-2 text-white bg-blue-600 rounded shadow"
                type="button"
            >
                Open Model
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
                <div class="max-w-2xl p-6 bg-gray-100 rounded-md shadow-xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl">Model Title</h3>
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
                            <input type="text" v-model="name" placeholder="Name" class="rounded-md">
                            <input type="text" v-model="name" placeholder="Price" class="rounded-md">
                            <textarea v-model="description" placeholder="Description" class="rounded-md resize-none	"></textarea>
                            <input type="file" @change="onImageChange" class="rounded-md" >
                            <img v-if="url" :src="url" />
                            <input type="hidden" v-model="user_id" class="rounded-md">
                        </form>

                        <button
                            @click="isOpen = false"
                            class="px-6 py-2 text-blue-800 border border-blue-600 rounded"
                        >
                            Cancel
                        </button>
                        <button class="px-6 py-2 ml-2 text-blue-50 bg-indigo-800 rounded">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            isOpen: false,
            url:null,
            user: [],
        };
    },
    mounted() {
        this.UserData();
    },
    methods: {
        onImageChange(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },
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
