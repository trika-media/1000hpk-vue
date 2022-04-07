<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Alert from "@/Components/Alert.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

import "leaflet/dist/leaflet.css";
import {
    LMap,
    LTileLayer,
    LMarker,
    LTooltip,
    LControl,
    LControlAttribution,
} from "@vue-leaflet/vue-leaflet";
import { computed } from "@vue/runtime-core";
import moment from "moment";

moment.locale("id");

const props = defineProps({
    ibuHamil: Object,
});

const ibuhamil = computed(() => props.ibuHamil);
</script>

<template>
    <Head title="Detail Ibu Hamil" />

    <AuthenticatedLayout>
        <template #heading> Detail Data Ibu Hamil </template>

        <template #subheading> Menampilkan detail data ibu hamil. </template>

        <template #button>
            <Link
                :href="route('user.ibu-hamil.index')"
                class="btn btn-sm btn-white d-inline-flex align-items-center"
            >
                <i class="fas fa-arrow-left me-3"></i>
                Kembali
            </Link>

            <a
                class="btn btn-sm btn-danger d-inline-flex align-items-center ms-2"
                :href="route('pdf.ibu-hamil.detail', ibuhamil.id)"
                target="_blank"
            >
                <i class="fas fa-file-pdf me-3"></i>
                PDF
            </a>

            <button
                class="btn btn-sm btn-info d-inline-flex align-items-center ms-2"
                @click="print()"
            >
                <i class="fas fa-print me-3"></i>
                Cetak
            </button>
        </template>

        <Alert />

        <div class="card">
            <ul class="list-group">
                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Identitas</div>
                        <h3 class="h6">{{ ibuhamil.identitas }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Nama</div>
                        <h3 class="h6">{{ ibuhamil.nama }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Alamat</div>
                        <h3 class="h6">{{ ibuhamil.alamat }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Nomor Ponsel</div>
                        <h3 class="h6">{{ ibuhamil.nomor_ponsel }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Tanggal Lahir</div>
                        <h3 class="h6">
                            {{ moment(ibuhamil.tanggal_lahir).format("LL") }}
                        </h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3 bg-gray-100"></li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Puskesmas</div>
                        <h3 class="h6">{{ ibuhamil.puskesmas.nama }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Keluhan</div>
                        <ul>
                            <li
                                class="h6"
                                v-for="keluhan in ibuhamil.keluhan"
                                :key="keluhan.id"
                            >
                                {{
                                    keluhan.penyakit.nama ||
                                    keluhan.nama_penyakit
                                }}
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3 bg-gray-100"></li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Kelurahan</div>
                        <h3 class="h6">{{ ibuhamil.kelurahan.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Kecamatan</div>
                        <h3 class="h6">{{ ibuhamil.kecamatan.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Kabupaten/Kota</div>
                        <h3 class="h6">{{ ibuhamil.kabupaten.name }}</h3>
                    </div>
                </li>

                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="small text-muted pe-4">Provinsi</div>
                        <h3 class="h6">{{ ibuhamil.provinsi.name }}</h3>
                    </div>
                </li>

                <li
                    class="list-group-item border-bottom p-3"
                    v-if="ibuhamil.lat && ibuhamil.lng"
                >
                    <div>
                        <div class="small text-muted pe-4">
                            Latitude/Longitude
                        </div>
                        <h3 class="h6">
                            {{ ibuhamil.lat }}/{{ ibuhamil.lng }}
                        </h3>

                        <div class="position-relative">
                            <div
                                class="position-absolute"
                                style="
                                    top: 0;
                                    left: 0;
                                    bottom: 0;
                                    right: 0;
                                    z-index: 1000;
                                "
                            ></div>

                            <LMap
                                style="height: 300px"
                                :minZoom="5"
                                :zoom="18"
                                :maxZoom="18"
                                :center="[ibuhamil.lat, ibuhamil.lng]"
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
                                    :lat-lng="[ibuhamil.lat, ibuhamil.lng]"
                                >
                                    <LTooltip
                                        >Lokasi Ibu Hamil :
                                        {{ ibuhamil.nama }}</LTooltip
                                    >
                                </LMarker>
                            </LMap>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <template #print>
            <div class="row">
                <div class="col-2">
                    <img
                        style="max-width: 20rem"
                        :src="ibuhamil.mahasiswa.akun.avatar_url"
                        :alt="'Foto' + ibuhamil.mahasiswa.akun.name"
                    />
                </div>

                <div class="col-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="align-top">NIM</td>
                            <td class="align-top">:</td>
                            <td class="align-top">
                                {{ ibuhamil.mahasiswa.nim }}
                            </td>
                        </tr>
                        <tr>
                            <td class="align-top">Nama</td>
                            <td class="align-top">:</td>
                            <td class="align-top">
                                {{ ibuhamil.mahasiswa.nama }}
                            </td>
                        </tr>
                        <tr>
                            <td class="align-top">Email</td>
                            <td class="align-top">:</td>
                            <td class="align-top">
                                {{ ibuhamil.mahasiswa.akun.email }}
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="align-top">Alamat</td>
                            <td class="align-top">:</td>
                            <td class="align-top">
                                {{ ibuhamil.mahasiswa.alamat }}
                            </td>
                        </tr>
                        <tr>
                            <td class="align-top">Nomor Ponsel</td>
                            <td class="align-top">:</td>
                            <td class="align-top">
                                {{ ibuhamil.mahasiswa.nomor_ponsel }}
                            </td>
                        </tr>
                        <tr>
                            <td class="align-top">Angkatan</td>
                            <td class="align-top">:</td>
                            <td class="align-top">
                                {{ ibuhamil.mahasiswa.angkatan }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-12">
                    <div class="w-100">
                        <LMap
                            style="height: 300px; width: 100%"
                            :minZoom="5"
                            :zoom="18"
                            :maxZoom="18"
                            :center="[ibuhamil.lat, ibuhamil.lng]"
                        >
                            <LControlAttribution
                                :prefix="$page.props.app.name"
                            />

                            <LTileLayer
                                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                                layer-type="base"
                                name="OpenStreetMap"
                            ></LTileLayer>

                            <LMarker :lat-lng="[ibuhamil.lat, ibuhamil.lng]">
                                <LTooltip
                                    >Lokasi Ibu Hamil :
                                    {{ ibuhamil.nama }}</LTooltip
                                >
                            </LMarker>
                        </LMap>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="align-top">Identitas</td>
                            <td class="align-top">:</td>
                            <td class="align-top">{{ ibuhamil.identitas }}</td>
                        </tr>
                        <tr>
                            <td class="align-top">Nama</td>
                            <td class="align-top">:</td>
                            <td class="align-top">{{ ibuhamil.nama }}</td>
                        </tr>
                        <tr>
                            <td class="align-top">Alamat</td>
                            <td class="align-top">:</td>
                            <td class="align-top">{{ ibuhamil.alamat }}</td>
                        </tr>
                        <tr>
                            <td class="align-top">Nomor Ponsel</td>
                            <td class="align-top">:</td>
                            <td class="align-top">
                                {{ ibuhamil.nomor_ponsel }}
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="align-top">Penyakit</td>
                            <td class="align-top">:</td>
                            <td class="align-top">
                                <span
                                    v-for="(keluhan, index) in ibuhamil.keluhan"
                                    :key="index"
                                >
                                    -
                                    {{
                                        keluhan.penyakit.nama ||
                                        keluhan.nama_penyakit
                                    }}
                                    <br />
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-top">Puskesmas</td>
                            <td class="align-top">:</td>
                            <td class="align-top">
                                {{ ibuhamil.puskesmas.nama }}
                            </td>
                        </tr>
                        <tr>
                            <td class="align-top">Lat</td>
                            <td class="align-top">:</td>
                            <td class="align-top">{{ ibuhamil.lat }}</td>
                        </tr>
                        <tr>
                            <td class="align-top">Lng</td>
                            <td class="align-top">:</td>
                            <td class="align-top">{{ ibuhamil.lng }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
