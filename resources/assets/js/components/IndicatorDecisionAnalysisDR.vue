<template>
    <tr>
        <td>{{ indicator.name }}
         </td>
         <template v-if="round == 1">
           <td class="text-center" v-if="indicator.num == 1.1 || indicator.num == 5.1 || indicator.num == 11.2 || indicator.num == 13.1">
             -
           </td>
           <td class="text-center" v-else>
             {{JSON.parse(variables['data'])[indicator.dividend] / JSON.parse(variables['data'])[indicator.divider] | myNumberPercentage}}
             <!-- {{variables}} -->
             <!-- <span v-if="variables[dividend_checked_name] == 1 || variables[divider_checked_name] == 1">N.D.</span> -->
             <!-- <span v-else> -->
             <!-- {{ (variables[indicator.dividend] / variables[indicator.divider]) | myNumberPercentage }} -->
             <!-- </span> -->
           </td>
         </template>
         <template v-if="round == 2">
           <td class="text-center">
             {{JSON.parse(variables['data'])[indicator.dividend] / JSON.parse(variables['data'])[indicator.divider] | myNumberPercentage}}
             <!-- {{variables}} -->
             <!-- <span v-if="variables[dividend_checked_name] == 1 || variables[divider_checked_name] == 1">N.D.</span> -->
             <!-- <span v-else> -->
             <!-- {{ (variables[indicator.dividend] / variables[indicator.divider]) | myNumberPercentage }} -->
             <!-- </span> -->
           </td>
         </template>
        <td v-html="interpretation['interpretation'+indicator.id+'_'+this.years_]"></td>
    </tr>
</template>

<script>
    export default {
        props: {
            indicator: Object,
            variables: Object,
            variables_info: Array,
            interpretation: Object,
            years: String,
            round: String,
        },
        data: () => ({
            divider_name: '',
            dividend_name: '',
            divider_checked_name: '',
            dividend_checked_name: '',
            years_ : '2017',
        }),
        watch: {
  years(nuevoValor, valorAnterior){
    this.years_ = nuevoValor;
    this.getDividerAndDividendName();
  }
},
        methods: {
          changeDivs(data){
            var valores_dividend = (data.dividend).split('_');
            var valores_divider = (data.divider).split('_');
            data.dividend = valores_dividend[0] + '_' +this.years_;
            data.divider = valores_divider[0] + '_' +this.years_;
            return data;
          },
          changeYear(data){
            var valores = data.split('_')
             var result = valores[0] + '_2018';
            return result;
          },
            getDividerAndDividendName(){
              this.changeDivs(this.indicator);

                // let divider_name = this.variables_info
                //     .filter(variable => variable.slug_2018 == this.indicator.divider)
                //     .map(divider_name => divider_name.name)
                // this.divider_name = divider_name[0]
                // let divider_checked_name = this.variables_info
                //     .filter(variable => variable.slug_2018 == this.indicator.divider)
                //     .map(divider_name => divider_name.check_slug_2018)
                // this.divider_checked_name = divider_checked_name[0]
                // let dividend_name = this.variables_info
                //     .filter(variable => variable.slug_2018 == this.indicator.dividend)
                //     .map(dividend_name => dividend_name.name)
                // this.dividend_name = dividend_name[0]
                // let dividend_checked_name = this.variables_info
                //     .filter(variable => variable.slug_2018 == this.indicator.dividend)
                //     .map(dividend_name => dividend_name.check_slug_2018)
                // this.dividend_checked_name = dividend_checked_name[0]

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
            }
        },
        created(){
            this.getDividerAndDividendName();
        }
    }
</script>

<style lang="scss" scoped>

</style>
