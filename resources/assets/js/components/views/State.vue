<template>
  <div class="state container">
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
                <span class="font-weight-bold text-secondary">
                  {{ state_selected.name }}
                </span>
              </li>
            </ol>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <div class="row" v-if="profile.type != 'readonly'">
      <div class="col-md-12 mb-4">
        <h3 class="text-left text-uppercase font-weight-bold" style="color:#14519B;">{{ state_selected.name }}</h3>
        <hr class="hr-height">
        <h4 class="text-left text-uppercase font-weight-bold"
        style="text-align-last: left;margin-top: 10px;">

        {{ $t('state.title') }}
      </h4>
      </div>

    </div>

    <template v-if="loading">
      <div class="row">
        <div class="col-md-12 text-center">
          <p>
            <i class="fas fa-spinner fa-pulse fa-4x"></i>
          </p>
          <p class="h4">{{ $t('loading') }}</p>
        </div>
      </div>
    </template>
    <template v-else>

    <!-- *****************************************  Cards  *********************************************-->

    <div class="row">
      <div class="col col-md-4" v-if="profile.type != 'readonly'">
        <div class="card shadow pointer card-outline-to-do">
          <div class="card-body align-items-center d-flex justify-content-center text-center card-body-height"
          @click="documentaryInfoLink">
          <img src="/img/assets/inl_info_documental_card.svg" alt="database"
          style="width:2rem; margin-bottom: 0.3rem;">
          <p class="h4 font-weight-normal">{{ $t('state.documentary_information') }}</p>
        </div>
      </div>
    </div>
    <div class="col col-md-4" v-if="profile.type != 'readonly'">
      <div class="card shadow pointer card-outline-to-do">
        <div class="card-body align-items-center d-flex justify-content-center text-center card-body-height"
        @click="quantitativeSourcesLink">
        <img src="/img/assets/inl_fuentes_cuanti_card.svg" alt="database"
        style="width:2rem;margin-bottom: 0.3rem;">
        <p class="h4 font-weight-normal">{{ $t('state.quantitative_sources') }}</p>
      </div>
    </div>
  </div>
  <div class="col col-md-4" v-if="profile.type != 'readonly'">
    <div class="card shadow pointer card-outline-to-do">
      <div class="card-body align-items-center d-flex justify-content-center text-center card-body-height"
      @click="qualitativeSourcesLink">
      <img src="/img/assets/inl_fuentes_cuali_card.svg" alt="database"
      style="width:2rem;margin-bottom: 0.3rem;">
      <p class="h4 font-weight-normal">{{ $t('state.qualitative_sources') }}</p>
    </div>
    <!-- v-if="!$gate.isINL()" -->
    <a class="upload-file pointer" data-toggle="tooltip" data-placement="top"
    title="Cargar hoja de cálculo" @click="openModal" >
    <img src="/img/assets/icons_INL_icon_upload_2.svg" alt="database"
    style="width:1.7rem;margin-bottom: 0.3rem;">
  </a>
</div>
</div>
</div>
<!--*********************************** Final Reports section ********************************** -->

<div class="row">
  <div class="col-md-12">
    <hr class="hr-height">
    <h4 class="text-left text-uppercase font-weight-bold"
    style="text-align-last: left; margin-top: 10px;">
    {{ $t('state.final_reports_title') }}
  </h4>
</div>
</div>

<div class="row">
  <div class="col-md-6">
    <h5 class="text-center text-uppercase font-weight-bold">
      {{ $t('state.final_reports_spanish') }}
    </h5>
    <div class="row">
      <!-- Firs Card whith condiccions -->
      <div class="col-md-6" v-if=" Object.keys(reportEEs).length > 0">
        <div class="card shadow pointer card-outline-to-do" style="width: 16rem;" v-show="!downloadingEE">
          <div class="card-body">
            <center><h5 class="card-title">{{ $t('state.executive_report') }}</h5></center>
            <center><img src="/img/assets/executive_report.svg" alt="database"
              style="width:5rem;margin-bottom: 0.6rem;"></center>

              <p class="card-text"></p>
              <center>
                <button class="btn btn-primary" style="margin-bottom: 8px;" @click="dowloadReport(reportEEs,'ee')">
                  {{ $t('state.dowload_report') }}
                </button>
                <button type="button" class="btn btn-outline-primary " @click="editReport(reportEEs)"
                style="min-width: 203px">{{ $t('state.change_report') }}
              </button>
            </center>
          </div>
        </div>
        <div class="card shadow pointer card-outline-to-do" style="width: 16rem;" v-show="downloadingEE">
          <div class="card-body">
            <div class="col-md-12 text-center">
              <p>
                <i class="fas fa-circle-notch fa-spin fa-4x"></i>
              </p>
              <p class="h4">{{ $t('downloading') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6" v-else>
        <div class="card shadow pointer card-outline-to-do" style="width: 16rem;">
          <div class="card-body">
            <center><img src="/img/assets/senales.svg" alt="database"
              style="width:3rem; margin-bottom: 1.8rem;"></center>

              <center><p class="card-text">{{ $t('state.document_uploaded') }}</p></center>
              <br>
              <center>
                <button class="btn btn-outline-primary" @click="uploadReport('Ejecutivo','Español')">
                  {{ $t('state.add_executive_report') }}
                </button>
              </center>
            </div>
          </div>
        </div>
        <!-- Firs Card whith condiccions -->
        <!-- Second card with condicions -->
        <div class="col-md-6" v-if=" Object.keys(reportDEs).length > 0">
          <div class="card shadow pointer card-outline-to-do" style="width: 16rem;" v-show="!downloadingED">
            <div class="card-body">
              <center><h5 class="card-title">{{ $t('state.detailed_report') }}</h5></center>
              <center><img src="/img/assets/detailed_report.svg" alt="database"
                style="width:5rem;margin-bottom: 0.6rem;"></center>
                <p class="card-text"></p>
                <center>
                  <button class="btn btn-primary" style="margin-bottom: 8px;" @click="dowloadReport(reportDEs,'ed')">
                    {{ $t('state.dowload_report') }}
                  </button>
                  <button type="button" class="btn btn-outline-primary " @click="editReport(reportDEs)"
                  style="min-width: 203px">{{ $t('state.change_report') }}
                </button>
              </center>

            </div>
          </div>
          <div class="card shadow pointer card-outline-to-do" style="width: 16rem;" v-show="downloadingED">
            <div class="card-body">
              <div class="col-md-12 text-center">
                <p>
                  <i class="fas fa-circle-notch fa-spin fa-4x"></i>
                </p>
                <p class="h4">{{ $t('downloading') }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6" v-else>
          <div class="card shadow pointer card-outline-to-do" style="width: 16rem;">
            <div class="card-body">
              <center><img src="/img/assets/senales.svg" alt="database"
                style="width:3rem; margin-bottom: 1.8rem;"></center>
                <center><p class="card-text">{{ $t('state.document_uploaded') }}</p></center>
                <br>
                <center>
                  <button class="btn  btn-outline-primary" @click="uploadReport('Detallado','Español')">
                    {{ $t('state.add_detailed_report') }}
                  </button>
                </center>
              </div>
            </div>
          </div>
          <!-- Second card with condicions -->

        </div>

      </div>
      <div class="col-md-6">
        <h5 class="text-center text-uppercase font-weight-bold">
          {{ $t('state.final_reports_english') }}
        </h5>
        <div class="row">
          <!-- third card with condicions -->
          <div class="col-md-6" v-if="Object.keys(reportEEn).length > 0">
              <div class="card shadow pointer card-outline-to-do" style="width: 16rem;" v-show="!downloadingIE">
                <div class="card-body">
                  <center><h5 class="card-title">{{ $t('state.executive_report') }}</h5></center>
                  <center><img src="/img/assets/executive_report.svg" alt="database"
                    style="width:5rem;margin-bottom: 0.6rem;"></center>

                    <p class="card-text"></p>
                    <center>
                      <button class="btn btn-primary" style="margin-bottom: 8px;" @click="dowloadReport(reportEEn,'ie')">
                        {{ $t('state.dowload_report') }}
                      </button>
                      <button type="button" class="btn btn-outline-primary " @click="editReport(reportEEn)"
                      style="min-width: 203px">{{ $t('state.change_report') }}
                    </button>
                  </center>

                </div>
              </div>
              <div class="card shadow pointer card-outline-to-do" style="width: 16rem;" v-show="downloadingIE">
                <div class="card-body">
                  <div class="col-md-12 text-center">
                    <p>
                      <i class="fas fa-circle-notch fa-spin fa-4x"></i>
                    </p>
                    <p class="h4">{{ $t('downloading') }}</p>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-6" v-else>
            <div class="card shadow pointer card-outline-to-do" style="width: 16rem;">
              <div class="card-body">
                <center><img src="/img/assets/senales.svg" alt="database"
                  style="width:3rem; margin-bottom: 1.8rem;"></center>

                  <center><p class="card-text">{{ $t('state.document_uploaded') }}</p></center>
                  <br>
                  <center>
                    <button class="btn  btn-outline-primary" @click="uploadReport('Ejecutivo','Inglés')">
                      {{ $t('state.add_executive_report') }}
                    </button>
                  </center>
                </div>
              </div>
            </div>
          <!-- third card with condicions -->
          <!-- fourd card with condicions -->
          <div class="col-md-6" v-if="Object.keys(reportDEn).length > 0">
              <div class="card shadow pointer card-outline-to-do" style="width: 16rem;" v-show="!downloadingID">
                <div class="card-body">
                  <center><h5 class="card-title">{{ $t('state.detailed_report') }}</h5></center>
                  <center><img src="/img/assets/detailed_report.svg" alt="database"
                    style="width:5rem;margin-bottom: 0.6rem;"></center>

                    <p class="card-text"></p>
                    <center>
                      <button class="btn btn-primary" style="margin-bottom: 8px;" @click="dowloadReport(reportDEn,'id')">
                        {{ $t('state.dowload_report') }}
                      </button>
                      <button type="button" class="btn btn-outline-primary " @click="editReport(reportDEn)"
                      style="min-width: 203px">{{ $t('state.change_report') }}
                    </button>
                  </center>
                </div>
              </div>
              <div class="card shadow pointer card-outline-to-do" style="width: 16rem;" v-show="downloadingID">
                <div class="card-body">
                  <div class="col-md-12 text-center">
                    <p>
                      <i class="fas fa-circle-notch fa-spin fa-4x"></i>
                    </p>
                    <p class="h4">{{ $t('downloading') }}</p>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-6" v-else>
            <div class="card shadow pointer card-outline-to-do" style="width: 16rem;">
              <div class="card-body">
                <center><img src="/img/assets/senales.svg" alt="database"
                  style="width:3rem; margin-bottom: 1.8rem;"></center>

                  <center><p class="card-text">{{ $t('state.document_uploaded') }}</p></center>
                  <br>
                  <center>
                    <button class="btn  btn-outline-primary" @click="uploadReport('Detallado','Inglés')">
                      {{ $t('state.add_detailed_report') }}
                    </button>
                  </center>
                </div>
              </div>
            </div>
          <!-- fourd card with condicions -->
        </div>

      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <hr >
      </div>
    </div>
    <div class="row">
      <!--************************************ Document Review section *************************************************************** -->
      <div class="col-md-6" v-if="profile.type != 'readonly'">
        <div class="card shadow pointer card-outline-to-do">
          <div class="card-body align-items-center d-flex justify-content-center text-center"
            @click="detailedReportLink">
            <p class="h5 font-weight-bold">{{ $t('state.read_detailed') }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6" v-if="profile.type != 'readonly'">
        <div class="card shadow pointer card-outline-to-do">
          <div class="card-body align-items-center d-flex justify-content-center text-center"
            @click="executiveReportLink">
            <p class="h5 font-weight-bold"> {{ $t('state.read_executive') }}</p>
          </div>
        </div>
      </div>
    </div>
    <hr class="hr-height">
    <!--*********************************** Other useful documents section ****************************************** -->
    <div class="row">
      <div class="col-md-12" v-if="profile.type != 'readonly'">
        <h4 class="text-left text-uppercase font-weight-bold"
          style="text-align-last: left; margin-top: 10px;">
          {{ $t('state.other_documents') }}
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4" v-if="profile.type != 'readonly'">
        <div class="card shadow pointer card-outline-to-do">
          <div class="card-body align-items-center d-flex justify-content-center text-center card-body-height"
            @click="informationRepo">
            <p class="h5 font-weight-bold">{{ $t('state.document_repository') }}</p>
          </div>
        </div>
      </div>
    </div>
    <hr class="hr-height">
    <!-- v-if="!$gate.isINL()" -->
    <template v-if="!sending">

    <div class="row" v-if="$gate.isCoordinator() || $gate.isDirector()">
      <br>
      <div class="col-md-12" style="border : 1px solid rgba(0, 0, 0, 0.1);border-radius: 5px;" :style="parseFloat(total_loades) < 95 ? 'background: gray;' : ''" >
        <input type="checkbox" v-model="state_selected.end" @click="sendEmail(state_selected.end)" class="dark" :disabled="!(parseFloat(total_loades) > 95)">&nbsp;<span style="font-size: 1.1em;">Marcar este estado como finalizado</span>
      </div>
    </div>
  </template>
    <template v-if="sending">
      <div class="row">
        <div class="col-md-12 text-center">
          <p>
            <i class="fas fa-spinner fa-pulse fa-4x"></i>
          </p>
          <p class="h4">{{ $t('loading') }}</p>
        </div>
      </div>
    </template>
    <br>
</template>
<!-- Modal -->
<div class="modal fade" id="addSpreadsheet" tabindex="-1" role="dialog" aria-labelledby="addSpreadsheetLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="addSpreadsheetLabel">{{ $t('state.qualitative_sources') }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form @submit="formSubmit" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleFormControlFile1">{{ $t('state.spreadsheet') }}</label>
          <input @change="onImageChange" type="file" class="form-control-file"
          id="exampleFormControlFile1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-round">{{ $t('state.load_data') }}</button>
        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">
          {{ $t('state.cacel') }}
        </button>
      </div>
    </form>
  </div>
</div>
</div>
<!--******************************************** Modal FinalReports ********************************-->
<div class="modal fade" id="FinalReports" tabindex="-1" role="dialog" aria-labelledby="FinalReports"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="FinalReports" v-if="!edit">Agregar Reporte {{ type }} en
        {{ languaje }}</h5>
        <h5 class="modal-title" id="FinalReports" v-else>Editar Reporte {{ type }} en
          {{ languaje }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- <form @submit.prevent="finalReports()" enctype="multipart/form-data"> -->
          <div class="modal-body" v-show="isloading">
            <div class="col-md-12 text-center">
              <p>
                <i class="fas fa-spinner fa-pulse fa-4x"></i>
              </p>
              <p class="h4">{{ $t('loading') }}</p>
            </div>
          </div>
          <div class="modal-body" v-show="!isloading">
            <div class="form-group">
              <label for="name">{{ $t('state.name') }}</label>
              <input v-model="form.name" type="text" name="name" placeholder="" class="form-control"
              :class="{ 'is-invalid': form.errors.has('name') }">
              <has-error :form="form" field="name"></has-error>
            </div>

            <div class="form-group">
              <label for="type">{{ $t('state.document_type') }}</label>
              <input v-model="form.type" hidden type="text" name="type" placeholder=""
              class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
              <has-error :form="form" field="type"></has-error>
            </div>

            <div class="form-group">
              <label for="exampleFormControlFile1">{{ $t('state.document') }}</label>
              <input @change="reportDocument" type="file" accept="application/pdf" ref="fileInput" class="form-control-file"
              id="exampleFormControlFile1">
            </div>
          </div>
          <div class="modal-footer" v-show="!isloading">
            <button @click="saveReports()" class="btn btn-primary btn-round">{{ $t('state.add') }}</button>
            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">
              {{ $t('state.cacel') }}
            </button>
          </div>
        <!-- </form> -->
      </div>
    </div>
  </div>


</div>
</template>

<script>
export default {
  data: () => ({
    isloading: false,
    loading: false,
    sending :  false,
    downloadingEE : false,
    downloadingED : false,
    downloadingIE : false,
    downloadingID : false,
    profile: {type: 'readonly'},
    state_selected: {},
    total_loades : 0,
    documentaryInfoStatus: 0,
    quantitativeSourcesStatus: 1,
    qualitativeSourcesStatus: 2,
    image: '',
    type: '',
    languaje: '',
    reportstFinal: [],
    reportDEs: {},
    reportEEs: {},
    reportDEn: {},
    reportEEn: {},
    edit: false,
    idEdit: 0,
    form: new Form({
      id: '',
      state_id: '',
      name: '',
      type: '',
      document: '',
    })
  }),
  methods: {
    sendEmail(data) {
      this.sending =true;
      // if (event.target.checked) {
        console.log(data);
        axios.post('/api/send_end_state/',{
          state_id : this.state_selected.id,
          check : event.target.checked,
        }).then(response => {
          this.sending =false;
        }).catch(e => {
          this.sending =false;
          console.log(e);
        });
      // }
    },

    editReport(document) {
      this.clearFile();
      $('#FinalReports').modal('show');
      this.form.document = '';
      this.edit = true;
      this.type = document.type_report;
      this.languaje = document.languaje;
      this.idEdit = document.id;
    },
    dowloadReport(doc,t) {
      t == 'ee' ? this.downloadingEE = true : t == 'ed' ? this.downloadingED = true : t == 'ie' ? this.downloadingIE = true : t == 'id' ? this.downloadingID = true : false;
      this.$Progress.start();
      axios({
        url: `/api/dowload-final-report/${doc.id}`,
        method: 'GET',
        responseType: 'blob', // important
      }).then((response) => {
        this.$Progress.finish();
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', doc.document);
        document.body.appendChild(link);
        link.click();
        t == 'ee' ? this.downloadingEE = false : t == 'ed' ? this.downloadingED = false : t == 'ie' ? this.downloadingIE = false : t == 'id' ? this.downloadingID = false : false;
        // //--Llama el metodo para borrar el archivo local una ves descargado--//
        // axios.get('/api/delete-final-report-temp/' + doc.document)
        // .then(response => {
        // });
      });

    },
    reportDocument(e) {
      if (e.target.files[0].type === 'application/pdf') {
        this.form.document = e.target.files[0];
      } else {
        this.clearFile();
        swal({
          icon: 'error',
          title: 'ERROR',
          text: "Solo se aceptan archivos con extención pdf",
          type: 'error',
          confirmButtonText: 'Aceptar'
        })

      }
    },
    clearFile() {
      const input = this.$refs.fileInput;
      input.type = 'text';
      input.type = 'file';
      this.form.name = '';
    },
    uploadReport(type, languaje) {
      this.clearFile();
      this.form.document = '';
      this.type = type;
      this.languaje = languaje;
      this.edit = false;
      $('#FinalReports').modal('show');
    },
    saveReports(){
      this.$Progress.start();
      this.isloading = true;

      let formData = new FormData();
      formData.append('name', this.form.name);
      /* formData.append('type', this.form.type); */
      formData.append('type', 'pdf');
      formData.append('document', this.form.document);
      formData.append('state_id', this.state_selected.id);
      formData.append('languaje', this.languaje);
      formData.append('type_report', this.type);
      formData.append('edit', this.edit);
      formData.append('id',this.idEdit);
      axios({
        method: 'POST',
        url: '/api/final-reports',
        data : formData
      }).then(response => {
        this.isloading = false;
        Fire.$emit('AfterCreate');
        $('#FinalReports').modal('hide')
        toast({
          type: 'success',
          title: 'Reporte cargado con éxito'
        })
        this.$Progress.finish();
        this.form.reset();
        this.loadDocuments();
      }).catch(e => {
        toast({
          type: 'error',
          title: 'Error al agregar reporte'
        })
        this.$Progress.fail();
        this.isloading = false;
      });
    },
    async finalReports() {

      if (!this.edit) {
        const config = {
          headers: {'content-type': 'multipart/form-data'}
        }

        let formData = new FormData();
        formData.append('name', this.form.name);
        /* formData.append('type', this.form.type); */
        formData.append('type', 'pdf');
        formData.append('document', this.form.document);
        formData.append('state_id', this.state_selected.id);
        formData.append('languaje', this.languaje);
        formData.append('type_report', this.type);
        this.$Progress.start();
        await axios.post(`/api/final-reports`, formData, config).then(() => {
          Fire.$emit('AfterCreate');
          $('#FinalReports').modal('hide')
          toast({
            type: 'success',
            title: 'Reporte cargado con éxito'
          })
          this.$Progress.finish();
          this.form.reset();
        })
        .catch((e) => {
          console.log(e);
          toast({
            type: 'error',
            title: 'Error al agregar reporte'
          })
          this.$Progress.fail();
        })
      } else {
        this.sendEdit();
      }

      this.loadDocuments();
    },
    async sendEdit() {

      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }

      let formData = new FormData();
      formData.append('name', this.form.name);
      /*  formData.append('type', this.form.type); */
      formData.append('type', 'pdf');
      formData.append('document', this.form.document);
      formData.append('state_id', this.state_selected.id);
      formData.append('languaje', this.languaje);
      formData.append('type_report', this.type);
      this.$Progress.start();
      await axios.post(`/api/update-report/${this.idEdit}`, formData, config).then(() => {
        Fire.$emit('AfterCreate');
        $('#FinalReports').modal('hide')
        toast({
          type: 'success',
          title: 'Reporte actualizado con éxito'
        })
        this.$Progress.finish();
        this.form.reset();
      })
      .catch((e) => {
        console.log(e);
        toast({
          type: 'error',
          title: 'Error al actualizadar el reporte'
        })
        this.$Progress.fail();
      })
      this.loadDocuments();
    },
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;

      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }
      let formData = new FormData();
      formData.append('image', this.image);
      formData.append('state_selected', this.state_selected.id);

      this.$Progress.start();
      axios.post(`/api/import-observation`, formData, config)
      .then(() => {
        Fire.$emit('AfterCreate');
        toast({
          type: 'success',
          title: 'Datos cargados correctamente'
        })
        $('#addSpreadsheet').modal('hide');
        this.$Progress.finish();
        this.$router.push(`/state/${this.$route.params.key}/qualitative-sources`)
      })
      .catch(() => {
        toast({
          type: 'error',
          title: 'Error al cargar datos'
        })
        this.$Progress.fail();
      });
    },
    onImageChange(e) {
      this.image = e.target.files[0];
      console.log(this.image);
    },
    openModal() {
      $('#addSpreadsheet').modal('show');
    },
    async loadData() {
      this.loading = true;
      await axios.get(`/api/state_by_key_single/${this.$route.params.key}`)
      .then(({data}) => (
        //this.loading = false,
        this.state_selected = data['data'],
        this.total_loades = data['percentage']
      )).catch(() => {
        toast({
          type: 'error',
          title: 'Error al cargar datos'
        })
        // this.loading = false;
      });
      this.loadDocuments();
      axios.get("/api/profile").then(
        ({data}) => {
          this.profile = data;

        }
      ).catch(() => {
        toast({
          type: 'error',
          title: 'Error al cargar usuario'
        })
        this.loading = false;
      });
    },

    async loadDocuments() {
      await axios.get(`/api/final-reports/${this.state_selected.id}`)
      .then(res => {
        this.reportstFinal = res.data
      }).catch(() => {
        toast({
          type: 'error',
          title: 'Error al cargar datos'
        })
      });
      this.documentExist();
    },
    documentExist() {
      for (let index = 0; index < this.reportstFinal.length; index++) {
        const element = this.reportstFinal[index];
        if (element.languaje == 'Español') {
          if (element.type_report == 'Detallado') {
            this.reportDEs = element;
          } else {
            this.reportEEs = element;
          }
        } else {
          if (element.type_report == 'Detallado') {
            this.reportDEn = element;
          } else {
            this.reportEEn = element;
          }
        }
      }
      // console.log(Object.keys(this.reportDEs).length)
      this.loading = false;
    },
    documentaryInfoLink() {
      this.$router.push(`/state/${this.$route.params.key}/documentary-information`)
    },
    quantitativeSourcesLink() {
      this.$router.push(`/state/${this.$route.params.key}/quantitative-sources`)
    },
    qualitativeSourcesLink() {
      this.$router.push(`/state/${this.$route.params.key}/qualitative-sources`)
    },
    detailedReportLink() {
      this.$router.push(`/state/${this.$route.params.key}/detailed-report`)
    },
    executiveReportLink() {
      this.$router.push(`/state/${this.$route.params.key}/executive-report`)
    },
    informationRepo() {
      this.$router.push(`/state/${this.$route.params.key}/repository`)
    }
  },
  created() {
    const languaje = localStorage.getItem("languaje");
    this.$i18n.locale = languaje;
    this.loadData();
  }
}
</script>

<style lang="scss" scoped>
@import "../../../sass/_variables.scss";

.shadow {
  box-shadow: 4px 5px 16px 3px rgba(0, 0, 0, 0.16) !important;
}

.card-outline-done {
  border-bottom: 6px solid $success;
}

.card-outline-in-progress {
  border-bottom: 6px solid $warning;
}

/* .card-outline-to-do {
border-bottom: 6px solid $danger;
} */
.card-outline-to-do {
  border-bottom: 6px solid #13385d;
}

.card-body-height {
  height: 20vh;
}

.upload-file {
  position: absolute;
  right: 1em;
  bottom: 1em;
}

.repo-link {
  position: absolute;
  right: 0em;
  top: -2.3em;
}
</style>
