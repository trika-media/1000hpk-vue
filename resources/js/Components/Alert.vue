<script setup>
const { usePage } = require("@inertiajs/inertia-vue3");
const { onUpdated } = require("@vue/runtime-core");

onUpdated(() => {
    for(let index in usePage().props.value.flash){
        if(usePage().props.value.flash?.[index]){
            setTimeout(() => {
                usePage().props.value.flash[index] = null
            }, 5000);
        }
    }
});

</script>

<template>
    <div class="alert alert-success" v-if="$page.props.flash.success">
        {{$page.props.flash.success}}
    </div>

    <div class="alert alert-danger" role="alert" v-if="$page.props.flash.danger">
        {{$page.props.flash.danger}}
    </div>

    <div class="alert alert-warning" role="alert" v-if="$page.props.flash.warning">
        {{$page.props.flash.warning}}
    </div>

    <div class="alert alert-info" role="alert" v-if="$page.props.flash.info">
        {{$page.props.flash.info}}
    </div>
</template>