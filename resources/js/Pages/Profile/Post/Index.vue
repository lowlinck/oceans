<template>
    <div>
        <div class="w-1/2 mb-4 pb-4 border-b border-gray-300 flex justify-between">

            <secondary-button>
                <Link :href="route('profiles.posts.create')">Add post</Link>
            </secondary-button>
        </div>

        <div class="w-3/4 mb-4 pb-4 border-b border-gray-300" >
            <div class="flex flex-row justify-between border" v-for="post in postsData" :key="post.id">
                <Link :href="route('profiles.posts.show', post.id)" class="mr-4">{{ post.title }}</Link>
                <Link :href="route('profiles.posts.show', post.id)" class="mr-4">{{ post.content }}</Link>
                <Link :href="route('profiles.posts.show', post.id)" class="mr-4">{{ post.description }}</Link>
                <Link :href="route('profiles.posts.show', post.id)" class="mr-4">{{ auth.user.name }}</Link>
                <Link :href="route('profiles.posts.show', post.id)" class="mr-4">
                    <div class="mb-4 pb-4 border-b border-gray-300">
                    <img class="w-[200px]" :src="post.preview_url" :alt="post.title">
                    </div>
                </Link>

               <template class="flex justify-between">
<!--                   <div class="mr-4">-->
<!--                       <Link :href="route('profile.posts.edit', post.id)" class="text-green-800">Edit</Link>-->
<!--                   </div>-->
<!--                   <div>-->
<!--                       <a href="#" @click.prevent="deletePost(post.id) " class="">Delete</a>-->
<!--                   </div>-->
               </template>


            </div>

        </div>

        <div v-if="postsData && postsData.meta && postsData.meta.links">
            <template v-for="link in postsData.meta.links" :key="link.label">
                <a class="inline-block p-2 bg-sky-600 text-white mr-4" href="#" v-if="link.url" v-html="link.label"
                   @click.prevent="setPage(link.url)"></a>
            </template>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import axios from 'axios';
import Edit from "@/Pages/Profile/Edit.vue";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: 'Index',
    layout: MainLayout,
    components: {
        Link
    },
    props: {
        posts: Array,
        auth:Array
    },
    data(){
        return{
            postsData:this.posts
        }
    },

};
</script>

<style scoped>
/* Ваши стили */
</style>
