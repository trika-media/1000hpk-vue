<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #heading>
            Dashboard
        </template>

        <template #subheading>
            Ringkasan aplikasi Anda berada disini.
        </template>
    </AuthenticatedLayout>
</template>
