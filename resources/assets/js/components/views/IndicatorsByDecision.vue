<template>
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
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
                                <router-link :to="`/state/${$route.params.key}/quantitative-sources`" class="text-secondary">
                                    {{ $t('breadcrumb.quantitative_sources') }}
                                </router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="font-weight-bold text-dark">
                                    Indicadores por decisión
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="text-center text-uppercase font-weight-bold mb-4">Indicadores por decisión {{year}}</h4>
            </div>
        </div>
        <div class="row" v-if="loading">
            <div class="col-md-12 text-center">
                <p>
                    <i class="fas fa-spinner fa-pulse fa-4x"></i>
                </p>
                <p class="h4">{{ $t('loading') }}</p>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-md-12 text-center">
                <decisions-selector
                    :decision_num="decision_selected"
                    @change-decision="changeDecision"
                />

                <p class="text-primary text-uppercase">Decisión {{ decision.num}}: {{ decision.name }}</p>
            </div>
            <div class="col-md-12">
                <div class="alert bg-primary" style="border-radius:0;" role="alert">
                    Decisión {{ decision.num }}: {{ decision.name }}
                </div>
            </div>
            <div class="col-md-12" v-for="indicator in indicators" :key="indicator.id">
              <!-- {{indicator}} -->
              <!-- {{state_selected}} -->
                <indicator-card
                    :indicator="indicator"
                    :variables="variables"
                    :variables_info="variables_info"
                    :form="form"
                    :year="year"
                    :round="state_selected.round"
                />
            </div>
            <!-- v-if="!$gate.isINL()" -->
            <div class="col-md-12 text-center mb-4" >
                <button  class="btn btn-primary btn-round" @click.prevent="updateInfo" type="submit">Guardar datos</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            year : '',
            loading: false,
            state_selected: {},
            indicators: [],
            variables_info: [],
            variables: {},
            decision: {},
            decision_selected: 1,
            form : '',
            // form: new Form({
            //     id: '',
            //     data : '',
            //     interpretation1: '',
            //     interpretation2: '',
            //     interpretation3: '',
            //     interpretation4: '',
            //     interpretation5: '',
            //     interpretation6: '',
            //     interpretation7: '',
            //     interpretation8: '',
            //     interpretation9: '',
            //     interpretation10: '',
            //     interpretation11: '',
            //     interpretation12: '',
            //     interpretation13: '',
            //     interpretation14: '',
            //     interpretation15: '',
            //     interpretation16: '',
            //     interpretation17: '',
            //     interpretation18: '',
            //     interpretation19: '',
            //     interpretation20: '',
            //     interpretation21: '',
            //     interpretation22: '',
            //     interpretation23: '',
            //     interpretation24: '',
            //     interpretation25: '',
            //     interpretation26: '',
            //     interpretation27: '',
            //     interpretation28: '',
            //     interpretation29: '',
            //     interpretation30: '',
            //     interpretation31: '',
            //     interpretation32: '',
            //     interpretation33: '',
            //     interpretation34: '',
            //     interpretation35: '',
            //     interpretation36: '',
            //     state_id: '',
            // }),
        }),
        methods: {
            changeDecision(number){
                this.decision_selected = number;
                this.getDecision();
            },
            getDecision() {
                axios.get(`/api/decision/${this.decision_selected}&${this.$route.params.key}`).then(
                    ({data}) => (
                        this.decision = data[0],
                        this.indicators = data.indicators
                    )
                ).catch(e =>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos1'
                    })
                })
            },
            getVariablesInfo(){
                axios.get('/api/variable/' + this.$route.params.key)
                .then(({data}) => (
                    this.variables_info = data
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos2'
                    })
                });
            },
            updateInfo() {
                this.$Progress.start();
                axios.put('/api/interpretation/'+this.form.id,{data : this.form})
                .then(()=>{
                    swal(
                        'Guardado',
                        'Información guardada correctamente.',
                        'success'
                    )
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(() => {
                    toast({
                        type: 'error',
                        title: 'Error al guardar los datos3'
                    })
                    this.$Progress.fail();
                });
            },
            loadState() {
                this.getVariablesInfo();
                this.getDecision();
                this.loading = true;
                this.year = this.$route.params.year;

                axios.get(`/api/indicators_by_decision/${this.$route.params.key}`)
                .then(({data}) => (
                    this.loading = false,
                    this.state_selected = data,
                    this.variables = JSON.parse(data.quantitative_source.data),
                    this.form = JSON.parse(data.interpretation.data)
                )).catch(e => {
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                    this.loading = false;
                });
            }
        },
        created(){
            this.loadState();
            Fire.$on('AfterCreate',() => {
                this.loadState();
            });
        }
    }
</script>

<style lang="scss" scoped>

</style>
