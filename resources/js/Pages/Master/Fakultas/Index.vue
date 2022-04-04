<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Pagination from "@/Components/Datatable/Pagination.vue";
import Filter from "@/Components/Datatable/Filter.vue";
import Rows from "@/Components/Datatable/Rows.vue";
import Alert from "@/Components/Alert.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { computed } from "@vue/runtime-core";

const props = defineProps({
    fakultas: Object,
});

const fakultas = computed(() => props.fakultas);

const destroy = (id) => {
    if (!confirm("Apakah Anda yakin?")) return;
    Inertia.delete(route("master.fakultas.destroy", { id }));
};
</script>

<template>
    <Head title="Fakultas" />

    <AuthenticatedLayout>
        <template #heading> Fakultas </template>

        <template #subheading> Master data fakultas. </template>

        <template #button>
            <Link
                :href="route('master.fakultas.create')"
                class="btn btn-sm btn-gray-800 d-inline-flex align-items-center"
            >
                <i class="fas fa-plus me-3"></i>
                Tambah Data Fakultas
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
                <table
                    class="table table-sm table-bordered table-striped align-middle"
                >
                    <thead>
                        <th width="10">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th width="10">Aksi</th>
                    </thead>

                    <tbody>
                        <Rows :data="fakultas.data" colspan="5">
                            <tr
                                v-for="(fakultas, index) in fakultas.data"
                                :key="fakultas.id"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ fakultas.kode }}</td>
                                <td>{{ fakultas.nama }}</td>
                                <td>
                                    <div class="btn-group">
                                        <Link
                                            class="btn btn-xs btn-secondary"
                                            :href="
                                                route(
                                                    'master.fakultas.edit',
                                                    fakultas.id
                                                )
                                            "
                                        >
                                            <i class="fas fa-edit"></i>
                                        </Link>

                                        <Link
                                            @click="destroy(fakultas.id)"
                                            class="btn btn-xs btn-danger"
                                            ><i class="fas fa-trash"></i
                                        ></Link>
                                    </div>
                                </td>
                            </tr>
                        </Rows>
                    </tbody>
                </table>
            </div>

            <div class="card-footer px-3">
                <Pagination
                    :links="fakultas.links"
                    :from="fakultas.from"
                    :to="fakultas.to"
                    :total="fakultas.total"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
