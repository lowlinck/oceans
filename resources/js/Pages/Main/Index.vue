<script  >
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {route} from 'ziggy-js';

export default {
    name: "Index",
    components:{
        Link
    },
    layout:AdminLayout,
}
</script>

<template>


        <Link :href="route('posts.index')">Posts</Link>

</template>

<style scoped>

</style>
