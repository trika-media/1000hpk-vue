<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    mahasiswa: Object,
});
</script>

<template>
    <Head title="Detail Mahasiswa" />

    <AuthenticatedLayout>
        <template #heading>
            Detail Mahasiswa
        </template>

        <template #subheading>
            Menampilkan detail mahasiswa.
        </template>

        <template #button>
            <Link :href="route('mahasiswa.index')" class="btn btn-sm btn-white d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-3"></i>
                Kembali
            </Link>
        </template>

        <Alert />

        <div class="card">
            <ul class="list-group">
                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">NIM</div>
                        <h3 class="h6">{{ props.mahasiswa.nim }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Nama</div>
                        <h3 class="h6">{{ props.mahasiswa.nama }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Angkatan</div>
                        <h3 class="h6">{{ props.mahasiswa.angkatan }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Nomor Ponsel</div>
                        <h3 class="h6">{{ props.mahasiswa.nomor_ponsel || '-' }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Alamat</div>
                        <h3 class="h6">{{ props.mahasiswa.alamat || '-' }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Jenis Kelamin</div>
                        <h3 class="h6" style="text-transform:capitalize">{{ props.mahasiswa.jenis_kelamin || '-' }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Fakultas</div>
                        <h3 class="h6" style="text-transform:capitalize">{{ props.mahasiswa.fakultas.nama || '-' }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Prodi</div>
                        <h3 class="h6" style="text-transform:capitalize">{{ props.mahasiswa.prodi.nama || '-' }}</h3>
                    </div>
                </li>

                <template v-if="props.mahasiswa.user_id">
                    <li class="list-group-item border-bottom p-3 bg-gray-200">
                        <div>
                            <div class="small text-muted pe-4">Detail Akun</div>
                        </div>
                    </li>

                    <li class="list-group-item border-bottom p-3 bg-gray-100">
                        <div>
                            <img
                                style="max-width:20rem"
                                :src="props.mahasiswa.akun.avatar_url"
                                :alt="'Fotot' + props.mahasiswa.akun.name"
                            >
                        </div>
                    </li>

                    <li class="list-group-item border-bottom p-3 bg-gray-100">
                        <div>
                            <div class="small text-muted pe-4">Nama Akun</div>
                            <h3 class="h6">{{ props.mahasiswa.akun.name }}</h3>
                        </div>
                    </li>

                    <li class="list-group-item border-bottom p-3 bg-gray-100">
                        <div>
                            <div class="small text-muted pe-4">Email</div>
                            <h3 class="h6">{{ props.mahasiswa.akun.email }}</h3>
                        </div>
                    </li>

                    <li class="list-group-item border-bottom p-3 bg-gray-100">
                        <div>
                            <div class="small text-muted pe-4">Role</div>
                            <h3 class="h6">{{ props.mahasiswa.akun.role }}</h3>
                        </div>
                    </li>

                    <li class="list-group-item border-bottom p-3 bg-gray-100">
                        <div>
                            <div class="small text-muted pe-4">Status</div>
                            <h3 class="h6">
                                <span class="badge bg-success" v-if="props.mahasiswa.akun.email_verified_at">
                                    Aktif
                                </span>

                                <span class="badge bg-primary" v-else>
                                    Nonaktif
                                </span>
                            </h3>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>