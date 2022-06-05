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
                                <span class="font-weight-bold text-dark">
                                    {{ $t('breadcrumb.qualitative_sources') }}
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
         <section class="row">
            <article class="mt-5">
                <h2 class="font-weight-bold text-center">SELECCIONAR ÁMBITO</h2>
                <hr/>
            </article>
            <article class="container">
                <div class="row mt-3">
                    <div class="col-sm side-line mt-3 d-flex justify-content-center flex-wrap" v-for="(ambit, index) in ambits" :key="index">
                        <div class="d-flex w-100 mt-3" style="justify-content: center; align-items :center;">
                            <img :src="`/img/assets/icons_INL_icon_${ambit.name}_blue.svg`" style="width:15%; margin: 10px;" :alt="ambit.name" class="align-self-center">
                            <p class="text-center text-blue text-uppercase text-bold m-0">Ámbito {{ambit.name}}</p>
                        </div>
                        <br />
                        <div class="row mt-3 d-flex justify-content-center flex-wrap">
                            <button class="btn btn-outline-primary rounded-btn btn-wrap-text" @click="gotoConclusion(ambit.id)">Observaciones por Fuente por Criterio</button>
                            <button class="btn btn-outline-primary rounded-btn btn-wrap-text" @click="gotoAmbit(ambit.id)"> Observaciones por Ámbito</button>
                            <button class="btn btn-outline-primary rounded-btn btn-wrap-text" @click="gotoProblematic(ambit.id)"> Posibles Problemáticas por Criterio</button>
                        </div>
                    </div>
                </div>
            </article>
         </section>
        <section  class="row mt-5 md-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="uploadExcel" value="Cargar Datos" visibility="hidden" style="display:none;">
                <label class="custom-file-label" for="uploadExcel" data-browse="Cargar Datos">Subir Hoja de Cálculo</label>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data: () => ({
            loading: false,
            state_selected: {},
            ambits: [],
        }),
        methods: {

            gotoConclusion(ambit) {

                if ( ambit == 1) {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/select-ambit/regulatory/by-criterion`)
                }

                else if ( ambit == 2) {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/select-ambit/institutional/by-criterion`)
                }

                else {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/select-ambit/individual/by-criterion`)
                }
            },

            gotoAmbit(ambit) {

                if ( ambit == 1) {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/select-ambit/regulatory/ambit-conclusion`)
                }

                else if ( ambit == 2) {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/select-ambit/institutional/ambit-conclusion`)
                }

                else {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/select-ambit/individual/ambit-conclusion`)
                }
            },

            gotoProblematic(ambit) {

                if ( ambit == 1) {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/select-ambit/regulatory/problematic-by-criterion`)
                }

                else if ( ambit == 2) {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/select-ambit/institutional/problematic-by-criterion`)
                }

                else {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/select-ambit/individual/problematic-by-criterion`)
                }
            },


            loadAmbits(){
                axios.get('/api/ambit')
                .then(({data})=>(
                    this.ambits = data
                ))
                .catch(()=> {
                    toast( {
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                })
            },



            loadData() {
                this.loadAmbits();
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
            }
        },
        created() {
            Fire.$on('AfterCreate',() => {
                this.loadData();
            });
            this.loadData();
        }
    }
</script>

<style lang="scss" scoped>

@import "../../../sass/_variables.scss";

.rounded-btn {
    border-radius: 40px;
    background: transparent;
    transition: all 0.3s ease 0s;
    margin:  7px 0;
    width: 20rem;
    &:hover{
        background: rgb(19, 56, 93) !important;
    }
    @media all and ( max-width: 768px) {
        width: 15rem;
    }
}

.side-line {
    border-right: 1px solid #e0e0e0;
    &:nth-child(3) {
        border: none !important;
    }
    @media all and ( max-width: 1024px) {
        border: none !important;
    }
}

.text-blue{
    color:#13385d;
}

hr, article {
    width:100%;
}


</style>
