<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Alert from "@/Components/Alert.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { computed } from "@vue/runtime-core";

const props = defineProps({
    prodi: Object,
    fakultas: Object,
});

const form = useForm({
    fakultas: props.prodi.fakultas_id,
    nama: props.prodi.nama,
});

const submit = () => {
    form.put(route("master.prodi.update", { prodi: props.prodi.id }));
};
</script>

<template>
    <Head title="Sunting Prodi" />

    <AuthenticatedLayout>
        <template #heading> Sunting Data Prodi </template>

        <template #subheading> Menyunting data prodi. </template>

        <template #button>
            <Link
                :href="route('master.prodi.index')"
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
                            <label for="fakultas">Fakultas</label>

                            <div class="input-group">
                                <select
                                    :class="{
                                        'is-invalid': form.errors.fakultas,
                                    }"
                                    class="form-control"
                                    id="fakultas"
                                    v-model="form.fakultas"
                                    required
                                    autocomplete="fakultas-ibu-hamil"
                                >
                                    <option value="" selected disabled>
                                        - Pilih -
                                    </option>
                                    <option
                                        v-for="fakultas in props.fakultas"
                                        :value="fakultas.id"
                                        :key="fakultas.id"
                                    >
                                        {{ fakultas.nama }}
                                    </option>
                                </select>

                                <div
                                    v-if="form.errors.fakultas"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.fakultas }}
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
                                    autocomplete="nama-prodi"
                                    placeholder="masukkan nama prodi"
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
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
