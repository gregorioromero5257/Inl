<template>
    <article>
        <div class="card collapsed-card"  v-for="(subsection, index) in subsections" :key="subsection.id" >
                <div class="card-header text-center bg-primary">
                    <p class="float-left">Ámbito {{actualAmbit}}</p>
                    <h4>CRITERIO: {{subsection.criterion.name}}</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse"  data-toggle="collapse" :key="subsection.id"  @click="toggleCollapsed(indicator.collapsed)">
                            <i v-if="collapse" class="fa fa-plus"></i>
                            <i v-else class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" :class="{ 'show': index === 0 }">
                    <div class="row">
                        <div class="col md-4">
                            <p class="text-left text-blue text-left text-bold text-uppercase">Fuente:</p>
                            <p class="text-left">{{sourceSelected.name}}</p>
                        </div>
                        <div class="col md-8">
                            <p class="text-blue text-left text-bold text-uppercase">Observaciones</p>
                            <p class="text-left"> Sede 1</p>
                            <textarea class="form-control w-100"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col md-12 text-center">
                        <p class="text-blue text-left text-bold text-uppercase">Conclusión del Criterio</p>
                        <textarea class="form-control w-100"></textarea>
                        </div>
                    </div>
                </div>
        </div>
    </article>
</template>
<script>
    export default {
        props: {
            subsections: Array,
            actualAmbit: String,
            sourceSelected : Object,
        },
        data: () => ({
            collapse: true,
        }),
        methods :{
            toggleCollapsed(observations_collapsed) {
                this.collapse = !this.collapse;
            },

        },
        created() {

        }
    }
    
</script>
<style lang="scss" scoped>

</style>
