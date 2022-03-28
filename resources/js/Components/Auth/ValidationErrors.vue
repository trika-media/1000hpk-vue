<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const errors = computed(() => usePage().props.value.errors);

const hasErrors = computed(() => Object.keys(errors.value).length > 0);
</script>

<template>
    <div class="alert alert-warning" role="alert" v-if="hasErrors">
        <h4 class="alert-heading">Perhatian!</h4>
        <p>Tolong periksa inputan Anda.</p>

        <hr>

        <ul>
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>
