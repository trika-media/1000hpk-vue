<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { computed, onMounted, ref } from '@vue/runtime-core';
import axios from 'axios';

const props = defineProps({
    puskesmas: Object,
});

const data_provinsi = ref([]);
const data_kabupaten = ref([]);
const data_kecamatan = ref([]);
const data_kelurahan = ref([]);

const form = useForm({
    nama: props.puskesmas.nama,
    alamat: props.puskesmas.alamat,

    provinsi: props.puskesmas.provinsi_id,
    kabupaten: props.puskesmas.kabupaten_id,
    kecamatan: props.puskesmas.kecamatan_id,
    kelurahan: props.puskesmas.kelurahan_id,

    lat: props.puskesmas.lat,
    lng: props.puskesmas.lng,
});

const getProvinsi = () => {
    axios.get(route('api.indonesia.provinsi'))
        .then(response => (data_provinsi.value = response.data));
}

const getKabupaten = () => {
    axios.get(route('api.indonesia.kabupaten', { provinsi: form.provinsi }))
        .then(response => (data_kabupaten.value = response.data));
}

const getKecamatan = () => {
    axios.get(route('api.indonesia.kecamatan', { kabupaten: form.kabupaten }))
        .then(response => (data_kecamatan.value = response.data));
}

const getKelurahan = () => {
    axios.get(route('api.indonesia.kelurahan', { kecamatan: form.kecamatan }))
        .then(response => (data_kelurahan.value = response.data));
}

onMounted(() => {
    getProvinsi();
    getKabupaten();
    getKecamatan();
    getKelurahan();
});

const submit = () => {
    form.put(route('master.puskesmas.update', { puskesmas: props.puskesmas.id }));
};
</script>

<template>
    <Head title="Sunting Puskesmas" />

    <AuthenticatedLayout>
        <template #heading>
            Sunting Data Puskesmas
        </template>

        <template #subheading>
            Menyunting data puskesmas.
        </template>

        <template #button>
            <Link :href="route('master.puskesmas.index')" class="btn btn-sm btn-white d-inline-flex align-items-center">
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
                            <label for="nama">Nama</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.nama}"
                                    class="form-control"
                                    id="nama"
                                    v-model="form.nama"
                                    type="text"
                                    required
                                    autocomplete="nama-puskesmas"
                                    placeholder="masukkan nama puskesmas"
                                >

                                <div v-if="form.errors.nama" class="invalid-feedback">
                                    {{ form.errors.nama }}
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
                                    required
                                    placeholder="masukkan alamat puskesmas"
                                    rows="3"
                                ></textarea>

                                <div v-if="form.errors.alamat" class="invalid-feedback">
                                    {{ form.errors.alamat }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="provinsi">Provinsi</label>

                            <div class="input-group">
                                <select
                                    :class="{'is-invalid': form.errors.provinsi}"
                                    class="form-control"
                                    id="provinsi"
                                    v-model="form.provinsi"
                                    required
                                    autocomplete="provinsi-puskesmas"
                                    @change="getKabupaten"
                                >
                                    <option value="" selected disabled> - Pilih - </option>
                                    <option
                                        v-for="provinsi in data_provinsi"
                                        :value="provinsi.id"
                                        :key="provinsi.id"
                                    >{{ provinsi.name }}</option>
                                </select>

                                <div v-if="form.errors.provinsi" class="invalid-feedback">
                                    {{ form.errors.provinsi }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4" v-if="form.provinsi">
                            <label for="kabupaten">Kabupaten</label>

                            <div class="input-group">
                                <select
                                    :class="{'is-invalid': form.errors.kabupaten}"
                                    class="form-control"
                                    id="kabupaten"
                                    v-model="form.kabupaten"
                                    required
                                    autocomplete="kabupaten-puskesmas"
                                    @change="getKecamatan"
                                >
                                    <option value="" selected disabled> - Pilih - </option>
                                    <option
                                        v-for="kabupaten in data_kabupaten"
                                        :value="kabupaten.id"
                                        :key="kabupaten.id"
                                    >{{ kabupaten.name }}</option>
                                </select>

                                <div v-if="form.errors.kabupaten" class="invalid-feedback">
                                    {{ form.errors.kabupaten }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4" v-if="form.kabupaten">
                            <label for="kecamatan">Kecamatan</label>

                            <div class="input-group">
                                <select
                                    :class="{'is-invalid': form.errors.kecamatan}"
                                    class="form-control"
                                    id="kecamatan"
                                    v-model="form.kecamatan"
                                    required
                                    autocomplete="kecamatan-puskesmas"
                                    @change="getKelurahan"
                                >
                                    <option value="" selected disabled> - Pilih - </option>
                                    <option
                                        v-for="kecamatan in data_kecamatan"
                                        :value="kecamatan.id"
                                        :key="kecamatan.id"
                                    >{{ kecamatan.name }}</option>
                                </select>

                                <div v-if="form.errors.kecamatan" class="invalid-feedback">
                                    {{ form.errors.kecamatan }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4" v-if="form.kecamatan">
                            <label for="kelurahan">Kelurahan</label>

                            <div class="input-group">
                                <select
                                    :class="{'is-invalid': form.errors.kelurahan}"
                                    class="form-control"
                                    id="kelurahan"
                                    v-model="form.kelurahan"
                                    required
                                    autocomplete="kelurahan-puskesmas"
                                >
                                    <option value="" selected disabled> - Pilih - </option>
                                    <option
                                        v-for="kelurahan in data_kelurahan"
                                        :value="kelurahan.id"
                                        :key="kelurahan.id"
                                    >{{ kelurahan.name }}</option>
                                </select>

                                <div v-if="form.errors.kelurahan" class="invalid-feedback">
                                    {{ form.errors.kelurahan }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">

                    </div>
                </div>
            </div>

            <div class="card-footer bg-gray-100 text-muted">
                <div class="mb-3">
                    <b>Opsional</b>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="lat">Latitude</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.lat}"
                                    class="form-control"
                                    id="lat"
                                    v-model="form.lat"
                                    type="text"
                                    autocomplete="lat-puskesmas"
                                    placeholder="masukkan latitude puskesmas"
                                >

                                <div v-if="form.errors.lat" class="invalid-feedback">
                                    {{ form.errors.lat }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="lng">Longitude</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.lng}"
                                    class="form-control"
                                    id="lng"
                                    v-model="form.lng"
                                    type="text"
                                    autocomplete="lng-puskesmas"
                                    placeholder="masukkan longitude puskesmas"
                                >

                                <div v-if="form.errors.lng" class="invalid-feedback">
                                    {{ form.errors.lng }}
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