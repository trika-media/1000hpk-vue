<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

import "leaflet/dist/leaflet.css"
import { LMap, LTileLayer, LMarker, LTooltip, LControl, LControlAttribution } from "@vue-leaflet/vue-leaflet";


const props = defineProps({
    puskesmas: Object,
});
</script>

<template>
    <Head title="Detail Puskesmas" />

    <AuthenticatedLayout>
        <template #heading>
            Detail Data Puskesmas
        </template>

        <template #subheading>
            Menampilkan detail data puskesmas.
        </template>

        <template #button>
            <Link :href="route('master.puskesmas.index')" class="btn btn-sm btn-white d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-3"></i>
                Kembali
            </Link>
        </template>

        <Alert />

        <div class="card">
            <ul class="list-group">
                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Nama</div>
                        <h3 class="h6">{{ props.puskesmas.nama }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Alamat</div>
                        <h3 class="h6">{{ props.puskesmas.alamat }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Kelurahan</div>
                        <h3 class="h6">{{ props.puskesmas.kelurahan.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Kecamatan</div>
                        <h3 class="h6">{{ props.puskesmas.kecamatan.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Kabupaten/Kota</div>
                        <h3 class="h6">{{ props.puskesmas.kabupaten.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Provinsi</div>
                        <h3 class="h6">{{ props.puskesmas.provinsi.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3" v-if="props.puskesmas.lat && props.puskesmas.lng">
                    <div>
                        <div class="small text-muted pe-4">Latitude/Longitude</div>
                        <h3 class="h6">{{ props.puskesmas.lat }}/{{ props.puskesmas.lng }}</h3>

                        <div class="position-relative">
                            <div class="position-absolute" style="top:0;left:0;bottom:0;right:0;z-index:1000"></div>

                            <LMap
                                style="height: 300px"
                                :minZoom="15"
                                :zoom="18"
                                :maxZoom="18"
                                :center="[props.puskesmas.lat, props.puskesmas.lng]"
                            >
                                <LControlAttribution :prefix="$page.props.app.name"/>

                                <LTileLayer
                                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                                    layer-type="base"
                                    name="OpenStreetMap"
                                ></LTileLayer>

                                <LMarker :lat-lng="[props.puskesmas.lat, props.puskesmas.lng]">
                                    <LTooltip>{{ props.puskesmas.nama }}</LTooltip>
                                </LMarker>
                            </LMap>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>