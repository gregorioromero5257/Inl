<template>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-dark">
                    <h4 class="text-center text-uppercase font-weight-bold mb-4" style="padding:1rem;">Análisis de decisiones</h4>
                </div>
            </div>

            <decision-analysis-dr
                v-for="decision in decisions"
                :key="decision.id"
                :decision="decision"
                :indicators="indicators"
                :interpretation="interpretation"
                :variables="variables"
                :variables_info="variables_info"
                :conclusion="conclusion"
                :problematic="problematic"
                @toggle-collapsed="$emit('toggle-collapsed', decision)"
            />
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            decisions: Array,
            indicators: Array,
            interpretation: Object,
            variables: Object,
            variables_info: Array,
            conclusion: Object,
            problematic: Object,
        },
    }
</script>

<style lang="scss" scoped>

</style>
