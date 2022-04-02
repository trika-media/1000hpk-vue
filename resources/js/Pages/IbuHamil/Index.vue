<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Datatable/Pagination.vue';
import Filter from '@/Components/Datatable/Filter.vue';
import Rows from '@/Components/Datatable/Rows.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { computed } from '@vue/runtime-core';

const props = defineProps({
    ibuhamil: Object,
});

const ibuhamil = computed(() => props.ibuhamil);

const destroy = (id) => {
    if (!confirm('Apakah Anda yakin?')) return;
    Inertia.delete(route('ibu-hamil.destroy', {id}));
}

const changeStatus = (id) => {
    Inertia.post(route('ibu-hamil.status', {id}));
}
</script>

<template>
    <Head title="Ibu Hamil" />

    <AuthenticatedLayout>
        <template #heading>
            Ibu Hamil
        </template>

        <template #subheading>
            Kumpulan data ibu hamil.
        </template>

        <template #button>
            <Link :href="route('ibu-hamil.create')" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <i class="fas fa-plus me-3"></i>
                Tambah Data Ibu Hamil
            </Link>
        </template>

        <Alert />

        <Filter />

        <div class="card">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped align-middle">
                    <thead>
                        <th width="10">No</th>
                        <th>Identitas</th>
                        <th>Nama</th>
                        <th width="250">Alamat</th>
                        <th>Nomor Ponsel</th>
                        <th>Ditambahkan oleh</th>
                        <th width="10">Aksi</th>
                    </thead>

                    <tbody>
                        <Rows :data="ibuhamil.data" colspan="7">
                            <tr v-for="(ibuhamil, index) in ibuhamil.data" :key="ibuhamil.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ ibuhamil.identitas }}</td>
                                <td>{{ ibuhamil.nama }}</td>
                                <td>{{ ibuhamil.alamat }}</td>
                                <td>{{ ibuhamil.nomor_ponsel }}</td>
                                <td>{{ ibuhamil.mahasiswa.nama || ibuhamil.ditambahkan_oleh }}</td>
                                <td>
                                    <div class="btn-group">
                                        <Link
                                            class="btn btn-xs btn-gray-100"
                                            :href="route('ibu-hamil.show', ibuhamil.id)"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </Link>

                                        <Link
                                            class="btn btn-xs btn-secondary"
                                            :href="route('ibu-hamil.edit', ibuhamil.id)"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </Link>

                                        <Link
                                            @click="destroy(ibuhamil.id)"
                                            class="btn btn-xs btn-danger"
                                        ><i class="fas fa-trash"></i></Link>
                                    </div>
                                </td>
                            </tr>
                        </Rows>
                    </tbody>
                </table>
            </div>

            <div class="card-footer px-3">
                <Pagination
                    :links="ibuhamil.links"
                    :from="ibuhamil.from"
                    :to="ibuhamil.to"
                    :total="ibuhamil.total"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>