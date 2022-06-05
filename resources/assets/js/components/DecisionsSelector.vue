<template>
    <div class="decisionSelector mb-2 mt-2">
        <!-- <hr> -->

    <hr class="hr-height" style="margin-bottom : 5px;">
    <div style="display: flex; justify-content: space-between;">
      <div  v-for="decision in decisions" :key="decision.id" >
        <button type="button" class="decision-num btn" :class="decision.num == decision_num ? 'btn btn-primary': ''"
        :style="decision.num == decision_num ? 'min-width: 50px; height: 26px; padding-top: 1.5px;'
        : 'min-width: 50px; height: 26px; padding-top: 1.5px; background: transparent;'"
        @click="$emit('change-decision', decision.num)">
        <!-- <span
        > -->
            <!-- <i class="fa-lg"
            :class="{ 'fas fa-circle text-primary-override'
            : decision.num != decision_num, 'fas fa-circle text-primary'
            : decision.num == decision_num }"></i> -->
            <!-- <span class="decision-num"> -->
              <!--
              :class="{ 'num-one' : decision.num == 1, 'num-small'
              : decision.num > 1 && decision.num < 10, 'num-big'
              : decision.num >= 10, 'text-primary': decision.num != decision_num, 'text-white'
              : decision.num == decision_num }" -->
            <h5 :style="decision.num == decision_num ? 'color: #fffffc;' : 'color: #99999c !important;'"><b>{{ decision.num }}</b></h5>
            <!-- </span> -->
        <!-- </span> -->
        </button>
      </div>
    </div>
    <hr class="hr-height" style="margin-top : 5px;">
  </div>

</template>

<script>
    export default {
        props: {
            decision_num: Number
        },
        data: () =>({
            decisions: {},
        }),
        methods: {
            loadDecisions() {
                axios.get("/api/decision").then(
                    ({data}) => (
                        this.decisions = data
                    )
                ).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                })
            }
        },
        created(){
            this.loadDecisions();
        }
    }
</script>

<style lang="scss" scoped>
.decisionSelector {
   position: relative;
}
    .decision-num {
        position:relative;
        bottom: 0.1em;
        font-size: 0.8em;
    }
    .num-one {
        right: 1.35em;
        color: white !important;
    }
    .num-small {
        right: 1.4em;
        color: white !important;
    }
    .num-big {
        right: 1.7em;
        color: white !important;
    }
    // hr {
    //     width: 71%;
    //     position: absolute;
    //     top:-25%;
    //     left: 0;
    //     right: 0;
    //     z-index: -4;
    //     color: #13385E;
    // }
    .text-primary-override{
        color: #8CA8C6 !important;
    }

    @media only screen and (max-width: 767px) {
        .mr-2, .mx-2 {
          margin-right: 0.7rem !important;
        }

        .fa-lg {

    font-size: 2em;
    line-height: 1.75em;
    vertical-align: -0.067em;

}

.decision-num {

    position: relative;
    bottom: 0.1em;
    font-size: 1.2em;

}
    }
</style>
