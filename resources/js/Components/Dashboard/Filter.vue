<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "@vue/reactivity";

// Route
const here = route().current();
const params = route().params;

// Ref
const tanggal_awal = ref(params.awal);
const tanggal_akhir = ref(params.akhir);

// Function
const filter = () => {
    Inertia.get(
        route(here),
        {
            awal: tanggal_awal.value,
            akhir: tanggal_akhir.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};

const reset = () => {
    Inertia.get(route(here));
};
</script>

<template>
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <div class="input-group me-2 me-lg-3 w-50">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>

                    <input
                        type="date"
                        class="form-control"
                        v-model="tanggal_awal"
                        @change="filter"
                    />

                    <input
                        type="date"
                        class="form-control"
                        v-model="tanggal_akhir"
                        @change="filter"
                    />
                </div>
            </div>

            <div class="col-3 col-lg-4 d-flex justify-content-end">
                <div class="btn-group">
                    <div class="dropdown me-1">
                        <button
                            class="btn text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                            @click="reset"
                        >
                            <i class="fas fa-repeat font-weight-bold"></i>
                            <span class="visually-hidden">Reset Filter</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
