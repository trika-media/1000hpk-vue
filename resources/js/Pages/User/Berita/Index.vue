<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/runtime-core';
import moment from 'moment';

moment.locale('id');

const props = defineProps({
    berita: Object,
});

const berita = computed(() => props.berita);
</script>

<template>
    <Head title="Berita" />

    <AuthenticatedLayout>
        <template #heading>
            Berita
        </template>

        <template #subheading>
            Menampilkan data berita terbaru.
        </template>

        <div id="list-berita">
            <Link
                class="card mb-3"
                v-for="berita in berita.data"
                :href="route('user.berita.show', {slug: berita.slug})"
                :key="berita.id"
            >
                <div class="row g-0">
                    <div class="col-md-3">
                        <img
                            :src="berita.gambar_url"
                            :alt="'Gambar Berita' + berita.judul"
                            class="img-fluid rounded-start"
                        >
                    </div>

                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">{{ berita.judul }}</h5>
                            <p class="card-text">
                                {{ berita.konten.replace(/<\/?[^>]+>/ig, " ").slice(0, 250) }}
                                {{ berita.konten.replace(/<\/?[^>]+>/ig, " ").length > 250 ? "..." : "" }}
                            </p>
                            <p class="card-text"><small class="text-muted">{{ moment(berita.created_at).format('LL') }}</small></p>
                        </div>
                    </div>
                </div>
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
