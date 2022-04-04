<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Admin from "@/Pages/Dashboard/Admin.vue";
import User from "@/Pages/Dashboard/User.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/runtime-core";

const props = defineProps({
    data: Object,
});

const data = computed(() => props.data);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #heading> Dashboard </template>

        <template #subheading>
            Ringkasan aplikasi Anda berada disini.
        </template>

        <Admin
            v-if="['admin', 'superadmin'].includes($page.props.auth.user.role)"
            :data="data"
        />

        <template
            v-if="['user', 'mahasiswa'].includes($page.props.auth.user.role)"
        >
            <User v-if="$page.props.auth.mahasiswa" :data="data" />

            <div v-else>
                <div class="alert alert-warning" role="alert">
                    <div class="alert-icon">
                        <span class="fas fa-exclamation-circle"></span>
                    </div>

                    <h4 class="alert-heading">Perhatian!</h4>

                    <p>
                        Akun ini belum terhubung dengan data mahasiswa. Anda
                        belum dapat mengakses menu yang ada.
                    </p>

                    <hr />

                    <p class="mb-0">
                        Silahkan kontak Admin untuk informasi lebih lanjut.
                    </p>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
