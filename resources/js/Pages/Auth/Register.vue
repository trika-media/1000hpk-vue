<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import ValidationErrors from "@/Components/Auth/ValidationErrors.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";

const data_fakultas = ref([]);
const data_prodi = ref([]);

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
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

onMounted(() => {
    getFakultas();
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Registrasi" />

        <ValidationErrors />

        <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h3">Buat Akun</h1>
        </div>

        <form @submit.prevent="submit" class="mt-4">
            <div class="form-group mb-4">
                <label for="email">Nama</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-user px-2 font-weight-bold"></i>
                    </span>

                    <input
                        class="form-control"
                        id="nama"
                        v-model="form.nama"
                        type="text"
                        required
                        autofocus
                        autocomplete="nama"
                        placeholder="masukkan nama lengkap"
                    />
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="nim">NIM</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-id-card px-2 font-weight-bold"></i>
                    </span>

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

                    <div v-if="form.errors.nim" class="invalid-feedback">
                        {{ form.errors.nim }}
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="fakultas">Fakultas</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i
                            class="fas fa-graduation-cap px-2 font-weight-bold"
                        ></i>
                    </span>

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
                        <option value="" selected disabled>- Pilih -</option>
                        <option
                            v-for="fakultas in data_fakultas"
                            :value="fakultas.id"
                            :key="fakultas.id"
                        >
                            {{ fakultas.nama }}
                        </option>
                    </select>

                    <div v-if="form.errors.fakultas" class="invalid-feedback">
                        {{ form.errors.fakultas }}
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="prodi">Prodi</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-chalkboard px-2 font-weight-bold"></i>
                    </span>

                    <select
                        :class="{ 'is-invalid': form.errors.prodi }"
                        class="form-control"
                        id="prodi"
                        v-model="form.prodi"
                        required
                        autocomplete="prodi"
                    >
                        <option value="" selected disabled>- Pilih -</option>
                        <option
                            v-for="prodi in data_prodi"
                            :value="prodi.id"
                            :key="prodi.id"
                        >
                            {{ prodi.nama }}
                        </option>
                    </select>

                    <div v-if="form.errors.prodi" class="invalid-feedback">
                        {{ form.errors.prodi }}
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="angkatan">Angkatan</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-school px-2 font-weight-bold"></i>
                    </span>

                    <input
                        :class="{ 'is-invalid': form.errors.angkatan }"
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

                    <div v-if="form.errors.angkatan" class="invalid-feedback">
                        {{ form.errors.angkatan }}
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="nomor_ponsel">Nomor Ponsel</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-phone px-2 font-weight-bold"></i>
                    </span>

                    <input
                        :class="{ 'is-invalid': form.errors.nomor_ponsel }"
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

            <div class="form-group mb-4">
                <label for="email">Email</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-at px-2 font-weight-bold"></i>
                    </span>

                    <input
                        class="form-control"
                        id="email"
                        v-model="form.email"
                        type="email"
                        required
                        autocomplete="usernama"
                        placeholder="email@contoh.com"
                    />
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="password">Password</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-lock px-2 font-weight-bold"></i>
                    </span>

                    <input
                        class="form-control"
                        id="password"
                        v-model="form.password"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="masukkan password"
                    />
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="password_confirmation">Konfirmasi Password</label>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-lock px-2 font-weight-bold"></i>
                    </span>

                    <input
                        class="form-control"
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="masukkan konfirmasi password"
                    />
                </div>
            </div>

            <div class="d-grid">
                <button
                    type="submit"
                    class="btn btn-gray-800"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Registrasi
                </button>
            </div>
        </form>

        <div class="d-flex justify-content-center align-items-center mt-4">
            <span class="fw-normal">
                Sudah mempunyai akun?

                <Link :href="route('login')" class="fw-bold">Login</Link>
            </span>
        </div>
    </GuestLayout>
</template>
