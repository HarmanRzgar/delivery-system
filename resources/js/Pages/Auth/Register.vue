<script>
import { defineComponent } from 'vue'
export default defineComponent({
    data() {
        return {
            roles: [],
        }},
    methods: {
        fetchData() {
            axios.get('/roles')
                .then(response => {
                    this.roles = response.data;
                    console.log(this.roles);
                })
                .catch(error => {
                    console.error(error);
                    console.log(this.roles);
                });
        }
    },
    mounted() {
        this.fetchData();
    },
})

</script>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineComponent } from 'vue'

import Dropdownpopper from "@/Components/Dropdownpopper.vue";


const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role_id: '',
});



let selectedRole = null; // Add a new data property to store the selected role

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
         // Include the selected role in the form data
    });
};

const roleSelected = (role) => {
    selectedRole = role; // Update the selectedRole property when the role is selected
};



</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <div class="mt-4 bg-gray-800">

                <label for="role"></label>
                <select v-model="form.role_id" name="role" class="form-control">
                    <option>Select role</option>
                    <option v-for="role in roles" :value="role.id">@{{ role.name }}</option>
                </select>

                <InputLabel for="role" value="Role" />

               <!-- Add the event handler for role selection -->
            </div>
            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>


        </form>
    </GuestLayout>
</template>
