<template>
    <div class="card" :class="{ 'collapsed-card' : indicator.collapsed }">

        <div class="card-header second-blue">
            <p style="padding-right: 1em;">{{ indicator.num }} {{ indicator.name }} </p>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" @click="toggleCollapsed(indicator.collapsed)">
                    <i v-if="collapse" class="fa fa-plus"></i>
                    <i v-else class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- <div class="col-md-8" v-if="indicator.desirable_range == '-' && indicator.num != 12.2 && indicator.num != 12.3 && indicator.num != 12.4">
                    <label for="" class="text-uppercase font-weight-bold">Interpretaciósn</label>
                    <textarea :readonly="$gate.isINL()" v-model="form['interpretation'+indicator.id]" class="form-control" name="" id="" cols="30" rows="12" :disabled="indicator.desirable_range == '-' && indicator.num != 12.2 && indicator.num != 12.3 && indicator.num != 12.4"></textarea>
                </div> -->
                <!-- v-else -->
                <div class="col-md-8" >
                    <label for="" class="text-uppercase font-weight-bold">Interpretación</label>
                    <vue-editor v-model="form['interpretation'+indicator.id+'_'+years]"></vue-editor>
                    <!-- <wysiwyg v-model="form['interpretation'+indicator.id+'_'+years]" :readonly="$gate.isINL()"/> -->
                </div>
                <div class="col-md-4 text-center">

                  <template v-if="round == '1'">
                    <p class="display-4 text-primary mt-4" v-if="indicator.num == 5.1 || indicator.num == 11.2 || indicator.num == 13.1">
                        -
                    </p>
                    <p class="display-4 text-primary mt-4" v-else>
                        <span v-if="variables[dividend_checked_name] == 1 || variables[divider_checked_name] == 1">N.D.</span>
                        <span v-else>
                            {{ (variables[indicator.dividend] / variables[indicator.divider]) | myNumberPercentage }}
                        </span>
                    </p>
                  </template>
                  <template v-if="round == '2'">
                    <p class="display-4 text-primary mt-4">
                    <span>
                      {{ (variables[indicator.dividend] / variables[indicator.divider]) | myNumberPercentage }}
                    </span>
                    </p>
                  </template>
                    <hr>
                    <!-- {{variables_info}} -->
                    <!-- {{indicator}} -->
                    <p>Rango deseable</p>
                    <p class="h3">{{ indicator.desirable_range }}</p>
                      <p>Datos del {{this.$route.params.year}}</p>
                    <hr>
                    <p>Fórmula</p>
                    {{indicator.num}}
                    <template v-if="$route.params.key === 'mex2' && indicator.num == 11.3">
                      <p class="text-primary">Feminicidio ({{ variables[indicator.dividend] }})  / {{ divider_name }} ({{ variables[indicator.divider] }})</p>
                    </template>
                    <template v-else-if="$route.params.key === 'mex2' && indicator.num == 11.4">
                      <p class="text-primary"> Feminicidio en grado de tentativa  ({{ variables[indicator.dividend] }})  / {{ divider_name }} ({{ variables[indicator.divider] }})</p>
                    </template>
                    <template v-else>
                      <p class="text-primary"> {{ dividend_name }} ({{ variables[indicator.dividend] }})  / {{ divider_name }} ({{ variables[indicator.divider] }})</p>
                    </template>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-uppercase font-weight-divider_checked_namebold mt-4">Guía de interpretación</p>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Arriba del rango</td>
                                    <td>
                                        <ul>
                                            <li v-for="interpretation in indicator.interpretation_guides" :key="interpretation.id" v-show="interpretation.type == 1">
                                                {{ interpretation.text }}
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Abajo del rango</td>
                                    <td>
                                        <ul>
                                            <li v-for="interpretation in indicator.interpretation_guides" :key="interpretation.id" v-show="interpretation.type == 0">
                                                {{ interpretation.text }}
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from "vue2-editor";
    export default {
        components: { VueEditor },
        props: {
            indicator: Object,
            variables: Object,
            form: Object,
            variables_info: Array,
            year : String,
            round : String,
        },
        data: () => ({
            years : 0,
            collapse: true,
            divider_name: '',
            dividend_name: '',
            divider_checked_name: '',
            dividend_checked_name: '',
            customToolbar: [
                                ["bold", "italic", "underline"],
                                [{ list: "ordered" }, { list: "bullet" }]
                            ],
            estatesNewOperation:[
                24,9,31,30,26,4,1,8,11,17,23,15,10,21,14,22,29
            ],
            operationTrigger: false,
        }),
        methods: {
            async checkOperation(){
                for (let index = 0; index < this.estatesNewOperation.length; index++) {
                    const estate = this.estatesNewOperation[index];
                    if (estate == this.variables.state_id) {
                        this.operationTrigger = true;
                    }
                }
                this.getDividerAndDividendName();
            },
            toggleCollapsed(observations_collapsed) {
                this.collapse = !this.collapse;
            },
            changeDivs(data){
              var valores_dividend = (data.dividend).split('_')
              var valores_divider = (data.divider).split('_')
              data.dividend = valores_dividend[0] + '_' +this.$route.params.year;
              data.divider = valores_divider[0] + '_' +this.$route.params.year;
              return data;
            },
            changeYear(data){
              var valores = data.split('_')
               var result = valores[0] + '_2018';
              return result;
            },
            getDividerAndDividendName(){

                if (this.operationTrigger) {
                     switch (this.indicator.id) {
                    // case 17:
                    //      this.indicator.divider = "variable18_2018";
                    //     break;
                    case 8:
                         this.indicator.divider = "variable7_2018";
                        break;
                    default:
                        break;
                    }
                }
                this.changeDivs(this.indicator);

                // if (this.$route.params.key === 'cmx' || this.$route.params.key === 'cmx2' || this.$route.params.key === 'cmx3' || this.$route.params.key === 'cmx4' || this.$route.params.key === 'mex2') {
                //   this.changeDivs(this.indicator);
                //   let divider_name = this.variables_info
                //   .filter(variable => variable.slug_2019 == this.indicator.divider)
                //   .map(divider_name => divider_name.name)
                //   this.divider_name = divider_name[0]
                //   let divider_checked_name = this.variables_info
                //   .filter(variable => variable.slug_2019 == this.indicator.divider)
                //   .map(divider_name => divider_name.check_slug_2019)
                //   this.divider_checked_name = divider_checked_name[0]
                //
                //   let dividend_name = this.variables_info
                //   .filter(variable => variable.slug_2019 == this.indicator.dividend)
                //   .map(dividend_name => dividend_name.name)
                //   this.dividend_name = dividend_name[0]
                //
                //   let dividend_checked_name = this.variables_info
                //   .filter(variable => variable.slug_2019 == this.indicator.dividend)
                //   .map(dividend_name => dividend_name.check_slug_2019)
                //   this.dividend_checked_name = dividend_checked_name[0]
                // }else {
                  let divider_name = this.variables_info
                  .filter(variable => variable.slug_2018 == this.changeYear(this.indicator.divider))
                  .map(divider_name => divider_name.name)
                  this.divider_name = divider_name[0]
                  let divider_checked_name = this.variables_info
                  .filter(variable => variable.slug_2018 == this.changeYear(this.indicator.divider))
                  .map(divider_name => divider_name.check_slug_2018)
                  this.divider_checked_name = divider_checked_name[0]

                  let dividend_name = this.variables_info
                  .filter(variable => variable.slug_2018 == this.changeYear(this.indicator.dividend))
                  .map(dividend_name => dividend_name.name)
                  this.dividend_name = dividend_name[0]

                  let dividend_checked_name = this.variables_info
                  .filter(variable => variable.slug_2018 == this.changeYear(this.indicator.dividend))
                  .map(dividend_name => dividend_name.check_slug_2018)
                  this.dividend_checked_name = dividend_checked_name[0]
                // }
            }
        },
        created(){
            this.years = this.$route.params.year;
            this.checkOperation();
            /* this.getDividerAndDividendName(); */
            if(this.$props.indicator.collapsed == 0) {
                this.collapse = false;
            } else {
                this.collapse = true;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .second-blue{
        background-color:#29597c;
        color: white;
        i{
            color : white;
        }

        p {
            margin: 0;
        }
    }
</style>
