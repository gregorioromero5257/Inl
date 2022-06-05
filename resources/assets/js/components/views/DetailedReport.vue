    <template>
    <div class="detailedReport container">
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
                                    {{ $t('detailedReport.title') }}
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="text-center text-uppercase font-weight-bold mb-4">{{ $t('detailedReport.title') }}</h4>
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
            <detailed-pdf-gen
                :state="state_selected"
                :map="mapImg"
                :organization="OrgImg"
                :sociodemographic_contexts="sociodemographic_contexts"
                :crime_contexts="crime_contexts"
                :decisions="decisions"
                :indicators="indicators"
            />
            <div class="col-md-12 mt-4">
                <context-information-dr
                    :sociodemographic_contexts="sociodemographic_contexts"
                    :crime_contexts="crime_contexts"
                />
                <state-map-dr
                    :map="map"
                    :headquarters="headquarters"
                />
                <org-structure-dr
                    :organization_chart="organization_chart"
                />
            </div>
            <decisions-analysis-dr
                :decisions="decisions"
                :indicators="indicators"
                :interpretation="JSON.parse(state_selected.interpretation.data)"
                :variables="state_selected.quantitative_source"
                :variables_info="variables_info"
                :conclusion="state_selected"
                :problematic="state_selected.problematic"
                @toggle-collapsed="toggleCollapsed"
            />
        </div>

    </div>
</template>

<script>
    export default {
        data: () => ({
            loading: false,
            state_selected: {},
            sociodemographic_contexts: {},
            crime_contexts: {},
            organizaztion_chart: {},
            map: {},
            subsections: [],
            decisions: [],
            indicators: [],
            headquarters: [],
            variables_info: [],
            rounds : 0,
            criterionconclusions : {},
        }),
        methods: {
            toggleCollapsed(decision) {
                let decisionSelected = {};
                decisionSelected = this.decisions.findIndex((d => d.id == decision.id));
                this.decisions[decisionSelected].collapsed = 1 - decision.collapsed;
            },
            getIndicators(){
                axios.get(`/api/indicator-by-round/${this.$route.params.key}`).then(
                    ({data}) => (
                        this.indicators = data
                    )
                )
            },
            getVariablesInfo(){
                axios.get('/api/variable')
                .then(({data}) => (
                    this.variables_info = data
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                });
            },
            loadData() {
                this.getVariablesInfo();
                this.getIndicators();
                this.loading = true;
                axios.get(`/api/state_by_key/${this.$route.params.key}`)
                .then(({data}) => (
                    this.state_selected = data,
                    this.round = data.round,
                    this.criterionconclusions = data.criterion_conclusions,
                    this.headquarters = data.all_headquarters,
                    this.sociodemographic_contexts = data.sociodemographic_contexts,
                    this.crime_contexts = data.crime_contexts,
                    this.organization_chart = data.documents.filter(organization => organization.type == 'organization'),
                    this.map = data.documents.filter(map => map.type == 'map')
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                });

                axios.get("/api/subsection")
                .then(({data}) => (
                    this.subsections = data
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                });

                axios.get("/api/decision").then(
                    ({data}) => (
                        this.loading = false,
                        this.decisions = data
                    )
                ).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                    this.loading = false;
                })
            },
        },
        computed: {

            mapImg: function() {
                return this.state_selected.documents.filter(document => document.type == 'map')
            },
            OrgImg: function() {
                return this.state_selected.documents.filter(document => document.type == 'organization')
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
