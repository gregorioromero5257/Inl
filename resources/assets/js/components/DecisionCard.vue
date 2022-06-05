<template>
    <div class="card">
        <div class="card-header bg-primary">
            <p class="pr-2">Decisión {{ decision.num }}: {{ decision.name }}</p>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="collapse" :data-target="`#observations-${decision.num}`" @click="$emit('toggle-collapsed', decision.observations_collapsed)">
                    <i v-if="decision.observations_collapsed == 1" class="fa fa-plus"></i>
                    <i v-if="decision.observations_collapsed != 1" class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div :id="`card-body-${decision.num}`" class="card-body card-body-style">
            <div class="row mb-1">
                <div class="col-md-4 text-center bg-light text-secondary pointer" :class="{'active-ambit blue-bg-tabs' : ambit.num == ambit_num, 'ambit-first-border' : ambit.num < 3, 'ambit-last-border' : ambit.num == 3 }" v-for="ambit in ambits" :key="ambit.id">
                    <ambit-selector :ambit="ambit" :ambit_selected="ambit_num" @change-ambit="$emit('change-ambit', ambit.num)" />
                </div>
            </div>
            <div class="row" style="padding:1.23rem">
                <div :id="`observations-${decision.num}`" class="col-md-12 collapse show">
                    <subsection
                        v-for="subsection in subsections"
                        :key="subsection.id"
                        :observations="observations"
                        :state="state"
                        :subsection="subsection"
                        :headquarters="headquarters"
                    />
                </div>
                <div class="col-md-12">
                    <form>
                        <div class="form-group" >
                            <label class="">Conclusión del Ámbito {{ ambit.name }}</label>
                            <!-- <wysiwyg v-model="formConclusion['conclusion-'+decision.num+'-'+ambit_selected.num]" /> -->
                            <vue-editor v-model="formConclusion['conclusion-'+decision.num+'-'+ambit_selected.num]"></vue-editor>
                        </div>
                        <div class="form-group" >
                            <label class="">Problemática de la conclusión del Ámbito {{ ambit.name }}</label>
                            <!-- <wysiwyg v-model="formProblematic['problematic-'+decision.num+'-'+ambit_selected.num]" /> -->
                            <vue-editor v-model="formProblematic['problematic-'+decision.num+'-'+ambit_selected.num]"></vue-editor>
                        </div>
                        <!-- v-if="!$gate.isINL()" -->
                        <button  class="btn btn-round btn-primary-color btn-fixed fa-lg" type="submit" @click.prevent="$emit('update-info', decision.num)">
                            <i class="far fa-save"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from "vue2-editor";
    export default {
        components: {
            VueEditor
        },
        props: {
            observations: Array,
            state: Number,
            headquarters: Array,
            subsections: Array,
            ambit: Object,
            decision: Object,
            ambit_num: Number,
            formConclusion: Object,
            formProblematic: Object,
        },
        data: () => ({
            ambits: {},
            customToolbar: [
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': 'right'}, { 'align': 'center'}, { 'align': 'right' }, { 'align': 'justify' }],
                ['code-block']
            ]
        }),
        methods: {
            loadAmbits() {
                axios.get("/api/ambit").then(
                    ({data}) => (
                        this.ambits = data
                    )
                ).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                })
            }
        },
        created(){
            this.loadAmbits();
        }
    }
</script>

<style lang="scss" scoped>
    .pr-2 {
        padding-right: 2em !important;
    }
    .active-ambit {
        border-bottom: solid 2px #13385d !important;
        background: rgba(19 , 56,94, 0.35) !important;
        color: #13385e !important;
        border-bottom: solid 2px #13385d !important;
    }
    .ambit-first-border {
        border-right:solid 1.5px lightgray;
        border-bottom:solid 1.5px lightgray;
    }
    .ambit-last-border {
        border-bottom:solid 1.5px lightgray;
    }
    .card-body-style {
        padding:0;
        padding-right: 0.9rem;
        padding-left: 0.9rem;
    }
    .btn-primary-color{
        color: #fff;
        background-color: #13519b;
        border-color: #13519b;
        width: 2.3em;
        height: 2.3em;
    }
    .btn-fixed {
        position: fixed;
        bottom: 2.5em;
        right: 2em;
    }
</style>
