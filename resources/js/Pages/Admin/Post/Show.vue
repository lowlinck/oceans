<script>
import { Link } from "@inertiajs/vue3";
import { route } from 'ziggy-js';
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: 'Show',
    layout: AdminLayout,
    components: {
        Link
    },
    props: {
        post: {
            type: Object,
            required: true
        }
    },
    watch: {
        post(newValue) {
            console.log(newValue.title);
        }
    }
}
</script>

<template>
    <div class="flex flex-col gap-2 w-1/4 mx-[500px]">
        <div class="mb-4 pb-4 border-b border-gray-300">
            {{ post.title }}
        </div>
        <div class="mb-4 pb-4 border-b border-gray-300">
            <img :src="post.preview_url" :alt="post.title">
        </div>
    </div>
    <a href="#" class="block mx-[500px] mt-1.5 w-[100px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add</a>
    <Link class="text-red-700 justify-center items-center h-screen" :href="route('admin.posts.index')">
        Back
    </Link>
</template>

<style scoped>

</style>
