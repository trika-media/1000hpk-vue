<script setup>
import GuestLayout from '@/Layouts/Guest.vue';
import ValidationErrors from '@/Components/Auth/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Masuk" />

        <ValidationErrors class="mb-4" />

        <div v-if="status" class="alert alert-info" role="alert">
            {{ status }}
        </div>

        <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h3">Masuk ke Aplikasi</h1>
        </div>

        <form @submit.prevent="submit" class="mt-4">
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
                        autocomplete="current-password"
                        placeholder="masukkan password"
                    >
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-top mb-4">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        value="true"
                        id="remember"
                        name="remember"
                        v-model="form.remember"
                    >

                    <label class="form-check-label mb-0" for="remember">
                        Ingat saya
                    </label>
                </div>

                <div>
                    <Link
                        class="small text-right"
                        v-if="canResetPassword"
                        :href="route('password.request')"
                    >Lupa Password?</Link>
                </div>
            </div>

            <div class="d-grid">
                <button
                    type="submit"
                    class="btn btn-gray-800"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >Masuk</button>
            </div>
        </form>
    </GuestLayout>
</template>
