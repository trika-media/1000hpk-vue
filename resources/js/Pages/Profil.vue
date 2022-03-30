<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import Alert from '@/Components/Alert';

const form = useForm({
    _method:'patch',

    avatar: null,
    nama: usePage().props.value.auth.user.name,
    email: usePage().props.value.auth.user.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('profil.update', {profil: usePage().props.value.auth.user.id}), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Profil" />

    <AuthenticatedLayout>
        <template #heading>
            Profil
        </template>

        <template #subheading>
            Perbaharui informasi Anda di sini.
        </template>

        <Alert />

        <form class="card" @submit.prevent="submit" >
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="avatar">Avatar</label>

                            <div class="d-flex align-items-center">
                                <img
                                    class="avatar-lg rounded-circle me-2"
                                    :alt="'Foto ' + $page.props.auth.name"
                                    :src="$page.props.auth.avatar"
                                >
                                <div class="input-group">
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


                            <small class="form-text text-muted">
                                Kosongkan jika tidak ingin mengubah
                            </small>
                        </div>

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
                                    disabled
                                    autocomplete="username"
                                    placeholder="email@contoh.com"
                                >

                                <div v-if="form.errors.email" class="invalid-feedback">
                                    {{ form.errors.email }}
                                </div>
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
                                    autocomplete="new-password"
                                    placeholder="masukkan password"
                                >

                                <div v-if="form.errors.password" class="invalid-feedback">
                                    {{ form.errors.password }}
                                </div>
                            </div>

                            <small class="form-text text-muted">
                                kosongkan jika tidak ingin mengubah
                            </small>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">Konfirmasi Password</label>

                            <div class="input-group">
                                <input
                                    class="form-control"
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
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
                >Simpan Perubahan</button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
