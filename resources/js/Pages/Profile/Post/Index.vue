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
            <secondary-button class="bg-sky-700 text-blue-700 focus:ring-indigo-900 hover:bg-blue-600"  >
                <a @click.prevent="getFilters"  href="#">Find</a>
            </secondary-button>
        </div>
        <div class="items-center">
            <secondary-button>
                <Link :href="route('admin.posts.create')">Add post</Link>
            </secondary-button>
        </div>

        <div>
            <h1 class="text-2xl font-bold mb-4">Posts <b class="text-blue-700">{{ name }}</b></h1>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-800 text-white">Title</th>
                    <th class="py-2 px-4 bg-gray-800 text-white">Content</th>
                    <th class="py-2 px-4 bg-gray-800 text-white">Description</th>
                    <th class="py-2 px-4 bg-gray-800 text-white">Preview</th>
                    <th class="py-2 px-4 bg-gray-800 text-white">Bloking</th>
                    <th class="py-2 px-4 bg-gray-800 text-white">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="post in postsProfileData.data" :key="post.id" class="border-b">
                    <td class="py-2 px-4">
                        <Link :href="route('admin.posts.show', post.id)" class="mr-4">{{ post.title }}</Link>
                    </td>
                    <td class="py-2 px-4">
                        <Link :href="route('admin.posts.show', post.id)" class="mr-4">{{ post.content }}</Link>
                    </td>
                    <td class="py-2 px-4">
                        <Link :href="route('admin.posts.show', post.id)" class="mr-4">{{ post.description }}</Link>
                    </td>
                    <td class="py-2 px-4">
                        <Link :href="route('admin.posts.show', post.id)">
                            <img class="w-[200px]" :src="post.preview_url" :alt="post.title">
                        </Link>
                    </td>
                    <td class="border px-4 py-2">
                        <input type="checkbox" v-model="post.is_blocked" @change="toggleBlock(post, 'posts')" />

                    </td>
                    <td class="py-2 px-4">
                        <div class="flex justify-between">
                            <div class="mr-4">
                                <Link :href="route('admin.posts.edit', post.id)" class="text-green-800">Edit</Link>
                            </div>
                            <div>
                                <a href="#" @click.prevent="deletePost(post.id)" class="text-red-800">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div v-if="postsProfileData && postsProfileData.meta && postsProfileData.meta.links">
            <template v-for="link in postsProfileData.meta.links" :key="link.label">
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

export default {
    name: 'Index',
    layout: AdminLayout,
    components: {
        SecondaryButton,
        Link
    },
    props: {
        postsProfile: {
            type: Object,

        },
        name:String,


    },
    setup(props) {
        const postsProfileData = ref(props.postsProfile);
        console.log(postsProfileData);
        const name = ref(props.name);

        const postFilter = ref({
            title: '',
            content: '',
            description: '',
            createdAtTo: '',
            is_blocked:'',
            page: 1
        });

        const getFilters = () => {
            axios.get('/admin/posts', {
                params: postFilter.value
            }).then(res => {
                postsData.value = res.data;
            }).catch(error => {
                console.error('Error fetching filters:', error);
            });
        };

        const setPage = (url) => {
            const params = new URLSearchParams(url.split('?')[1]);
            postFilter.value.page = params.get('page') || 1;
            getFilters();
        };

        const deletePost = (id) => {
            axios.delete(`/posts/${id}`)
                .then(res => {
                    getFilters();
                }).catch(error => {
                console.error('Error deleting post:', error);
            });
        };

        const toggleBlock = (post) => {
            const url = route('admin.toggleBlock', { type: 'posts', id: post.id });

            axios.patch(url, { is_blocked: post.is_blocked, reason: 'Admin toggled' })
                .then(response => {
                    console.log(`Post ${post.id} is now ${post.is_blocked ? 'blocked' : 'unblocked'}.`);
                })
                .catch(error => {
                    console.error(`Error updating block status:`, error);
                    alert(`Failed to update block status. Please try again.`);
                });
        };





        // onMounted(() => {
        //     getFilters();
        // });

        watch(postsProfileData, (newData) => {
            console.log('postsData updated:', newData); // Отладочное сообщение
        });

        return {
            postsProfileData,
            postFilter,
            getFilters,
            setPage,
            deletePost,
            toggleBlock,
            name

        };
    },
    mounted() {

    }
};
</script>

<style scoped>
/* Ваши стили */
</style>
