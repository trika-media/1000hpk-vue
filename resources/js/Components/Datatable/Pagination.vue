<script setup>
import { computed } from '@vue/runtime-core';
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    links: Array,
    total: Number,
    from: Number,
    to: Number,
});

const links = computed(() => props.links);
</script>

<template>
    <div v-if="links.length > 3" class="border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination mb-0">
                <li class="page-item" v-for="(link, p) in links" :key="p" :class="{ 'active': link.active, 'disabled': link.url === null }">
                    <Link class="page-link" :href="link.url">
                        {{ link.label }}
                    </Link>
                </li>
            </ul>
        </nav>

        <div class="fw-normal small mt-4 mt-lg-0">
            Menampilkan {{ props.from }} sampai {{ props.to }} dari <b>{{ props.total }}</b> data.
        </div>
    </div>
</template>