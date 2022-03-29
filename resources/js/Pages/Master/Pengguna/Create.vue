<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import { computed } from '@vue/runtime-core';
const props = defineProps({
    roles: Object,
});
const roles = computed(() => props.roles);
const form = useForm({
    nama: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '',
    avatar: null,
});
const submit = () => {
    form.post(route('master.pengguna.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Tambah Pengguna" />

    <AuthenticatedLayout>
        <template #heading>
            Tambah Data Pengguna
        </template>

        <template #subheading>
            Menambah data pengguna.
        </template>

        <template #button>
            <Link :href="route('master.pengguna.index')" class="btn btn-sm btn-white d-inline-flex align-items-center">
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
                            <label for="email">Nama</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.nama}"
                                    class="form-control"
                                    id="nama"
                                    v-model="form.nama"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="nama"
                                    placeholder="masukkan nama lengkap"
                                >

                                <div v-if="form.errors.nama" class="invalid-feedback">
                                    {{ form.errors.nama }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">Email</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.email}"
                                    class="form-control"
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    required
                                    autocomplete="username"
                                    placeholder="email@contoh.com"
                                >

                                <div v-if="form.errors.email" class="invalid-feedback">
                                    {{ form.errors.email }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="role">Role</label>

                            <div class="input-group">
                                <select
                                    :class="{'is-invalid': form.errors.role}"
                                    class="form-control"
                                    id="role"
                                    v-model="form.role"
                                    required
                                    autocomplete="role-pengguna"
                                >
                                    <option value="" selected disabled> - Pilih - </option>
                                    <option
                                        v-for="(role, index) in roles"
                                        :value="role"
                                        :key="index"
                                    >{{ role.charAt(0).toUpperCase() + role.slice(1) }}</option>
                                </select>

                                <div v-if="form.errors.role" class="invalid-feedback">
                                    {{ form.errors.role }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="avatar">Avatar</label>

                            <input
                                class="form-control"
                                id="avatar"
                                type="file"
                                @input="form.avatar = $event.target.files[0]"
                                :class="{'is-invalid': form.errors.avatar}"
                            />

                            <div v-if="form.errors.avatar" class="invalid-feedback">
                                {{ form.errors.avatar }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="password">Password</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.password}"
                                    class="form-control"
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="masukkan password"
                                >

                                <div v-if="form.errors.password" class="invalid-feedback">
                                    {{ form.errors.password }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">Konfirmasi Password</label>

                            <div class="input-group">
                                <input
                                    class="form-control"
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="masukkan konfirmasi password"
                                >
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
                >Simpan</button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>