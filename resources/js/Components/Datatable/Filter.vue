<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import { ref } from '@vue/reactivity';

// Route
const here = route().current();
const params = route().params;

// Ref
const query = ref(params.q || '');
const per_page = ref(params.per_page || 10);

// Function
const search = () => {
    Inertia.get(route(here), {
        q: query.value,
        per_page: per_page.value,
    }, {
        preserveState: true,
        preserveScroll: true
    });
}

const changePerPage = (row) => {
    per_page.value = row;
    search();
}

const reset = () => {
    Inertia.get(route(here), {},{
        preserveState: true,
        preserveScroll: true
    });
}
</script>

<template>
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <div class="input-group me-2 me-lg-3 fmxw-300">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>

                    <input
                        type="search"
                        class="form-control"
                        placeholder="Cari..."
                        autofocus
                        v-model="query"
                        @keyup="search"
                    />
                </div>

                <slot />
            </div>

            <div class="col-3 col-lg-4 d-flex justify-content-end">
                <div class="btn-group">
                    <div class="dropdown me-1">
                        <button class="btn text-dark dropdown-toggle dropdown-toggle-split m-0 p-1" @click="reset">
                            <i class="fas fa-repeat font-weight-bold"></i>
                            <span class="visually-hidden">Reset Filter</span>
                        </button>
                    </div>

                    <div class="dropdown me-1">
                        <button
                            class="btn text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="fas fa-sliders font-weight-bold"></i>
                            <span class="visually-hidden">Per Halaman</span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end pb-0">
                            <span class="small ps-3 fw-bold text-dark">Tampilkan</span>

                            <button class="dropdown-item fw-bold d-flex align-items-center" @click="changePerPage(10)">
                                <span>10</span>
                                <i class="fas fa-check ms-auto" v-if="per_page == 10"></i>
                            </button>

                            <button class="dropdown-item fw-bold d-flex align-items-center" @click="changePerPage(50)">
                                <span>50</span>
                                <i class="fas fa-check ms-auto" v-if="per_page == 50"></i>
                            </button>

                            <button class="dropdown-item fw-bold d-flex align-items-center rounded-bottom" @click="changePerPage(100)">
                                <span>100</span>
                                <i class="fas fa-check ms-auto" v-if="per_page == 100"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>