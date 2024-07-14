<template>
    <div>тест</div>
    <div>
        <h1>{{ message }}</h1>
        <pre>{{ data }}</pre>
    </div>

</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: 'Stores',
    layout:AdminLayout,
    props: {
        message: String,
        data: Object
    },
    data() {
        return {
            // Your data here
        };
    },
    methods: {
        // Your methods here
        tores() {
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
