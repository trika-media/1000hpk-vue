<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <Link class="navbar-brand me-lg-5" href="/">
            <i class="fas fa-map-location-dot" style="font-size:2rem"></i>
        </Link>

        <div class="d-flex align-items-center">
            <button
                class="navbar-toggler d-lg-none collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</template>