<template>
    <div class="flex flex-wrap">
        <div class="w-full sm:w-6/12 md:w-4/12 px-4">
            <div class="relative inline-flex align-middle w-full">
                <button
                    class="text-white font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 bg-slate-700 ease-linear transition-all duration-150 font-normal px-6 py-2 rounded outline-none focus:outline-none mr-1 mb-1 capitalize w-full"
                    type="button"
                    v-on:click="toggleDropdown()"
                    ref="btnDropdownRef"
                >
                    White Dropdown
                </button>
                <div
                    v-bind:class="{'hidden': !dropdownPopoverShow, 'block': dropdownPopoverShow}"
                    class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1"
                    style="min-width:12rem"
                    ref="popoverDropdownRef"
                >
                    <a
                        href="#pablo"
                        class="text-sm border-1 border-gray-300 epy-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent  text-slate-700"
                        v-for="role in roles"
                        :key="role.id"
                        @click="selectRole(role.id)"
                    >
                        {{ role.name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { createPopper } from "@popperjs/core";

export default {
    name: "dropdown",
    props: {
        selectedRole: {
            type: Number,
            default: null,
        },
    },
    data() {
        return {
            dropdownPopoverShow: false,
            roles: [], // Add a roles array to store the roles fetched from the database
        };
    },
    methods: {
        toggleDropdown: function () {
            if (this.dropdownPopoverShow) {
                this.dropdownPopoverShow = false;
            } else {
                this.dropdownPopoverShow = true;
                createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
                    placement: "bottom-start",
                });
            }
        },
        selectRole: function (roleId) {
            this.selectedRole = roleId;
            this.$emit("role-selected", this.selectedRole); // Emit the event with the selected role
        },
    },
};
</script>
