<script setup>
import GuestLayout from '@/Layouts/Guest.vue';
import ValidationErrors from '@/Components/Auth/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    })
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <p>
            Ini adalah area aplikasi yang aman.
            Harap konfirmasi kata sandi Anda sebelum melanjutkan.
        </p>

        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
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

            <div class="d-grid">
                <button
                    type="submit"
                    class="btn btn-gray-800"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >Konfirmasi</button>
            </div>
        </form>
    </GuestLayout>
</template>
