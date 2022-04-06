<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Pagination from "@/Components/Datatable/Pagination.vue";
import Rows from "@/Components/Datatable/Rows.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/runtime-core";

const props = defineProps({
    keluhan: Object,
});

const keluhan = computed(() => props.keluhan);
</script>

<template>
    <Head title="Laporan Jumlah Penyakit Terbanyak" />

    <AuthenticatedLayout>
        <template #heading> Laporan Jumlah Penyakit Terbanyak </template>

        <template #subheading>
            Menampilkan jumlah keluhan penyakit terbanyak.
        </template>

        <template #button>
            <a
                :href="route('pdf.penyakit.jumlah-terbanyak')"
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
                        <th>Nama Penyakit</th>
                        <th>Jumlah</th>
                    </thead>

                    <tbody>
                        <tr v-for="(keluhan, index) in keluhan" :key="index">
                            <td>{{ keluhan.nama }}</td>
                            <td>{{ keluhan.jumlah }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
