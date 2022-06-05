require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import router from './router'
Vue.use(VueRouter)

import store from './store.js'

import i18n from './i18n'

import moment from 'moment';
import numeral from 'numeral';

import { Form, HasError, AlertError } from 'vform';

// import VueYouTubeEmbed from 'vue-youtube-embed'
import wysiwyg from "vue-wysiwyg";

Vue.use(wysiwyg, {}); // config is optional. more below


// Vue.use(VueYouTubeEmbed)
// if you don't want install the component globally
// Vue.use(VueYouTubeEmbed, { global: false })
// if you want to install the component globally with a different name
// Vue.use(VueYouTubeEmbed, { global: true, componentId: "youtube-media" })

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);


import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.toast = toast;


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '5px'
})


Vue.filter('upText', function(text){
  return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate',function(created){
  return moment(created).locale("es").format('LL');
});

Vue.filter('myNumber',function(number){
  return numeral(number).format('0,0');
});

Vue.filter('myNumberDecimal',function(number){
  return numeral(number).format('0,0.0');
});

Vue.filter('myNumberPercentage',function(number){
  return number == Infinity ? 'N.D.' : numeral(number).format('0.0%');
  // return isNaN(number) == false ? 'N.D.' : numeral(number).format('0.0%');
});


window.Fire =  new Vue();

/**
 * Costum components
*/
Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));
Vue.component('not-found', require('./components/views/NotFound.vue'));

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('language-switcher', require('./components/LanguageSwitcher.vue'));
Vue.component('headquarters', require('./components/Headquarters'));
Vue.component('all-headquarters', require('./components/AllHeadquarters'));
Vue.component('decisions-selector', require('./components/DecisionsSelector'));
Vue.component('source-by-criterion', require('./components/SourceByCriterionTab'));
Vue.component('decision-card', require('./components/DecisionCard'));
Vue.component('ambit-selector', require('./components/AmbitSelector'));
Vue.component('subsection', require('./components/Subsection'));
Vue.component('loading', require('./components/Loading'));
Vue.component('observation', require('./components/Observation'));
Vue.component('observations', require('./components/Observations'));
Vue.component('indicator-card', require('./components/IndicatorCard'));
Vue.component('context-information-dr', require('./components/ContextInformationDR'));
Vue.component('state-map-dr', require('./components/StateMapDR'));
Vue.component('org-structure-dr', require('./components/OrgStructureDR'));
Vue.component('decisions-analysis-dr', require('./components/DecisionsAnalysisDR'));
Vue.component('decision-analysis-dr', require('./components/DecisionAnalysisDR'));
Vue.component('indicator-decision-analysis-dr', require('./components/IndicatorDecisionAnalysisDR'));
Vue.component('criterion-card-body', require('./components/CriterionCardBody'));
Vue.component('conclusion-by-criterion', require('./components/ConclusionByCriterion'));
Vue.component('conclusions-by-criterion', require('./components/ConclusionsByCriterion'));
Vue.component('criterion-card-footer', require('./components/CriterionCardFooter'));
Vue.component('criterion-by-ambit', require('./components/CriterionByAmbit'));

Vue.component('detailed-pdf-gen', require('./components/DetailedReportPDFGen'));
Vue.component('executive-pdf-gen', require('./components/ExecutiveReportPDFGen'));


const app = new Vue({
  el: '#app',
  store,
  router,
  i18n,
  data:{
    search: '',
    videoId: 'Mp_dgDxcEL4',
  },
  methods:{
    searchit: _.debounce(() => {
      Fire.$emit('searching');
    },1000),
    printme(){
      window.print();
    },
    documentaryInfoLink(){
      this.$router.push(`/state/${this.$route.params.key}/documentary-information`)
    },
    quantitativeSourcesLink(){
        this.$router.push(`/state/${this.$route.params.key}/quantitative-sources`)
    },
    qualitativeSourcesLink(){
        this.$router.push(`/state/${this.$route.params.key}/qualitative-sources`)
    },
    detailedReportLink(){
        this.$router.push(`/state/${this.$route.params.key}/detailed-report`)
    },
    ready (event) {
      this.player = event.player
    },
    playing (event) {
    // The player is playing a video.
    },
    change () {
    // when you change the value, the player will also change.
    // If you would like to change `playerVars`, please change it before you change `videoId`.
    // If `playerVars.autoplay` is 1, `loadVideoById` will be called.
    // If `playerVars.autoplay` is 0, `cueVideoById` will be called.
    this.videoId = 'another video id'
    },
    stop () {
    this.player.stopVideo()
    },
    pause () {
    this.player.pauseVideo()
    },
    openVideo () {
      $('#Video').modal('show');
    }
  },
  created(){

  }
});
