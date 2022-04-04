<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Alert from "@/Components/Alert.vue";
import VueMultiselect from "vue-multiselect";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { computed, onMounted, ref } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import {
    LMap,
    LTileLayer,
    LMarker,
    LTooltip,
    LControl,
    LControlAttribution,
} from "@vue-leaflet/vue-leaflet";
import axios from "axios";
import "leaflet/dist/leaflet.css";
import "vue-multiselect/dist/vue-multiselect.css";

const props = defineProps({
    puskesmas: Object,
    penyakit: Object,
});

const location = ref({
    available: false,
    lat: "",
    lng: "",
});

const data_provinsi = ref([]);
const data_kabupaten = ref([]);
const data_kecamatan = ref([]);
const data_kelurahan = ref([]);

const form = useForm({
    identitas: "",
    nama: "",
    alamat: "",
    nomor_ponsel: "",

    puskesmas: "",
    keluhan: [],

    provinsi: "",
    kabupaten: "",
    kecamatan: "",
    kelurahan: "",

    lat: "",
    lng: "",
});

const setPosition = (position) => {
    location.value.lat = position.coords.latitude;
    location.value.lng = position.coords.longitude;
};

const getPosition = () => {
    if (navigator.geolocation) {
        location.value.available = true;
        navigator.geolocation.getCurrentPosition(setPosition);
    } else {
        location.value.available = false;
    }
};

const addMarker = (event) => {
    if (event.latlng) {
        location.value.lat = event.latlng.lat;
        location.value.lng = event.latlng.lng;

        updateFormLatLng(event.latlng);
    }
};

const updateMarker = (position) => {
    location.value.lat = position.lat;
    location.value.lng = position.lng;

    updateFormLatLng(position);
};

const updateFormLatLng = (position) => {
    form.lat = position.lat;
    form.lng = position.lng;
};

const getProvinsi = () => {
    axios
        .get(route("api.indonesia.provinsi"))
        .then((response) => (data_provinsi.value = response.data));
};

const getKabupaten = () => {
    axios
        .get(route("api.indonesia.kabupaten", { provinsi: form.provinsi }))
        .then((response) => (data_kabupaten.value = response.data));
};

const getKecamatan = () => {
    axios
        .get(route("api.indonesia.kecamatan", { kabupaten: form.kabupaten }))
        .then((response) => (data_kecamatan.value = response.data));
};

const getKelurahan = () => {
    axios
        .get(route("api.indonesia.kelurahan", { kecamatan: form.kecamatan }))
        .then((response) => (data_kelurahan.value = response.data));
};

onMounted(() => {
    getProvinsi();
    getPosition();
});

const submit = () => {
    form.post(route("user.ibu-hamil.store"));
};
</script>

<template>
    <Head title="Tambah Ibu Hamil" />

    <AuthenticatedLayout>
        <template #heading> Tambah Data Ibu Hamil </template>

        <template #subheading> Menambah data ibu hamil. </template>

        <template #button>
            <Link
                :href="route('ibu-hamil.index')"
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
                            <label for="identitas"
                                >Nomor Identitas (KTP / SIM / BPJS)</label
                            >

                            <div class="input-group">
                                <input
                                    :class="{
                                        'is-invalid': form.errors.identitas,
                                    }"
                                    class="form-control"
                                    id="identitas"
                                    v-model="form.identitas"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="identitas"
                                    placeholder="masukkan identitas"
                                />

                                <div
                                    v-if="form.errors.identitas"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.identitas }}
                                </div>
                            </div>
                        </div>

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
                                    autocomplete="nama"
                                    placeholder="masukkan nama lengkap"
                                />

                                <div
                                    v-if="form.errors.nama"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.nama }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="nomor_ponsel">Nomor Ponsel</label>

                            <div class="input-group">
                                <input
                                    :class="{
                                        'is-invalid': form.errors.nomor_ponsel,
                                    }"
                                    class="form-control"
                                    id="nomor_ponsel"
                                    v-model="form.nomor_ponsel"
                                    type="text"
                                    autocomplete="nomor_ponsel"
                                    placeholder="masukkan nomor ponsel"
                                />

                                <div
                                    v-if="form.errors.nomor_ponsel"
                                    class="invalid-feedback"
                                >
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
                                    :class="{
                                        'is-invalid': form.errors.alamat,
                                    }"
                                    class="form-control"
                                    id="alamat"
                                    v-model="form.alamat"
                                    type="text"
                                    placeholder="masukkan alamat puskesmas"
                                    rows="3"
                                ></textarea>

                                <div
                                    v-if="form.errors.alamat"
                                    class="invalid-feedback"
                                >
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
                            <label for="puskesmas">Puskesmas</label>

                            <div class="input-group">
                                <select
                                    :class="{
                                        'is-invalid': form.errors.puskesmas,
                                    }"
                                    class="form-control"
                                    id="puskesmas"
                                    v-model="form.puskesmas"
                                    required
                                    autocomplete="puskesmas-ibu-hamil"
                                >
                                    <option value="" selected disabled>
                                        - Pilih -
                                    </option>
                                    <option
                                        v-for="puskesmas in props.puskesmas"
                                        :value="puskesmas.id"
                                        :key="puskesmas.id"
                                    >
                                        {{ puskesmas.nama }}
                                    </option>
                                </select>

                                <div
                                    v-if="form.errors.puskesmas"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.puskesmas }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="keluhan">Keluhan</label>

                            <VueMultiselect
                                id="keluhan"
                                v-model="form.keluhan"
                                :options="props.penyakit"
                                :multiple="true"
                                :hideSelected="true"
                                placeholder="- Pilih -"
                                label="nama"
                                track-by="nama"
                                openDirection="bottom"
                                selectLabel=""
                            />

                            <div
                                v-if="form.errors.keluhan"
                                class="invalid-feedback"
                            >
                                {{ form.errors.keluhan }}
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
                                    :class="{
                                        'is-invalid': form.errors.provinsi,
                                    }"
                                    class="form-control"
                                    id="provinsi"
                                    v-model="form.provinsi"
                                    required
                                    autocomplete="provinsi-ibu-hamil"
                                    @change="getKabupaten"
                                >
                                    <option value="" selected disabled>
                                        - Pilih -
                                    </option>
                                    <option
                                        v-for="provinsi in data_provinsi"
                                        :value="provinsi.id"
                                        :key="provinsi.id"
                                    >
                                        {{ provinsi.name }}
                                    </option>
                                </select>

                                <div
                                    v-if="form.errors.provinsi"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.provinsi }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4" v-if="form.provinsi">
                            <label for="kabupaten">Kabupaten</label>

                            <div class="input-group">
                                <select
                                    :class="{
                                        'is-invalid': form.errors.kabupaten,
                                    }"
                                    class="form-control"
                                    id="kabupaten"
                                    v-model="form.kabupaten"
                                    required
                                    autocomplete="kabupaten-ibu-hamil"
                                    @change="getKecamatan"
                                >
                                    <option value="" selected disabled>
                                        - Pilih -
                                    </option>
                                    <option
                                        v-for="kabupaten in data_kabupaten"
                                        :value="kabupaten.id"
                                        :key="kabupaten.id"
                                    >
                                        {{ kabupaten.name }}
                                    </option>
                                </select>

                                <div
                                    v-if="form.errors.kabupaten"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.kabupaten }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4" v-if="form.kabupaten">
                            <label for="kecamatan">Kecamatan</label>

                            <div class="input-group">
                                <select
                                    :class="{
                                        'is-invalid': form.errors.kecamatan,
                                    }"
                                    class="form-control"
                                    id="kecamatan"
                                    v-model="form.kecamatan"
                                    required
                                    autocomplete="kecamatan-ibu-hamil"
                                    @change="getKelurahan"
                                >
                                    <option value="" selected disabled>
                                        - Pilih -
                                    </option>
                                    <option
                                        v-for="kecamatan in data_kecamatan"
                                        :value="kecamatan.id"
                                        :key="kecamatan.id"
                                    >
                                        {{ kecamatan.name }}
                                    </option>
                                </select>

                                <div
                                    v-if="form.errors.kecamatan"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.kecamatan }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4" v-if="form.kecamatan">
                            <label for="kelurahan">Kelurahan</label>

                            <div class="input-group">
                                <select
                                    :class="{
                                        'is-invalid': form.errors.kelurahan,
                                    }"
                                    class="form-control"
                                    id="kelurahan"
                                    v-model="form.kelurahan"
                                    required
                                    autocomplete="kelurahan-ibu-hamil"
                                >
                                    <option value="" selected disabled>
                                        - Pilih -
                                    </option>
                                    <option
                                        v-for="kelurahan in data_kelurahan"
                                        :value="kelurahan.id"
                                        :key="kelurahan.id"
                                    >
                                        {{ kelurahan.name }}
                                    </option>
                                </select>

                                <div
                                    v-if="form.errors.kelurahan"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.kelurahan }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6"></div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row" v-if="location.available">
                    <div class="col-12">
                        <label for="map">Pilih Titik pada Peta</label>

                        <div class="border rounded">
                            <LMap
                                style="height: 300px"
                                :minZoom="5"
                                :zoom="18"
                                :maxZoom="18"
                                :center="[location.lat, location.lng]"
                                @click="addMarker"
                            >
                                <LControlAttribution
                                    :prefix="$page.props.app.name"
                                />

                                <LTileLayer
                                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                                    layer-type="base"
                                    name="OpenStreetMap"
                                ></LTileLayer>

                                <LMarker
                                    :lat-lng="[location.lat, location.lng]"
                                    draggable
                                    @update:latLng="updateMarker"
                                >
                                    <LTooltip>
                                        <b>Anda telah memilih:</b> <br />
                                        Lat : {{ location.lat }} <br />
                                        Lng : {{ location.lng }} <br />
                                    </LTooltip>
                                </LMarker>
                            </LMap>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="lat">Latitude</label>

                            <div class="input-group">
                                <input
                                    :class="{ 'is-invalid': form.errors.lat }"
                                    class="form-control"
                                    id="lat"
                                    v-model="form.lat"
                                    type="text"
                                    autocomplete="lat-ibu-hamil"
                                    placeholder="pilih pada peta ..."
                                    :readonly="location.available"
                                    required
                                />

                                <div
                                    v-if="form.errors.lat"
                                    class="invalid-feedback"
                                >
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
                                    :class="{ 'is-invalid': form.errors.lng }"
                                    class="form-control"
                                    id="lng"
                                    v-model="form.lng"
                                    type="text"
                                    autocomplete="lng-ibu-hamil"
                                    placeholder="pilih pada peta ..."
                                    :readonly="location.available"
                                    required
                                />

                                <div
                                    v-if="form.errors.lng"
                                    class="invalid-feedback"
                                >
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
                >
                    Simpan
                </button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>

<style>
.multiselect__tag {
    background: #f0bc74 !important;
}
.multiselect__tags {
    color: #6b7280 !important;
    border: 0.0625rem solid #d1d5db !important;
    border-radius: 0.5rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07);
}
.multiselect__tag-icon::after {
    color: #bf9355 !important;
}
.multiselect__option--highlight {
    background: #f0bc74 !important;
}
.multiselect__option--highlight::after {
    background: #f0bc74 !important;
}
</style>
