<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Users and Profiles</h1>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-800 text-white">User</th>
                <th class="py-2 px-4 bg-gray-800 text-white">Profile</th>
                <th class="py-2 px-4 bg-gray-800 text-white">Role</th>
                <th class="py-2 px-4 bg-gray-800 text-white">Posts</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="user in usersData" :key="user.id">
                <template v-for="(profile, index) in user.profiles" :key="profile.id">
                    <tr>
                        <td class="border px-4 py-2" v-if="index === 0">{{ user.name }}</td>
                        <td class="border px-4 py-2" v-else></td>
                        <td class="border px-4 py-2">{{ profile.first_name }}</td>
                        <td class="border px-4 py-2">
                            <select v-model="profile.selectedRole" @change="updateRole(profile)" class="ml-2 select-role">
                                <option value="" disabled>Select Role</option>
                                <option v-for="role in enumRoles" :key="role" :value="role">{{ role }}</option>
                            </select>
                        </td>
                        <td class="border px-4 py-2">
                            <Link :href="route('admin.profile.posts', profile.id)" class="text-blue-500 hover:underline">View Posts</Link>
                        </td>
                    </tr>
                </template>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import axios from 'axios';

export default {
    name: 'Index',
    layout: AdminLayout,
    components: {
        Link
    },
    props: {
        users: Array,
        enumRoles: Array
    },
    data() {
        return {
            usersData: this.initializeUsersData(this.users)
        };
    },
    methods: {
        initializeUsersData(users) {
            return users.map(user => {
                user.profiles.forEach(profile => {
                    profile.is_blocked = profile.is_blocked || false; // Инициализация флага блокировки
                    profile.selectedRole = profile.roles.length ? profile.roles[0].name : ''; // Инициализация выбранной роли

                    // Лог для проверки данных
                    console.log(`Profile ID: ${profile.id}, Name: ${profile.first_name}, Selected Role: ${profile.selectedRole}`);
                });
                return user;
            });
        },
        updateRole(profile) {
            console.log('Updating role for profile:', profile.id, 'New role:', profile.selectedRole);

            let roleData = new FormData();
            roleData.append('title', profile.selectedRole);
            roleData.append('profile_id', profile.id);
            roleData.append('_method', 'patch');

            const updateRoleUrl = route('admin.profile.updaterole', { profile_id: profile.id });

            axios.post(updateRoleUrl, roleData)
                .then(res => {
                    console.log('Role updated successfully', res.data);
                    // Обновляем роль в профиле
                    // profile.roles[0].name = res.data.title;
                })
                .catch(error => {
                    console.error('Error updating role:', error);
                    alert('Failed to update role. Please try again.');
                });
        },
        toggleBlock(profile) {
            const action = profile.is_blocked ? 'unblock' : 'block';
            const routeName = `admin.posts.${action}`;

            const url = route(routeName, { id: profile.id });

            axios.patch(url, { reason: 'Admin toggled' })
                .then(response => {
                    console.log(`Profile ${action}ed successfully`, response.data);
                    profile.is_blocked = !profile.is_blocked;
                })
                .catch(error => {
                    console.error(`Error ${action}ing profile:`, error);
                    alert(`Failed to ${action} profile. Please try again.`);
                    profile.is_blocked = !profile.is_blocked; // Откат в случае ошибки
                });
        }
    },
    mounted() {
        console.log('Users:', this.users);
        console.log('Enum Roles:', this.enumRoles);
    }
};
</script>

<style scoped>
.select-role {
    display: inline-block;
    min-width: 120px;
    padding: 2px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>
