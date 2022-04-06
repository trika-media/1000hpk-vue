<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Pagination from "@/Components/Datatable/Pagination.vue";
import Rows from "@/Components/Datatable/Rows.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import { computed, ref } from "@vue/runtime-core";

// SEARCH FUNCTION

const here = route().current();
const params = route().params;
const query = ref(params.angkatan || "");

const search = () => {
    Inertia.get(
        route(here),
        {
            angkatan: query.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};

// END SEARCH FUNCTION

const props = defineProps({
    mahasiswa: Object,
    angkatan: Array,
});

const mahasiswa = computed(() => props.mahasiswa);
const angkatan = computed(() => props.angkatan);
</script>

<template>
    <Head title="Laporan Mahasiswa" />

    <AuthenticatedLayout>
        <template #heading> Laporan Mahasiswa Per Angkatan </template>

        <template #subheading>
            Menampilkan laporan mahasiswa per-angkatan.
        </template>

        <template #button>
            <a
                :href="
                    route('pdf.mahasiswa.per-angkatan') +
                    '?angkatan=' +
                    params.angkatan
                "
                target="_blank"
                class="btn btn-sm btn-danger d-inline-flex align-items-center"
            >
                <i class="fas fa-file-pdf me-3"></i>

                PDF
            </a>
        </template>

        <div class="table-settings mb-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-9 col-lg-8 d-md-flex">
                    <div class="input-group me-2 me-lg-3 fmxw-300">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>

                        <select
                            class="form-control"
                            v-model="query"
                            @change="search"
                        >
                            <option value="" selected>
                                - Pilih Angkatan -
                            </option>

                            <option
                                v-for="angkatan in angkatan"
                                :value="angkatan"
                                :key="angkatan"
                            >
                                {{ angkatan }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table
                    class="table table-sm table-bordered table-striped align-middle"
                >
                    <thead>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Tahun Angkatan</th>
                        <th>Email</th>
                        <th>Nomor Ponsel</th>
                    </thead>

                    <tbody>
                        <Rows :data="mahasiswa.data" colspan="6">
                            <tr
                                v-for="mahasiswa in mahasiswa.data"
                                :key="mahasiswa.id"
                            >
                                <td>{{ mahasiswa.nim }}</td>
                                <td>{{ mahasiswa.nama }}</td>
                                <td>{{ mahasiswa.angkatan }}</td>
                                <td>{{ mahasiswa.akun.email }}</td>
                                <td>{{ mahasiswa.nomor_ponsel }}</td>
                            </tr>
                        </Rows>
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
