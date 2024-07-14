<template>
    <div class="flex flex-col gap-2 w-1/4 mx-[500px]">
        <input type="text" placeholder="title" v-model="tagable.post.title">
        <div v-if="errors['post.title']" class="text-red-800">
            <div v-for="error in errors['post.title']" :key="error">
                {{ error }}
            </div>
        </div>
        <input type="text" placeholder="content" v-model="tagable.post.content">
        <div v-if="errors['post.content']" class="text-red-800">
            <div v-for="error in errors['post.content']" :key="error">
                {{ error }}
            </div>
        </div>
        <input type="text" placeholder="description" v-model="tagable.post.description">
        <div v-if="errors['post.description']" class="text-red-800">
            <div v-for="error in errors['post.description']" :key="error">
                {{ error }}
            </div>
        </div>
        <input type="text" placeholder="tags" v-model="tagable.tags">
        <div v-if="errors['tags']" class="text-red-800">
            <div v-for="error in errors['tags']" :key="error">
                {{ error }}
            </div>
        </div>
        <div class="mb-4 w-1/4">
            <img :src="tagable.post.preview_url" :alt="tagable.post.title">
        </div>
        <input type="file" @change="setImage" ref="fileInput">

    </div>
    <div>
        <select v-model="tagable.post.category_id" class="flex flex-col gap-2 w-1/4 mx-[500px]">
            <option :value="null" disabled>Category</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.title }}</option>
        </select>
        <div v-if="errors['post.category_id']" class="text-red-800 gap-2 w-1/4 mx-[500px]">
                {{ errors['post.category_id'] }}
          </div>

    </div>
    <a href="#" @click.prevent="UpdatePost" class="block mx-[500px] mt-1.5 w-[100px]
    bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</a>
    <Link class="text-red-700 justify-center items-center h-screen" :href="route('posts.index')">
        Back
    </Link>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import axios from 'axios'; // Убедитесь, что axios импортирован

export default {
    name: "Edit",
    components: { Link },
    props: {
        categories: Array,
        post:Object
    },
    data() {
        return {
            tagable: {
                post:this.post,
                tags: this.post.tags
            },
            errors: {}
        };
    },
    methods: {
        setImage(e) {
            this.tagable.post.preview_path = e.target.files[0];
        },
        UpdatePost() {
              axios.patch(`/posts/${this.post.id}`, this.tagable, {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            })
                .then(res => {
                    console.log('Данные отправлены:', this.tagable);
                    this.resetForm();
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error('Ошибка при отправке данных:', error);
                    }

                });
        },
        resetForm() {
            this.tagable = {
                post: {
                    title: '',
                    content: '',
                    description: '',
                    category_id: null,
                    preview_path: ''
                },
                tags: ''
            };
            this.$refs.fileInput.value = null; // сброс поля файла
            this.errors = {}; // сброс ошибок
        }
    }
};
</script>

<style scoped>
/* Your styles here */
</style>
