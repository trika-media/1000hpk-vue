<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Verifikasi Email" />

        <p>
            Terima kasih telah mendaftar! Sebelum memulai, dapatkah Anda memverifikasi
            alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan melalui
            email kepada Anda? Jika Anda tidak menerima email tersebut,
            dengan senang hati kami akan mengirimkan email lainnya kepada Anda.
        </p>

        <div v-if="verificationLinkSent"  class="alert alert-info" role="alert">
            Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
        </div>

        <form @submit.prevent="submit">
            <div class="d-flex">
                <button
                    type="submit"
                    class="btn btn-gray-800"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                Kirim Ulang Verifikasi Email</button>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="btn btn-danger ms-2 w-25"
                >Keluar</Link>
            </div>
        </form>
    </GuestLayout>
</template>
