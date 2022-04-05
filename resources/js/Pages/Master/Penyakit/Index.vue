<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Pagination from "@/Components/Datatable/Pagination.vue";
import Filter from "@/Components/Datatable/Filter.vue";
import Rows from "@/Components/Datatable/Rows.vue";
import Alert from "@/Components/Alert.vue";
import ImportModal from "@/Components/Datatable/ImportModal.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { computed } from "@vue/runtime-core";

const props = defineProps({
    penyakit: Object,
});

const penyakit = computed(() => props.penyakit);

const destroy = (id) => {
    if (!confirm("Apakah Anda yakin?")) return;
    Inertia.delete(route("master.penyakit.destroy", { id }));
};
</script>

<template>
    <Head title="Penyakit" />

    <AuthenticatedLayout>
        <template #heading> Penyakit </template>

        <template #subheading> Master data penyakit. </template>

        <template #button>
            <Link
                :href="route('master.penyakit.create')"
                class="btn btn-sm btn-gray-800 d-inline-flex align-items-center"
            >
                <i class="fas fa-plus me-3"></i>
                Tambah Data Penyakit
            </Link>

            <div class="btn-group ms-2 ms-lg-3">
                <button
                    type="button"
                    class="btn btn-sm btn-outline-gray-600"
                    data-bs-toggle="modal"
                    data-bs-target="#modal-import-penyakit"
                >
                    Import
                </button>

                <a
                    :href="route('excel.export.penyakit')"
                    type="button"
                    class="btn btn-sm btn-outline-gray-600"
                >
                    Export
                </a>
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
                        <th>Kelompok</th>
                        <th width="10">Aksi</th>
                    </thead>

                    <tbody>
                        <Rows :data="penyakit.data" colspan="5">
                            <tr
                                v-for="(penyakit, index) in penyakit.data"
                                :key="penyakit.id"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ penyakit.kode }}</td>
                                <td>{{ penyakit.nama }}</td>
                                <td>
                                    {{
                                        penyakit.kelompok
                                            .charAt(0)
                                            .toUpperCase() +
                                        penyakit.kelompok.slice(1)
                                    }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <Link
                                            class="btn btn-xs btn-secondary"
                                            :href="
                                                route(
                                                    'master.penyakit.edit',
                                                    penyakit.id
                                                )
                                            "
                                        >
                                            <i class="fas fa-edit"></i>
                                        </Link>

                                        <Link
                                            @click="destroy(penyakit.id)"
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
                    :links="penyakit.links"
                    :from="penyakit.from"
                    :to="penyakit.to"
                    :total="penyakit.total"
                />
            </div>
        </div>
    </AuthenticatedLayout>

    <ImportModal
        target="modal-import-penyakit"
        title="Import Data Penyakit"
        template="penyakit.xlsx"
        route="excel.import.penyakit"
    />
</template>
