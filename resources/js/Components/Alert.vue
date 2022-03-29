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