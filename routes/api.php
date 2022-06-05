<?php

use Illuminate\Http\Request;

/*php
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources(['user' => 'API\UserController']);
Route::get('profile', 'API\UserController@profile');
Route::get('findUser', 'API\UserController@search');
Route::put('profile', 'API\UserController@updateProfile');
Route::get('export-user', 'API\UserController@export');
Route::get('import-user', 'API\UserController@import');
Route::get('add_states/{id}', 'API\UserController@addStates');
Route::post('active-desactive','API\UserController@userActiveDesactive');

Route::apiResources(['state' => 'API\StateController']);
Route::get('state-two','API\StateController@statetwo');
Route::get('state-all','API\StateController@stateall');
Route::get('state_by_key/{state}', 'API\StateController@statebykey');
Route::get('state_by_key_single/{state}', 'API\StateController@statebykeysingle');
Route::get('get-document-status/{id}','API\StateController@getdocumentstate');
Route::get('get_state_quantitative_source/{id}','API\StateController@getquantitativesource');
Route::get('get-cpoc/{id}','API\StateController@getcpoc');
Route::post('send_end_state','API\StateController@sendendstate');

//New routes
Route::get('state_documentary_information/{state}', 'API\StateController@statedocumentaryinformation');
Route::get('state_quantitative_source/{state}', 'API\StateController@statequantitativesource');
Route::get('indicators_by_decision/{state}', 'API\StateController@indicatorsbydecision');
Route::get('state_data/{state}', 'API\StateController@statedata');
Route::get('observations_source_criterion/{state}', 'API\StateController@observationssourcecriterion');
Route::get('observations_by_ambit/{state}', 'API\StateController@observationsbyambit');
Route::get('problematic_by_criterion/{state}', 'API\StateController@problematicbycriterion');

Route::apiResources(['sociodemographic_context' => 'API\SociodemographicContextController']);

Route::apiResources(['quantitative_source' => 'API\QuantitativeSourceController']);

Route::apiResources(['interpretation' => 'API\InterpretationController']);

Route::apiResources(['decision' => 'API\DecisionController']);

Route::apiResources(['criterion' => 'API\CriterionController']);

Route::apiResources(['ambit' => 'API\AmbitController']);
Route::get('ambit_by_slug/{slug}', 'API\AmbitController@ambitbyslug');

Route::apiResources(['problematic' => 'API\ProblematicController']);

Route::apiResources(['criterion_problematic' => 'API\CriterionproblematicController']);

Route::apiResources(['conclusion' => 'API\ConclusionController']);

Route::apiResources(['variable' => 'API\VariableController']);

Route::apiResources(['interpretation-guide' => 'API\InterpretationGuideController']);

Route::apiResources(['indicator' => 'API\IndicatorController']);
Route::get('indicators-by-decision/{decision}', 'API\IndicatorController@indicatorsbydecision');
Route::get('indicator-by-round/{id}', 'API\IndicatorController@indicatorbyround');

Route::apiResources(['subsection' => 'API\SubsectionController']);
Route::get('subsections-by-decisionambit/{decision}/{ambit}/{key}', 'API\SubsectionController@subsectionsbydecisionambit');
Route::get('subsections-by-decisionambit/all', 'API\SubsectionController@subsectionByDecisionambitAll');
Route::get('subsection_by_ambit/{ambit}', 'API\SubsectionController@subsectionbyambit');

Route::apiResources(['criterion-conclusion' => 'API\CriterionConclusionsController']);
Route::post('save-conclusion-problematic','API\CriterionConclusionsController@saveCP');
Route::post('save-problematic-conclusion','API\CriterionConclusionsController@savePC');
Route::post('save-conclusion-problematic-ambits','API\CriterionConclusionsController@saveCPA');
Route::post('update-conclusion-problematic-ambits','API\CriterionConclusionsController@updateCPA');
Route::get('delete-conclusion-problematic-ambits/{id}','API\CriterionConclusionsController@deleteCPA');

Route::apiResources(['observation' => 'API\ObservationController']);
Route::post('import-observation', 'API\ObservationController@import');
Route::get('observation-by-variables/{state}/{headquarter}/{decision}/{ambit}/{criterion}/{source}', 'API\ObservationController@observationbyvariables');
Route::get('observations-by-decisionambit/{decision}/{ambit}', 'API\ObservationController@observationsbydecisionambit');

Route::apiResources(['document' => 'API\DocumentController']);

Route::post('d-information/{state}/o-chart', 'API\DInformationController@organizationChart');
Route::post('d-information/{state}/map', 'API\DInformationController@map');
//N/A Routes for map and orgchart
Route::get('map_na/{state}', 'API\DInformationController@mapna');
Route::get('orgchart_na/{state}', 'API\DInformationController@orgchartna');
Route::get('map_na_delete/{state}', 'API\DInformationController@mapnadelete');
Route::get('org_na_delete/{state}', 'API\DInformationController@orgchartnadelete');

Route::apiResources(['headquarters' => 'API\HeadquarterController']);
Route::get('headquarters-state/{id}','API\HeadquarterController@getbystate');
Route::get('headquarters-delete/{id}','API\HeadquarterController@deleteheadquarters');

Route::apiResources(['all_headquarters' => 'API\AllHeadquartersController']);

Route::apiResources(['repository' => 'API\RepositoryController']);
Route::get('delete-repository/{id}','API\RepositoryController@deletedDocumentaryRepository');
Route::get('download-repository-document/{id}', 'API\RepositoryController@dowloadRepository');
Route::get('all-repository','API\RepositoryController@getDocumentaryRepositoryData');
Route::post('upload-repository-document-all','API\RepositoryController@importDocumentRepositoryAll');
Route::post('upload-repository-document','API\RepositoryController@importDocumentRepository');
Route::get('download-repository-file/{id}', 'API\RepositoryController@downloadFile');
Route::get('download-repository-zip/{state}', 'API\RepositoryController@downloadZip');

Route::post('qualitative-sources/{state}/store', 'API\QualitativeSourceController@storeFile');
Route::post('qualitative-sources/{id}/delete', 'API\QualitativeSourceController@delete');


Route::apiResources(['/final-reports' => 'API\FinalReportsController']);
Route::get('dowload-final-report/{id}','API\FinalReportsController@downloadFile');
Route::get('delete-final-report-temp/{id}','API\FinalReportsController@deletetemporal');
Route::post('/update-report/{id}','API\FinalReportsController@updateReport');
Route::post('/dowload-map','API\FinalReportsController@dowloadMap');
Route::post('/dowload-organziation','API\FinalReportsController@dowloadOrganization');

Route::get('fixed-observations/{id}','API\FixedController@fixed');
Route::get('fixed-observations-contar/{id}','API\FixedController@contar');
Route::get('fixed-observations-revisar/{id}','API\FixedController@revisar');
Route::get('fixed-observations-eliminar/{id}','API\FixedController@eliminar');
Route::get('fixed-indicators/{id}','API\FixedController@fixedIndicators');
Route::get('fixed-indicators-round-two/{id}','API\FixedController@fixedIndicatorsRoundTwo');
Route::get('fixed-criterion-conclusions-round-two','API\FixedController@CriterionConclusionsRoundTwo');
Route::get('fixed-loaded-data-one','API\FixedController@saveLoadedDataOne');
Route::get('fixed-loaded-data-two','API\FixedController@saveLoadedDataTwo');
Route::get('fixed-loaded-data-three','API\FixedController@saveLoadedDataThree');
Route::get('fixed-criterion-conclusion','API\FixedController@fixedcriterionconcusion');
Route::get('fixed-json-convert-cc','API\FixedController@convertJsonCriterionConclusion');

Route::get('/sessionStatus', function() {
    return ['user' => Auth::user() ? Auth::user()->load('profile') : null];
});
