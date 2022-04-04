<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Alert from "@/Components/Alert.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { computed, onMounted, ref } from "@vue/runtime-core";

const props = defineProps({
    jenis_kelamin: Array,
    pengguna: Object,
});

const data_fakultas = ref([]);
const data_prodi = ref([]);

const jenis_kelamin = computed(() => props.jenis_kelamin);
const pengguna = computed(() => props.pengguna);
const buat_akun = computed(() => {
    return {
        none: "Tanpa akun",
        select: "Pilih dari pengguna",
        input: "Tambah Baru",
    };
});

const getFakultas = () => {
    axios
        .get(route("api.master.fakultas"))
        .then((response) => (data_fakultas.value = response.data));
};

const getProdi = () => {
    axios
        .get(route("api.master.prodi", { fakultas: form.fakultas }))
        .then((response) => (data_prodi.value = response.data));
};

const form = useForm({
    fakultas: "",
    prodi: "",

    nim: "",
    nama: "",
    angkatan: "",
    nomor_ponsel: null,
    alamat: null,
    jenis_kelamin: null,

    akun: "none", // none, select, input
    akun_id: "",

    akun_email: null,
    akun_password: null,
});

onMounted(() => {
    getFakultas();
});

const submit = () => {
    form.post(route("mahasiswa.store"));
};
</script>

<template>
    <Head title="Tambah Mahasiswa" />

    <AuthenticatedLayout>
        <template #heading> Tambah Mahasiswa </template>

        <template #subheading> Menambah data mahasiswa. </template>

        <template #button>
            <Link
                :href="route('mahasiswa.index')"
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
                            <label for="nim">NIM</label>

                            <div class="input-group">
                                <input
                                    :class="{ 'is-invalid': form.errors.nim }"
                                    class="form-control"
                                    id="nim"
                                    v-model="form.nim"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="nim"
                                    placeholder="masukkan nim"
                                />

                                <div
                                    v-if="form.errors.nim"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.nim }}
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
                            <label for="angkatan">Angkatan</label>

                            <div class="input-group">
                                <input
                                    :class="{
                                        'is-invalid': form.errors.angkatan,
                                    }"
                                    class="form-control"
                                    id="angkatan"
                                    v-model="form.angkatan"
                                    type="number"
                                    min="1945"
                                    max="2100"
                                    required
                                    autocomplete="angkatan"
                                    placeholder="masukkan angkatan"
                                />

                                <div
                                    v-if="form.errors.angkatan"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.angkatan }}
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

                        <div class="form-group mb-4">
                            <label for="jenis_kelamin">Jenis Kelamin</label>

                            <div
                                class="form-check"
                                v-for="item in jenis_kelamin"
                                :key="item"
                            >
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    v-model="form.jenis_kelamin"
                                    :id="'radio-' + item"
                                    :value="item"
                                />

                                <label
                                    class="form-check-label"
                                    :for="'radio-' + item"
                                    style="
                                        text-transform: capitalize;
                                        font-weight: normal;
                                    "
                                >
                                    {{ item }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
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
                                    autocomplete="fakultas"
                                    @change="getProdi"
                                >
                                    <option value="" selected disabled>
                                        - Pilih -
                                    </option>
                                    <option
                                        v-for="fakultas in data_fakultas"
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
                            <label for="prodi">Prodi</label>

                            <div class="input-group">
                                <select
                                    :class="{ 'is-invalid': form.errors.prodi }"
                                    class="form-control"
                                    id="prodi"
                                    v-model="form.prodi"
                                    required
                                    autocomplete="prodi"
                                >
                                    <option value="" selected disabled>
                                        - Pilih -
                                    </option>
                                    <option
                                        v-for="prodi in data_prodi"
                                        :value="prodi.id"
                                        :key="prodi.id"
                                    >
                                        {{ prodi.nama }}
                                    </option>
                                </select>

                                <div
                                    v-if="form.errors.prodi"
                                    class="invalid-feedback"
                                >
                                    {{ form.errors.prodi }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-gray-100">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <label for="akun">Buat Akun</label>
                        <p class="mb-0">Pilih cara membuat akun mahasiswa.</p>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group mt-2">
                            <div class="input-group">
                                <select
                                    class="form-control"
                                    id="akun"
                                    v-model="form.akun"
                                    required
                                    autocomplete="akun"
                                >
                                    <option value="" selected disabled>
                                        - Pilih -
                                    </option>
                                    <option
                                        v-for="(cara, index) in buat_akun"
                                        :value="index"
                                        :key="index"
                                    >
                                        {{ cara }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="card-footer"
                v-if="['select', 'input'].includes(form.akun)"
            >
                <div id="pilih" v-if="form.akun == 'select'">
                    <div class="row" v-if="pengguna.length">
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="akun_id">Pilih Akun Pengguna</label>

                                <div class="input-group">
                                    <select
                                        :class="{
                                            'is-invalid': form.errors.akun_id,
                                        }"
                                        class="form-control"
                                        id="akun_id"
                                        v-model="form.akun_id"
                                        required
                                        autocomplete="akun_id"
                                    >
                                        <option value="" selected disabled>
                                            - Pilih -
                                        </option>
                                        <option
                                            v-for="akun in pengguna"
                                            :value="akun.id"
                                            :key="akun.id"
                                        >
                                            {{ akun.name }}
                                        </option>
                                    </select>

                                    <div
                                        v-if="form.errors.akun_id"
                                        class="invalid-feedback"
                                    >
                                        {{ form.errors.akun_id }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else>
                        Akun dengan role user tidak ada / telah terpakai.
                        Silahkan tambah di
                        <Link
                            class="text-secondary"
                            :href="route('master.pengguna.create')"
                            >menu berikut</Link
                        >.
                    </div>
                </div>

                <div id="input" v-if="form.akun == 'input'">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="akun_email">Email</label>

                                <div class="input-group">
                                    <input
                                        :class="{
                                            'is-invalid':
                                                form.errors.akun_email,
                                        }"
                                        class="form-control"
                                        id="akun_email"
                                        v-model="form.akun_email"
                                        type="email"
                                        required
                                        autocomplete="username"
                                        placeholder="email@contoh.com"
                                    />

                                    <div
                                        v-if="form.errors.akun_email"
                                        class="invalid-feedback"
                                    >
                                        {{ form.errors.akun_email }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="akun_password">Password</label>

                                <div class="input-group">
                                    <input
                                        :class="{
                                            'is-invalid':
                                                form.errors.akun_password,
                                        }"
                                        class="form-control"
                                        id="akun_password"
                                        v-model="form.akun_password"
                                        type="password"
                                        required
                                        autocomplete="akun_password"
                                        placeholder="masukkan password"
                                    />

                                    <div
                                        v-if="form.errors.akun_password"
                                        class="invalid-feedback"
                                    >
                                        {{ form.errors.akun_password }}
                                    </div>
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
