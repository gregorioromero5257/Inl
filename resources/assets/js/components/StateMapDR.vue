<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-center">
                    <p>{{ $t('detailedReport.state_map') }}</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>{{ $t('detailedReport.map_includes') }}</p>
                            <ul>
                                <li>{{ $t('detailedReport.AGO_Headquarters') }}</li>
                                <li>{{ $t('detailedReport.municipalities_ago') }}</li>
                                <li>{{ $t('detailedReport.number_per_region') }}</li>
                            </ul>
                            <div class="text-center image-border" v-for="m in map" :key="m.id" v-show="m.type == 'map' && map.length >= 1">
                                <img class="w-60 mt-3 mb-3" :src="'/myFiles/' + m.path"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive mt-4">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase">{{ $t('detailedReport.AGO_Headquarters_offices') }}</th>
                                            <th class="text-uppercase">{{ $t('detailedReport.municipalities_by_headquartes') }}</th>
                                            <th class="text-uppercase text-center">{{ $t('detailedReport.number_per_region') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="headquarter in headquarters" :key="headquarter.id">
                                            <td class="">{{ headquarter.name }}</td>
                                            <td class="">{{ headquarter.city_halls }}</td>
                                            <td class="text-center">{{ headquarter.agents }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
            map: Array,
            headquarters: Array
        },
        data: () => ({

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
    .image-border {
        border: solid 0.1rem lightgray;
        border-style: dashed;
    }
    .w-60 {
        width: 60%;
    }
</style>