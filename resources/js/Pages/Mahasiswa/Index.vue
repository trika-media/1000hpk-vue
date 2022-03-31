<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Datatable/Pagination.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { computed } from '@vue/runtime-core';

const props = defineProps({
    mahasiswa: Object,
});

const mahasiswa = computed(() => props.mahasiswa);

const destroy = (id) => {
    if (!confirm('Apakah Anda yakin?')) return;
    Inertia.delete(route('mahasiswa.destroy', {id}));
}

const changeStatus = (id) => {
    Inertia.post(route('mahasiswa.status', {id}));
}
</script>

<template>
    <Head title="Mahasiswa" />

    <AuthenticatedLayout>
        <template #heading>
            Mahasiswa
        </template>

        <template #subheading>
            Kumpulan data mahasiswa.
        </template>

        <template #button>
            <Link :href="route('mahasiswa.create')" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <i class="fas fa-plus me-3"></i>
                Tambah Data Mahasiswa
            </Link>
        </template>

        <Alert />

        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th width="10">No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Nomor Ponsel</th>
                        <th>Angkatan</th>
                        <th width="10">Aksi</th>
                    </thead>

                    <tbody>
                        <tr v-for="(mahasiswa, index) in mahasiswa.data" :key="mahasiswa.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ mahasiswa.nim }}</td>
                            <td>
                                {{ mahasiswa.nama }}

                                <span class="badge bg-success" title="Punya Akun" v-if="mahasiswa.user_id">
                                    <i class="fas fa-check"></i>
                                </span>
                            </td>
                            <td>{{ mahasiswa.nomor_ponsel }}</td>
                            <td>{{ mahasiswa.angkatan }}</td>
                            <td>
                                <div class="btn-group">
                                    <Link
                                        class="btn btn-sm btn-gray-100"
                                        :href="route('mahasiswa.show', mahasiswa.id)"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </Link>

                                    <Link
                                        class="btn btn-sm btn-secondary"
                                        :href="route('mahasiswa.edit', mahasiswa.id)"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </Link>

                                    <Link
                                        @click="destroy(mahasiswa.id)"
                                        class="btn btn-sm btn-danger"
                                    ><i class="fas fa-trash"></i></Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer px-3">
                <Pagination
                    :links="mahasiswa.links"
                    :from="mahasiswa.from"
                    :to="mahasiswa.to"
                    :total="mahasiswa.total"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>