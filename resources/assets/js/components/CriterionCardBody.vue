<template>
    <div class="card-body">
        <div class="row" >
            <div class="col-md-4">
                <p class="text-left text-blue text-left text-bold text-uppercase"> {{ $t('observationsBySource.source') }}:</p>
                <p class="text-left">{{subsection.source.name}}</p>
            </div>
            <div class="col-md-8">
                <p class="text-blue text-left text-bold text-uppercase">{{ $t('observationsBySource.observations') }}</p>
                <div class="row" v-for="headquarter in state.headquarters" :key="headquarter.id">
                    <div class="col-md-12">
                        <p> {{ $t('observationsBySource.headquarters') }}: {{ headquarter.name }}</p>
                    </div>
                    <div class="col-md-12">
                        <observations
                            v-if="obs.length  >= 1"
                            :update="true"
                            :observations="obs"
                            :headquarter="headquarter.id"
                            :criterion="subsection.criterion_id"
                            :source="subsection.source_id"
                        />

                        <observation
                            v-else
                            :update="false"
                            :state="state.id"
                            :ambit="subsection.ambit_id"
                            :decision="subsection.decision_id"
                            :headquarter="headquarter.id"
                            :criterion="subsection.criterion_id"
                            :source="subsection.source_id"
                        />
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            criterion: Object,
            subsection: Object,
            observations: Array,
            ambit_selected: Number,
            state: Object,
            decision: Number,
        },
        data: () => ({

        }),
        methods: {
        },
        computed: {
            obs: function() {
                return this.observations.filter(observation => observation.source_id == this.$props.subsection.source_id)
            }
        },
        created(){
            const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
        }
    }
</script>

<style lang="scss" scoped>
    .card {
        border-radius: 0px !important;
    }
    textarea {
        background: #F9F9F9;
    }
</style>
