<template>
  <div class="col-md-12">
    <div class="card" :class="{ 'collapsed-card' : decision.num != 1 }">
      <div class="card-header bg-primary">
        <p style="padding-right: 1em;">Decisión {{ decision.num }}: {{ decision.name }}</p>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" @click="$emit('toggle-collapsed', decision)">
            <i v-if="decision.collapsed == 1" class="fa fa-plus"></i>
            <i v-if="decision.collapsed != 1" class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table :id="'conclusions-decision'+decision.num" class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">{{ $t('detailedReport.level') }} </th>
                    <th class="text-center">{{ $t('detailedReport.conclusion_by_level') }}</th>
                    <th class="text-center">{{ $t('detailedReport.possible_problem') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th class="text-center">
                      <img src="/img/assets/icons_INL_icon_regulatorio_blue.svg" style="width:1.5rem;" alt="">
                      {{ $t('detailedReport.regulatory') }}
                    </th>
                    <td>
                      <div v-html="conclusion.conclusion['conclusion-'+decision.num+'-'+1]" />
                      <div v-for="t in conclusion.criterion_conclusions" >
                        <template v-if="t.ambit_id == 1 && t.decision_id == decision.num">
                          <template v-if="t.conclusion_ambit != null">
                            <template v-for="s in t.conclusion_probletic_ambit">
                              <div v-html="s.conclusion_ambit" />
                            </template>
                          </template>
                        </template>
                      </div>
                    </td>
                      <td >
                        <div v-html="problematic['problematic-'+decision.num+'-'+1]" />
                        <div v-for="t in conclusion.criterion_conclusions" >
                          <template v-if="t.ambit_id == 1 && t.decision_id == decision.num">
                            <template v-if="t.problematic_ambit != null">
                              <template v-for="s in t.conclusion_probletic_ambit">
                                <div v-html="s.problematic_ambit" />
                              </template>
                            </template>
                          </template>
                        </div>
                      </td>
                  </tr>
                  <tr>
                    <th class="text-center">
                      <img src="/img/assets/icons_INL_icon_institucional_blue.svg" style="width:1.5rem;" alt="">
                      {{ $t('detailedReport.institutional') }}
                    </th>
                    <td>
                      <div v-html="conclusion.conclusion['conclusion-'+decision.num+'-'+2]" />
                      <div v-for="t in conclusion.criterion_conclusions" >
                        <template v-if="t.ambit_id == 2 && t.decision_id == decision.num">
                          <template v-if="t.conclusion_ambit != null">
                            <template v-for="s in t.conclusion_probletic_ambit">
                              <div v-html="s.conclusion_ambit" />
                            </template>
                          </template>
                        </template>
                      </div>
                    </td>
                      <td >
                        <div v-html="problematic['problematic-'+decision.num+'-'+2]" />
                        <div v-for="t in conclusion.criterion_conclusions" >
                          <template v-if="t.ambit_id == 2 && t.decision_id == decision.num">
                            <template v-if="t.problematic_ambit != null">
                              <template v-for="s in t.conclusion_probletic_ambit">
                                <div v-html="s.problematic_ambit" />
                              </template>
                            </template>
                          </template>
                        </div>
                      </td>
                  </tr>
                  <tr>
                    <th class="text-center">
                      <img src="/img/assets/icons_INL_icon_individual_blue.svg" style="width:1.5rem;" alt="">
                      {{ $t('detailedReport.individual') }}
                    </th>
                    <td>
                      <div v-html="conclusion.conclusion['conclusion-'+decision.num+'-'+3]" />
                      <div v-for="t in conclusion.criterion_conclusions" >
                        <template v-if="t.ambit_id == 3 && t.decision_id == decision.num">
                          <template v-if="t.conclusion_ambit != null">
                            <template v-for="s in t.conclusion_probletic_ambit">
                              <div v-html="s.conclusion_ambit" />
                            </template>
                          </template>
                        </template>
                      </div>
                    </td>
                      <td >
                        <div v-html="problematic['problematic-'+decision.num+'-'+3]" />
                        <div v-for="t in conclusion.criterion_conclusions" >
                          <template v-if="t.ambit_id == 3 && t.decision_id == decision.num">
                            <template v-if="t.problematic_ambit != null">
                              <template v-for="s in t.conclusion_probletic_ambit">
                                <div v-html="s.problematic_ambit" />
                              </template>
                            </template>
                          </template>
                        </div>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <!-- <div class="row">

            <div class="col-md-2">
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Seleccionar año
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <button class="dropdown-item" type="button" @click="years = '2017'">2017</button>
                  <button class="dropdown-item" type="button" @click="years = '2018'">2018</button>
                  <button class="dropdown-item" type="button" @click="years = '2019'">2019</button>
                  <button class="dropdown-item" type="button" @click="years = '2020'">2020</button>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <label>({{years}})</label>
            </div>
          </div> -->
          <h6 class="text-left text-uppercase font-weight-bold">
            {{ $t('state.indicator_year') }}
          </h6>

          <div class="table-responsive" style="margin-bottom: -16px;">
            <table class="table" style="border-left: 1px solid darkgrey; border-right: 1px solid darkgrey;">
              <thead>
                <tr>
                  <th width="15%">Seleccionar año</th>
                  <th v-show="conclusion.round == 1">
                    <button class="dropdown-item" style="cursor: pointer;"
                    :style="years == '2017' ? 'color: #e9ecef;background: black;border-radius: 5px;' :''"
                    type="button" @click="years = '2017'">2017</button>
                    </th>
                  <th>
                    <button class="dropdown-item" style="cursor: pointer;"
                    :style="years == '2018' ? 'color: #e9ecef;background: black;border-radius: 5px;' :''"
                    type="button" @click="years = '2018'">2018</button>
                    </th>
                  <th>
                    <button class="dropdown-item" style="cursor: pointer;"
                    :style="years == '2019' ? 'color: #e9ecef;background: black;border-radius: 5px;' :''"
                    type="button" @click="years = '2019'">2019</button>
                  </th>
                  <th>
                    <button class="dropdown-item" style="cursor: pointer;"
                    :style="years == '2020' ? 'color: #e9ecef;background: black;border-radius: 5px;' :''"
                    type="button" @click="years = '2020'">2020</button>
                  </th>
                  <th v-show="conclusion.round == 2">
                    <button class="dropdown-item" style="cursor: pointer;"
                    :style="years == '2021' ? 'color: #e9ecef;background: black;border-radius: 5px;' :''"
                    type="button" @click="years = '2021'">2021</button>
                  </th>
                </tr>
              </thead>
            </table>
          </div>

            <div class="table-responsive">
              <table :id="'indicators-decision'+decision.num" class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-uppercase">Indicador</th>
                    <th class="text-uppercase text-center">Porcentaje</th>
                    <th class="text-uppercase">Interpretación</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- {{indicatorsFiltered}} -->
                  <!-- kdkj -->
                  <!-- {{variables}} -->
                  <!-- ggg -->
                  <!-- {{variables_info}} -->
                  <tr
                  v-for="(indicator,index) in indicatorsFiltered"
                  :key="index"
                  is="indicator-decision-analysis-dr"
                  :indicator="indicator"
                  :variables="variables"
                  :variables_info="variables_info"
                  :interpretation="interpretation"
                  :years = "years"
                  :round="conclusion.round"
                  >
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</template>

<script>
export default {
  props: {
    decision: Object,
    indicators: Array,
    interpretation: Object,
    variables: Object,
    variables_info: Array,
    conclusion: Object,
    problematic: Object,
  },
  data: () => ({
    years : '2017',
  }),
  methods: {
  },
  computed: {
    indicatorsFiltered: function () {
      return this.$props.indicators.filter(indicator => indicator.decision_id == this.$props.decision.id)
    }
  },
  created(){
    console.log(this.$props);
  }
}
</script>

<style lang="scss" scoped>
.cell-border {
  border: 1px solid #cccccc;
  border-radius: 0px;
}

.table-border {
  border-bottom: 1px solid !important;
  font-size: 16px;

}
.ambit-cell {
  padding: 1rem;
  background-color: rgba(19 , 56,94, 0.35) !important;
}
</style>
