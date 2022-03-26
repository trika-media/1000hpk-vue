<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import GuestLayout from '@/Layouts/Guest.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<template>
    <GuestLayout>
        <Head title="1000 Hari Pertama Kehidupan" />

        <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h3">1000 Hari Pertama Kehidupan</h1>
        </div>

        <p>
            Masa 1000 hari pertama kehidupan (1000 HPK) terdiri atas 270 hari selama kehamilan dan 730 hari pada dua tahun pertama kehidupan buah hati.
            Dampak pada masa periode emas akan sangat berpengaruh terhadap tumbuh kembang buah hati hingga dewasanya.
        </p>

        <div v-if="canLogin">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard.index')"
                class="btn btn-primary"
                type="button"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="btn btn-primary me-2"
                    type="button"
                >
                    Login
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="btn btn-outline-primary"
                    type="button"
                >
                    Register
                </Link>
            </template>
        </div>

        <div class="mt-3">
            <small class="text-muted">
                Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
            </small>
        </div>
    </GuestLayout>
</template>