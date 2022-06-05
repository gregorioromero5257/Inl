<template>
    <div class="col-md-12">
        <div class="row">
            <conclusion-by-criterion
                v-for="conclusion in conclusions"
                :key="conclusion.id"
                :conclusion="conclusion"
                :update="update"
                :ambit="ambit"
                :state="state"
                :decision="decision"
                :criterion="criterion"
            />
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            conclusions: Array,
            state: Number,
            ambit: Number,
            decision: Number,
            criterion: Number,
            update: Boolean,
        },
        data: () => ({

        }),
        methods: {

        },
        created(){

        }
    }
</script>

<style lang="scss" scoped>

</style>