<template>
    <div class="card">
        <div class="card-header text-left" style="background : #dfe6ed;">
          <h5 class="uppercase font-weight-bold" style="color : #000000;">
            {{ $t('observationsBySource.headquarters') }} {{ criterion.id }}: {{ criterion.name }}
          </h5>
        </div>
        <criterion-card-body
            v-for="subsection in filteredSubsections" :key="subsection.id"
            :subsection="subsection"
            :criterion="criterion"
            :decision="decision"
            :observations="observations"
            :ambit_selected="ambit"
            :state="state"
        />
        <criterion-card-footer
            :conclusions="conclusions"
            :state="state.id"
            :ambit="ambit"
            :decision="decision"
            :criterion="criterion.id"
        />
    </div>
</template>

<script>
    export default {
        props: {
            criterion: Object,
            subsections: Array,
            decision: Number,
            observations: Array,
            ambit: Number,
            state: Object,
            conclusions: Array,
        },
        data: () => ({

        }),
        methods: {

        },
        computed: {
            filteredSubsections: function() {
                return this.$props.subsections.filter(subsection => subsection.criterion_id == this.$props.criterion.id)
            }
        },
        created(){
            const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
        }
    }
</script>

<style lang="scss" scoped>

</style>
