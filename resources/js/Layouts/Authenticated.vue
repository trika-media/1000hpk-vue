<script setup>
import { Link } from "@inertiajs/inertia-vue3";

import Nav from "@/Components/Dashboard/Nav.vue";
import Sidenav from "@/Components/Dashboard/Sidenav.vue";
import Topbar from "@/Components/Dashboard/Topbar.vue";
import Footer from "@/Components/Dashboard/Footer.vue";
</script>

<template>
    <Nav class="d-print-none" />

    <Sidenav class="d-print-none" />

    <main class="content d-print-none">
        <Topbar />

        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4"
        >
            <div class="d-block mb-4 mb-md-0">
                <h2 class="h4">
                    <slot name="heading" />
                </h2>

                <p class="mb-0">
                    <slot name="subheading" />
                </p>
            </div>

            <div class="btn-toolbar mb-2 mb-md-0">
                <slot name="button" />
            </div>
        </div>

        <slot />

        <Footer />
    </main>

    <div class="d-none d-print-block" id="print-area">
        <slot name="print" />
    </div>
</template>
