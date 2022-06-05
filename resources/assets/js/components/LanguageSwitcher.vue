<template lang="html">
  <div class="row">
    <div class="col-md-12">
      <multiselect v-model="languageSelected" :options="languages" placeholder="Selecciona el idioma" :allow-empty="false" deselectLabel="" selectLabel="Seleccionar" selectedLabel="Seleccionado" :loading="isLoading" label="name" track-by="name" @input="changeLanguage(languageSelected)"></multiselect>
    </div>
  </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
  name: 'LanguageSwitcher',
  components: {
    Multiselect
  },
  data: () => ({
    isLoading: true,
    languageSelected: '',
    languages: [
      {
        id: 'es',
        name: 'Español'
      },
      {
        id: 'en',
        name: 'English'
      }
    ]
  }),
  methods: {
    changeLanguage(lang) {
      this.$i18n.locale = this.languageSelected.id
    }
  },
  created(){
     let vm = this;
    this.languageSelected = this.languages.find(function(language) {
      return language.id == vm.$i18n.locale.toString()
    });
    this.isLoading = false;
  }
}
</script>

<style lang="css" scoped>
</style>
