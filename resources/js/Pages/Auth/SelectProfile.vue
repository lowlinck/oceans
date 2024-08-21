<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';

defineProps({
    profiles: Array,
});

const selectedProfile = ref(null);
const form = useForm({
    profile_id: null,
});

const submitProfile = () => {
    form.post(route('selectProfile'), {
        data: { profile_id: selectedProfile.value },
        onFinish: () => {
            if (!form.hasErrors) {
                window.location.href = route('dashboard');
            }
        }
    });
};
</script>

<template>
    <GuestLayout>
        <div class="mt-4">
            <InputLabel for="profile" value="Select Profile" />

            <select id="profile" v-model="form.profile_id" class="mt-1 block w-full">
                <option value="" disabled>Select a profile</option>
                <option v-for="profile in profiles" :key="profile.id" :value="profile.id">
                    {{ profile.first_name }}
                </option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton @click="submitProfile">
                Select Profile
            </PrimaryButton>
        </div>
    </GuestLayout>
</template>
