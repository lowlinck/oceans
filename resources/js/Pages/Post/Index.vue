<template>
    <div>
        <div class="w-1/2 mb-4 pb-4 border-b border-gray-300 flex justify-between">
            <div>
                <input type="text" v-model="postFilter.title" placeholder="title">
            </div>
            <div>
                <input type="text" v-model="postFilter.content" placeholder="content">
            </div>
            <div>
                <input type="text" v-model="postFilter.description" placeholder="description">
            </div>
            <div>
                <input type="date" v-model="postFilter.createdAtTo">
            </div>
            <div>
                <a @click.prevent="getFilters" class="bg-blue-800 text-white" href="#">Find</a>
            </div>
        </div>
        <div class="items-center">
            <secondary-button>
                <Link :href="route('posts.create')">Add post</Link>
            </secondary-button>
        </div>

        <div class="w-3/4 mb-4 pb-4 border-b border-gray-300" >
            <div class="flex flex-row justify-between border" v-for="post in postsData.data" :key="post.id">
                <Link :href="route('posts.show', post.id)" class="mr-4">{{ post.title }}</Link>
                <Link :href="route('posts.show', post.id)" class="mr-4">{{ post.content }}</Link>
                <Link :href="route('posts.show', post.id)" class="mr-4">{{ post.description }}</Link>
               <template class="flex justify-between">
                   <div class="mr-4">
                       <Link :href="route('posts.edit', post.id)" class="text-green-800">Edit</Link>
                   </div>
                   <div>
                       <a href="#" @click.prevent="deletePost(post.id) " class="">Delete</a>
                   </div>
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

export default {
    name: 'Index',
    layout: AdminLayout,
    components: {
        Edit,
        SecondaryButton,
        Link
    },
    props: {
        posts: {
            type: Object,
            required: true
        }
    },
    setup(props) {
        const postsData = ref(props.posts);
        const postFilter = ref({
            title: '',
            content: '',
            description: '',
            createdAtTo: '',
            page: 1
        });

        const getFilters = () => {
            console.log('Getting filters with:', postFilter.value); // Отладочное сообщение
            axios.get('/posts', {
                params: postFilter.value
            }).then(res => {
                console.log('Data fetched:', res.data); // Отладочное сообщение
                postsData.value = res.data;
                console.log('Updated postsData:', postsData.value); // Отладочное сообщение
            }).catch(error => {
                console.error('Error fetching filters:', error);
            });
        };

        const setPage = (url) => {
            console.log('Setting page with URL:', url); // Отладочное сообщение
            const params = new URLSearchParams(url.split('?')[1]);
            postFilter.value.page = params.get('page') || 1;
            console.log('Updated postFilter:', postFilter.value); // Отладочное сообщение
            getFilters();
        };
        const deletePost = (id) => {
          axios.delete(`/posts/${id}` )
              .then(res=>{
                  getFilters();
              });

        };
        onMounted(() => {
            console.log('Component mounted, initial page:', postFilter.value.page);

        });

        watch(postsData, (newData) => {
            console.log('postsData updated:', newData); // Отладочное сообщение
        });

        return {
            postsData,
            postFilter,
            getFilters,
            setPage,
            deletePost
        };
    }
};
</script>

<style scoped>
/* Ваши стили */
</style>
