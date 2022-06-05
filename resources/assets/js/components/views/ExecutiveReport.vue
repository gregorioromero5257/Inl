<template>
    <div class="container executive-report">
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
                                <span class="font-weight-bold text-dark">
                                    {{ $t('executiveReport.title') }}
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="text-center text-uppercase font-weight-bold mb-4">{{ $t('executiveReport.title') }}</h4>
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
            <executive-pdf-gen
                :state="state_selected"
                :criteria="criteria"
            />
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-dark">
                            <h4 class="text-center text-uppercase font-weight-bold mb-4" style="padding:1rem;">{{ state_selected.name }}</h4>
                        </div>
                    </div>
                </div>

                <div class="row mb-3" style="padding-left:1em; padding-right:1em;margin-top: -1.7em;">
                    <div @click="selectScope(1)" class="col-md-4 text-center bg-light text-secondary pointer" :class="{'active-scope blue-bg-tabs' : scope_selected == 1}" style="padding:1em; border-right:solid 1.5px lightgray; border-left:solid 1.5px lightgray; border-bottom:solid 1.5px lightgray;">
                        <img v-if="scope_selected !== 1" src="/img/assets/icons_INL_icon_regulatorio_grey.svg" style="width:1.5rem;" alt="">
                        <img v-else src="/img/assets/icons_INL_icon_regulatorio_blue.svg" style="width:1.5rem;" alt="">
                        <span class="font-weight-bold">
                             {{ $t('executiveReport.regulatory_level') }}
                        </span>
                    </div>
                    <div @click="selectScope(2)" class="col-md-4 text-center bg-light text-secondary pointer" :class="{'active-scope blue-bg-tabs' : scope_selected == 2}" style="padding:1em; border-right:solid 1.5px lightgray; border-bottom:solid 1.5px lightgray;">
                        <img v-if="scope_selected !== 2" src="/img/assets/icons_INL_icon_institucional_grey.svg" style="width:1.5rem;" alt="">
                        <img v-else src="/img/assets/icons_INL_icon_institucional_blue.svg" style="width:1.5rem;" alt="">
                        <span class="font-weight-bold">
                            {{ $t('executiveReport.institutional_level') }}
                        </span>
                    </div>
                    <div @click="selectScope(3)" class="col-md-4 text-center bg-light text-secondary pointer" :class="{'active-scope blue-bg-tabs' : scope_selected == 3}" style="padding:1em; border-bottom:solid 1.5px lightgray; border-right:solid 1.5px lightgray;">
                        <img v-if="scope_selected !== 3" src="/img/assets/icons_INL_icon_individual_grey.svg" style="width:1.5rem;" alt="">
                        <img v-else src="/img/assets/icons_INL_icon_individual_blue.svg" style="width:1.5rem;" alt="">
                        <span class="font-weight-bold">
                            {{ $t('executiveReport.individual_level') }}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" v-for="criterion in criteria.slice(0, 3)" :key="criterion.id" v-show="scope_selected == 1">
                        <div class="card">
                            <div class="card-header bg-primary">
                                 {{ $t('executiveReport.criteria') }} {{ criterion.id }}: {{ criterion.name }}
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase font-weight-bold"> {{ $t('executiveReport.possible_problem') }}</p>
                                <hr>
                                <p >
                                  <div v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]" />
                                  <div v-for="t in state_selected.criterion_conclusions">
                                    <template v-if="t.criterion_id == criterion.id">
                                      <div v-html="t.problematica_conclusion" />
                                    </template>
                                  </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" v-for="criterion in criteria.slice(3, 11)" :key="criterion.id" v-show="scope_selected == 2">
                        <div class="card">
                            <div class="card-header bg-primary">
                                 {{ $t('executiveReport.criteria') }} {{ criterion.id }}: {{ criterion.name }}
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase font-weight-bold">{{ $t('executiveReport.possible_problem') }}</p>
                                <hr>
                                <p>
                                  <div v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]" />
                                  <div v-for="t in state_selected.criterion_conclusions">
                                    <template v-if="t.criterion_id == criterion.id">
                                      <div v-html="t.problematica_conclusion" />
                                    </template>
                                  </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" v-for="criterion in criteria.slice(11, 15)" :key="criterion.id" v-show="scope_selected == 3">
                        <div class="card">
                            <div class="card-header bg-primary">
                                 {{ $t('executiveReport.criteria') }} {{ criterion.id }}: {{ criterion.name }}
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase font-weight-bold">{{ $t('executiveReport.possible_problem') }}</p>
                                <hr>
                                <p>
                                  <div v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]" />
                                  <div v-for="t in state_selected.criterion_conclusions">
                                    <template v-if="t.criterion_id == criterion.id">
                                      <div v-html="t.problematica_conclusion" />
                                    </template>
                                  </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-none">
                <div class="table-responsive">
                    <table id="criteria-regulatory" class="table">
                        <thead>
                            <tr>
                                <th>{{ $t('executiveReport.criteria') }}</th>
                                <th>{{ $t('executiveReport.possible_problem') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="criterion in criteria.slice(0, 3)" :key="criterion.id">
                                <td>{{ $t('executiveReport.criteria') }} {{ criterion.id }}: {{ criterion.name }}</td>
                                <td v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 d-none">
                <div class="table-responsive">
                    <table id="criteria-institutional" class="table">
                        <thead>
                            <tr>
                                <th>{{ $t('executiveReport.criteria') }}</th>
                                <th>{{ $t('executiveReport.possible_problem') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="criterion in criteria.slice(3, 11)" :key="criterion.id">
                                <td>{{ $t('executiveReport.criteria') }} {{ criterion.id }}: {{ criterion.name }}</td>
                                <td v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 d-none">
                <div class="table-responsive">
                    <table id="criteria-individual" class="table">
                        <thead>
                            <tr>
                                <th>{{ $t('executiveReport.criteria') }}</th>
                                <th>{{ $t('executiveReport.possible_problem') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="criterion in criteria.slice(11, 15)" :key="criterion.id">
                                <td>{{ $t('executiveReport.criteria') }} {{ criterion.id }}: {{ criterion.name }}</td>
                                <td v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            loading: false,
            scope_selected: 1,
            state_selected: {},
            criteria: [],
        }),
        methods: {
            selectScope(scope) {
                this.scope_selected = scope;
            },
            loadData(){
                this.loading = true;
                axios.get(`/api/state_by_key/${this.$route.params.key}`)
                .then(({data}) => (
                    this.loading = false,
                    this.state_selected = data
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                    this.loading = false;
                });

                axios.get("/api/criterion").then(
                    ({data}) => (
                        this.criteria = data
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
            const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
            this.loadData();
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../../sass/_variables.scss";
    .active-scope {
        border-bottom: solid 2px $primary !important;
        background: rgba(19 , 56,94, 0.35) !important;
        color: #13385e !important;
        border-bottom: solid 2px $primary !important;
    }
</style>
