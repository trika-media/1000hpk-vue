<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import { computed, ref } from '@vue/runtime-core';

const props = defineProps({
    jenis_kelamin: Array,
    mahasiswa: Object,
});

const jenis_kelamin = computed(() => props.jenis_kelamin);

const form = useForm({
    nim: props.mahasiswa.nim,
    nama: props.mahasiswa.nama,
    angkatan: props.mahasiswa.angkatan,
    nomor_ponsel: props.mahasiswa.nomor_ponsel,
    alamat: props.mahasiswa.alamat,
    jenis_kelamin: props.mahasiswa.jenis_kelamin,
});

const submit = () => {
    form.post(route('user.data-diri.store'));
};
</script>

<template>
    <Head title="Data Diri" />

    <AuthenticatedLayout>
        <template #heading>
            Data Diri
        </template>

        <template #subheading>
            Perbaharui data mahasiswa Anda di sini.
        </template>

        <Alert />

        <form class="card" @submit.prevent="submit" >
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="nim">NIM</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.nim}"
                                    class="form-control"
                                    id="nim"
                                    v-model="form.nim"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="nim"
                                    placeholder="masukkan nim"
                                >

                                <div v-if="form.errors.nama" class="invalid-feedback">
                                    {{ form.errors.nama }}
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
                                    autocomplete="nama"
                                    placeholder="masukkan nama lengkap"
                                >

                                <div v-if="form.errors.nama" class="invalid-feedback">
                                    {{ form.errors.nama }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="angkatan">Angkatan</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.angkatan}"
                                    class="form-control"
                                    id="angkatan"
                                    v-model="form.angkatan"
                                    type="number"
                                    min="1945"
                                    max="2100"
                                    required
                                    autocomplete="angkatan"
                                    placeholder="masukkan angkatan"
                                >

                                <div v-if="form.errors.nama" class="invalid-feedback">
                                    {{ form.errors.nama }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="nomor_ponsel">Nomor Ponsel</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.nomor_ponsel}"
                                    class="form-control"
                                    id="nomor_ponsel"
                                    v-model="form.nomor_ponsel"
                                    type="text"
                                    autocomplete="nomor_ponsel"
                                    placeholder="masukkan nomor ponsel"
                                >

                                <div v-if="form.errors.nomor_ponsel" class="invalid-feedback">
                                    {{ form.errors.nomor_ponsel }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="alamat">Alamat</label>

                            <div class="input-group">
                                <textarea
                                    :class="{'is-invalid': form.errors.alamat}"
                                    class="form-control"
                                    id="alamat"
                                    v-model="form.alamat"
                                    type="text"
                                    placeholder="masukkan alamat puskesmas"
                                    rows="3"
                                ></textarea>

                                <div v-if="form.errors.alamat" class="invalid-feedback">
                                    {{ form.errors.alamat }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="jenis_kelamin">Jenis Kelamin</label>

                            <div class="form-check" v-for="item in jenis_kelamin" :key="item">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    v-model="form.jenis_kelamin"
                                    :id="'radio-' + item"
                                    :value="item"
                                >

                                <label
                                    class="form-check-label"
                                    :for="'radio-' + item"
                                    style="text-transform:capitalize;font-weight:normal"
                                >
                                    {{ item }}
                                </label>
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
