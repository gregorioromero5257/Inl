import VueRouter from 'vue-router';
import Home from './components/views/Home.vue';
import Developer from './components/views/Developer.vue';
import Users from './components/views/Users.vue';
import State from './components/views/State.vue';
import DocumentaryInformation from './components/views/DocumentaryInformation.vue';
import QuantitativeSources from './components/views/QuantitativeSources.vue';
import IndicatorsByDecision from './components/views/IndicatorsByDecision.vue';
import ProblematicByCriterion from './components/views/ProblematicByCriterion.vue';
import QualitativeSources from './components/views/QualitativeSources.vue';
import DetailedReport from './components/views/DetailedReport.vue';
import ExecutiveReport from './components/views/ExecutiveReport.vue';
import Profile from './components/views/Profile.vue';
import NotFound from './components/views/NotFound.vue';
import ObservationsBySourceByCriterion from './components/views/ObservationsBySourceByCriterion.vue';
import ObservationsByAmbit from './components/views/ObservationsByAmbit.vue';
import Repository from './components/views/Repository.vue';
import CustomReports from './components/views/CustomReports.vue'
import DocumentRepository from './components/views/DocumentRepository.vue'
let routes = [
    { path: '/home', component: Home },
    { path: '/developer', component: Developer },
    { path: '/users', component: Users },
    { path: '/custom-report', component: CustomReports },
    { path: '/document-repository', component: DocumentRepository},
    { path: '/state/:key', component: State },
    { path: '/state/:key/repository', component: Repository },
    { path: '/state/:key/documentary-information', component: DocumentaryInformation },
    { path: '/state/:key/quantitative-sources', component: QuantitativeSources },
    { path: '/state/:key/qualitative-sources', component: QualitativeSources },
    { path: '/state/:key/detailed-report', component: DetailedReport },
    { path: '/state/:key/executive-report', component: ExecutiveReport },
    { path: '/state/:key/quantitative-sources/indicators-by-decision/:year', component: IndicatorsByDecision },
    { path: '/state/:key/qualitative-sources/:ambit/problematic-by-criterion', component: ProblematicByCriterion, props: true },
    { path: '/state/:key/qualitative-sources/:ambit/observations-by-source-by-criterion', component: ObservationsBySourceByCriterion },
    { path: '/state/:key/qualitative-sources/:ambit/observations-by-ambit', component: ObservationsByAmbit },
    { path: '/profile', component: Profile },
    { path: '*', component: NotFound }
]

const router = new VueRouter({
    mode: 'history',
    routes,
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
})

export default router
