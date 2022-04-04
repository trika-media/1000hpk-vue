<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Alert from "@/Components/Alert.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { computed } from "@vue/runtime-core";

const form = useForm({
    kode: "",
    nama: "",
});
const submit = () => {
    form.post(route("master.fakultas.store"));
};
</script>

<template>
    <Head title="Tambah Fakultas" />

    <AuthenticatedLayout>
        <template #heading> Tambah Data Fakultas </template>

        <template #subheading> Menambah data fakultas. </template>

        <template #button>
            <Link
                :href="route('master.fakultas.index')"
                class="btn btn-sm btn-white d-inline-flex align-items-center"
            >
                <i class="fas fa-arrow-left me-3"></i>
                Kembali
            </Link>
        </template>

        <Alert />

        <form class="card" @submit.prevent="submit">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="kode">Kode</label>

                            <div class="input-group">
                                <input
                                    :class="{ 'is-invalid': form.errors.kode }"
                                    class="form-control"
                                    id="kode"
                                    v-model="form.kode"
                                    type="text"
                                    autofocus
                                    required
                                    autocomplete="kode-fakultas"
                                    placeholder="masukkan kode fakultas"
                                />

                                <div
                                    v-if="form.errors.kode"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.kode }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="nama">Nama</label>

                            <div class="input-group">
                                <input
                                    :class="{ 'is-invalid': form.errors.nama }"
                                    class="form-control"
                                    id="nama"
                                    v-model="form.nama"
                                    type="text"
                                    required
                                    autocomplete="nama-fakultas"
                                    placeholder="masukkan nama fakultas"
                                />

                                <div
                                    v-if="form.errors.nama"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.nama }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button
                    type="submit"
                    class="btn btn-gray-800"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Simpan
                </button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
