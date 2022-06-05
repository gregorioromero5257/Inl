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
        <loading v-if="loading" />
        <div class="row justify-content-center" v-else>
            <div class="col-md-12">
                <h3 class="text-center text-uppercase font-weight-bold mb-4">{{ $t('qualitative_source.select_level') }}</h3>
            </div>
            <div class="col-md-12">
                <div class="card-group text-center">
                    <div class="card ambit-card" v-for="(ambit, index) in ambits" :key="index" :class="{'no-border-left' : ambit.num == 1, 'no-border-right' : ambit.num == 3 }">
                        <div class="card-body">
                            <p class="text-center text-primary text-uppercase text-bold mb-4">
                                <img :src="`/img/assets/icons_INL_icon_${ambit.name}_blue.svg`" class="mr-2" style="width:2.5rem;" :alt="ambit.name">
                                <span>Ámbito {{ambit.name}}</span>
                            </p>
                            <button class="btn btn-outline-primary rounded-btn mb-3" @click="gotoConclusion(ambit)">
                                <span style="font-size:12px;">{{ $t('qualitative_source.observations_by_source')}}</span>
                                <!-- <span style="font-size:6px;">{{ $t('qualitative_source.observations_by_source') }}</span> -->
                            </button>
                            <br>
                            <button class="btn btn-outline-primary rounded-btn text-center mb-3" @click="gotoAmbit(ambit)">
                                <span style="font-size:12px;">{{ $t('qualitative_source.observations_by_level') }}</span>
                                <!-- <span class="d-lg-none">{{ $t('qualitative_source.observations_by_source') }}</span> -->
                            </button>
                            <br>
                            <button class="btn btn-outline-primary rounded-btn" @click="gotoProblematic(ambit)">
                                <span style="font-size:12px;">{{ $t('qualitative_source.possible_problems') }}</span>
                                <!-- <span class="d-lg-none">{{ $t('qualitative_source.possible_problems') }}</span> -->
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-12">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="uploadExcel" value="Buscar">
                    <label class="custom-file-label" for="uploadExcel" data-browse="Buscar">Seleccionar Hoja de Cálculo</label>
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
            ambits: [],
            file_name: 'Seleccionar hoja de cálculo'
        }),
        methods: {

            gotoConclusion(ambit) {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/${ambit.slug}/observations-by-source-by-criterion`)
            },

            gotoAmbit(ambit) {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/${ambit.slug}/observations-by-ambit`)
            },

            gotoProblematic(ambit) {
                this.$router.push(`/state/${this.$route.params.key}/qualitative-sources/${ambit.slug}/problematic-by-criterion`)
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
                axios.get(`/api/state_data/${this.$route.params.key}`)
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

</style>
