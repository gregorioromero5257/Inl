<template>
    <div class="container problematic-by-criterion">
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
                                <router-link :to="`/state/${$route.params.key}/qualitative-sources`" class="text-secondary">
                                    {{ $t('breadcrumb.qualitative_sources') }}
                                </router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="font-weight-bold text-dark">
                                     {{ $t('problematicByCriterion.title') }}
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="row" v-if="loading">
            <div class="col-md-12 text-center">
                <p>
                    <i class="fas fa-spinner fa-pulse fa-4x"></i>
                </p>
                <p class="h4">{{ $t('loading') }}</p>
            </div>
        </div>
        <div class="row" v-else>
          <div class="col-md-12">
            <h6 class="text-uppercase"><b>Ámbito {{ ambit_selected.name }}</b></h6>
          </div>
          <div class="col-md-12">
            <h4 class="text-uppercase font-weight-bold mb-2" style="color:#14519b;">{{ $t('problematicByCriterion.title') }}</h4>
          </div>

          <!-- <div class="col-md-12 text-center">
              <h4 class="text-center text-uppercase font-weight-bold mb-4">{{ $t('problematicByCriterion.title') }}</h4>
          </div> -->
            <!-- <div class="col-md-12">
                <div class="bg-dark">
                    <h4 class="text-center text-uppercase font-weight-bold mb-4 padding-1">
                        <img :src="`/img/assets/icons_INL_icon_${ambit_selected.name}_grey.svg`" style="width:2rem;" :alt="ambit_selected.name">
                        Ámbito {{ ambit_selected.name }}
                    </h4>
                </div>
            </div> -->
            <br>
            <br>
            <div class="col-md-12" v-for="criterion in criteria" :key="criterion.id">
                <div class="card">
                    <div class="card-header bg-primary">
                        <p class="text-uppercase font-weight-bold pr-2">
                            Criterio {{ criterion.id }}: {{ criterion.name }}
                        </p>
                        <!-- <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="collapse" :data-target="`#criterion-${criterion.id}`">
                                <i v-if="criterion.collapsed == 1" class="fa fa-plus"></i>
                                <i v-if="criterion.collapsed != 1" class="fa fa-minus"></i>
                            </button>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3" v-for="conclusion in orderedConclusions" :key="conclusion.id" v-show="conclusion.criterion_id == criterion.id && conclusion.ambit_id == ambit_selected.id && conclusion.state_id == state_selected.id">
                                <p class="text-uppercase font-weight-bold">
                                    Conclusión de la decision {{ conclusion.decision_id }}: {{ conclusion.decision.name }}
                                </p>
                                <p>
                                    {{ conclusion.conclusion }}
                                </p>
                                <!-- <template v-if="round == 2"> -->
                                  <template v-if="conclusion.problematica_conclusion == null">
                                    <button type="button" @click="conclusion.problematica_conclusion = ' '" class="btn btn-round btn-primary-color">+</button>
                                  </template>
                                  <template v-if="conclusion.problematica_conclusion != null">
                                    <button type="button" @click="conclusion.problematica_conclusion = null" class="btn btn-round btn-primary-color">-</button>
                                    <div class="form-group" >
                                        <label class="text-uppercase">Conclusión - Problemática </label>
                                        <!-- <wysiwyg v-model="conclusion.problematica_conclusion" /> -->
                                        <vue-editor v-model="conclusion.problematica_conclusion"></vue-editor>
                                    </div>
                                  </template>
                                <!-- </template> -->
                            </div>
                        </div>
                        <div class="row" v-show="round != 2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-uppercase" for="">Posible problemática</label>
                                    <!-- <wysiwyg v-model="form['problematicbycriterion'+criterion.id]" /> -->
                                    <vue-editor v-model="form['problematicbycriterion'+criterion.id]"></vue-editor>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center mb-4">
                <button class="btn btn-round btn-primary" type="submit" @click.prevent="updateInfo">
                      {{ $t('problematicByCriterion.save_data') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from "vue2-editor";
    export default {
        components :{ VueEditor},
        data: () => ({
            round : 0,
            loading: false,
            state_selected: {},
            ambit_selected: {},
            subsections: [],
            criterion_conclusions: [],
            form: new Form({
                id: '',
                problematicbycriterion1: '',
                problematicbycriterion2: '',
                problematicbycriterion3: '',
                problematicbycriterion4: '',
                problematicbycriterion5: '',
                problematicbycriterion6: '',
                problematicbycriterion7: '',
                problematicbycriterion8: '',
                problematicbycriterion9: '',
                problematicbycriterion10: '',
                problematicbycriterion11: '',
                problematicbycriterion12: '',
                problematicbycriterion13: '',
                problematicbycriterion14: '',
                problematicbycriterion15: '',
                state_id: '',
            }),
            customToolbar: [
                                ["bold", "italic", "underline"]
                            ]
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
            loadSubsections() {
                this.loadAmbits();
                axios.get(`/api/subsection_by_ambit/${this.$route.params.ambit}`)
                .then(({data}) => (
                    this.subsections = data
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                })
            },
            loadState() {
                this.loadSubsections();
                this.loading = true;
                axios.get(`/api/problematic_by_criterion/${this.$route.params.key}`)
                .then(({data}) => (
                    this.loading = false,
                    this.state_selected = data,
                    this.round = (data.id < 37 ? 1 : 2),
                    this.criterion_conclusions = data.criterion_conclusions,
                    this.form.fill(data.criterion_problematic)
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos 2'
                    })
                    this.loading = false;
                });
            },
            updateInfo(){
                this.$Progress.start();
                axios.post('/api/save-problematic-conclusion',{
                  data : this.criterion_conclusions,
                }).then(response => {
                  console.log('ok');
                }).catch(e => {
                  console.log(e);
                });

                this.form.put('/api/criterion_problematic/'+this.form.id)
                .then(() => {
                    swal(
                        '¡Actualizado!',
                        'Datos actualizados.',
                        'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                }).catch(() => {
                    this.$Progress.fail();
                });

            },
        },
        computed: {
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
            orderedConclusions: function () {
                return _.orderBy(this.criterion_conclusions, 'decision_id')
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
    .btn-blue {
        background:#13519B;
        color: white;
        width: 20rem;
        &:hover{
            background: #13385d;
        }
    }
</style>
