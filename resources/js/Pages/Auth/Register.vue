<script setup>
import GuestLayout from '@/Layouts/Guest.vue';
import ValidationErrors from '@/Components/Auth/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Registrasi" />

        <ValidationErrors />

        <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h3">Buat Akun</h1>
        </div>

        <form @submit.prevent="submit" class="mt-4">
            <div class="form-group mb-4">
                <label for="email">Nama</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-user px-2 font-weight-bold"></i>
                    </span>

                    <input
                        class="form-control"
                        id="name"
                        v-model="form.name"
                        type="text"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="masukkan nama lengkap"
                    >
                </div>
            </div>

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
                        autocomplete="username"
                        placeholder="email@contoh.com"
                    >
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="password">Password</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-lock px-2 font-weight-bold"></i>
                    </span>

                    <input
                        class="form-control"
                        id="password"
                        v-model="form.password"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="masukkan password"
                    >
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="password_confirmation">Konfirmasi Password</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-lock px-2 font-weight-bold"></i>
                    </span>

                    <input
                        class="form-control"
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="masukkan konfirmasi password"
                    >
                </div>
            </div>

            <div class="d-grid">
                <button
                    type="submit"
                    class="btn btn-gray-800"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >Registrasi</button>
            </div>
        </form>

        <div class="d-flex justify-content-center align-items-center mt-4">
            <span class="fw-normal">
                Sudah mempunyai akun?

                <Link :href="route('login')" class="fw-bold">Login</Link>
            </span>
        </div>
    </GuestLayout>
</template>
