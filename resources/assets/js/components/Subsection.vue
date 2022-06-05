<template>
    <div class="subsection row">
        <div class="col-md-4">
            <p class="text-uppercase">Fuente</p>
            <hr>
            <p>{{ subsection.source.name }}</p>
            <p>
                <span class="text-uppercase">Criterio</span> {{ subsection.criterion.name }}
            </p>
        </div>
        <div class="col-md-8">
            <p class="text-uppercase">Observaciones</p>
            <hr>
            <div class="row" v-for="headquarter in headquarters" :key="headquarter.id">
                <div class="col-md-12">
                    <p>{{ headquarter.name }}</p>
                </div>
                <div class="col-md-12">
                    <observations
                        v-if="filtered_observations.length  >= 1"
                        :update="true"
                        :observations="filtered_observations"
                        :headquarter="headquarter.id"
                        :criterion="subsection.criterion_id"
                        :source="subsection.source_id"
                    />
                    <observation 
                        v-else
                        :update="false"
                        :state="state"
                        :ambit="subsection.ambit_id"
                        :decision="subsection.decision_id"
                        :headquarter="headquarter.id"
                        :criterion="subsection.criterion_id"
                        :source="subsection.source_id"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            subsection: Object,
            headquarters: Array,
            state: Number,
            observations: Array
        },
        data: () =>({
            filtered_observations: []
        }),
        methods: {
            filterObservations() {
                this.filtered_observations = this.$props.observations.filter(observation => observation.ambit_id == this.$props.subsection.ambit_id && observation.decision_id == this.$props.subsection.decision_id && observation.state_id == this.$props.state);
            }
        },
        created(){
            this.filterObservations();
        }
    }
</script>

<style lang="scss" scoped>

</style>