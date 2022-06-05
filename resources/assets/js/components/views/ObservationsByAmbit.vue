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
                                    {{ $t('observationsByAmbit.tittle') }}
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            <!-- <div class="col-md-12 text-center">
                <h4 class="text-center text-uppercase font-weight-bold mb-2">
                    {{ $t('observationsByAmbit.tittle') }}
                </h4>
            </div> -->
            <div class="col-md-12">
              <h6 class="text-uppercase"><b>Ámbito {{ ambit_selected.name }}</b></h6>
            </div>
            <div class="col-md-12">
              <h4 class="text-uppercase font-weight-bold mb-2" style="color:#14519b;">{{ $t('observationsByAmbit.tittle') }}</h4>
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
                    <div class="row" v-show="loadingGral">
                      <div class="col-md-12 text-center">
                        <p>
                          <i class="fas fa-spinner fa-pulse fa-4x"></i>
                        </p>
                        <p class="h4">{{ $t('loading') }}</p>
                      </div>
                    </div>
                      <div class="row text-left" v-show="!loadingGral">
                          <div class="col-md-12 mb-3" v-for="(conclusion, keygral) in criterion_conclusions" :key="conclusion.id" v-show="conclusion.decision_id == decision.id && conclusion.ambit_id == ambit_selected.id && conclusion.state_id == state_selected.id">
                              <h6 class="text-uppercase uppercase text-secondary font-weight-bold">
                                {{ $t('conclusion_criterion') }}: {{ conclusion.criterion.name }}
                              </h6>
                              <!-- <p>
                                  {{ conclusion.conclusion }}
                              </p> -->
                              <p>
                              </p>
                              <template>
                                <template v-if="conclusion.conclusion_ambit == null && conclusion.problematic_ambit == null">
                                  <div class="form-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" v-model="conclusion.conclusion">
                                    <label class="form-check-label" for="inlineCheckbox1">N/A &nbsp;</label>
                                    <template v-if="conclusion.conclusion == false || conclusion.conclusion == null">
                                      <button class="btn btn-round btn-primary-color" @click="conclusion.conclusion_ambit = ' ';conclusion.problematic_ambit = ' '">+ Anadir</button>
                                    </template>

                                  </div>
                                </template>
                                <template v-else>
                                  <!-- <button type="button" @click="conclusion.conclusion_ambit = null" class="btn btn-round btn-primary-color">-</button> -->
                                  <button class="btn btn-round btn-primary-color" @click="conclusion.conclusion_ambit = null; conclusion.problematic_ambit = null">- Quitar tabla de hallazgos</button>
                                  <br>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <br>
                                      <div class="table-responsive">
                                        <table class="table table-bordered">
                                          <tr class="text-center">
                                            <th></th>
                                            <th class="text-secondary">Conclusión</th>
                                            <th class="text-secondary">Problemática</th>
                                          </tr>
                                            <tr v-for="(cpa, key) in conclusion.conclusion_probletic_ambit"  :key="cpa.id">
                                            <td width="4%" class="text-center">
                                              <img src="/img/assets/icons_INL_icon_pencil.svg" alt="edit"
                                              style="width:2.5rem; margin-bottom: 0.3rem;cursor: pointer;"
                                              @click="conclusion.conclusion_ambit = cpa.conclusion_ambit; conclusion.problematic_ambit = cpa.problematic_ambit; keysl =key; conclusion_id = cpa.id;">
                                              <br><br>
                                              <img src="/img/assets/icons_INL_icon_delete.svg" alt="delete"
                                              style="width:1.8rem; margin-bottom: 0.3rem;cursor: pointer;"
                                              @click="deleteC(cpa.id,conclusion.conclusion_probletic_ambit, keygral)">
                                            </td>
                                            <td width="48%">
                                              <div v-html="cpa.conclusion_ambit">
                                              </div>
                                            </td>
                                            <td width="48%">
                                              <div v-html="cpa.problematic_ambit">
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row" v-show="dataLoaded">
                                    <div class="col-md-12 text-center">
                                      <p>
                                        <i class="fas fa-spinner fa-pulse fa-4x"></i>
                                      </p>
                                      <p class="h4">{{ $t('loading') }}</p>
                                    </div>
                                  </div>
                                  <div class="row" v-show="!dataLoaded">
                                    <div class="col-md-6">
                                      <div class="form-group text-center" >
                                        <label class="text-uppercase ">Conclusión </label>
                                        <vue-editor v-model="conclusion.conclusion_ambit"></vue-editor>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group text-center" >
                                        <label class="text-uppercase">Problemática </label>
                                        <vue-editor v-model="conclusion.problematic_ambit"></vue-editor>
                                      </div>
                                    </div>
                                  </div>
                                  <template v-if ="keysl != null">
                                    <button class="btn btn-round btn-primary-outline-color" @click="editData(conclusion.conclusion_probletic_ambit, conclusion.conclusion_ambit, conclusion.problematic_ambit, conclusion_id); conclusion.conclusion_ambit = '-'; conclusion.problematic_ambit = '-';">+ Editar fila</button>
                                    <button class="btn btn-round btn-outline-secondary" @click="keysl = null; conclusion.conclusion_ambit = '-'; conclusion.problematic_ambit = '-';">- Cancelar</button>
                                  </template>
                                  <template v-else>
                                    <button class="btn btn-round btn-primary-outline-color" @click="sendData(conclusion.conclusion_probletic_ambit, conclusion.conclusion_ambit, conclusion.problematic_ambit, conclusion.id); conclusion.conclusion_ambit = '-'; conclusion.problematic_ambit = '-';">+ Anadir fila</button>
                                  </template>
                                  <hr class="hr-height">
                                </template>
                              </template>
                          </div>
                      </div>
                      <div class="row" v-show="round != 2">
                          <div class="col-md-12">
                              <div class="form-group" >
                                  <label class="h6 text-uppercase">Conclusión del Ámbito {{ ambit_selected.name }}</label>
                                  <vue-editor v-model="formConclusion['conclusion-'+decision.num+'-'+ambit_selected.num]" ></vue-editor>
                                  <!-- <wysiwyg v-model="formConclusion['conclusion-'+decision.num+'-'+ambit_selected.num]" /> -->

                              </div>
                              <div class="form-group" >
                                  <label class="h6 text-uppercase">Problemática de la conclusión del Ámbito {{ ambit_selected.name }}</label>
                                  <vue-editor v-model="formProblematic['problematic-'+decision.num+'-'+ambit_selected.num]"></vue-editor>
                                  <!-- <wysiwyg v-model="formProblematic['problematic-'+decision.num+'-'+ambit_selected.num]"/> -->

                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- <p class="text-primary text-uppercase"> {{ $t('observationsByAmbit.decision') }} {{ decision.num}}: {{ decision.name }}</p> -->
            </div>
            <!-- <div class="col-md-12">
                <div class="bg-dark">
                    <h4 class="text-center text-uppercase font-weight-bold mb-4 padding-1">
                        <img :src="`/img/assets/icons_INL_icon_${ambit_selected.name}_grey.svg`" style="width:2rem;" :alt="ambit_selected.name">
                        Ámbito {{ ambit_selected.name }}
                    </h4>
                </div>
            </div> -->
            <!-- <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                      <h5 class="uppercase font-weight-bold">
                        {{ $t('observationsByAmbit.decision') }} {{ decision.num }}: {{ decision.name }}
                      </h5>
                    </div>

                </div>
            </div> -->
            <div class="col-md-12 text-center mb-4">
                <button class="btn btn-round btn-primary-color" type="submit" @click.prevent="updateInfo">
                    {{ $t('observationsByAmbit.save_data') }}
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { VueEditor } from "vue2-editor";
// import { VueEditor } from "vue2-editor";
export default {
    components: { VueEditor },
    props: {
        cardCollapsed : Boolean,
    },
    computed: {
        actualAmbit(){
            if( this.$route.params.ambit == 'regulatory') {
               return 'Regulatorio'
            }
            else if (this.$route.params.ambit == 'institutional') {
                return 'Institucional'
            }
            else  {
                return 'Individual'
            }
        }
    },
    data:() => ({
      conclusion_id : 0,
      keysl : null,
        dataLoaded :  false,
        loadingGral :  false,
        round : 0,
        state_selected : {},
        decision: {},
        decisions: [],
        ambits: [],
        ambit_selected: {},
        decision_selected: 1,
        collapse: false,
        subsections: [],
        criterion_conclusions: [],
        fields_added: false,
        formConclusion: new Form ({
            id: '',
            state_id: '',
        }),
        formProblematic: new Form ({
            id: '',
            state_id: '',
        }),
        customToolbar: [
            ["bold", "italic", "underline"],
        ]
    }),

    methods: {
        deleteC(id, data, k){

          swal({
              title: '¿Estás seguro de eliminar?',
              text: "¡No podrás revertir esta acción!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sí, eliminar'
          }).then((result) => {
              if (result.value) {
                var sata = (data).filter((item) => item.id !== id);
                this.dataLoaded = true;
                axios.get('/api/delete-conclusion-problematic-ambits/' + id).then(response => {
                  this.criterion_conclusions[k]['conclusion_probletic_ambit'] = sata;
                  this.dataLoaded = false;
                }).catch(e => {
                  this.dataLoaded = false;
                });
              }
            });
        },

        editData(data, ca, pa, id){
          data[this.keysl]['conclusion_ambit'] = ca;
          data[this.keysl]['problematic_ambit'] = pa;
          this.dataLoaded = true;
            axios.post('/api/update-conclusion-problematic-ambits',{
              criterion_conclusions_id : this.conclusion_id,
              conclusion_ambit : ca,
              problematic_ambit : pa,
            }).then(response => {
              this.dataLoaded = false;
              this.keysl = null;
            }).catch(e => {
              this.keysl = null;
              this.dataLoaded = false;
              console.error(e);
            });
        },

        sendData(data, ca, pa, id){
          this.dataLoaded = true;
            axios.post('/api/save-conclusion-problematic-ambits',{
              criterion_conclusions_id : id,
              conclusion_ambit : ca,
              problematic_ambit : pa,
            }).then(response => {
              data.push({id : response.data.id, conclusion_ambit : ca, problematic_ambit : pa});
              this.dataLoaded = false;
            }).catch(e => {
              this.dataLoaded = false;
              console.error(e);
            });
        },

        updateInfo() {
            this.$Progress.start();

            axios.post('/api/save-conclusion-problematic',{
              data : this.criterion_conclusions,
            }).then(response => {
            }).catch(e => {
              console.error(e);
              toast({
                  type: 'error',
                  title: 'Error al guardar los datos'
              })
            });

            this.formProblematic.put('/api/problematic/'+this.formProblematic.id)
            .then(()=>{
              // this.getDecision();
                // this.$router.push(`/state/${this.$route.params.key}/qualitative-sources`)
                this.$Progress.finish();
            })
            .catch(() => {
                toast({
                    type: 'error',
                    title: 'Error al guardar los datos'
                })
                this.$Progress.fail();
            });

            this.formConclusion.put('/api/conclusion/'+this.formConclusion.id)
            .then(()=>{
                swal(
                    'Guardado',
                    'Información guardada correctamente.',
                    'success'
                )
                this.getDecision();
                // this.$router.push(`/state/${this.$route.params.key}/qualitative-sources`)
                this.$Progress.finish();
            })
            .catch(() => {
                toast({
                    type: 'error',
                    title: 'Error al guardar los datos'
                })
                this.$Progress.fail();
            });


        },
        addFormsFields(){
            for (var i=0; i<13; i++){
                for (var j=0; j<3; j++){
                    this.formConclusion['conclusion-'+(i+1)+'-'+(j+1)] = null;
                    this.formProblematic['problematic-'+(i+1)+'-'+(j+1)] = null;
                }
            }
            this.fields_added = true;
        },
        loadAmbits() {
            axios.get(`/api/ambit_by_slug/${this.$route.params.ambit}`)
            .then(({data}) => (
                this.ambit_selected = data
            )).catch(()=>{
                toast({
                    type: 'error',
                    title: 'Error al cargar datos 1'
                })
            })
        },
        loadState(){
          this.loadingGral = true;
            this.addFormsFields();
            this.loadAmbits();
            this.getDecision();
            this.loading = true;
            axios.get(`/api/observations_by_ambit/${this.$route.params.key}`)
            .then(({data}) => (
                this.round = (data.id < 37 ? 1 : 2),
                this.state_selected = data,
                this.formProblematic.fill(data.problematic),
                this.formConclusion.fill(data.conclusion),
                this.criterion_conclusions = data.criterion_conclusions,
                this.loadingGral = false
            )).catch((e)=>{
                toast({
                    type: 'error',
                    title: 'Error al cargar datos 3'
                })
                this.loadingGral = false;
            });
        },
        getDecision() {
            axios.get(`/api/decision/${this.decision_selected}&${this.$route.params.key}`).then(
                ({data}) => (
                    this.decision = data[0]
                )
            ).catch(()=>{
                toast({
                    type: 'error',
                    title: 'Error al cargar datos 2'
                })
            })
        },
        changeDecision(number){
            this.decision_selected = number;
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
    created() {
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
.btn-outline {
    background: transparent;
    border: 1px solid #13385d;
    color: #13385d;
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
textarea.grey {
    background: #f9f9f9;
    margin :0 0 30px 0 ;
}
.padding-1 {
    padding: 1rem;
}
.btn-primary-color{
    color: #fff;
    background-color: #13519b;
    border-color: #13519b;
}

.btn-primary-outline-color{
    color: #13519b;
    background-color: transparent;
    border-color: #13519b;
}

.btn-fixed {
    position: fixed;
    bottom: 2.5em;
    right: 2em;
}
</style>
