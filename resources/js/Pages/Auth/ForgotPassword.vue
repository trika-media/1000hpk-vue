<script setup>
import GuestLayout from '@/Layouts/Guest.vue';
import ValidationErrors from '@/Components/Auth/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Lupa Password" />

        <h1 class="h3">Lupa Password?</h1>

        <ValidationErrors class="mb-4" />

        <div v-if="status" class="alert alert-info" role="alert">
            {{ status }}
        </div>

        <p class="mb-4">
            Lupa kata sandi Anda? Tidak masalah.
            Cukup beri tahu kami alamat email Anda dan kami akan
            mengirim email kepada Anda tautan pengaturan ulang kata sandi
             yang memungkinkan Anda memilih yang baru.
        </p>

        <form @submit.prevent="submit">
            <div class="form-group mb-4">
                <label for="email">Email</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-at px-2 font-weight-bold"></i>
                    </span>

                    <input
                        class="form-control"
                        id="email"
                        v-model="form.email"
                        type="email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="masukkan email"
                    >
                </div>
            </div>

            <div class="d-grid">
                <button
                    type="submit"
                    class="btn btn-gray-800"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                Pulihkan Password</button>
            </div>
        </form>
    </GuestLayout>
</template>
