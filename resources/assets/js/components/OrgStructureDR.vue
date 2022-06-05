<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-center">
                    <p class="">{{ $t('detailedReport.organizational_structure') }}</p>
                </div>
                <div class="card-body">
                    <p class="text-uppercase font-weight-bold">{{ $t('detailedReport.organizational_chart') }}</p>
                    <p>{{ $t('detailedReport.organizational_chart_institution') }}</p>
                    <div class="text-center image-border" v-for="org in organization_chart" :key="org.id" v-show="org.type == 'organization' && organization_chart.length >= 1">
                        <img class="w-60 mt-3 mb-3" :src="'/myFiles/' + org.path"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            organization_chart: Array,
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