  <template>
  <div class="quantitative_sources container">
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
                  {{ $t('breadcrumb.quantitative_sources') }}
                </span>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="row">
      <div class="col-md-12 mb-4">
        <h4 class="text-center text-uppercase font-weight-bold">{{ $t('quantitative_sources.title') }}</h4>
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
      <!-- <div class="col-md-12"> -->
      <!-- <div class="row"> -->
        <div class="col-md-12 mb-3">
          <a href="#" @click="viewIndicators()"><img src="/img/assets/icons_INL_icon_eye_active.svg" alt="see" style="width: 2.5em;">
            {{ $t('quantitative_sources.see_indicators_by_decision') }}</a>
            <!-- <router-link :to="`/state/${this.$route.params.key}/quantitative-sources/indicators-by-decision`" class="btn btn-link mb-2 float-right">
            <img src="/img/assets/icons_INL_icon_eye_active.svg" alt="see" style="width: 2.5em;">
            {{ $t('quantitative_sources.see_indicators_by_decision') }}
          </router-link> -->
        </div>
      <!-- </div> -->
      <!-- <div class="row"> -->
        <div class="col-md-12">

          <div class="card">
            <div class="card-header bg-primary font-weight-bold">
              <span class="card-title">{{ $t('quantitative_sources.card_header') }}</span>
            </div>
            <div class="card-body">

                <div class="col-md-12">
                  <ul class="nav justify-content-end">
                    <li class="nav-item">
                      <a class="nav-link active" href="#">
                        <span class="text-success">
                          <i class="fas fa-square"></i>
                        </span>
                        {{ $t('state.complete_task') }}
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <span class="text-danger">
                          <i class="fas fa-square"></i>
                        </span>
                        {{ $t('state.pending_task') }}
                      </a>
                    </li>
                  </ul>
                </div>

                <div class="table-responsive col-md-12">
                  <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">{{ $t('quantitative_sources.data_for_previus_year') }}</th>
                      <th scope="col">{{ $t('quantitative_sources.source') }}</th>
                      <th scope="col" v-show="state_selected.round == 1">Total (2017)</th>
                      <th scope="col" v-show="state_selected.round == 1">N/A</th>
                      <th scope="col">Total (2018)</th>
                      <th scope="col">N/A</th>
                      <th scope="col">Total (2019)</th>
                      <th scope="col">N/A</th>
                      <th scope="col">Total (2020)</th>
                      <th scope="col">N/A</th>
                      <th scope="col" v-show="state_selected.round == 2">Total (2021)</th>
                      <th scope="col" v-show="state_selected.round == 2">N/A</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(variable, index) in variables" :key="index">

                      <template v-if="((variable.num).split('.')).length == 1">
                        <td>
                          <p class="one"> {{ variable.num }}. {{ variable.name }}</p>
                        </td>
                      </template>
                      <template v-else-if="((variable.num).split('.')).length == 2">
                        <td>
                          <p class="two"> {{ variable.num }}. {{ variable.name }}</p>
                        </td>
                      </template>
                      <template v-else-if="((variable.num).split('.')).length == 3">
                        <td>
                          <p class="three"> {{ variable.num }}. {{ variable.name }}</p>
                        </td>
                    </template>

                    <td>{{ variable.source }}</td>

                    <td v-show="state_selected.round == 1">
                      <!-- :readonly="$gate.isINL()" -->
                      <input  :id="variable.slug_2017" v-model="form[variable.slug_2017]" type="number" class="form-control" :disabled="form[variable.check_slug_2017] == 1" :class="{ done: form[variable.slug_2017] || form[variable.check_slug_2017] == 1, pending : !form[variable.slug_2017] }">
                    </td>
                    <td v-show="state_selected.round == 1">
                      <i class="far mt-2 pointer" :class="{ 'fa-square': form[variable.check_slug_2017] == 0, 'fa-check-square': form[variable.check_slug_2017] == 1 }" @click="toggleCheck2017(variable.check_slug_2017, variable.slug_2017)"></i>
                    </td>
                    <td>
                      <!-- :readonly="$gate.isINL()" -->
                      <input  :id="variable.slug_2018" v-model="form[variable.slug_2018]" type="number" class="form-control" :disabled="form[variable.check_slug_2018] == 1" :class="{ done: form[variable.slug_2018] || form[variable.check_slug_2018] == 1, pending : !form[variable.slug_2018] }">
                    </td>
                    <td>
                      <i class="far mt-2 pointer" :class="{ 'fa-square': form[variable.check_slug_2018] == 0, 'fa-check-square': form[variable.check_slug_2018] == 1 }" @click="toggleCheck(variable.check_slug_2018, variable.slug_2018)"></i>
                    </td>
                    <!-- New -->
                    <td>
                      <!-- :readonly="$gate.isINL()" -->
                      <input  :id="variable.slug_2019" v-model="form[variable.slug_2019]" type="number" class="form-control" :disabled="form[variable.check_slug_2019] == 1" :class="{ done: form[variable.slug_2019] || form[variable.check_slug_2019] == 1, pending : !form[variable.slug_2019] }">
                    </td>
                    <td>

                      <i class="far mt-2 pointer" :class="{ 'fa-square': form[variable.check_slug_2019] == 0, 'fa-check-square': form[variable.check_slug_2019] == 1 }" @click="toggleCheck2019(variable.check_slug_2019, variable.slug_2019)"></i>
                    </td>
                    <td>
                      <!-- :readonly="$gate.isINL()" -->
                      <input  :id="variable.slug_2020" v-model="form[variable.slug_2020]" type="number" class="form-control" :disabled="form[variable.check_slug_2020] == 1" :class="{ done: form[variable.slug_2020] || form[variable.check_slug_2020] == 1, pending : !form[variable.slug_2020] }">
                    </td>
                    <td>
                      <i class="far mt-2 pointer" :class="{ 'fa-square': form[variable.check_slug_2020] == 0, 'fa-check-square': form[variable.check_slug_2020] == 1 }" @click="toggleCheck2020(variable.check_slug_2020, variable.slug_2020)"></i>
                    </td>
                    <td v-show="state_selected.round == 2">
                      <!-- :readonly="$gate.isINL()" -->
                      <input  :id="variable.slug_2021" v-model="form[variable.slug_2021]" type="number" class="form-control" :disabled="form[variable.check_slug_2021] == 1" :class="{ done: form[variable.slug_2021] || form[variable.check_slug_2021] == 1, pending : !form[variable.slug_2021] }">
                    </td>
                    <td v-show="state_selected.round == 2">
                      <i class="far mt-2 pointer" :class="{'fa-square': form[variable.check_slug_2021] == 0, 'fa-check-square': form[variable.check_slug_2021] == 1 }"
                      @click="toggleCheck2021( variable.check_slug_2021,variable.slug_2021)"></i>
                    </td>
                    <!-- New End -->
                    </tr>

                  </tbody>
                </table>
          </div>

          </div>
        </div>
      </div>
    <!-- </div> -->


    <!-- </div> -->
    <!-- v-if="!$gate.isINL()" -->
    <div class="col-md-12 text-center mb-4" >
      <button class="btn btn-primary btn-round" @click.prevent="updateInfo" type="submit">{{ $t('quantitative_sources.save_data') }}</button>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data: () => ({
    fields_added: false,
    loading: false,
    state_selected: {},
    completed: '',
    input: '',
    form: new Form({
      id: '',
      state_id: '',
      variable1_2018: '',
      variable2_2018: '',
      variable3_2018: '',
      variable4_2018: '',
      variable5_2018: '',
      variable6_2018: '',
      variable7_2018: '',
      variable8_2018: '',
      variable9_2018: '',
      variable10_2018: '',
      variable11_2018: '',
      variable12_2018: '',
      variable13_2018: '',
      variable14_2018: '',
      variable15_2018: '',
      variable16_2018: '',
      variable17_2018: '',
      variable18_2018: '',
      variable19_2018: '',
      variable20_2018: '',
      variable21_2018: '',
      variable22_2018: '',
      variable23_2018: '',
      variable24_2018: '',
      variable25_2018: '',
      variable26_2018: '',
      variable27_2018: '',
      variable28_2018: '',
      variable29_2018: '',
      variable30_2018: '',
      variable31_2018: '',
      variable32_2018: '',
      variable33_2018: '',
      variable34_2018: '',
      variable35_2018: '',
      variable36_2018: '',
      variable37_2018: '',
      variable38_2018: '',
      variable39_2018: '',
      variable40_2018: '',
      variable41_2018: '',
      variable42_2018: '',
      variable43_2018: '',

      checked1_2018: '',
      checked2_2018: '',
      checked3_2018: '',
      checked4_2018: '',
      checked5_2018: '',
      checked6_2018: '',
      checked7_2018: '',
      checked8_2018: '',
      checked9_2018: '',
      checked10_2018: '',
      checked11_2018: '',
      checked12_2018: '',
      checked13_2018: '',
      checked14_2018: '',
      checked15_2018: '',
      checked16_2018: '',
      checked17_2018: '',
      checked18_2018: '',
      checked19_2018: '',
      checked20_2018: '',
      checked21_2018: '',
      checked22_2018: '',
      checked23_2018: '',
      checked24_2018: '',
      checked25_2018: '',
      checked26_2018: '',
      checked27_2018: '',
      checked28_2018: '',
      checked29_2018: '',
      checked30_2018: '',
      checked31_2018: '',
      checked32_2018: '',
      checked33_2018: '',
      checked34_2018: '',
      checked35_2018: '',
      checked36_2018: '',
      checked37_2018: '',
      checked38_2018: '',
      checked39_2018: '',
      checked40_2018: '',
      checked41_2018: '',
      checked42_2018: '',
      checked43_2018: '',

      variable1_2017: '',
      variable2_2017: '',
      variable3_2017: '',
      variable4_2017: '',
      variable5_2017: '',
      variable6_2017: '',
      variable7_2017: '',
      variable8_2017: '',
      variable9_2017: '',
      variable10_2017: '',
      variable11_2017: '',
      variable12_2017: '',
      variable13_2017: '',
      variable14_2017: '',
      variable15_2017: '',
      variable16_2017: '',
      variable17_2017: '',
      variable18_2017: '',
      variable19_2017: '',
      variable20_2017: '',
      variable21_2017: '',
      variable22_2017: '',
      variable23_2017: '',
      variable24_2017: '',
      variable25_2017: '',
      variable26_2017: '',
      variable27_2017: '',
      variable28_2017: '',
      variable29_2017: '',
      variable30_2017: '',
      variable31_2017: '',
      variable32_2017: '',
      variable33_2017: '',
      variable34_2017: '',
      variable35_2017: '',
      variable36_2017: '',
      variable37_2017: '',
      variable38_2017: '',
      variable39_2017: '',
      variable40_2017: '',
      variable41_2017: '',
      variable42_2017: '',
      variable43_2017: '',

      checked1_2017: '',
      checked2_2017: '',
      checked3_2017: '',
      checked4_2017: '',
      checked5_2017: '',
      checked6_2017: '',
      checked7_2017: '',
      checked8_2017: '',
      checked9_2017: '',
      checked10_2017: '',
      checked11_2017: '',
      checked12_2017: '',
      checked13_2017: '',
      checked14_2017: '',
      checked15_2017: '',
      checked16_2017: '',
      checked17_2017: '',
      checked18_2017: '',
      checked19_2017: '',
      checked20_2017: '',
      checked21_2017: '',
      checked22_2017: '',
      checked23_2017: '',
      checked24_2017: '',
      checked25_2017: '',
      checked26_2017: '',
      checked27_2017: '',
      checked28_2017: '',
      checked29_2017: '',
      checked30_2017: '',
      checked31_2017: '',
      checked32_2017: '',
      checked33_2017: '',
      checked34_2017: '',
      checked35_2017: '',
      checked36_2017: '',
      checked37_2017: '',
      checked38_2017: '',
      checked39_2017: '',
      checked40_2017: '',
      checked41_2017: '',
      checked42_2017: '',
      checked43_2017: '',
      // 2019
      variable1_2019: '',
      variable2_2019: '',
      variable3_2019: '',
      variable4_2019: '',
      variable5_2019: '',
      variable6_2019: '',
      variable7_2019: '',
      variable8_2019: '',
      variable9_2019: '',
      variable10_2019: '',
      variable11_2019: '',
      variable12_2019: '',
      variable13_2019: '',
      variable14_2019: '',
      variable15_2019: '',
      variable16_2019: '',
      variable17_2019: '',
      variable18_2019: '',
      variable19_2019: '',
      variable20_2019: '',
      variable21_2019: '',
      variable22_2019: '',
      variable23_2019: '',
      variable24_2019: '',
      variable25_2019: '',
      variable26_2019: '',
      variable27_2019: '',
      variable28_2019: '',
      variable29_2019: '',
      variable30_2019: '',
      variable31_2019: '',
      variable32_2019: '',
      variable33_2019: '',
      variable34_2019: '',
      variable35_2019: '',
      variable36_2019: '',
      variable37_2019: '',
      variable38_2019: '',
      variable39_2019: '',
      variable40_2019: '',
      variable41_2019: '',
      variable42_2019: '',
      variable43_2019: '',

      checked1_2019: '',
      checked2_2019: '',
      checked3_2019: '',
      checked4_2019: '',
      checked5_2019: '',
      checked6_2019: '',
      checked7_2019: '',
      checked8_2019: '',
      checked9_2019: '',
      checked10_2019: '',
      checked11_2019: '',
      checked12_2019: '',
      checked13_2019: '',
      checked14_2019: '',
      checked15_2019: '',
      checked16_2019: '',
      checked17_2019: '',
      checked18_2019: '',
      checked19_2019: '',
      checked20_2019: '',
      checked21_2019: '',
      checked22_2019: '',
      checked23_2019: '',
      checked24_2019: '',
      checked25_2019: '',
      checked26_2019: '',
      checked27_2019: '',
      checked28_2019: '',
      checked29_2019: '',
      checked30_2019: '',
      checked31_2019: '',
      checked32_2019: '',
      checked33_2019: '',
      checked34_2019: '',
      checked35_2019: '',
      checked36_2019: '',
      checked37_2019: '',
      checked38_2019: '',
      checked39_2019: '',
      checked40_2019: '',
      checked41_2019: '',
      checked42_2019: '',
      checked43_2019: '',
      // 2019
      // 2020
      variable1_2020: '',
      variable2_2020: '',
      variable3_2020: '',
      variable4_2020: '',
      variable5_2020: '',
      variable6_2020: '',
      variable7_2020: '',
      variable8_2020: '',
      variable9_2020: '',
      variable10_2020: '',
      variable11_2020: '',
      variable12_2020: '',
      variable13_2020: '',
      variable14_2020: '',
      variable15_2020: '',
      variable16_2020: '',
      variable17_2020: '',
      variable18_2020: '',
      variable19_2020: '',
      variable20_2020: '',
      variable21_2020: '',
      variable22_2020: '',
      variable23_2020: '',
      variable24_2020: '',
      variable25_2020: '',
      variable26_2020: '',
      variable27_2020: '',
      variable28_2020: '',
      variable29_2020: '',
      variable30_2020: '',
      variable31_2020: '',
      variable32_2020: '',
      variable33_2020: '',
      variable34_2020: '',
      variable35_2020: '',
      variable36_2020: '',
      variable37_2020: '',
      variable38_2020: '',
      variable39_2020: '',
      variable40_2020: '',
      variable41_2020: '',
      variable42_2020: '',
      variable43_2020: '',

      checked1_2020: '',
      checked2_2020: '',
      checked3_2020: '',
      checked4_2020: '',
      checked5_2020: '',
      checked6_2020: '',
      checked7_2020: '',
      checked8_2020: '',
      checked9_2020: '',
      checked10_2020: '',
      checked11_2020: '',
      checked12_2020: '',
      checked13_2020: '',
      checked14_2020: '',
      checked15_2020: '',
      checked16_2020: '',
      checked17_2020: '',
      checked18_2020: '',
      checked19_2020: '',
      checked20_2020: '',
      checked21_2020: '',
      checked22_2020: '',
      checked23_2020: '',
      checked24_2020: '',
      checked25_2020: '',
      checked26_2020: '',
      checked27_2020: '',
      checked28_2020: '',
      checked29_2020: '',
      checked30_2020: '',
      checked31_2020: '',
      checked32_2020: '',
      checked33_2020: '',
      checked34_2020: '',
      checked35_2020: '',
      checked36_2020: '',
      checked37_2020: '',
      checked38_2020: '',
      checked39_2020: '',
      checked40_2020: '',
      checked41_2020: '',
      checked42_2020: '',
      checked43_2020: '',
      // 2020
      // 2021
      variable1_2021: '',
      variable2_2021: '',
      variable3_2021: '',
      variable4_2021: '',
      variable5_2021: '',
      variable6_2021: '',
      variable7_2021: '',
      variable8_2021: '',
      variable9_2021: '',
      variable10_2021: '',
      variable11_2021: '',
      variable12_2021: '',
      variable13_2021: '',
      variable14_2021: '',
      variable15_2021: '',
      variable16_2021: '',
      variable17_2021: '',
      variable18_2021: '',
      variable19_2021: '',
      variable20_2021: '',
      variable21_2021: '',
      variable22_2021: '',
      variable23_2021: '',
      variable24_2021: '',
      variable25_2021: '',
      variable26_2021: '',
      variable27_2021: '',
      variable28_2021: '',
      variable29_2021: '',
      variable30_2021: '',
      variable31_2021: '',
      variable32_2021: '',
      variable33_2021: '',
      variable34_2021: '',
      variable35_2021: '',
      variable36_2021: '',
      variable37_2021: '',
      variable38_2021: '',
      variable39_2021: '',
      variable40_2021: '',
      variable41_2021: '',
      variable42_2021: '',
      variable43_2021: '',

      checked1_2021: '',
      checked2_2021: '',
      checked3_2021: '',
      checked4_2021: '',
      checked5_2021: '',
      checked6_2021: '',
      checked7_2021: '',
      checked8_2021: '',
      checked9_2021: '',
      checked10_2021: '',
      checked11_2021: '',
      checked12_2021: '',
      checked13_2021: '',
      checked14_2021: '',
      checked15_2021: '',
      checked16_2021: '',
      checked17_2021: '',
      checked18_2021: '',
      checked19_2021: '',
      checked20_2021: '',
      checked21_2021: '',
      checked22_2021: '',
      checked23_2021: '',
      checked24_2021: '',
      checked25_2021: '',
      checked26_2021: '',
      checked27_2021: '',
      checked28_2021: '',
      checked29_2021: '',
      checked30_2021: '',
      checked31_2021: '',
      checked32_2021: '',
      checked33_2021: '',
      checked34_2021: '',
      checked35_2021: '',
      checked36_2021: '',
      checked37_2021: '',
      checked38_2021: '',
      checked39_2021: '',
      checked40_2021: '',
      checked41_2021: '',
      checked42_2021: '',
      checked43_2021: '',
      // 2021
    }),
    variables: [],
  }),
  methods: {
    // addFormsFields(){
    //     for (var i=0; i<35; i++){
    //         this.form['variable'+(i+1)+'_2017'] = '';
    //         this.form['variable'+(i+1)+'_2018'] = '';
    //         this.form['checked'+(i+1)+'_2017'] = '0';
    //         this.form['checked'+(i+1)+'_2018'] = '0';
    //     }
    //     this.fields_added = true;
    // },
    toggleCheck2017(check_slug_2017, slug_2017){
      this.form[check_slug_2017] = 1 - this.form[check_slug_2017];
      this.form[slug_2017] = '';
    },
    toggleCheck(check_slug_2018, slug_2018) {
      this.form[check_slug_2018] = 1 - this.form[check_slug_2018];
      this.form[slug_2018] = '';
    },
    toggleCheck2019(check_slug_2019, slug_2019){
      this.form[check_slug_2019] = 1 - this.form[check_slug_2019];
      this.form[slug_2019] = '';
    },
    toggleCheck2020(check_slug_2020, slug_2020){
      this.form[check_slug_2020] = 1 - this.form[check_slug_2020];
      this.form[slug_2020] = '';
    },
    toggleCheck2021(check_slug_2021, slug_2021){
      this.form[check_slug_2021] = 1 - this.form[check_slug_2021];
      this.form[slug_2021] = '';
    },
    loadVariables(){
      axios.get('/api/variable/' +this.$route.params.key )
      .then(({data}) => (
        this.variables = data
      )).catch(()=>{
        toast({
          type: 'error',
          title: 'Error al cargar datos'
        })
      });
    },
    loadData() {
      // this.addFormsFields();
      this.loadVariables();
      this.loading = true;
      // if(this.fields_added){
      axios.get(`/api/state_quantitative_source/${this.$route.params.key}`)
      .then(response => {
        this.loading = false;
        this.state_selected = response.data;
        this.form.fill(JSON.parse(response.data.quantitative_source.data));
      }).catch(()=>{
        toast({
          type: 'error',
          title: 'Error al cargar datos'
        })
        this.loading = false;
      });
      // } else {
      //     toast({
      //             type: 'error',
      //             title: 'Algo salió mal.'
      //     })
      //     this.loading = false;
      // }
    },
    updateInfo() {
      this.$Progress.start();
      this.form.put('/api/quantitative_source/'+this.form.id)
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
          title: 'Error al guardar los datos'
        })
        this.$Progress.fail();
      });
    },

    viewIndicators(){
      if (this.state_selected.round == 1) {
        var cadena = ['2017','2018','2019','2020'];
      }else if (this.state_selected.round == 2) {
        var cadena = ['2018','2019','2020','2021'];
      }

      swal({
        title: 'Seleccionar el año de consulta',
        input: 'select',
        inputOptions: cadena,
        inputPlaceholder: 'Seleccionar',
        confirmButtonText:
        'Continuar <i class="fa fa-arrow-right></i>',
        showCancelButton: true,
        customClass: 'form-check form-check-inline',
        inputValidator: (result) => {
          return !result && 'Se requiere elegir un año'
        }
      }).then((result) => {
        if (result.value) {
          this.$router.push(`/state/${this.$route.params.key}/quantitative-sources/indicators-by-decision/${cadena[result.value]}`);
        }
      }).catch(e => {
        console.error(e);
      });
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
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap');

.shadow {
  box-shadow: 4px 5px 16px 3px rgba(0,0,0,0.16) !important;
}

.pending {
  border-left: 0.5em solid $danger;
}

.done {
  border-left: 0.5em solid $success !important;
  width: 4.5rem;
}

.card-title {
  font-family: "Open Sans Condensed", sans-serif;
}

.border-bottom {
  border-bottom:  1px solid;
}

.table td {
  padding:.85rem;
}
.one {
  font-family: 'Montserrat',sans-serif;
  font-weight:600;
}
.two {
  font-family: 'Montserrat',sans-serif;
  font-weight:500;
  padding-left: 8px;
}
.three {
  font-family: 'Montserrat',sans-serif;
  font-weight:400;
  padding-left: 28px;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
