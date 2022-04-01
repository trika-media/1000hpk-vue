<script setup>
const props = defineProps({
    data: Object,
    colspan: String,
});
</script>


<template>
    <template v-if="!props.data.length">
        <tr>
            <td :colspan="colspan" class="text-center py-5">
                <i class="fas fa-folder-open"></i>

                Tidak ada data.
            </td>
        </tr>
    </template>

    <template v-else>
        <slot />
    </template>
</template>