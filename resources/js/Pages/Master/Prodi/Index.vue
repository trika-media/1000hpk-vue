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
    prodi: Object,
});

const prodi = computed(() => props.prodi);

const destroy = (id) => {
    if (!confirm("Apakah Anda yakin?")) return;
    Inertia.delete(route("master.prodi.destroy", { id }));
};
</script>

<template>
    <Head title="Prodi" />

    <AuthenticatedLayout>
        <template #heading> Prodi </template>

        <template #subheading> Master data prodi. </template>

        <template #button>
            <Link
                :href="route('master.prodi.create')"
                class="btn btn-sm btn-gray-800 d-inline-flex align-items-center"
            >
                <i class="fas fa-plus me-3"></i>
                Tambah Data Prodi
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
                        <th>Fakultas</th>
                        <th>Prodi</th>
                        <th width="10">Aksi</th>
                    </thead>

                    <tbody>
                        <Rows :data="prodi.data" colspan="5">
                            <tr
                                v-for="(prodi, index) in prodi.data"
                                :key="prodi.id"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ prodi.fakultas.nama }}</td>
                                <td>{{ prodi.nama }}</td>
                                <td>
                                    <div class="btn-group">
                                        <Link
                                            class="btn btn-xs btn-secondary"
                                            :href="
                                                route(
                                                    'master.prodi.edit',
                                                    prodi.id
                                                )
                                            "
                                        >
                                            <i class="fas fa-edit"></i>
                                        </Link>

                                        <Link
                                            @click="destroy(prodi.id)"
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
                    :links="prodi.links"
                    :from="prodi.from"
                    :to="prodi.to"
                    :total="prodi.total"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
