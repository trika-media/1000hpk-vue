<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';

moment.locale('id');


const props = defineProps({
    berita: Object,
});
</script>

<template>
    <Head title="Detail Berita" />

    <AuthenticatedLayout>
        <template #heading>
            {{ props.berita.judul }}
        </template>

        <template #subheading>
            <small class="text-muted">{{ moment(props.berita.created_at).format('LL') }}</small>

            <small class="badge bg-info ms-2">{{ props.berita.penulis }}</small>
        </template>

        <template #button>
            <Link :href="route('user.berita.index')" class="btn btn-sm btn-white d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-3"></i>
                Kembali
            </Link>
        </template>

        <Alert />

        <div class="card">
            <div class="card-body" v-if="props.berita.gambar">
                <img
                    style="max-width:20rem"
                    :src="props.berita.gambar_url"
                    :alt="'Gambar Berita' + props.berita.judul"
                >
            </div>

            <div class="card-footer">
                <div v-html="props.berita.konten"></div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>