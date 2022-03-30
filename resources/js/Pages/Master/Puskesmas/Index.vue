<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Datatable/Pagination.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import { computed } from '@vue/runtime-core';

const props = defineProps({
    puskesmas: Object,
});

const puskesmas = computed(() => props.puskesmas);

const destroy = (id) => {
    if (!confirm('Apakah Anda yakin?')) return;
    Inertia.delete(route('master.puskesmas.destroy', {id}));
}
</script>

<template>
    <Head title="Puskesmas" />

    <AuthenticatedLayout>
        <template #heading>
            Puskesmas
        </template>

        <template #subheading>
            Master data puskesmas.
        </template>

        <template #button>
            <Link :href="route('master.puskesmas.create')" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <i class="fas fa-plus me-3"></i>
                Tambah Data Puskesmas
            </Link>

            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">
                    Import
                </button>

                <button type="button" class="btn btn-sm btn-outline-gray-600">
                    Export
                </button>
            </div>
        </template>

        <Alert />

        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th width="10">No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th width="10">Aksi</th>
                    </thead>

                    <tbody>
                        <tr v-for="(puskesmas, index) in puskesmas.data" :key="puskesmas.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ puskesmas.nama }}</td>
                            <td>{{ puskesmas.alamat }}</td>
                            <td>
                                <div class="btn-group">
                                    <Link
                                        class="btn btn-sm btn-gray-100"
                                        :href="route('master.puskesmas.show', puskesmas.id)"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </Link>

                                    <Link
                                        class="btn btn-sm btn-secondary"
                                        :href="route('master.puskesmas.edit', puskesmas.id)"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </Link>

                                    <Link
                                        @click="destroy(puskesmas.id)"
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
                    :links="puskesmas.links"
                    :from="puskesmas.from"
                    :to="puskesmas.to"
                    :total="puskesmas.total"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>