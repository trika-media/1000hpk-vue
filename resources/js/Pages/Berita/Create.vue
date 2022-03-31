<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const form = useForm({
    judul: '',
    gambar: '',
    tampil: true,
    konten: '',
});

const submit = () => {
    form.post(route('berita.store'));
};
</script>

<template>
    <Head title="Tambah Berita" />

    <AuthenticatedLayout>
        <template #heading>
            Tambah Berita
        </template>

        <template #subheading>
            Menambah data berita.
        </template>

        <template #button>
            <Link :href="route('berita.index')" class="btn btn-sm btn-white d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-3"></i>
                Kembali
            </Link>
        </template>

        <Alert />

        <form class="card" @submit.prevent="submit">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label for="email">Judul</label>

                            <div class="input-group">
                                <input
                                    :class="{'is-invalid': form.errors.judul}"
                                    class="form-control"
                                    id="judul"
                                    v-model="form.judul"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="judul-berita"
                                    placeholder="masukkan judul berita"
                                >

                                <div v-if="form.errors.judul" class="invalid-feedback">
                                    {{ form.errors.judul }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="gambar">Gambar</label>

                            <input
                                class="form-control"
                                id="gambar"
                                type="file"
                                @input="form.gambar = $event.target.files[0]"
                                :class="{'is-invalid': form.errors.gambar}"
                            />

                            <div v-if="form.errors.gambar" class="invalid-feedback">
                                {{ form.errors.gambar }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-4">
                            <label for="status">Status</label>

                            <div class="form-check form-switch">
                                <input
                                    :class="{'is-invalid': form.errors.tampil}"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="status-berita"
                                    v-model="form.tampil"
                                >

                                <label class="form-check-label" for="status-berita">
                                    Apakah berita tampil?
                                </label>

                                <div v-if="form.errors.tampil" class="invalid-feedback">
                                    {{ form.errors.tampil }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <QuillEditor
                    v-model:content="form.konten"
                    contentType="html"
                    toolbar="minimal"
                    placeholder="masukkan konten berita"
                    style="min-height:200px"
                    required
                />

                <small v-if="form.errors.konten" class="text-danger">
                    {{ form.errors.konten }}
                </small>
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
