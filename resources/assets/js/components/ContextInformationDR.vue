<template>
    <div class="row">
        <div class="col-md-12">
            <div class="bg-dark">
                <h4 class="text-center text-uppercase font-weight-bold mb-4" style="padding:1rem;">Información de Contexto</h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-center">
                    <p>{{ $t('detailedReport.socio_demographic_data') }}</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sociodemographic" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th class="text-uppercase">{{ $t('detailedReport.socio_demographic_data') }}</th>
                                    <th class="text-uppercase text-center">{{ $t('detailedReport.state_information') }}</th>
                                    <th class="text-uppercase text-center">{{ $t('detailedReport.nacional_average') }}</th>
                                    <th class="text-uppercase text-center">{{ $t('detailedReport.ranking') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(sociodemographic_information_context,index) in sociodemographic_information_contexts" :key="index">
                                    <td>{{ sociodemographic_information_context.name }}</td>
                                    <td class="text-center">
                                        <span v-if="sociodemographic_information_context.variable_num == '6' || sociodemographic_information_context.variable_num == '7' || sociodemographic_information_context.variable_num == '8' || sociodemographic_information_context.variable_num == '9'">
                                            {{ sociodemographic_contexts['variable'+sociodemographic_information_context.variable_num] | myNumberDecimal }}
                                        </span>
                                        <span v-else-if="sociodemographic_information_context.variable_num == '9_s1'">
                                            {{ sociodemographic_contexts['variable'+sociodemographic_information_context.variable_num] }}
                                        </span>
                                        <span v-else>
                                            {{ sociodemographic_contexts['variable'+sociodemographic_information_context.variable_num] | myNumber }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span v-if="sociodemographic_information_context.variable_num == '6' || sociodemographic_information_context.variable_num == '7' || sociodemographic_information_context.variable_num == '8'">
                                            {{ sociodemographic_information_context.national_avg | myNumberDecimal }}
                                        </span>
                                        <span v-else-if="sociodemographic_information_context.variable_num == '9_s1'">
                                            N/A
                                        </span>
                                        <span v-else>
                                            {{ sociodemographic_information_context.national_avg | myNumber }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span v-if="sociodemographic_information_context.variable_num == '6' || sociodemographic_information_context.variable_num == '7' || sociodemographic_information_context.variable_num == '8' || sociodemographic_information_context.variable_num == '9'">
                                            {{ sociodemographic_contexts['clasification'+sociodemographic_information_context.variable_num] }}
                                        </span>
                                        <span v-else-if="sociodemographic_information_context.variable_num == '9_s1'">
                                            {{ sociodemographic_contexts['clasification'+sociodemographic_information_context.variable_num] }}
                                        </span>
                                        <span v-else>
                                            {{ sociodemographic_contexts['clasification'+sociodemographic_information_context.variable_num] }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-center">
                    <p>{{ $t('detailedReport.crime_data') }}</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="criminality" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th class="text-uppercase">{{ $t('detailedReport.crime_data') }}</th>
                                    <th class="text-uppercase text-center">{{ $t('detailedReport.state_information') }}</th>
                                    <th class="text-uppercase text-center">{{ $t('detailedReport.nacional_average') }}</th>
                                    <th class="text-uppercase text-center">{{ $t('detailedReport.ranking') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(crime_information_context, index) in crime_information_contexts" :key="index">
                                    <td>{{ crime_information_context.name }}</td>
                                    <td class="text-center">
                                        <span v-if="crime_information_context.variable_num == '13' || crime_information_context.variable_num == '14' || crime_information_context.variable_num == '15' || crime_information_context.variable_num == '16' || crime_information_context.variable_num == '17' || crime_information_context.variable_num == '18' || crime_information_context.variable_num == '19' || crime_information_context.variable_num == '20'">
                                            {{ crime_contexts['variable'+crime_information_context.variable_num] | myNumberDecimal }}
                                        </span>
                                        <span v-else>
                                            {{ crime_contexts['variable'+crime_information_context.variable_num] | myNumber }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span v-if="crime_information_context.variable_num == '13' || crime_information_context.variable_num == '14' || crime_information_context.variable_num == '15' || crime_information_context.variable_num == '16' || crime_information_context.variable_num == '17' || crime_information_context.variable_num == '18' || crime_information_context.variable_num == '19' || crime_information_context.variable_num == '20'">
                                            {{ crime_information_context.national_avg | myNumberDecimal }}
                                        </span>
                                        <span v-else>
                                            {{ crime_information_context.national_avg | myNumber }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span v-if="crime_information_context.variable_num == '13' || crime_information_context.variable_num == '14' || crime_information_context.variable_num == '15' || crime_information_context.variable_num == '16' || crime_information_context.variable_num == '17' || crime_information_context.variable_num == '18' || crime_information_context.variable_num == '19' || crime_information_context.variable_num == '20'">
                                            {{ crime_contexts['clasification'+crime_information_context.variable_num] }}
                                        </span>
                                        <span v-else>
                                            {{ crime_contexts['clasification'+crime_information_context.variable_num] }}
                                        </span>
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
    export default {
        props: {
            sociodemographic_contexts: Object,
            crime_contexts: Object
        },
        data: () => ({
            sociodemographic_information_contexts: [
                {
                    variable_num: '1',
                    name: 'Población, 2017 (habitantes)',
                    national_avg: '3876304'
                },
                {
                    variable_num: '2',
                    name: 'Superficie (Km²)',
                    national_avg: '61474'
                },
                {
                    variable_num: '3',
                    name: 'Densidad de población, 2017 (habitantes/Km²)',
                    national_avg: '63'
                },
                {
                    variable_num: '4',
                    name: 'PIB, 2017 (millones de pesos a precios corrientes)',
                    national_avg: '765437'
                },
                {
                    variable_num: '5',
                    name: 'PIB per-cápita, 2017 (pesos a precios corrientes)',
                    national_avg: '197466'
                },
                {
                    variable_num: '6',
                    name: 'Promedio de escolaridad, 2015 (años)',
                    national_avg: '9.2'
                },
                {
                    variable_num: '7',
                    name: 'Porcentaje de población con carencia por acceso a servicios de salud, 2015',
                    national_avg: '16.9'
                },
                {
                    variable_num: '8',
                    name: 'Porcentaje de pobreza, 2016',
                    national_avg: '43.6'
                },
                {
                    variable_num: '9',
                    name: 'Índice de marginación, 2015',
                    national_avg: ''
                },
                {
                    variable_num: '9_s1',
                    name: 'Grado de marginación, 2015',
                    national_avg: ''
                }
            ],
            crime_information_contexts: [
                {
                    variable_num: 1,
                    name: 'Tasa de incidencia delictiva, 2018 (por cada cien mil habitantes)',
                    national_avg: '1483'
                },
                {
                    variable_num: 2,
                    name: 'Número de incidencia delictiva, 2018',
                    national_avg: '58071'
                },
                {
                    variable_num: 3,
                    name: 'Tasa de homicidio doloso, 2018 (por cada cien mil habitantes)',
                    national_avg: '23'
                },
                {
                    variable_num: 4,
                    name: 'Número de homicidios, 2018',
                    national_avg: '900'
                },
                {
                    variable_num: 5,
                    name: 'Tasa de robos, 2018 (por cada cien mil habitantes)',
                    national_avg: '573'
                },
                {
                    variable_num: 6,
                    name: 'Tasa de robos con violencia, 2018 (por cada cien mil habitantes)',
                    national_avg: '147'
                },
                {
                    variable_num: 7,
                    name: 'Tasa de robos sin violencia, 2018 (por cada cien mil habitantes)',
                    national_avg: '264'
                },
                {
                    variable_num: 8,
                    name: 'Número de robos, 2018',
                    national_avg: '22424'
                },
                {
                    variable_num: 9,
                    name: 'Número de robos con violencia, 2018',
                    national_avg: '5757'
                },
                {
                    variable_num: 10,
                    name: 'Número de robos sin violencia, 2018',
                    national_avg: '10338'
                },
                {
                    variable_num: 11,
                    name: 'Tasa de robos de vehículos, 2018 (por cada cien mil habitantes)',
                    national_avg: '161'
                },
                {
                    variable_num: 12,
                    name: 'Número de robos de vehículos',
                    national_avg: '6296'
                },
                {
                    variable_num: 13,
                    name: 'Porcentaje de mujeres (+15) con incidentes de violencia en el ámbito familiar, 2016',
                    national_avg: '10.3'
                },
                {
                    variable_num: 14,
                    name: 'Porcentaje de cifra negra con relación a los delitos ocurridos, 2017',
                    national_avg: '93.2'
                },
                {
                    variable_num: 15,
                    name: 'Porcentaje de población (18+) que percibe que su entidad federativa es segura, 2018',
                    national_avg: '19.0'
                },
                {
                    variable_num: 16,
                    name: 'Porcentaje de delitos no denunciados por causas atribuibles a la autoridad, 2017',
                    national_avg: '64.5'
                },
                {
                    variable_num: 17,
                    name: 'Porcentaje de población (18+) que identifica a los Ministerios Públicos y Procuradurías Estatales, en un nivel de algo de desconfianza y mucha desconfianza, 2018',
                    national_avg: '45.0'
                },
                {
                    variable_num: 18,
                    name: 'Porcentaje de población (18+) que percibe la existencia de corrupción en los Ministerios Públicos y Procuradurías Estatales, 2018',
                    national_avg: '66.5'
                },
                {
                    variable_num: 19,
                    name: 'Porcentaje de población (18+) que identifica a los Ministerios Públicos y Procuradurías Estatales, en un nivel de desempeño muy efectivo y algo efectivo, 2018',
                    national_avg: '50.0'
                },
            ]
        }),
        methods: {

        },
        created(){
 const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
        }
    }
</script>

<style lang="scss" scoped>

</style>