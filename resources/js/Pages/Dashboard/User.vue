<script setup>
import Filter from "@/Components/Dashboard/Filter.vue";
import "leaflet/dist/leaflet.css";
import { latLngBounds, latLng } from "leaflet";
import {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip,
    LControl,
    LControlAttribution,
} from "@vue-leaflet/vue-leaflet";
import { computed } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import moment from "moment";

moment.locale("id");

const props = defineProps({ data: Object });

const ibuhamil = computed(() => props.data.ibuhamil);
const jumlah = computed(() => props.data.jumlah);
const berita = computed(() => props.data.berita);
const map = computed(() => props.data.map);
const tanggal = computed(() => props.data.tanggal);
</script>

<template>
    <Filter />

    <div class="row">
        <div class="col-8">
            <div class="mb-4">
                <LMap
                    style="height: 350px"
                    :minZoom="5"
                    :zoom="5"
                    :maxZoom="18"
                    :center="[-5.143759051537124, 119.40061707043272]"
                    :bounds="latLngBounds(map.bounds)"
                    :maxBounds="latLngBounds(map.bounds)"
                >
                    <LControlAttribution :prefix="$page.props.app.name" />

                    <LTileLayer
                        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                        layer-type="base"
                        name="OpenStreetMap"
                    ></LTileLayer>

                    <LMarker
                        v-for="bumil in ibuhamil"
                        :key="bumil.id"
                        :lat-lng="[bumil.lat, bumil.lng]"
                    >
                        <LPopup>
                            <table cellpadding="5">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>
                                        <b>{{ bumil.nama }}</b>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>
                                        <b>
                                            {{ bumil.alamat }},
                                            {{ bumil.provinsi?.name }},
                                            {{ bumil.kabupaten?.name }},
                                            {{ bumil.kecamatan?.name }},
                                            {{ bumil.kelurahan?.name }}
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Puskesmas</td>
                                    <td>:</td>
                                    <td>
                                        <b>{{ bumil.puskesmas.nama }}</b>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>
                                        <b>
                                            {{
                                                moment(bumil.created_at).format(
                                                    "LL"
                                                )
                                            }}
                                        </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <Link
                                            :href="
                                                route(
                                                    'user.ibu-hamil.show',
                                                    bumil.id
                                                )
                                            "
                                            >Selengkapnya</Link
                                        >
                                    </td>
                                </tr>
                            </table>
                        </LPopup>
                    </LMarker>
                </LMap>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow mb-3">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center"
                        >
                            <div
                                class="icon-shape icon-shape-secondary rounded me-4 me-sm-0"
                            >
                                <i
                                    class="fas fa-person-pregnant"
                                    style="font-size: 2rem"
                                ></i>
                            </div>

                            <div class="d-sm-none">
                                <h2 class="h5">Ibu Hamil</h2>
                                <h3 class="fw-extrabold mb-1">
                                    {{ jumlah.ibuhamil }}
                                </h3>
                            </div>
                        </div>

                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">Ibu Hamil</h2>
                                <h3 class="fw-extrabold mb-1">
                                    {{ jumlah.ibuhamil }}
                                </h3>
                            </div>

                            <small class="text-muted">
                                {{ moment(tanggal.awal).format("LL") }}
                                -
                                {{ moment(tanggal.akhir).format("LL") }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow">
                <div class="card-body">
                    <h2 class="fs-5 fw-bold mb-1">Baca Berita Terbaru</h2>
                    <p>Berikut adalah berita terbaru untuk Anda :</p>

                    <div v-for="berita in berita" :key="berita.id">
                        <Link
                            class="text-secondary"
                            :href="
                                route('user.berita.show', { slug: berita.slug })
                            "
                        >
                            <u>{{ berita.judul }}</u>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
