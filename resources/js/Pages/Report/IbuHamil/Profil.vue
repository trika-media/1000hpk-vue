<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Pagination from "@/Components/Datatable/Pagination.vue";
import Rows from "@/Components/Datatable/Rows.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/runtime-core";

const props = defineProps({
    ibuhamil: Object,
});

const ibuhamil = computed(() => props.ibuhamil);
</script>

<template>
    <Head title="Laporan Ibu Hamil" />

    <AuthenticatedLayout>
        <template #heading> Laporan Ibu Hamil </template>

        <template #subheading> Menampilkan laporan profil ibu hamil. </template>

        <template #button>
            <a
                :href="route('pdf.ibu-hamil.profil')"
                target="_blank"
                class="btn btn-sm btn-danger d-inline-flex align-items-center"
            >
                <i class="fas fa-file-pdf me-3"></i>

                PDF
            </a>
        </template>

        <div class="card">
            <div class="table-responsive">
                <table
                    class="table table-sm table-bordered table-striped align-middle"
                >
                    <thead>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Kab/Kota</th>
                        <th>Provinsi</th>
                        <th>Nomor Ponsel</th>
                        <th>Tanggal Lahir</th>
                    </thead>

                    <tbody>
                        <Rows :data="ibuhamil.data" colspan="6">
                            <tr
                                v-for="ibuhamil in ibuhamil.data"
                                :key="ibuhamil.id"
                            >
                                <td>{{ ibuhamil.nama }}</td>
                                <td>{{ ibuhamil.alamat }}</td>
                                <td>{{ ibuhamil.kabupaten.name }}</td>
                                <td>{{ ibuhamil.provinsi.name }}</td>
                                <td>{{ ibuhamil.nomor_ponsel }}</td>
                                <td>{{ ibuhamil.tanggal_lahir }}</td>
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
