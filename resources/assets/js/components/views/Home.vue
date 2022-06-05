<template>
  <div class="home container" @click="closeDropdown()">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">
                <span class="font-weight-bold text-dark">
                  {{ $t('breadcrumb.state') }}
                </span>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="row">
      <div class="col-md-12 mb-4">
        <h4 class="text-center text-uppercase font-weight-bold">{{ $t('states.select_state') }}</h4>
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
    <div v-else>
      <div class="card">
        <div class="card-header second-blue" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" @click="toggleCollapsedOne()" aria-expanded="true" aria-controls="collapseOne">
              <template v-if="collapse_show_one === 'collapse show'">
                <img src="/img/up.png" alt="progress" class="img-align">
              </template>
              <template v-if="collapse_show_one === 'collapse'">
                <img src="/img/down.png" alt="progress" class="img-align">
              </template>
              &nbsp;
              <span class="text-dark" ><b>Ronda 1</b></span>
            </button>
          </h5>
        </div>

        <div id="collapseOne" :class="collapse_show_one" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body" >
            <div class="row">


              <div class="col-md-4 " v-for="(state, index) in states" :key="index">


                <div class="dropdown-menu dropdown-menu-right" :id="'dropdown'+state.id" style="margin-top :  -70px;">
  <button class="dropdown-item" type="button" @click="linknewP(state)">{{ $t('other.open_np') }}</button>
  <button class="dropdown-item" type="button" @click="linknewV(state)">{{ $t('other.open_nv') }}</button>
</div>
                <div class="card pointer" style="height: 80%;display:flex;"
                  @contextmenu.prevent.stop="cardOptions(state)" >
                  <div class="card-body" @click="selectState(state)">

                    <div class="row" style="height: 100%; align-content: center;">
                      <div class="col-md-3" style="align-self: center;">
                        <center>
                          <template>
                            <vue-circle

                            ref= "someRef"
                            :data-key="state.key"
                            :progress="0"
                            :size="30"
                            :reverse="false"
                            line-cap="round"
                            :animation-start-value="0.0"
                            :start-angle="80"
                            insert-mode="append"
                            :thickness="6"
                            :show-percent="false"
                            @vue-circle-progress="progress"
                            @vue-circle-end="progress_end">
                          </vue-circle>

                        </template>
                      </center>

                    </div>
                    <div class="col-md-9">
                      <div class="d-inline-flex p-2">
                        <span>{{ state.name }}</span>
                      </div>

                    </div>
                  </div>
                  <!-- <div class="active-state"></div> -->
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" @click="toggleCollapsedTwo()" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <template v-if="collapse_show_two === 'collapse show'">
              <img src="/img/up.png" alt="progress" class="img-align">
            </template>
            <template v-if="collapse_show_two === 'collapse'">
              <img src="/img/down.png" alt="progress" class="img-align">
            </template>
            &nbsp;
            <span class="text-dark" ><b>Ronda 2</b></span>
          </button>
        </h5>
      </div>
      <div id="collapseTwo" :class="collapse_show_two" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <div class="row">


            <div class="col-md-4 " v-for="(state, index) in states_two" :key="index">
              <div class="dropdown-menu dropdown-menu-right" :id="'dropdown'+state.id" style="margin-top :  -70px;">
<button class="dropdown-item" type="button" @click="linknewP(state)">{{ $t('other.open_np') }}</button>
<button class="dropdown-item" type="button" @click="linknewV(state)">{{ $t('other.open_nv') }}</button>
</div>
              <div class="card pointer" style="height: 80%;display:flex;"
                @contextmenu.prevent.stop="cardOptions(state)" >
                <div class="card-body" @click="selectState(state)">
                  <div class="row" style="height: 100%; align-content: center;">
                    <div class="col-md-3" style="align-self: center;">
                      <center>
                        <template>
                          <vue-circle
                          ref= "someRef"
                          :data-key="state.key"
                          :progress="0"
                          :size="30"
                          :reverse="false"
                          line-cap="round"
                          :animation-start-value="0.0"
                          :start-angle="80"
                          insert-mode="append"
                          :thickness="6"
                          :show-percent="false"
                          @vue-circle-progress="progress"
                          @vue-circle-end="progress_end">
                        </vue-circle>
                      </template>
                    </center>

                  </div>
                  <div class="col-md-9">
                    <div class="d-inline-flex p-2">
                      <span>{{ state.name }}</span>
                    </div>

                  </div>
                </div>
                <!-- <div class="active-state"></div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<hr>
<center>
  <!--           <h2 class="font-weight-bold" style="color: #6c757d;"> REPORTES PERSONALIZADOS </h2>
  <br> -->
  <!-- <p class="btn-primary btn-round">
  <a href="/custom-report" class="overflow-visible">
    <img src="/img/02.6_icon.png" alt="progress" class="img-align">
    {{ $t('states.custom_report_button') }}
  </a>
  </p> -->
  <router-link to="/custom-report" v-if="profile.type != 'readonly'">
    <button  class="btn btn-primary btn-round overflow-visible" >
      <h5 class="font-weight-bold" style="overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: initial;">
        <img src="/img/02.6_icon.png" alt="progress" class="img-align">
        {{ $t('states.custom_report_button') }}
      </h5>
    </button>
  </router-link>
</center>
<br>
</div>
</template>

<script>
import VueCircle from 'vue2-circle-progress'
export default {
  components: {
    VueCircle
  },
  data: () => ({
    collapse_round_one : false,
    collapse_round_two : true,
    languaje:'',
    loading: false,
    profile:{},
    states: '',
    states_two : '',
    documentaryPercentaje:{
      map: 0,
      organization_chart: 0,
      headquarters: 0,
      color:'',
      progress: '0%'
    },
    cuantitativePercentaje: {
      color:'',
      prorgess: '0%'
    },
    cualitativePercentaje:{
      progress: '0%',
      color: ''
    },
    percntajesProgress: [],
    total: 0,
    cantVar : '',
    totalCriterioRegulatorio : 0,
    totalCriterioIndividual : 0,
    totalCriterioinstitucional : 0,
    collapse_show_one : 'collapse show',
    collapse_show_two : 'collapse',
  }),
  methods: {
    cardOptions(state){

      // $(".dropdown-menu").dropdown('hide');
      // this.folderSelected = folder;
      $(".dropdown-menu").hide();
      console.log($('#dropdown'+state.id));
      $('#dropdown'+state.id).slideToggle('fast')
    },

    toggleCollapsedOne(){
      if (this.collapse_show_one === 'collapse show') {
        this.collapse_show_one = 'collapse';
      }else {
        if (this.collapse_show_two === 'collapse show') {
          this.collapse_show_two = 'collapse';
        }
        this.collapse_show_one = 'collapse show';
      }
    },

    toggleCollapsedTwo(){
      if (this.collapse_show_two === 'collapse show') {
        this.collapse_show_two = 'collapse';
      }else {
        this.collapse_show_two = 'collapse show';
        if (this.collapse_show_one === 'collapse show') {
          this.collapse_show_one = 'collapse';
        }
      }
    },

    loadData(){
      this.loading = true;
      axios.get("api/state").then(
        ({data}) => (
          this.states = data,
          this.globalProgressReport()
        )
      ).catch(()=>{
        toast({
          type: 'error',
          title: 'Error al cargar datos'
        })
        this.loading = false;
      });
      axios.get("api/state-two").then(
        ({data}) => (
          this.states_two = data,
          this.globalProgressReportTwo()
        )
      ).catch((e)=>{
        toast({
          type: 'error',
          title: 'Error al cargar datos 2'
        })
        // console.error(e);
        this.loading = false;
      });
      axios.get("api/profile").then(
        ({data}) => {
          this.profile = data;

        }
      ).catch(()=>{
        toast({
          type: 'error',
          title: 'Error al cargar datos'
        })
        this.loading = false;
      });
      // axios.get(`/api/variable`).then(response => {
      //   this.cantVar = response.data.length;
      // });
      // axios.get(`/api/subsections-by-decisionambit/all`).then(response => {
      //   this.totalCriterioRegulatorio = response.data.filter(subsections => subsections.ambit.name == 'regulatorio');
      //   this.totalCriterioIndividual = response.data.filter(subsections => subsections.ambit.name == 'individual');
      //   this.totalCriterioinstitucional = response.data.filter(subsections => subsections.ambit.name == 'institucional');
      // });
    },
    selectState(state){
      this.$router.push(`state/${state.key}`)
      this.$store.commit('AddState',state)
    },

    linknewP(state){
      // this.$router.push(`state/${state.key}`)
      // this.$store.commit('AddState',state)
      window.open(`state/${state.key}`,'_blank'); // Se abre una nueva ventana enlace externo
       $('#dropdown'+state.id).hide();
 // 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"
    },

    linknewV(state){
      // this.$router.push(`state/${state.key}`)
      // this.$store.commit('AddState',state)
      window.open(`state/${state.key}`,'_blank', 'location=yes,scrollbars=yes,status=yes'); // Se abre una nueva ventana enlace externo
       $('#dropdown'+state.id).hide();
    },

    closeDropdown(){
      $(".dropdown-menu").hide();
    },
    //actualziacion

    async globalProgressReport(){
      /*  this.$refs.myUniqueID.updateProgress(global); */
      const timeout = await this.states.forEach(element => {
        this.dataByState(element.key)
      });

      this.loading = false;
    },

    async globalProgressReportTwo(){
      /*  this.$refs.myUniqueID.updateProgress(global); */
      const timeout_two = await this.states_two.forEach(element => {
        this.dataByState(element.key)
      });

      this.loading = false;
    },

    progress(event,progress,stepValue){
      //console.log(stepValue);
    },
    progress_end(event){
      //  console.log("Circle progress end");
    },
    updateProgress(value){
      /*  console.log('update progress');
      console.log(value) */
    },

    async dataByState(key){
      const progress = await this.averageDocumentary(key);
      // const progressCuantitative = await this.averageCuantitative(key);
      const progressCualitative = await this.averageCualitative(key);

      // var iprogress = parseInt(progress);
      // var iprogresCuantitative = parseInt(progressCuantitative);
      var iprogresCualitative = parseInt(progressCualitative);

      const totalPercentaje = progress + iprogresCualitative;
      const global = totalPercentaje/3;

      const dropdown = this.$refs['someRef'].find(
        el => el.$attrs['data-key'] === key
      );
      dropdown.updateProgress(global);
      if (global > 90 ) {
        dropdown.updateFill("#8cc63f");
      }else{
        dropdown.updateFill("#f7b500");
      }
    },
    async averageCualitative(key){
      const stateByKey = await axios.get(`/api/get-cpoc/${key}`)

      let total = stateByKey.data.length * 100;
      let registrado = 0;
      (stateByKey.data).forEach((item, i) => {
        registrado += item.percentage;
      });

      let totalPercentaje = (registrado * 100) / total;

      return totalPercentaje;

    },
    async averageDocumentary(key){
      const stateByKey = await axios.get(`/api/get-document-status/${key}`)

        var headquarters = stateByKey.data[3].percentage;
        var organization_chart = stateByKey.data[6].percentage;
        var map = stateByKey.data[4].percentage;

        var uno = parseInt(((headquarters + organization_chart + map)/ 3).toFixed(0));

        var cuanti = stateByKey.data[2].percentage;
        var dos = parseInt(cuanti);

        return (uno + dos);
    },
    async averageCuantitative(key){
      const indicators = await axios.get(`/api/get_state_quantitative_source/${key}`);

      const progress = indicators.data.percentage;

      return progress;
    },

    //fin actualizacion


  },
  created(){
    const languaje = localStorage.getItem("languaje");
    this.languaje = languaje;
    this.$i18n.locale = languaje;
    this.loadData();
  }
}
</script>

<style lang="scss" scoped>
@import "../../../sass/_variables.scss";
.active-state {
  width: 2.5em;
  height: 0.7em;
  background-color: $green;
  position: absolute;
  top: 0.5em;
  left: 0.5em;
  border-radius: 3px;
}

.inactive-state {
  width: 2.5em;
  height: 0.7em;
  background-color: #efefef;
  position: absolute;
  top: 0.5em;
  left: 0.5em;
  border-radius: 3px;
}

.card:hover {
  box-shadow: 4px 5px 16px 3px rgba(0,0,0,0.16) !important;
}
.img-align {
  margin-right: 5px
}
</style>
