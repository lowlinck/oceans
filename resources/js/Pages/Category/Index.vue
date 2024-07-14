<template>
    <div>

<!--        <div class="w-1/2 mx-[500px]">-->


<!--            <div v-for="category in categories">-->
<!--                <Link :href="route('categories.show',  category.id)">{{ category.title }}</Link>-->
<!--            </div>-->
<!--            <div>-->
<!--                <a v-for=" category in categories " >{{category.title}}</a>-->
<!--            </div>-->
<!--            <div>-->
<!--                <secondary-button><Link :href="route('posts.create')">Add post</Link></secondary-button>-->
<!--            </div>-->
<!--        </div>-->
        <div>тест</div>
        <div>
            <h1>{{ message }}</h1>
            <pre>{{ data }}</pre>
        </div>
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
        message: String,
        data: Object,

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
