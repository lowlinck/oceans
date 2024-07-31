<template>
    <div class="flex flex-col">
        <b>Переход пао ссылке</b>
        <Link :href="route('profiles.posts.index')">перейти на index</Link>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

export default {
    name: 'Dashboard',
    layout:MainLayout,
    components:{
      Link
    },
    props: {
        // Your props here
    },
    data() {
        return {
            // Your data here
        };
    },
    methods: {
        // Your methods here
        create() {
            // Your method implementation
        }
    },
    computed: {
        // Your computed properties here
    }
};
</script>

<style scoped>
/* Your styles here */
</style>
