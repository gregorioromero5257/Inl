<template>
    <div @click="$emit('change-ambit', ambit.num)" style="padding:1em;">
        <img v-if="ambit_selected == ambit.num" :src="`/img/assets/icons_INL_icon_${ambit.name}_blue.svg`" style="width:1.5rem;" :alt="ambit.name">
        <img v-if="ambit_selected != ambit.num" :src="`/img/assets/icons_INL_icon_${ambit.name}_grey.svg`" style="width:1.5rem;" :alt="ambit.name">
        Ámbito {{ ambit.name }}
    </div>
</template>

<script>
    export default {
        props: {
            ambit: Object,
            ambit_selected: Number
        },
        data: () =>({

        }),
        methods: {

        },
        created(){

        }
    }
</script>

<style lang="scss" scoped>
    
</style>