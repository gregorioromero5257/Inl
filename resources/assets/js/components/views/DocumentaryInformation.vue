<template>
    <div class="documentary-info container">
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
                                    {{ $t('breadcrumb.documentary_information') }}
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
         <div class="row">
            <div class="col-md-12 mb-4">
                <h4 class="font-weight-bold">{{ $t('documentary_information.title') }}</h4>
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
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link pointer" :class="{ 'active' : tab === 1}" @click="selectTab(1)">
                                    <img src="/img/assets/icons_INL_icon_organigrama.svg" alt="database" style="width:1.5rem;">
                                    {{ $t('documentary_information.organization_chart') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pointer" :class="{ 'active' : tab === 2}" @click="selectTab(2)">
                                    <img src="/img/assets/icons_INL_icon_map.svg" alt="database" style="width:1.5rem;">
                                    {{ $t('documentary_information.map') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="organization-chart" v-show="tab === 1">
                        <input type="checkbox" v-model="org_na" @click="orgchart_na($event)"><label>&nbsp;&nbsp;N/A</label>
                        <template v-if="!org_na">
                          <!-- v-if="!$gate.isINL()" -->
                            <vue-dropzone
                                class="image-border mb-3"
                                v-model="orgchart"
                                id="drop-org-chart"
                                :options="dropOptionsOrgChart"
                                @vdropzone-success="orgchart_success"
                            ></vue-dropzone>
                            <div class="text-center image-border mb-3" v-for="org in organization_chart" :key="org.id" v-show="org.type == 'organization' && organization_chart.length >= 1">
                                <a class="pointer delete-btn" @click="deleteFile(org, 'org')">
                                    <img src="/img/assets/icons_INL_icon_delete.svg" alt="pencil" style="width: 1.5em;">
                                </a>
                                <template v-if="(org.path).substr(-3) === 'pdf'">
                                  <embed :src="'/myFiles/' + org.path" type="application/pdf" width="100%" height="600px" />
                                </template>
                                <template v-else>
                                  <img class="w-60 mt-3 mb-3" :src="'/myFiles/' + org.path"/>
                                </template>
                                <!-- {{(org.path).substr(-3)}} -->
                                <!-- {{org}} -->
                            </div>
                          </template>
                        </div>
                        <div class="map" v-show="tab === 2">
                            <input type="checkbox" v-model="m_na" @click="map_na($event)"><label>&nbsp;&nbsp;N/A</label>
                            <template v-if="!m_na">

                            <p>{{ $t('documentary_information.map_include') }}</p>
                            <ul>
                                <li>{{ $t('documentary_information.headquarter_offices') }}</li>
                                <li>{{ $t('documentary_information.headquarter_offices_regions') }}</li>
                                <li>{{ $t('documentary_information.number_prosecutors') }}</li>
                            </ul>
                            <div class="text-center image-border" v-for="m in map" :key="m.id" v-show="m.type == 'map' && map.length >= 1">
                                <a class="pointer delete-btn-map" @click="deleteFile(m, 'map')">
                                    <img src="/img/assets/icons_INL_icon_delete.svg" alt="pencil" style="width: 1.5em;">
                                </a>
                                <template v-if="(m.path).substr(-3) === 'pdf'">
                                  <embed :src="'/myFiles/' + m.path" type="application/pdf" width="100%" height="600px" />
                                </template>
                                <template v-else>
                                  <img class="w-60 mt-3 mb-3" :src="'/myFiles/' + m.path"/>
                                </template>
                                <!-- {{org}} -->
                            </div>
                            <!-- v-if="!$gate.isINL()" -->
                            <vue-dropzone
                                class="image-border"
                                id="drop-org-map"
                                :options="dropOptionsMap"
                                @vdropzone-success="map_success"
                                v-show="map.length < 1"></vue-dropzone>
                              </template>
                        </div>
                    </div>
                </div>
            </div>
            <all-headquarters
                :keyState="state"
            />
            <headquarters
                :keyState="state">
            </headquarters>
        </div>
    </div>
</template>

<script>
    import vueDropzone from "vue2-dropzone";
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import { log } from 'util';
    export default {
        components: {
            vueDropzone
        },
        data: () => ({
            org_na : false,
            m_na : false,
            loading: false,
            organization_chart: [],
            map: [],
            state_selected: {},
            state: '',
            tab: 1,
            orgchart: {},
            form: new Form({
                id: '',
                state_id: '',
                path: '',
                url: '',
                file_name: '',
                type: '',
            }),
            urlOrg: '',
            urlMap: '',
            dropOptionsOrgChart: {
                url: "/",
                maxFilesize: 2, // MB
                maxFiles: 1,
                // chunking: true,
                // chunkSize: 500, // Bytes
                thumbnailWidth: 150, // px
                thumbnailHeight: 150,
                addRemoveLinks: true,
                dictDefaultMessage: "Agregar Organigrama"
            },
            dropOptionsMap: {
                url: "/",
                maxFilesize: 2, // MB
                maxFiles: 1,
                // chunking: true,
                // chunkSize: 500, // Bytes
                thumbnailWidth: 150, // px
                thumbnailHeight: 150,
                addRemoveLinks: true,
                dictDefaultMessage: "Agregar Mapa"
            },
        }),
        methods: {
            orgchart_success() {
                Fire.$emit('AfterCreate');
                toast({
                    type: 'success',
                    title: 'Organigrama guardado correctamente'
                })
            },
            map_success(){
                Fire.$emit('AfterCreate');
                toast({
                    type: 'success',
                    title: 'Mapa guardado correctamente'
                })
            },
            deleteFile(file, type) {
                swal({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('/api/document/'+file.id + '&' +this.$route.params.key + '&' + type).then(()=>{
                            swal(
                            '¡Eliminado!',
                            'El documento ha sido eliminado.',
                            'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(()=> {
                            swal("Error", "Algo salió mal", "warning");
                        });
                    }
                })
            },
            selectTab(tab) {
                this.$data.tab = tab;
            },
            loadData(){
                this.loading = true;
                axios.get(`/api/state_documentary_information/${this.$route.params.key}`)
                .then(response => {
                    this.loading = false;
                    this.state_selected = response.data;
                    this.organization_chart = response.data.documents.filter(organization => organization.type == 'organization');
                    this.map = response.data.documents.filter(map => map.type == 'map');

                    if ((this.organization_chart).length > 0) {
                      if (this.organization_chart[0]['file_name'] === 'N/A') {
                        this.org_na = true;
                      }
                    }
                    if ((this.map).length > 0) {
                      if (this.map[0]['file_name'] === 'N/A') {
                        this.m_na = true;
                      }
                    }
                }).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                    this.loading = false;
                });
            },
            map_na(e){
              if (e.target.checked == true) {
                axios.get(`/api/map_na/${this.$route.params.key}`).then(response => {
                  toast({
                      type: 'success',
                      title: 'Guardado correctamente'
                  })
                });
              }else {
                axios.get(`/api/map_na_delete/${this.$route.params.key}`).then(response => {
                  this.loadData();
                });
              }
            },
            orgchart_na(e){
              if (e.target.checked == true) {
                axios.get(`/api/orgchart_na/${this.$route.params.key}`).then(response => {
                  toast({
                      type: 'success',
                      title: 'Guardado correctamente'
                  })
                });
              }else {
                axios.get(`/api/org_na_delete/${this.$route.params.key}`).then(response => {
                  console.log('ok');
                  this.loadData();
                });
              }
            }
        },
        created(){
            const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
            // Fire.$on('AfterCreate',() => {
            //     this.loadData();
            //     this.state = this.$route.params.key;
            //     this.dropOptionsOrgChart.url = `/api/d-information/${this.$route.params.key}/o-chart`;
            //     this.dropOptionsMap.url = `/api/d-information/${this.$route.params.key}/map`;
            // });
            this.loadData();
            this.state = this.$route.params.key;
            this.dropOptionsOrgChart.url = `/api/d-information/${this.$route.params.key}/o-chart`;
            this.dropOptionsMap.url = `/api/d-information/${this.$route.params.key}/map`;
        }
    }
</script>

<style scoped>
    .shadow {
        box-shadow: 4px 5px 16px 3px rgba(0,0,0,0.16) !important;
    }
    .card-header-tabs {
        margin-left: -1.3rem;
        margin-top: -0.8rem;
    }
    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        color: #495057;
        background-color: #ffffff;
        border-color: #dee2e6 #dee2e6 #ffffff;
    }
    .nav-tabs .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: 0rem;
        border-top-right-radius: 0rem;
    }
    .image-border {
        border: solid 0.1rem lightgray;
        border-style: dashed;
    }
    .w-60 {
        width: 90%;
    }
    @media only screen and (max-width: 767px) {
      .w-60 {
          width: 100%;
      }
    }
    .delete-btn {
        position: absolute;
        right: 40px;
        top: 77px;
    }
    .delete-btn-map {
        position: absolute;
        right: 40px;
        top: 12.5rem;
    }
</style>
