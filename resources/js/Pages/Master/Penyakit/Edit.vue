<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import { computed } from '@vue/runtime-core';
const props = defineProps({
    kelompok: Object,
    penyakit: Object,
});
const kelompok = computed(() => props.kelompok);
const form = useForm({
    kode: props.penyakit.kode,
    nama: props.penyakit.nama,
    kelompok: props.penyakit.kelompok,
});
const submit = () => {
    form.put(route('master.penyakit.update', {penyakit: props.penyakit.id}));
};
</script>

<template>
    <Head title="Sunting Penyakit" />

    <AuthenticatedLayout>
        <template #heading>
            Sunting Data Penyakit
        </template>

        <template #subheading>
            Menyunting data penyakit.
        </template>

        <template #button>
            <Link :href="route('master.penyakit.index')" class="btn btn-sm btn-white d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-3"></i>
                Kembali
            </Link>
        </template>

        <Alert />

        <form class="card" @submit.prevent="submit" >
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="kode">Kode</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.kode}"
                                    class="form-control"
                                    id="kode"
                                    v-model="form.kode"
                                    type="text"
                                    autofocus
                                    required
                                    autocomplete="kode-penyakit"
                                    placeholder="masukkan kode penyakit"
                                >

                                <div v-if="form.errors.kode" class="invalid-feedback">
                                    {{ form.errors.kode }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="nama">Nama</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.nama}"
                                    class="form-control"
                                    id="nama"
                                    v-model="form.nama"
                                    type="text"
                                    required
                                    autocomplete="nama-penyakit"
                                    placeholder="masukkan nama penyakit"
                                >

                                <div v-if="form.errors.nama" class="invalid-feedback">
                                    {{ form.errors.nama }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="kelompok">Kelompok</label>

                            <div class="input-group">
                                <select
                                    :class="{'is-invalid': form.errors.kelompok}"
                                    class="form-control"
                                    id="kelompok"
                                    v-model="form.kelompok"
                                    required
                                    autocomplete="kelompok-penyakit"
                                >
                                    <option value="" selected disabled> - Pilih - </option>
                                    <option
                                        v-for="(kelompok, index) in kelompok"
                                        :value="kelompok"
                                        :key="index"
                                    >{{ kelompok.charAt(0).toUpperCase() + kelompok.slice(1) }}</option>
                                </select>

                                <div v-if="form.errors.kelompok" class="invalid-feedback">
                                    {{ form.errors.kelompok }}
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
                >Simpan Perubahan</button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>