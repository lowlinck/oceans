<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Категории</h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-800 text-white">№ п.п</th>
                <th class="py-2 px-4 bg-gray-800 text-white">Категория</th>
                <th class="py-2 px-4 bg-gray-800 text-white">Описание</th>
                <th class="py-2 px-4 bg-gray-800 text-white">Посты</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(category, index) in categories" :key="category.id" class="border-b">
                <td class="py-2 px-4 text-center">{{ index + 1 }}</td>
                <td class="py-2 px-4">{{ category.title }}</td>
                <td class="py-2 px-4">{{ category.description }}</td>
                <td class="border px-4 py-2">
                    <Link :href="route('admin.category.posts', category.id)" class="text-blue-500 hover:underline">View Posts</Link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {route} from 'ziggy-js';
export default {
    name: 'Index',
    layout:AdminLayout,
    components: {
        SecondaryButton,
        Link
    },
    props: {
        categories: Array,


    },
    data() {
        return {
            categoriesData : this.categories
        };
    },
    methods: {
        // Your methods here
        getCategory() {
            // Your method implementation
        }
    },
    mounted() {

    },
    computed: {
        // Your computed properties here
    }
};
</script>

<style scoped>
/* Your styles here */
</style>
