<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    puskesmas: Object,
});
</script>

<template>
    <Head title="Detail Puskesmas" />

    <AuthenticatedLayout>
        <template #heading>
            Detail Data Puskesmas
        </template>

        <template #subheading>
            Menampilkan detail data puskesmas.
        </template>

        <template #button>
            <Link :href="route('master.puskesmas.index')" class="btn btn-sm btn-white d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-3"></i>
                Kembali
            </Link>
        </template>

        <Alert />

        <div class="card">
            <ul class="list-group">
                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Nama</div>
                        <h3 class="h6">{{ props.puskesmas.nama }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Alamat</div>
                        <h3 class="h6">{{ props.puskesmas.alamat }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Kelurahan</div>
                        <h3 class="h6">{{ props.puskesmas.kelurahan.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Kecamatan</div>
                        <h3 class="h6">{{ props.puskesmas.kecamatan.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Kabupaten/Kota</div>
                        <h3 class="h6">{{ props.puskesmas.kabupaten.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Provinsi</div>
                        <h3 class="h6">{{ props.puskesmas.provinsi.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3" v-if="props.puskesmas.lat && props.puskesmas.lng">
                    <div>
                        <div class="small text-muted pe-4">Latitude/Longitude</div>
                        <h3 class="h6">{{ props.puskesmas.lat }}/{{ props.puskesmas.lng }}</h3>
                    </div>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>