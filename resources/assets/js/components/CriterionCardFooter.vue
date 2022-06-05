<template>
    <div class="card-footer">
        <div class="row">
            <conclusions-by-criterion
                :v-if="filteredConclusions >= 1"
                :conclusions="filteredConclusions"
                :update="true"
                :ambit="ambit"
                :state="state"
                :decision="decision"
                :criterion="criterion"
            />
            <conclusion-by-criterion
                v-if="filteredConclusions < 1"
                :update="false"
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
        },
        data: () => ({

        }),
        methods: {

        },
        computed: {
            filteredConclusions: function() {
                if(this.$props.conclusions){
                    return this.$props.conclusions.filter(conclusion => conclusion.ambit_id == this.$props.ambit && conclusion.criterion_id == this.$props.criterion && conclusion.decision_id == this.$props.decision && conclusion.state_id == this.$props.state);
                } else {
                    return []
                }
                
            }
        },
        created(){

        }
    }
</script>

<style lang="scss" scoped>

</style>