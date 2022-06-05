<template>
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-12 d-flex justify-content-between">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <router-link to="/home" class="text-secondary">
                                    {{ $t('breadcrumb.state') }}
                                </router-link>
                            </li>
                            <li class="breadcrumb-item">
                              <router-link to="/home" class="text-secondary">
                                {{ $t('breadcrumb.round') }} {{state_selected.round}}
                              </router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <router-link :to="`/state/${$route.params.key}`" class="text-secondary">
                                    {{ state_selected.name }}
                                </router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <router-link :to="`/state/${$route.params.key}/qualitative-sources`" class="text-secondary">
                                    {{ $t('breadcrumb.qualitative_sources') }}
                                </router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="font-weight-bold text-dark">
                                     {{ $t('observationsBySource.tittle_min') }}
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
         <div class="row">
           <div class="col-md-12">
             <h6 class="text-uppercase"><b>Ámbito {{ ambit_selected.name }}</b></h6>
           </div>
           <div class="col-md-12">
             <h4 class="text-uppercase font-weight-bold mb-2" style="color:#14519b;">{{ $t('observationsBySource.tittle_may') }}</h4>
           </div>
           <div class="col-md-12 text-center">
             <decisions-selector
             :decision_num="decision_selected"
             @change-decision="changeDecision"
             />
             <div class="card">
               <div class="card-header bg-primary" style="padding-top: 4px; padding-bottom : 2px;">
                 <div style="display: flex; justify-content: space-between; align-items : center;">
                 <a href="#" @click="lesDesicion()"> <h3> <i class="fas fa-angle-left"></i> </h3></a>
                 <p class="uppercase font-weight-bold">Decisión {{ decision.num}}: {{ decision.name }}</p>
                 <a href="#" @click="plusDesicion()"> <h3> <i class="fas fa-angle-right"></i> </h3></a>
               </div>
               </div>
               <div class="card-body">
                 <div v-show="loading">
                   <div class="row">
                     <div class="col-md-12 text-center">
                       <p>
                         <i class="fas fa-spinner fa-pulse fa-4x"></i>
                       </p>
                       <p class="h4">{{ $t('loading') }}</p>
                     </div>
                   </div>
                 </div>
                 <div v-show="!loading" class="col-md-12" v-for="criterion in criteria" :key="criterion.id">

                     <criterion-by-ambit
                         :criterion="criterion"
                         :subsections="subsections"
                         :decision="decision_selected"
                         :observations="observations"
                         :ambit="ambit_selected.id"
                         :state="state_selected"
                         :conclusions="criterion_conclusions"
                     />
                 </div>
               </div>
             </div>
           </div>


            <!-- <div class="col-md-12 text-center">
                <h4 class="text-center text-uppercase font-weight-bold mb-2">{{ $t('observationsBySource.tittle_may') }}</h4>
            </div> -->

            <!-- <div class="col-md-12">
                <div class="bg-dark">
                    <h4 class="text-center text-uppercase font-weight-bold mb-4 padding-1">
                        <img :src="`/img/assets/icons_INL_icon_${ambit_selected.name}_grey.svg`" style="width:2rem;" :alt="ambit_selected.name">
                        Ámbito {{ ambit_selected.name }}
                    </h4>
                </div>
            </div> -->

         </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            loading: false,
            state_selected: {},
            fields_added: false,
            editmode: false,
            loading: false,
            indicators: [],
            decisions: [],
            decision: {},
            subsections: [],
            ambit_selected: {},
            decision_selected: 1,
            filtered_criteria: [],
            criterion_conclusions: [],
        }),
        methods: {
            loadAmbits() {
                axios.get(`/api/ambit_by_slug/${this.$route.params.ambit}`)
                .then(({data}) => (
                    this.ambit_selected = data
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                })
            },
            loadSubsections(){
                this.loadAmbits();
                axios.get(`/api/subsections-by-decisionambit/${this.decision_selected}/${this.$route.params.ambit}/${this.$route.params.key}`)
                .then(({data}) => (
                    this.subsections = data
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                });
            },
            loadState(){
                this.loadSubsections();
                this.getDecision();
                this.loading = true;

                axios.get(`/api/observations_source_criterion/${this.$route.params.key}`)
                .then(response => {
                    this.loading = false;
                    this.state_selected = response.data;
                    this.criterion_conclusions = response.data.criterion_conclusions;
                }).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                    this.loading = false;
                });
            },
            getDecision() {
              this.loading = true;
                this.loadSubsections();
                axios.get(`/api/decision/${this.decision_selected}&${this.$route.params.key}`).then(
                    ({data}) => (
                        this.decision = data[0],
                        this.loading = false
                    )
                ).catch(()=>{
                  this.loading = false;
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                })
            },

            changeDecision(number){
                this.decision_selected = number;
                console.log(number,'shs');
                this.getDecision();
            },

            lesDesicion(){
              if (this.decision_selected > 1) {
                this.decision_selected = this.decision_selected - 1;
                this.getDecision();
              }
            },

            plusDesicion(){
              if (this.decision_selected < 13) {
                this.decision_selected = this.decision_selected + 1;
                this.getDecision();
              }
            },

        },
        computed : {
            criteria: function() {
                const seen = new Set();
                const all_criteria = this.subsections.map(subsection => subsection.criterion);
                const filtered_criteria = all_criteria.filter(criterion => {
                    const duplicate = seen.has(criterion.id);
                    seen.add(criterion.id)
                    return !duplicate;
                })
                return filtered_criteria;
            },
            observations: function() {
                if(this.state_selected.observations){
                    return this.state_selected.observations.filter(observation => observation.state_id == this.state_selected.id && observation.ambit_id == this.ambit_selected.id && observation.decision_id == this.decision_selected)
                } else {
                    return []
                }

            }
        },
        created(){
            const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
            this.loadState();
            Fire.$on('AfterCreate',() => {
                this.loadState();
            });
        },
    }

</script>

<style lang="scss" scoped>
@import "../../../sass/_variables.scss";
.active-scope {
    border-bottom: solid 2px $primary !important;
    background: rgba(19 , 56,94, 0.35) !important;
    color: #13385e !important;
}
.ambit-icon {
    margin-top: -0.3em;
    width: 2rem;
}

.padding-1 {
    padding: 1rem;
}
.card {
    border-radius: 0px !important;
}
.white-bar {
    background: white;
    padding: 17px 7px;
    width: 100vw;
    position: relative;
    left: 0;
    right: 0;
    margin: 2rem 0;
}
.dropdown-item {
    font-size: 12px;
    color: #091F2F;
    margin: 4px;
}
button.btn.no-bg.dropdown-toggle {
    font-size: 12px;
}
.no-bg{
    background: transparent;
}
.alpha-text {
    color: rgba(209, 209, 209, 0.7);
    font-weight: bolder;
    font-family: "Open Sans Condensed", sans-serif;
}

.btn-blue {
    background:#13519B;
    color: white;
    width: 20rem;
    &:hover{
        background: #13385d;
    }
}

.text-blue{
    color:#13385d;
}
.show {
    display: block;
}
</style>
