<template>
    <div class="container">
        <div class="row">

          <div class="col-md-1">
          </div>
          <div class="col-md-10">
            <label>&nbsp;</label>
            <h2 class="font-weight-bold mb-5">{{ $t('custom_reports.tittle') }}</h2>
            <!--  -->
            <div class="card shadow mb-4">
                <div class="card-header font-weight-bold" style="background-color:#091f2f; color: #ffff">
                    <span class="card-title" @click="showList" v-if="!stateSelected" style="font-family: Open Sans Condensed;
                        font-size: 24px;
                        color: #FFFFFF;
                        text-align: left;
                        vertical-align: top;
                        font-weight: 700;
                        text-transform: none;">
                        <img src="/img/assets/01.5_icon_down.png" alt="progress" class="img-align">
                        {{ $t('custom_reports.select_state') }}
                    </span>
                    <span class="card-title" @click="showList" v-if="stateSelected" style="font-family: Open Sans Condensed;
                        font-size: 24px;
                        color: #FFFFFF;
                        text-align: left;
                        vertical-align: top;
                        font-weight: 700;
                        text-transform: none;">
                        <img src="/img/assets/01.5_icon_down.png" alt="progress" class="img-align">
                        {{ stateSelectedName }} {{ $t('breadcrumb.round') }} {{stateRound}}
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-4 " style="position: absolute; z-index:5" v-if="controlList">
                    <ul class="list-group">

                        <div class="list-group-item list-group-item-action" data-toggle="list" role="tab"
                             aria-controls="profile"
                             v-for="state in states" :key="state.id"
                             @click="dataByState(state.key,state.name,state.id, state.round)">

                            {{ state.name}} {{ '(' + $t('breadcrumb.round') }} {{  state.round+ ')'}}
                        </div>
                    </ul>
                </div>
            </div>
            <div class="grid">
              <!-- Uno -->
              <div class="grid-child-one">
                <div class="card shadow pointer card-outline-to-do" style="display: flex; align-items: center; justify-content: center;">
                  <h3 class="font-weight-bold float-left" style="
                  font-family: Poppins;
                  font-size: 21px;
                  color: #a6adaf;
                  vertical-align: top;
                  font-weight: 700;
                  text-transform: none;">{{ $t('custom_reports.tittle_general_chart') }}</h3>
                        <template>
                          <vue-circle
                          ref="myUniqueID"
                          :progress="0"
                          :size="280"
                          :reverse="false"
                          line-cap="round"
                          :fill="fill"
                          empty-fill="rgba(0, 0, 0, .1)"
                          :animation-start-value="0.0"
                          :start-angle="80"
                          insert-mode="append"
                          :thickness="23"
                          :show-percent="true"
                          @vue-circle-progress="progress"
                          @vue-circle-end="progress_end">
                        </vue-circle>
                      </template>
                      <span class="card-title  float-left" style="font-family: Poppins;
                        font-size: 21px;
                        color: #a6adaf;
                        vertical-align: top;
                        font-weight: 500;
                        text-transform: none;
                        ">
                        {{ $t('custom_reports.general_reports') }}
                      </span>
                      <!-- Inicio de reporte Ejecutivo Español -->
                      <div class="row">
                        <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                          <span style="font-family: Poppins;
                          font-size: 16px;
                          color: #6C757D;
                          font-weight: 700;
                          text-transform: none;">
                          <img src="/img/assets/executive_report.svg"
                               alt="progress" style="margin-top: -22px;"
                               height="57px" width="38px" class="img-align">
                               {{$t('custom_reports.ejecutive')}}
                          </span>
                        </div>
                        <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                          <img src="/img/assets/03.3_Icon_download.png" @click="dowloadReport(reportEEs)">
                          <img src="/img/assets/04.3.4 unavailable.png" @click="dowloadReport(reportEEs)">
                          <label>&nbsp;</label>
                         <span style="font-family: Poppins;
                          font-size: 14px;
                          color: #6C757D;
                          font-weight: 400;
                          text-transform: none;">{{ $t('custom_reports.reportEs') }}</span>
                        <label>&nbsp;</label>
                          <img src="/img/assets/03.3_Icon_download.png" @click="dowloadReport(reportEEn)">
                          <img src="/img/assets/04.3.4 unavailable.png" @click="dowloadReport(reportEEn)">
                          <label>&nbsp;</label>
                          <span style="font-family: Poppins;
                          font-size: 14px;
                          color: #6C757D;
                          font-weight: 400;
                          text-transform: none;">{{ $t('custom_reports.reportEn') }}</span>
                        </div>
                      </div>
                      <!-- Fin de reporte Ejecutivo Español -->
                      <br>
                      <!-- Inicio de reporte Detallado Español -->
                      <div class="row">
                        <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                          <span class="float-left" style="font-family: Poppins;
                          font-size: 16px;
                          color: #6C757D;
                          text-align: left;
                          font-weight: 700;
                          text-transform: none;">
                          <img src="/img/assets/detailed_report.svg"
                               @click="dowloadReport(reportDEs)" alt="progress"
                               style="margin-top: -22px;" height="57px"
                               width="38px" class="img-align">
                               {{$t('custom_reports.detailed')}}
                           </span>
                        </div>
                        <div class="col-md-12 mb-4" style="display: flex; align-items: center; justify-content: center;">
                          <img src="/img/assets/03.3_Icon_download.png">
                          <img src="/img/assets/04.3.4 unavailable.png" @click="dowloadReport(reportDEs)">
                          <label>&nbsp;</label>
                          <span style="font-family: Poppins;
                          font-size: 14px;
                          color: #6C757D;
                          font-weight: 400;
                          text-transform: none;">
                          {{ $t('custom_reports.reportEs') }}
                          </span>
                          <label>&nbsp;</label>
                          <img src="/img/assets/03.3_Icon_download.png" @click="dowloadReport(reportDEn)">
                          <img src="/img/assets/04.3.4 unavailable.png" @click="dowloadReport(reportDEn)">
                          <label>&nbsp;</label>
                          <span style="font-family: Poppins;
                          font-size: 14px;
                          color: #6C757D;
                          font-weight: 400;
                          text-transform: none;">{{ $t('custom_reports.reportEn') }}</span>
                        </div>
                      </div>
                      <!-- Fin de reporte Detallado Español -->

                </div>

              </div>
              <!-- Uno -->
              <div class="grid-child-two">
                <div class="row">
                  <!-- Inicio de fuente documental -->
                  <div class="col-md-12">
                    <div class="card shadow pointer card-outline-to-do" v-if="!documentaryReport">
                        <div class="card-body align-items-center d-flex  card-body-height" >
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8">
                                        <span class="float-left" style="font-family: Poppins;
                                        font-size: 21px;
                                        color: #213239;
                                        font-weight: 500;
                                        text-transform: none;" @click="documentaryReportShow(true)">
                                            <img src="/img/assets/06.1.2_show list.png" alt="progress"
                                                 class="img-align" @click="documentaryReportShow(true)">
                                            {{ $t('custom_reports.documental') }}
                                        </span>

                                    </div>
                                    <div class="col-md-4">
                                        <span class="float-right">
                                            <img src="/img/assets/inl_info_documental_card.svg" width="47px"
                                                 height="53px">
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <span style="font-family: Poppins;
                                            font-size: 36px;
                                            color: #6C757D;
                                            font-weight: 200;
                                            text-transform: none;">
                                            {{ documentaryPercentaje.progress }}
                                        </span>
                                        <span style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 700;
                                            text-transform: none;">
                                            {{ $t('custom_reports.progress') }}
                                        </span>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="progress" style="height: 30px; width: 100%;">
                                            <div class="progress-bar" role="progressbar"
                                                 :style="{'width': documentaryPercentaje.progress, 'background-color': documentaryPercentaje.color}"
                                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card shadow pointer card-outline-to-do" v-if="documentaryReport" style="border-color: #091f2f;
                        background-color: #F4F7F9 !important;">
                        <div class="card-body align-items-center d-flex   card-body-height" >
                            <div class="container">

                                <div class="row">
                                    <div class="col-md-8">
                                        <span class="float-left" style="font-family: Poppins;
                                        font-size: 21px;
                                        color: #213239;
                                        font-weight: 500;
                                        text-transform: none;" @click="documentaryReportShow(false)">
                                            <img src="/img/assets/06.1.1_hide list.png" alt="progress"
                                                 class="img-align" @click="documentaryReportShow(false)">
                                            {{ $t('custom_reports.documental') }}
                                        </span>

                                    </div>
                                    <div class="col-md-4">
                                        <span class="float-right">
                                            <img src="/img/assets/inl_info_documental_card.svg" width="47px"
                                                 height="53px">
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-all"
                                                   :checked="reportControlAll.documental"
                                                   @click="changeDocumentary">
                                            <label class="custom-control-label" for="checkbox-all" style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 700;
                                            text-transform: none;">{{ $t('custom_reports.all_documental') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-orga"
                                                   :checked="this.reportControl.organigrama"
                                                   @click="organigramaChanged">
                                            <label class="custom-control-label" for="checkbox-orga" style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 500;
                                            text-transform: none;
                                            margin-left: 23px;">{{
                                                    $t('custom_reports.organization_chart')
                                                }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-map"
                                                   :checked="this.reportControl.mapa" @click="mapaChanged">
                                            <label class="custom-control-label" for="checkbox-map" style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 500;
                                            text-transform: none;
                                            margin-left: 23px;">{{ $t('custom_reports.map') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- Fin de fuente documental -->
                  <!-- Inicio de fuente cuantitativa -->
                  <div class="col-md-12">
                    <div class="card shadow pointer card-outline-to-do" v-if="!cuantitativeReport">
                        <div class="card-body align-items-center d-flex   card-body-height" >
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <span class="float-left" style="font-family: Poppins;
                                        font-size: 21px;
                                        color: #213239;
                                        font-weight: 500;
                                        text-transform: none;" @click="cuantitativeReportShow(true)">
                                            <img src="/img/assets/06.1.2_show list.png" alt="progress"
                                                 class="img-align" @click="cuantitativeReportShow(true)">
                                            {{ $t('custom_reports.cuantitative_source') }}
                                        </span>

                                    </div>
                                    <div class="col-md-4">
                                        <span class="float-right">
                                            <img src="/img/assets/inl_fuentes_cuanti_card.svg" width="47px"
                                                 height="53px">
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <span style="font-family: Poppins;
                                            font-size: 36px;
                                            color: #6C757D;
                                            font-weight: 200;
                                            text-transform: none;">
                                            {{ cuantitativePercentaje.prorgess }}
                                        </span>
                                        <span style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 700;
                                            text-transform: none;">
                                           {{ $t('custom_reports.progress') }}
                                        </span>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="progress" style="height: 30px; width: 100%;">
                                            <div class="progress-bar " role="progressbar"
                                                 :style="{'width': cuantitativePercentaje.prorgess, 'background-color': cuantitativePercentaje.color}"
                                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow pointer card-outline-to-do" v-if="cuantitativeReport" style="border-color: #091f2f;
                        background-color: #F4F7F9 !important;">
                        <div class="card-body align-items-center d-flex   card-body-height" >
                            <div class="container">

                                <div class="row">

                                    <div class="col-md-8">
                                        <span class="float-left" style="font-family: Poppins;
                                        font-size: 21px;
                                        color: #213239;
                                        font-weight: 500;
                                        text-transform: none;" @click="cuantitativeReportShow(false)">
                                            <img src="/img/assets/06.1.1_hide list.png" alt="progress"
                                                 class="img-align" @click="cuantitativeReportShow(false)">
                                            {{ $t('custom_reports.cuantitative_source') }}
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="float-right">
                                            <img src="/img/assets/inl_fuentes_cuanti_card.svg" width="47px"
                                                 height="53px">
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="checkbox-all-cuantitative"
                                                   :checked="reportControlAll.cuantitativa"
                                                   @click="cuantitativeDesision('all')">
                                            <label class="custom-control-label" for="checkbox-all-cuantitative"
                                                   style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 700;
                                            text-transform: none;">{{
                                                    $t('custom_reports.all_cuantitative_source')
                                                }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input"
                                                   :id="'cuantitative1'" :checked="reportControl.cuanti2017"
                                                   @click="cuantitativeDesision('2017')">
                                            <label class="custom-control-label" :for="'cuantitative1'" style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 500;
                                            text-transform: none;
                                            margin-left: 23px;">2017 </label>
                                        </div>
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input"
                                                   :id="'cuantitative2'" :checked="reportControl.cuanti2018"
                                                   @click="cuantitativeDesision('2018')">
                                            <label class="custom-control-label" :for="'cuantitative2'" style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 500;
                                            text-transform: none;
                                            margin-left: 23px;">2018 </label>
                                        </div>
                                        <div v-if="stateRound == 2">
                                          <div class="custom-control custom-checkbox checkbox-lg">
                                              <input type="checkbox" class="custom-control-input"
                                                     :id="'cuantitative3'" :checked="reportControl.cuanti2019"
                                                     @click="cuantitativeDesision('2019')">
                                              <label class="custom-control-label" :for="'cuantitative3'" style="font-family: Poppins;
                                              font-size: 16px;
                                              color: #6C757D;
                                              font-weight: 500;
                                              text-transform: none;
                                              margin-left: 23px;">2019 </label>
                                          </div>
                                          <div class="custom-control custom-checkbox checkbox-lg">
                                              <input type="checkbox" class="custom-control-input"
                                                     :id="'cuantitative4'" :checked="reportControl.cuanti2020"
                                                     @click="cuantitativeDesision('2020')">
                                              <label class="custom-control-label" :for="'cuantitative4'" style="font-family: Poppins;
                                              font-size: 16px;
                                              color: #6C757D;
                                              font-weight: 500;
                                              text-transform: none;
                                              margin-left: 23px;">2020 </label>
                                          </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- Fin de fuente cuantitativa -->
                  <!-- Inicio de fuente cualitativa -->
                  <div class="col-md-12">
                    <div class="card shadow pointer card-outline-to-do" v-if="!cualitativeReport">
                        <div class="card-body align-items-center d-flex   card-body-height" >
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <span class="float-left" style="font-family: Poppins;
                                        font-size: 21px;
                                        color: #213239;
                                        font-weight: 500;
                                        text-transform: none;" @click="cualitativeReortShow(true)">
                                            <img src="/img/assets/06.1.2_show list.png" alt="progress"
                                                 class="img-align" @click="cualitativeReortShow(true)">
                                            {{ $t('custom_reports.cualitative_source') }}
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="float-right">
                                            <img src="/img/assets/inl_fuentes_cuali_card.svg" width="47px"
                                                 height="53px">
                                        </span>
                                    </div>

                                    <div class="col-md-12">

                                        <span style="font-family: Poppins;
                                            font-size: 36px;
                                            color: #6C757D;
                                            font-weight: 200;
                                            text-transform: none;">
                                            {{ cualitativePercentaje.progress }}
                                        </span>
                                        <span style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 700;
                                            text-transform: none;">
                                            {{ $t('custom_reports.progress') }}
                                        </span>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="progress" style="height: 30px; width: 100%;">
                                            <div class="progress-bar" role="progressbar"
                                                 :style="{'width': cualitativePercentaje.progress, 'background-color': cualitativePercentaje.color}"
                                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow pointer card-outline-to-do" v-if="cualitativeReport" style="border-color: #091f2f;
                        background-color: #F4F7F9 !important;">
                        <div class="card-body align-items-center d-flex   card-body-height" >
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <span class="float-left" style="font-family: Poppins;
                                        font-size: 21px;
                                        color: #213239;
                                        font-weight: 500;
                                        text-transform: none;" @click="cualitativeReortShow(false)">
                                            <img src="/img/assets/06.1.1_hide list.png" alt="progress"
                                                 class="img-align" @click="cualitativeReortShow(false)">
                                           {{ $t('custom_reports.cualitative_source') }}
                                        </span>

                                    </div>
                                    <div class="col-md-4">
                                        <span class="float-right">
                                            <img src="/img/assets/inl_fuentes_cuali_card.svg" width="47px"
                                                 height="53px">
                                        </span>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="checkbox-all-cualitative"
                                                   :checked="reportControlAll.cualitativa"
                                                   @click="cualitativeReportChanged('all')">
                                            <label class="custom-control-label" for="checkbox-all-cualitative"
                                                   style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 700;
                                            text-transform: none;">{{
                                                    $t('custom_reports.all_cualitative_source')
                                                }}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-reg"
                                                   :checked="reportControl.regulatorio"
                                                   @click="cualitativeReportChanged('regulatorio')">
                                            <label class="custom-control-label" for="checkbox-reg" style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 500;
                                            text-transform: none;
                                            margin-left: 23px;">{{ $t('custom_reports.regulatory') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-inst"
                                                   :checked="reportControl.institucional"
                                                   @click="cualitativeReportChanged( 'institucional')">
                                            <label class="custom-control-label" for="checkbox-inst" style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 500;
                                            text-transform: none;
                                            margin-left: 23px;">{{ $t('custom_reports.institutional') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-indi"
                                                   :checked="reportControl.individual"
                                                   @click="cualitativeReportChanged('individual')">
                                            <label class="custom-control-label" for="checkbox-indi" style="font-family: Poppins;
                                            font-size: 16px;
                                            color: #6C757D;
                                            font-weight: 500;
                                            text-transform: none;
                                            margin-left: 23px;">{{ $t('custom_reports.individual') }}</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- Fin de fuente cualitativa -->
                </div>
              </div>
            </div>
            <!--  -->
          </div>
          <div class="col-md-1">
          </div>
        </div>

        <label>&nbsp;</label>
        <div class="row mb-4">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

                <center>

                    <button class="btn btn-primary btn-round w-50 p-3 "
                            @click="customReportDowload">
                        <h5 class="font-weight-bold" style="overflow: hidden !important;
                      text-overflow: ellipsis !important;
                      white-space: initial;">
                            <img src="/img/04.4.1_icon .png" alt="progress" class="img-align">
                            {{ $t('custom_reports.button_report') }}
                        </h5>
                    </button>
                    <div class="col-md-12 " v-if="createdTable" hidden >
                        <div class="table-responsive">
                            <table id="criteria-regulatory" class="table">
                                <thead>
                                <tr>
                                    <th>Criterio</th>
                                    <th>Posible problemática</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="criterion in criteria.slice(0, 3)" :key="criterion.id">
                                    <td>Criterio {{ criterion.id }}: {{ criterion.name }}</td>
                                    <template v-if="stateRound == 1">
                                      <td v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]"></td>
                                    </template>
                                    <template v-if="stateRound == 2">
                                      <template v-for="tf in state_selected.criterion_conclusions">
                                        <template v-if="tf.ambit_id == 1 && tf.criterion_id == criterion.id">
                                          <template v-if="tf.problematica_conclusion != null">
                                            <td v-html="tf.problematica_conclusion"></td><br>
                                          </template>
                                        </template>
                                      </template>
                                    </template>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 " v-if="createdTable" hidden>
                        <div class="table-responsive">
                            <table id="criteria-institutional" class="table">
                                <thead>
                                <tr>
                                    <th>Criterio</th>
                                    <th>Posible problemática</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="criterion in criteria.slice(3, 11)" :key="criterion.id">
                                    <td>Criterio {{ criterion.id }}: {{ criterion.name }}</td>
                                    <template v-if="stateRound == 1">
                                      <td v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]"></td>
                                    </template>
                                    <template v-if="stateRound == 2">
                                      <template v-for="tf in state_selected.criterion_conclusions">
                                        <template v-if="tf.ambit_id == 2 && tf.criterion_id == criterion.id">
                                          <template v-if="tf.problematica_conclusion != null">
                                            <td v-html="tf.problematica_conclusion"></td><br>
                                          </template>
                                        </template>
                                      </template>
                                    </template>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 " v-if="createdTable" hidden>
                        <div class="table-responsive">
                            <table id="criteria-individual" class="table">
                                <thead>
                                <tr>
                                    <th>Criterio</th>
                                    <th>Posible problemática</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="criterion in criteria.slice(11, 15)" :key="criterion.id">
                                    <td>Criterio {{ criterion.id }}: {{ criterion.name }}</td>
                                    <template v-if="stateRound == 1">
                                      <td v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]"></td>
                                    </template>
                                    <template v-if="stateRound == 2">
                                      <template v-for="tf in state_selected.criterion_conclusions">
                                        <template v-if="tf.ambit_id == 3 && tf.criterion_id == criterion.id">
                                          <template v-if="tf.problematica_conclusion != null">
                                            <td v-html="tf.problematica_conclusion"></td><br>
                                          </template>
                                        </template>
                                      </template>
                                    </template>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="col-md-12 " v-if="createdTable" hidden>
                        <div class="table-responsive">
                            <table id="criteria-institutional" class="table">
                                <thead>
                                <tr>
                                    <th>Criterio</th>
                                    <th>Posible problemática</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="criterion in criteria.slice(3, 11)" :key="criterion.id">
                                    <td>Criterio {{ criterion.id }}: {{ criterion.name }}</td>
                                    <td v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 " v-if="createdTable" hidden>
                        <div class="table-responsive">
                            <table id="criteria-individual" class="table">
                                <thead>
                                <tr>
                                    <th>Criterio</th>
                                    <th>Posible problemática</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="criterion in criteria.slice(11, 15)" :key="criterion.id">
                                    <td>Criterio {{ criterion.id }}: {{ criterion.name }}</td>
                                    <td v-html="state_selected.criterion_problematic['problematicbycriterion'+criterion.id]"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> -->

                    <div class="col-md-12" hidden>
                        <div class="table-responsive">
                            <table class="table" id="cuantitative-report">
                                <thead>
                                <tr>
                                    <th>Datos de los 12 meses del año anterior</th>
                                    <th>Fuentes</th>
                                    <th v-if="reportControl.cuanti2017">Total (2017)</th>
                                    <th v-if="reportControl.cuanti2018">Total (2018)</th>
                                    <th v-if="reportControl.cuanti2019">Total (2019)</th>
                                    <th v-if="reportControl.cuanti2020">Total (2020)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(variable, index) in variables" :key="index">
                                    <td>{{ variable.num }}. {{ variable.name }}</td>
                                    <td>{{ variable.source }}</td>
                                    <template v-if="reportControl.cuanti2017">
                                        <td v-if=" form[variable.check_slug_2017] == 0">
                                            {{ form[variable.slug_2017] }}
                                        </td>
                                        <td v-else>
                                            N/A
                                        </td>
                                    </template>

                                    <template v-if="reportControl.cuanti2018">
                                        <td v-if="form[variable.check_slug_2018] == 0">
                                            {{ form[variable.slug_2018] }}
                                        </td>
                                        <td v-else>
                                            N/A
                                        </td>
                                    </template>
                                    <template v-if="reportControl.cuanti2019">
                                        <td v-if="form[variable.check_slug_2019] == 0">
                                            {{ form[variable.slug_2019] }}
                                        </td>
                                        <td v-else>
                                            N/A
                                        </td>
                                    </template>
                                    <template v-if="reportControl.cuanti2020">
                                        <td v-if="form[variable.check_slug_2020] == 0">
                                            {{ form[variable.slug_2020] }}
                                        </td>
                                        <td v-else>
                                            N/A
                                        </td>
                                    </template>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </center>
            </div>
        </div>

        <div class="col-md-2">
        </div>

    </div>
</template>
<script>
import VueCircle from 'vue2-circle-progress'
import * as fs from "fs";
import {saveAs} from 'file-saver';
import jsPDF from 'jspdf'
import autoTable from 'jspdf-autotable'

export default {
    components: {
        VueCircle, jsPDF, autoTable
    },
    data: () => ({
        fill: '#8cc63f',
        documentaryPercentaje: {
            map: 0,
            organization_chart: 0,
            headquarters: 0,
            color: '',
            progress: '0%'
        },
        cuantitativePercentaje: {
            color: '',
            prorgess: '0%'
        },
        cualitativePercentaje: {
            progress: '0%',
            color: ''
        },
        documentprogress: '0%',
        states: [],
        organization_chart: [],
        headquarters: [],
        map: [],
        loading: false,
        controlList: false,
        cualitativeReport: false,
        cuantitativeReport: false,
        documentaryReport: false,
        gobalProgress: 0,
        stateSelected: false,
        stateSelectedName: '',
        stateRound : '',
        reportDEs: {},
        reportEEs: {},
        reportDEn: {},
        reportEEn: {},
        reportstFinal: [],
        reportControl: {
            organigrama: false,
            mapa: false,
            sedes: false,
            cuanti2017: false,
            cuanti2018: false,
            cuanti2019: false,
            cuanti2020: false,
            regulatorio: false,
            institucional: false,
            individual: false,
        },
        reportControlAll: {
            documental: false,
            cuantitativa: false,
            cualitativa: false
        },
        desicionNum: 4,
        key: '',
        criteria: '',
        createdTable: false,
        state_selected: {},
        form : {},
        // form: new Form({
        //     id: '',
        //     state_id: '',
        //     variable1_2018: '',
        //     variable2_2018: '',
        //     variable3_2018: '',
        //     variable4_2018: '',
        //     variable5_2018: '',
        //     variable6_2018: '',
        //     variable7_2018: '',
        //     variable8_2018: '',
        //     variable9_2018: '',
        //     variable10_2018: '',
        //     variable11_2018: '',
        //     variable12_2018: '',
        //     variable13_2018: '',
        //     variable14_2018: '',
        //     variable15_2018: '',
        //     variable16_2018: '',
        //     variable17_2018: '',
        //     variable18_2018: '',
        //     variable19_2018: '',
        //     variable20_2018: '',
        //     variable21_2018: '',
        //     variable22_2018: '',
        //     variable23_2018: '',
        //     variable24_2018: '',
        //     variable25_2018: '',
        //     variable26_2018: '',
        //     variable27_2018: '',
        //     variable28_2018: '',
        //     variable29_2018: '',
        //     variable30_2018: '',
        //     variable31_2018: '',
        //     variable32_2018: '',
        //     variable33_2018: '',
        //     variable34_2018: '',
        //     variable35_2018: '',
        //     checked1_2018: '',
        //     checked2_2018: '',
        //     checked3_2018: '',
        //     checked4_2018: '',
        //     checked5_2018: '',
        //     checked6_2018: '',
        //     checked7_2018: '',
        //     checked8_2018: '',
        //     checked9_2018: '',
        //     checked10_2018: '',
        //     checked11_2018: '',
        //     checked12_2018: '',
        //     checked13_2018: '',
        //     checked14_2018: '',
        //     checked15_2018: '',
        //     checked16_2018: '',
        //     checked17_2018: '',
        //     checked18_2018: '',
        //     checked19_2018: '',
        //     checked20_2018: '',
        //     checked21_2018: '',
        //     checked22_2018: '',
        //     checked23_2018: '',
        //     checked24_2018: '',
        //     checked25_2018: '',
        //     checked26_2018: '',
        //     checked27_2018: '',
        //     checked28_2018: '',
        //     checked29_2018: '',
        //     checked30_2018: '',
        //     checked31_2018: '',
        //     checked32_2018: '',
        //     checked33_2018: '',
        //     checked34_2018: '',
        //     checked35_2018: '',
        //     variable1_2017: '',
        //     variable2_2017: '',
        //     variable3_2017: '',
        //     variable4_2017: '',
        //     variable5_2017: '',
        //     variable6_2017: '',
        //     variable7_2017: '',
        //     variable8_2017: '',
        //     variable9_2017: '',
        //     variable10_2017: '',
        //     variable11_2017: '',
        //     variable12_2017: '',
        //     variable13_2017: '',
        //     variable14_2017: '',
        //     variable15_2017: '',
        //     variable16_2017: '',
        //     variable17_2017: '',
        //     variable18_2017: '',
        //     variable19_2017: '',
        //     variable20_2017: '',
        //     variable21_2017: '',
        //     variable22_2017: '',
        //     variable23_2017: '',
        //     variable24_2017: '',
        //     variable25_2017: '',
        //     variable26_2017: '',
        //     variable27_2017: '',
        //     variable28_2017: '',
        //     variable29_2017: '',
        //     variable30_2017: '',
        //     variable31_2017: '',
        //     variable32_2017: '',
        //     variable33_2017: '',
        //     variable34_2017: '',
        //     variable35_2017: '',
        //     checked1_2017: '',
        //     checked2_2017: '',
        //     checked3_2017: '',
        //     checked4_2017: '',
        //     checked5_2017: '',
        //     checked6_2017: '',
        //     checked7_2017: '',
        //     checked8_2017: '',
        //     checked9_2017: '',
        //     checked10_2017: '',
        //     checked11_2017: '',
        //     checked12_2017: '',
        //     checked13_2017: '',
        //     checked14_2017: '',
        //     checked15_2017: '',
        //     checked16_2017: '',
        //     checked17_2017: '',
        //     checked18_2017: '',
        //     checked19_2017: '',
        //     checked20_2017: '',
        //     checked21_2017: '',
        //     checked22_2017: '',
        //     checked23_2017: '',
        //     checked24_2017: '',
        //     checked25_2017: '',
        //     checked26_2017: '',
        //     checked27_2017: '',
        //     checked28_2017: '',
        //     checked29_2017: '',
        //     checked30_2017: '',
        //     checked31_2017: '',
        //     checked32_2017: '',
        //     checked33_2017: '',
        //     checked34_2017: '',
        //     checked35_2017: '',
        // }),
        variables: []
    }),
    methods: {
        customReportDowload() {
            if (this.key != '') {
                if (this.reportControl.organigrama || this.reportControl.mapa) {
                    this.documentaryDowloadReport();
                }
                if (this.reportControl.cuanti2017 || this.reportControl.cuanti2018 || this.reportControl.cuanti2019 || this.reportControl.cuanti2020) {
                    this.cuantitativeReportDowload();
                }
                if (this.reportControl.regulatorio || this.reportControl.institucional || this.reportControl.individual) {

                    this.cualitativeReportDowload();
                }
            } else {
                swal(
                    'Selecciona un estado',
                    '',
                    'error'
                )
            }


        },
        async cuantitativeReportDowload() {
            const stateBykey = await axios.get(`/api/state_by_key/${this.key}`);
            const variables = await axios.get('/api/variable/' + this.key);
            this.form =JSON.parse(stateBykey.data.quantitative_source.data);
            // this.form.fill(JSON.parse(stateBykey.data.quantitative_source.data));
            this.variables = variables.data;
            setTimeout(() => this.exportPdfCuantitative(), 2000);

        },
        async cualitativeReportDowload() {
            this.createdTable = true;
            const criterio = await axios.get("/api/criterion");
            const stateBykey = await axios.get(`/api/state_by_key/${this.key}`);
            this.state_selected = stateBykey.data;
            this.criteria =criterio.data;
            setTimeout(() => this.exportPdf(), 2000);
        },

        exportPdfCuantitative() {

            var doc = new jsPDF();
            doc.setFontSize(22);
            doc.setFontStyle("bold");
            doc.setTextColor(33, 37, 41);
            // doc.text(`Reporte Ejecutivo de ${this.state_selected.name}`, 105, 20, null, null, 'center');

            doc.setFontStyle("bold");
            doc.setFontSize(12);
            doc.setTextColor(145, 145, 145);
            doc.text('Reporte Cuantitativo', 105, 35, null, null, 'center');

            doc.autoTable({
                startY: 40,
                html: '#cuantitative-report',
                showHead: 'firstPage',
                rowPageBreak: 'avoid',
                cellWidth: 'linebreak',
                minCellHeight: 7,
                columnWidth: 'wrap',
                headStyles: {fillColor: [19, 56, 93], fontSize: 9, valign: 'middle', halign: 'center'},
                styles: {cellPadding: 3, overflowColumns: 'linebreak', fontSize: 8},
                columnStyles: {
                    0: {columnWidth: 15},
                    1: {columnWidth: 60},
                },
                tableLineColor: [219, 219, 219],
                tableLineWidth: 0.15
            })
            doc.save(`Cuantitative_Report_${this.state_selected.name}.pdf`);
        },
        exportPdf() {
            if (this.reportControl.regulatorio && this.reportControl.institucional && this.reportControl.individual) {
                var doc = new jsPDF();
                doc.setFontSize(22);
                doc.setFontStyle("bold");
                doc.setTextColor(33, 37, 41);
                // doc.text(`Reporte Ejecutivo de ${this.state_selected.name}`, 105, 20, null, null, 'center');

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145, 145, 145);
                doc.text('Ámbito Regulatorio', 105, 35, null, null, 'center');

                doc.autoTable({
                    startY: 40,
                    html: '#criteria-regulatory',
                    showHead: 'firstPage',
                    rowPageBreak: 'avoid',
                    cellWidth: 'linebreak',
                    minCellHeight: 7,
                    columnWidth: 'wrap',
                    headStyles: {fillColor: [19, 56, 93], fontSize: 9, valign: 'middle', halign: 'center'},
                    styles: {cellPadding: 3, overflowColumns: 'linebreak', fontSize: 8},
                    columnStyles: {
                        0: {columnWidth: 40},
                        1: {columnWidth: 135},
                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15
                });

                doc.addPage();

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145, 145, 145);
                doc.text("Ámbito Intitucional", 85, 20, null, null);

                doc.autoTable({
                    startY: 30,
                    html: '#criteria-institutional',
                    showHead: 'firstPage',
                    pageBreak: 'avoid',
                    rowPageBreak: 'avoid',
                    cellWidth: 'linebreak',
                    minCellHeight: 7,
                    columnWidth: 'wrap',
                    headStyles: {fillColor: [19, 56, 93], fontSize: 9, valign: 'middle', halign: 'center'},
                    styles: {cellPadding: 3, overflowColumns: 'linebreak', fontSize: 8},
                    columnStyles: {
                        0: {columnWidth: 40},
                        1: {columnWidth: 135},
                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15
                });

                doc.addPage();

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145, 145, 145);
                doc.text("Ámbito Individual", 85, 20);

                doc.autoTable({
                    startY: 30,
                    html: '#criteria-individual',
                    showHead: 'firstPage',
                    rowPageBreak: 'avoid',
                    cellWidth: 'linebreak',
                    minCellHeight: 7,
                    columnWidth: 'wrap',
                    headStyles: {fillColor: [19, 56, 93], fontSize: 9, valign: 'middle', halign: 'center'},
                    styles: {cellPadding: 3, overflowColumns: 'linebreak', fontSize: 8},
                    columnStyles: {
                        0: {columnWidth: 40},
                        1: {columnWidth: 135}
                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15
                });


                doc.save(`Cualitative_Report_${this.state_selected.name}.pdf`);
            }

            if (this.reportControl.regulatorio && this.reportControl.institucional && !this.reportControl.individual) {
                var doc = new jsPDF();
                doc.setFontSize(22);
                doc.setFontStyle("bold");
                doc.setTextColor(33, 37, 41);
                //doc.text(`Reporte Ejecutivo de ${this.state_selected.name}`, 105, 20, null, null, 'center');

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145, 145, 145);
                doc.text('Ámbito Regulatorio', 105, 35, null, null, 'center');

                doc.autoTable({
                    startY: 40,
                    html: '#criteria-regulatory',
                    showHead: 'firstPage',
                    rowPageBreak: 'avoid',
                    cellWidth: 'linebreak',
                    minCellHeight: 7,
                    columnWidth: 'wrap',
                    headStyles: {fillColor: [19, 56, 93], fontSize: 9, valign: 'middle', halign: 'center'},
                    styles: {cellPadding: 3, overflowColumns: 'linebreak', fontSize: 8},
                    columnStyles: {
                        0: {columnWidth: 40},
                        1: {columnWidth: 135},
                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15
                });

                doc.addPage();

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145, 145, 145);
                doc.text("Ámbito Intitucional", 85, 20, null, null);

                doc.autoTable({
                    startY: 30,
                    html: '#criteria-institutional',
                    showHead: 'firstPage',
                    pageBreak: 'avoid',
                    rowPageBreak: 'avoid',
                    cellWidth: 'linebreak',
                    minCellHeight: 7,
                    columnWidth: 'wrap',
                    headStyles: {fillColor: [19, 56, 93], fontSize: 9, valign: 'middle', halign: 'center'},
                    styles: {cellPadding: 3, overflowColumns: 'linebreak', fontSize: 8},
                    columnStyles: {
                        0: {columnWidth: 40},
                        1: {columnWidth: 135},
                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15
                });
                doc.save(`Cualitative_Report_${this.state_selected.name}.pdf`);
            }
            if (this.reportControl.regulatorio && !this.reportControl.institucional && !this.reportControl.individual) {
                var doc = new jsPDF();
                doc.setFontSize(22);
                doc.setFontStyle("bold");
                doc.setTextColor(33, 37, 41);
                doc.text(`Reporte Ejecutivo de ${this.state_selected.name}`, 105, 20, null, null, 'center');

                doc.setFontStyle("bold");
                doc.setFontSize(12);
                doc.setTextColor(145, 145, 145);
                doc.text('Ámbito Regulatorio', 105, 35, null, null, 'center');

                doc.autoTable({
                    startY: 40,
                    html: '#criteria-regulatory',
                    showHead: 'firstPage',
                    rowPageBreak: 'avoid',
                    cellWidth: 'linebreak',
                    minCellHeight: 7,
                    columnWidth: 'wrap',
                    headStyles: {fillColor: [19, 56, 93], fontSize: 9, valign: 'middle', halign: 'center'},
                    styles: {cellPadding: 3, overflowColumns: 'linebreak', fontSize: 8},
                    columnStyles: {
                        0: {columnWidth: 40},
                        1: {columnWidth: 135},
                    },
                    tableLineColor: [219, 219, 219],
                    tableLineWidth: 0.15
                });
                doc.save(`Cualitative_Report_${this.state_selected.name}.pdf`);
            }


        },
        async documentaryDowloadReport() {
            this.loading = true;
            const key = this.key;
            const stateByKey = await axios.get(`/api/state_by_key/` + key);
            let dat = stateByKey.data
            if (this.reportControl.organigrama) {
                const organization = dat.documents.filter(organization => organization.type == 'organization');
                const mapOrganziation = organization[0].path;
                const orgaUrlCut = mapOrganziation.split('.');
                const orgaExtention = orgaUrlCut[1];
                try {
                    const organziationdowload = await axios.post(`/api/dowload-organziation/`, {data: mapOrganziation}, {responseType: 'blob'});
                    this.dowloadImages(organziationdowload, 'organigrama', key, orgaExtention)
                } catch (error) {
                    console.error('imagen not found')
                }
                this.loading = false;
            }
            if (this.reportControl.mapa) {
                const map = this.map = dat.documents.filter(map => map.type == 'map')
                const mapUrl = map[0].path;
                const mapulrcut = mapUrl.split('.');
                const mapExtention = mapulrcut[1];
                try {
                    const mapdowload = await axios.post(`/api/dowload-map/`, {data: mapUrl}, {responseType: 'blob'});
                    this.dowloadImages(mapdowload, 'map', key, mapExtention);
                } catch (error) {
                    consoe.error('Imagen not found')
                }
                this.loading = false;
            }
        },
        dowloadImages(data, name, state, ext) {
            const url = window.URL.createObjectURL(new Blob([data.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', name + state + '.' + ext);
            document.body.appendChild(link);
            link.click();
        },
        cualitativeReportChanged(report) {
            console.log('entro')
            console.log(report);
            switch (report) {
                case 'regulatorio':
                    if (!this.reportControl.regulatorio) this.reportControl.regulatorio = true;
                    else this.reportControl.regulatorio = false;
                    break;
                case 'institucional':
                    if (!this.reportControl.institucional) this.reportControl.institucional = true;
                    else this.reportControl.institucional = false;
                    break;
                case 'individual':
                    if (!this.reportControl.individual) this.reportControl.individual = true;
                    else this.reportControl.individual = false;
                    break;
                case 'all':
                    if (!this.reportControlAll.cualitativa) {
                        this.reportControlAll.cualitativa = true;
                        this.reportControl.regulatorio = true;
                        this.reportControl.institucional = true;
                        this.reportControl.individual = true;
                    } else {
                        this.reportControlAll.cualitativa = false;
                        this.reportControl.regulatorio = false;
                        this.reportControl.institucional = false;
                        this.reportControl.individual = false;
                    }
                    break;

                default:
                    break;
            }

        },
        cuantitativeDesision(repoort) {
            switch (repoort) {
                case '2017':
                    if (!this.reportControl.cuanti2017) this.reportControl.cuanti2017 = true;
                    else this.reportControl.cuanti2017 = false;
                    break;
                case '2018':
                    if (!this.reportControl.cuanti2018) this.reportControl.cuanti2018 = true;
                    else this.reportControl.cuanti2018 = false;
                    break;
                    case '2019':
                        if (!this.reportControl.cuanti2019) this.reportControl.cuanti2019 = true;
                        else this.reportControl.cuanti2019 = false;
                        break;
                        case '2020':
                            if (!this.reportControl.cuanti2020) this.reportControl.cuanti2020 = true;
                            else this.reportControl.cuanti2020 = false;
                            break;
                case 'all':
                    if (!this.reportControlAll.cuantitativa) {
                        this.reportControlAll.cuantitativa = true;
                        this.reportControl.cuanti2017 = true;
                        this.reportControl.cuanti2018 = true;
                        this.reportControl.cuanti2019 = true;
                        this.reportControl.cuanti2020 = true;

                    } else {
                        this.reportControlAll.cuantitativa = false;
                        this.reportControl.cuanti2017 = false;
                        this.reportControl.cuanti2018 = false;
                        this.reportControl.cuanti2019 = false;
                        this.reportControl.cuanti2020 = false;
                    }
                    break;
                default:
                    break;
            }
        },
        changeDocumentary() {
            if (!this.reportControlAll.documental) {
                this.reportControlAll.documental = true;

                this.reportControl.organigrama = true;
                this.reportControl.mapa = true;
                this.reportControl.sedes = true;
            } else {
                this.reportControlAll.documental = false;

                this.reportControl.organigrama = false;
                this.reportControl.mapa = false;
                this.reportControl.sedes = false;
            }


        },
        organigramaChanged() {
            if (!this.reportControl.organigrama) this.reportControl.organigrama = true;
            else this.reportControl.organigrama = false;
        },
        mapaChanged() {
            if (!this.reportControl.mapa) this.reportControl.mapa = true;
            else this.reportControl.mapa = false;
        },
        sedeschanged() {
            if (!this.reportControl.sedes) this.reportControl.sedes = true;
            else this.reportControl.sedes = false;

        },
        dowloadReport(doc) {
            if (this.key != '') {
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
                });
            } else {
                swal(
                    'Selecciona un estado',
                    '',
                    'error'
                )
            }


        },
        async loadDocuments(id) {
            await axios.get(`/api/final-reports/${id}`)
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
            this.loading = false;
        },
        progress(event, progress, stepValue) {
            console.log(stepValue);
        },
        progress_end(event) {
            console.log("Circle progress end");
        },
        updateProgress(value) {
            console.log(value)
        },
        async dataByState(key, name, id, round) {
            this.loadDocuments(id);
            this.key = key;
            this.stateSelected = true;
            this.controlList = false;
            this.stateSelectedName = name;
            this.stateRound = round;
            const progress = await this.averageDocumentary(key);
            const progressCuantitative = await this.averageCuantitative(key);
            const progressCualitative = await this.averageCualitative(key);


            if (progress == 100) this.documentaryPercentaje.color = '#8cc63f';
            else this.documentaryPercentaje.color = '#f7b500';

            if (progressCuantitative == 100) this.cuantitativePercentaje.color = '#8cc63f';
            else this.cuantitativePercentaje.color = '#f7b500';

            if (progressCualitative == 100) this.cualitativePercentaje.color = '#8cc63f';
            else this.cualitativePercentaje.color = '#f7b500';

            this.cuantitativePercentaje.prorgess = progressCuantitative.toString() + '%';
            this.documentaryPercentaje.progress = progress.toString() + '%';
            this.cualitativePercentaje.progress = progressCualitative.toString() + '%';
            const totalPercentaje = parseInt(progressCuantitative) + parseInt(progress) + parseInt(progressCualitative);
            const global = totalPercentaje / 3;

            this.gobalProgress = global;
            this.$refs.myUniqueID.updateProgress(global);
            if (global > 50) {

                this.$refs.myUniqueID.updateFill("#8cc63f");
            } else {
                this.$refs.myUniqueID.updateFill("#f7b500");

            }


        },

        percentageToDegrees(percentage) {

            return percentage / 100 * 360;

        },
        async averageCualitative(key) {
          const stateByKey = await axios.get(`/api/get-cpoc/${key}`)

            // const decision = await axios.get("/api/decision");
            // const stateByKey = await axios.get(`/api/state_by_key/${key}`)
            // const subseccion = await axios.get(`/api/subsections-by-decisionambit/all`);
            // const observationConclucion = stateByKey.data.conclusion;
            // let observationProblem = stateByKey.data.problematic;
            // const observationsCriterio = stateByKey.data.observations;
            // const criterion_problematic = stateByKey.data.criterion_problematic;
            // const numModule = 13;

            //ambito regulatorio percentaje
            // const totalCriterioRegulatorio = subseccion.data.filter(subsections => subsections.ambit.name == 'regulatorio');
            // const totalCriterioIndividual = subseccion.data.filter(subsections => subsections.ambit.name == 'individual');
            // const totalCriterioinstitucional = subseccion.data.filter(subsections => subsections.ambit.name == 'totalCriterio');
            //
            // const criteriotoal = totalCriterioRegulatorio.length + totalCriterioIndividual.length + totalCriterioinstitucional.length;
            // const percentajeDecicion = (observationsCriterio.length * 100) / criteriotoal;
            //
            // //Observaciones por ambito (REGULATORIO, INSTITUCIONAL, INDIVIDUAL)
            //
            // const paternProblem = 'problematic';
            // const paternConclucion = 'conclusion';
            // let conclucionComplete = 0;
            // let problematicComplete = 0;
            // let problematicAll = 0;
            // let conclucionAll = 0;
            // Object.keys(observationProblem).forEach(element => {
            //     if (element.indexOf(paternProblem) === 0) {
            //         problematicAll++;
            //         if (observationProblem[element] != null) {
            //             problematicComplete++;
            //         }
            //     }
            // });
            // Object.keys(observationConclucion).forEach(element => {
            //     if (element.indexOf(paternConclucion) === 0) {
            //         conclucionAll++;
            //         if (observationConclucion[element] != null) {
            //             conclucionComplete++;
            //         }
            //     }
            // });
            // const totalObservation = conclucionAll + problematicAll
            // const totalComplete = problematicComplete + conclucionComplete
            // const percentajeObservation = (totalComplete * 100) / totalObservation;
            //
            //
            // //Posibles problematicas
            // let possibleProblemsTotal = 0;
            // let completePosibleProblems = 0;
            // Object.values(criterion_problematic).forEach(function (element, index) {
            //     possibleProblemsTotal++;
            //     if (element != null) completePosibleProblems++;
            // });
            // let percentajePosibleProblems = (completePosibleProblems * 100) / possibleProblemsTotal;
            //
            // let totalPercentaje = ((percentajeDecicion + percentajeObservation + percentajePosibleProblems) / 3).toFixed(0);
            // if (totalPercentaje >= 92) totalPercentaje = 100
            // if (totalPercentaje > 100) totalPercentaje = 100

            let total = stateByKey.data.length * 100;
            let registrado = 0;
            (stateByKey.data).forEach((item, i) => {
              registrado += item.percentage;
            });
            let totalPercentaje = (registrado * 100) / total;

            return totalPercentaje

        },
        async averageDocumentary(key) {
            // const stateByKey = await axios.get(`/api/state_by_key/${key}`)
            const stateByKey = await axios.get(`/api/get-document-status/${key}`)

            // this.state_selected = stateByKey.data;
            // this.organization_chart = stateByKey.data.documents.filter(organization => organization.type == 'organization');
            // this.map = stateByKey.data.documents.filter(map => map.type == 'map');
            //
            // const allHeadquarters = await axios.get('/api/all_headquarters?state=' + key);
            // this.headquarters = allHeadquarters.data;
            //
            // if (this.headquarters.length > 0) this.documentaryPercentaje.headquarters = 100;
            // else this.documentaryPercentaje.headquarters = 0;
            // if (this.organization_chart.length > 0) this.documentaryPercentaje.organization_chart = 100;
            // else this.documentaryPercentaje.organization_chart = 0
            // if (this.map.length > 0) this.documentaryPercentaje.map = 100;
            // else this.documentaryPercentaje.map = 0
            var headquarters = 0;
            var organization_chart = 0;
            var map = 0;
            (stateByKey.data).forEach((item, i) => {
              if (item.type === 'head') {
                headquarters = item.percentage;
              }
              if (item.type === 'org') {
                organization_chart = item.percentage;
              }
              if (item.type === 'map') {
                map = item.percentage;
              }
            });




            return ((headquarters + organization_chart + map)/ 3).toFixed(0);
        },
        async averageCuantitative(key) {
            // const indicators = await axios.get(`/api/state_by_key/${key}`);
            const indicators = await axios.get(`/api/get_state_quantitative_source/${key}`);
            //
            // const cuantitative = indicators.data.quantitative_source;
            // const varIndicator = await axios.get(`/api/variable`);
            // const cantVar = varIndicator.data.length;
            //
            // let missingData = 0;
            // for (let index = 1; index < cantVar + 1; index++) {
            //     const checked2017 = cuantitative['checked' + index + '_2017'];
            //     const checked2018 = cuantitative['checked' + index + '_2018'];
            //     const variable2017 = cuantitative['variable' + index + '_2017'];
            //     const variable2018 = cuantitative['variable' + index + '_2018'];
            //
            //     if (checked2017 == 0 && (variable2017 == null || variable2017 == undefined)) {
            //         missingData++;
            //     }
            //     if (checked2018 == 0 && (variable2018 == null || variable2018 == undefined)) {
            //         missingData++;
            //     }
            // }
            //
            // const total = cantVar * 2
            // const complete = total - missingData
            // const progress = ((complete * 100) / total).toFixed(0);
            const progress = indicators.data.percentage;

            return progress;
        },
        cuantitativeReportShow(status) {
            this.cuantitativeReport = status;
        },
        cualitativeReortShow(status) {
            this.cualitativeReport = status;
        },
        documentaryReportShow(status) {
            this.documentaryReport = status;
        },
        showList() {
            if (!this.controlList) this.controlList = true
            else this.controlList = false
        },
        loadData() {
            this.loading = true;
            axios.get("api/state-all").then(
                ({data}) => (
                    this.loading = false,
                        this.states = data
                )
            ).catch(() => {
                toast({
                    type: 'error',
                    title: 'Error al cargar datos'
                })
                this.loading = false;
            });
        },
    },

    created() {
        const languaje = localStorage.getItem("languaje");
        this.$i18n.locale = languaje;
        this.loadData();
        console.log('Se creo reportes personalizados')
    }
}
</script>
<style scoped>
.list-group {
    max-height: 600px;
    overflow: scroll;
    margin-top: -50px;

    -webkit-overflow-scrolling: touch;
}

.div-list {

    position: relative;
    z-index: 3;
}

.img-align {
    margin-right: 5px
}

.progressCircle {
    width: 330px;
    height: 330px;
    background: none;
    position: relative;
}

.progressCircle::after {
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 20px solid #eee;
    position: absolute;
    top: 0;
    left: 0;
}

.progressCircle > span {
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1;
}

.progressCircle .progressCircle-left {
    left: 0;
}

.progressCircle .progressCircle-bar {
    width: 100%;
    height: 100%;
    background: none;
    border-width: 6px;
    border-style: solid;
    position: absolute;
    top: 0;
}

.progressCircle .progressCircle-left .progressCircle-bar {
    left: 100%;
    border-top-right-radius: 80px;
    border-bottom-right-radius: 80px;
    border-left: 0;
    -webkit-transform-origin: center left;
    transform-origin: center left;
}

.progressCircle .progressCircle-right {
    right: 0;
}

.progressCircle .progressCircle-right .progressCircle-bar {
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
}

.progressCircle .progressCircle-value {
    position: absolute;
    top: -10px;
    left: 0;
}

.grid {
  display: grid;
  grid-template-columns: 40% 60%;
}

.grid-child-one {
  padding-right: 1rem;
}
@media (max-width: 1024px) {
  .grid {
    display: grid;
    grid-template-columns: 1fr;
  }
}

</style>
