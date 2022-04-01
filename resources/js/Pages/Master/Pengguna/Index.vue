<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Datatable/Pagination.vue';
import Filter from '@/Components/Datatable/Filter.vue';
import Rows from '@/Components/Datatable/Rows.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import { computed } from '@vue/runtime-core';

const props = defineProps({
    pengguna: Object,
});

const pengguna = computed(() => props.pengguna);

const destroy = (id) => {
    if (!confirm('Apakah Anda yakin?')) return;
    Inertia.delete(route('master.pengguna.destroy', {id}));
}

const changeStatus = (id) => {
    Inertia.post(route('master.pengguna.status', {id}));
}
</script>

<template>
    <Head title="Pengguna" />

    <AuthenticatedLayout>
        <template #heading>
            Pengguna
        </template>

        <template #subheading>
            Master data pengguna.
        </template>

        <template #button>
            <Link :href="route('master.pengguna.create')" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <i class="fas fa-plus me-3"></i>
                Tambah Data Pengguna
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

        <Filter />

        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th width="10">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="170">Status</th>
                        <th width="10">Aksi</th>
                    </thead>

                    <tbody>
                        <Rows :data="pengguna.data" colspan="6">
                            <tr v-for="(pengguna, index) in pengguna.data" :key="pengguna.id">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    <img
                                        class="avatar rounded-circle me-2"
                                        :alt="'Foto ' + pengguna.name"
                                        :src="pengguna.avatar_url"
                                    >

                                    {{ pengguna.name }}
                                </td>
                                <td>{{ pengguna.email }}</td>
                                <td>
                                    <span
                                        class="badge"
                                        :class="{
                                            'bg-success' : pengguna.role == 'superadmin' ,
                                            'bg-info' : pengguna.role == 'admin' ,
                                            'bg-secondary' : pengguna.role == 'user'
                                        }"
                                    >
                                        {{ pengguna.role }}
                                    </span>
                                </td>
                                <td>
                                    <Link
                                        @click="changeStatus(pengguna.id)"
                                        class="btn btn-sm btn text-white w-100"
                                        :class="pengguna.email_verified_at ? 'btn-success' : 'btn-primary'"
                                    >
                                        {{ pengguna.email_verified_at ? 'Aktif' : 'Nonaktif'  }}
                                        <i class="fas fa-repeat ms-2"></i>
                                    </Link>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <Link
                                            class="btn btn-sm btn-secondary"
                                            :href="route('master.pengguna.edit', pengguna.id)"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </Link>

                                        <Link
                                            @click="destroy(pengguna.id)"
                                            class="btn btn-sm btn-danger"
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
                    :links="pengguna.links"
                    :from="pengguna.from"
                    :to="pengguna.to"
                    :total="pengguna.total"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>