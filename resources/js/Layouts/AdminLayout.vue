<template>
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
            <div class="p-4">
                <Link :href="route('dashboard')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Dashboard
                </Link>
                <Link :href="route('admin.posts.index')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Posts
                </Link>
                <Link :href="route('admin.categories.index')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Category
                </Link>
                <Link :href="route('admin.users.index')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Users
                </Link>
                <!-- Add more links as needed -->
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-grow flex flex-col">
            <!-- Header -->
            <header class="bg-gray-800 text-white p-4 md:p-6 lg:p-8 flex justify-between items-center">
                <Link :href="route('dashboard')" class="text-2xl md:text-3xl lg:text-4xl font-bold">{{userRoles.join(', ')}}</Link>
                <a class="text-amber-400 " href="#"  @click="logout">Logout</a>
            </header>

            <!-- Content -->
            <main class="flex-grow p-4">
                <section>
                    <slot />
                </section>
            </main>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white p-4 md:p-6 lg:p-8">
                <div class="text-center text-sm md:text-base lg:text-lg">
                    &copy; 2024 Your Company. All rights reserved.
                </div>
                <div class="flex justify-center mt-4 space-x-4">
                    <Link :href="route('dashboard')" class="hover:text-gray-400">Privacy Policy</Link>
                    <Link :href="route('dashboard')" class="hover:text-gray-400">Terms of Service</Link>
                    <Link :href="route('dashboard')" class="hover:text-gray-400">Contact Us</Link>
                </div>
            </footer>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import {route} from 'ziggy-js';
export default {
    name: 'AdminLayout',
    components: {
        Link
    },
    props: {
        userRoles: {
            type: Array,
            default: () => ['guest']
        }
    },

    data() {
        return {

        };
    },
    methods: {
        logout(){
            axios.post('/logout', {

            }).then(res => {
                window.location.href = route('login');
            }).catch(error => {
                console.error('Error logout:', error);
            });
        },
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
