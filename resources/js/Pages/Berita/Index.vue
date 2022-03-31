<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Datatable/Pagination.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { computed } from '@vue/runtime-core';
import moment from 'moment';

moment.locale('id');

const props = defineProps({
    berita: Object,
});

const berita = computed(() => props.berita);

const destroy = (id) => {
    if (!confirm('Apakah Anda yakin?')) return;
    Inertia.delete(route('berita.destroy', {id}));
}

const changeStatus = (id) => {
    Inertia.post(route('berita.status', {id}));
}
</script>

<template>
    <Head title="Berita" />

    <AuthenticatedLayout>
        <template #heading>
            Berita
        </template>

        <template #subheading>
            Kumpulan data berita.
        </template>

        <template #button>
            <Link :href="route('berita.create')" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <i class="fas fa-plus me-3"></i>
                Tambah Data Berita
            </Link>
        </template>

        <Alert />

        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th width="10">No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th width="170">Status</th>
                        <th width="10">Aksi</th>
                    </thead>

                    <tbody>
                        <tr v-for="(berita, index) in berita.data" :key="berita.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ berita.judul }}</td>
                            <td>{{ berita.penulis }}</td>
                            <td>{{ moment(berita.created_at).format('LL') }}</td>
                            <td>
                                <Link
                                    @click="changeStatus(berita.id)"
                                    class="btn btn-sm btn text-white w-100"
                                    :class="berita.tampil ? 'btn-success' : 'btn-primary'"
                                >
                                    {{ berita.tampil ? 'Aktif' : 'Nonaktif'  }}
                                    <i class="fas fa-repeat ms-2"></i>
                                </Link>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <Link
                                        class="btn btn-sm btn-gray-100"
                                        :href="route('berita.show', berita.id)"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </Link>

                                    <Link
                                        class="btn btn-sm btn-secondary"
                                        :href="route('berita.edit', berita.id)"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </Link>

                                    <Link
                                        @click="destroy(berita.id)"
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
                    :links="berita.links"
                    :from="berita.from"
                    :to="berita.to"
                    :total="berita.total"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>