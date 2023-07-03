<template>
    <footer class="bg-gray-200 p-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-600">&copy; {{ currentYear }} Jiasaz for IT services and solutions</span>
                </div>
                <div>
                    <a href="#" class="text-gray-600 hover:text-gray-800 mx-2">Terms of Service</a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 mx-2">Privacy Policy</a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 mx-2">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
export default {
    data() {
        return {
            currentYear: null
        };
    },
    mounted() {
        this.getCurrentYear();
    },
    methods: {
        getCurrentYear() {
            const currentDate = new Date();
            this.currentYear = currentDate.getFullYear();
        }
    }
};
</script>

<style scoped>
/* Add any custom styling for the footer here */
</style>
