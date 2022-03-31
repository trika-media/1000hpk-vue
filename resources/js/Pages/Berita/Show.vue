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
            Detail Berita
        </template>

        <template #subheading>
            Menampilkan detail berita.
        </template>

        <template #button>
            <Link :href="route('berita.index')" class="btn btn-sm btn-white d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-3"></i>
                Kembali
            </Link>
        </template>

        <Alert />

        <div class="card">
            <ul class="list-group">
                <li class="list-group-item border-bottom p-3" v-if="props.berita.gambar">
                    <div>
                        <img
                            :src="props.berita.gambar_url"
                            :alt="'Gambar Berita' + props.berita.judul"
                        >
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Judul</div>
                        <h3 class="h6">{{ props.berita.judul }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Tanggal</div>
                        <h3 class="h6">{{ moment(props.berita.created_at).format('LL') }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Penulis</div>
                        <h3 class="h6">{{ props.berita.penulis }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Status</div>
                        <h3 class="h6">
                            <span class="badge bg-success" v-if="props.berita.tampil">
                                Aktif
                            </span>

                            <span class="badge bg-primary" v-else>
                                Nonaktif
                            </span>
                        </h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Konten</div>
                        <div class="border border-2 rounded p-3 mt-2">
                            <div v-html="props.berita.konten"></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>