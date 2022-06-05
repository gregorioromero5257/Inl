import VueI18n from 'vue-i18n'
import Vue from 'vue'
import es from '../lang/es.json'
import en from '../lang/en.json'

Vue.use(VueI18n)
export const i18n = new VueI18n({
  locale: 'es', // set locale
  fallbackLocale: 'en',
  messages: { en, es }// set locale messages
})
