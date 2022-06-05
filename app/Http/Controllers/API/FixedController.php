<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Observation;
use App\Subsection;
use App\AllHeadquarters;
use App\Headquarter;
use App\Interpretation;
use App\CriterionConclusions;
use App\DataLoaded;
use App\State;
use App\Conclusion;
use App\ConclusionProblematicAmbit;
use Illuminate\Support\Facades\DB;

class FixedController extends Controller
{
  //
  public function contar($id)
  {
    // code...
    $state_observation = Observation::where('state_id',$id)->get();
    return response()->json(count($state_observation));
  }

  public function revisar($id)
  {
    $state_observation = Observation::where('state_id',$id)->get();
    $arr = [];
    foreach ($state_observation as $key => $value) {
      $state_observation = Observation::where('state_id',$id)
      ->where('decision_id',$value->decision_id)
      ->where('ambit_id',$value->ambit_id)
      ->where('criterion_id',$value->criterion_id)
      ->where('source_id',$value->source_id)
      ->get();
      if (count($state_observation) > 1) {
        $arr [] = $state_observation;
      }
    }

    return response()->json(($arr));
  }

  public function eliminar($id)
  {
    $state_observation = Observation::where('state_id',$id)->get();
    foreach ($state_observation as $key => $value) {
      $state_observation = Observation::where('state_id',$id)
      ->where('decision_id',$value->decision_id)
      ->where('ambit_id',$value->ambit_id)
      ->where('criterion_id',$value->criterion_id)
      ->where('source_id',$value->source_id)
      ->get();
      if (count($state_observation) > 1) {
        $state_observation_delete = Observation::where('id',$state_observation[0]['id'])->delete();
      }
    }
    return response()->json(['status' => true]);
  }

  public function fixed($id)
  {
    try {

      DB::beginTransaction();
      $state_observation = Observation::where('state_id',$id)->get();
      $headquarter = Headquarter::where('state_id',$id)->first();
      $headquarter_id = 0;

      if (isset($headquarter) == false) {

        $all_headquarters = AllHeadquarters::where('state_id',$id)->first();
        if (isset($all_headquarters) == false) {
          $all_headquarters_new = new AllHeadquarters();
          $all_headquarters_new->state_id = $id;
          $all_headquarters_new->name = 'Pendiente';
          $all_headquarters_new->city_halls = 'Pendiente';
          $all_headquarters_new->agents = 0;
          $all_headquarters_new->save();

          $headquarter_new = new Headquarter();
          $headquarter_new->state_id = $id;
          $headquarter_new->name = 'Pendiente';
          $headquarter_new->city_halls = 'Pendiente';
          $headquarter_new->agents = 0;
          $headquarter_new->save();

          $headquarter_id = $headquarter_new->id;

        }else {
          $headquarter_new = new Headquarter();
          $headquarter_new->state_id = $id;
          $headquarter_new->name = $all_headquarters->name;
          $headquarter_new->city_halls = $all_headquarters->city_halls;
          $headquarter_new->agents = $all_headquarters->agents;
          $headquarter_new->save();

          $headquarter_id = $headquarter_new->id;
        }
      }else {
        $headquarter_id = $headquarter->id;
      }

      $subsections = Subsection::get();
      $arreglo = [];
      foreach ($subsections as $key => $value) {
        $state_observation_f = Observation::where('state_id',$id)
        ->where('decision_id',$value->decision_id)
        ->where('ambit_id',$value->ambit_id)
        ->where('criterion_id',$value->criterion_id)
        ->where('source_id',$value->source_id)
        ->get();

        if (count($state_observation_f) != 0) {
          $arreglo [] = $state_observation_f;
        }else {
          //se debe agregar el registro
          $arreglo [] = ['vacio', $value];
          $state_observation_new = new Observation();
          $state_observation_new->state_id = $id;
          $state_observation_new->headquarter_id = $headquarter_id;
          $state_observation_new->decision_id = $value->decision_id;
          $state_observation_new->ambit_id = $value->ambit_id;
          $state_observation_new->criterion_id = $value->criterion_id;
          $state_observation_new->source_id = $value->source_id;
          // $state_observation_new->observation = '';
          $state_observation_new->save();
        }

      }
      DB::commit();
      return response()->json($arreglo);
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
    }
  }

  public function fixedIndicators($id)
  {
    try {
      DB::beginTransaction();
      $intepretation = Interpretation::
      select('id',
          'state_id',
          'interpretation1',
          'interpretation2',
          'interpretation3',
          'interpretation4',
          'interpretation5',
          'interpretation6',
          'interpretation7',
          'interpretation8',
          'interpretation9',
          'interpretation10',
          'interpretation11',
          'interpretation12',
          'interpretation13',
          'interpretation14',
          'interpretation15',
          'interpretation16',
          'interpretation17',
          'interpretation18',
          'interpretation19',
          'interpretation20',
          'interpretation21',
          'interpretation22',
          'interpretation23',
          'interpretation24',
          'interpretation25',
          'interpretation26',
          'interpretation27',
          'interpretation28',
          'interpretation29',
          'interpretation30',
          'interpretation31',
          'interpretation32',
          'interpretation33',
          'interpretation34',
          'interpretation35',
          'interpretation36',
          'created_at',
          'updated_at'
          )
      ->where('state_id',$id)->first();

      $data = [
        'id' => $intepretation->id,
        'state_id' => $intepretation->state_id,
        'interpretation1_2018' => $intepretation->interpretation1,
        'interpretation2_2018' => $intepretation->interpretation2,
        'interpretation3_2018' => $intepretation->interpretation3,
        'interpretation4_2018' => $intepretation->interpretation4,
        'interpretation5_2018' => $intepretation->interpretation5,
        'interpretation6_2018' => $intepretation->interpretation6,
        'interpretation7_2018' => $intepretation->interpretation7,
        'interpretation8_2018' => $intepretation->interpretation8,
        'interpretation9_2018' => $intepretation->interpretation9,
        'interpretation10_2018' => $intepretation->interpretation10,
        'interpretation11_2018' => $intepretation->interpretation11,
        'interpretation12_2018' => $intepretation->interpretation12,
        'interpretation13_2018' => $intepretation->interpretation13,
        'interpretation14_2018' => $intepretation->interpretation14,
        'interpretation15_2018' => $intepretation->interpretation15,
        'interpretation16_2018' => $intepretation->interpretation16,
        'interpretation17_2018' => $intepretation->interpretation17,
        'interpretation18_2018' => $intepretation->interpretation18,
        'interpretation19_2018' => $intepretation->interpretation19,
        'interpretation20_2018' => $intepretation->interpretation20,
        'interpretation21_2018' => $intepretation->interpretation21,
        'interpretation22_2018' => $intepretation->interpretation22,
        'interpretation23_2018' => $intepretation->interpretation23,
        'interpretation24_2018' => $intepretation->interpretation24,
        'interpretation25_2018' => $intepretation->interpretation25,
        'interpretation26_2018' => $intepretation->interpretation26,
        'interpretation27_2018' => $intepretation->interpretation27,
        'interpretation28_2018' => $intepretation->interpretation28,
        'interpretation29_2018' => $intepretation->interpretation29,
        'interpretation30_2018' => $intepretation->interpretation30,
        'interpretation31_2018' => $intepretation->interpretation31,
        'interpretation32_2018' => $intepretation->interpretation32,
        'interpretation33_2018' => $intepretation->interpretation33,
        'interpretation34_2018' => $intepretation->interpretation34,
        'interpretation35_2018' => $intepretation->interpretation35,
        'interpretation36_2018' => $intepretation->interpretation36,

        'interpretation1_2017' => '',
        'interpretation2_2017' => '',
        'interpretation3_2017' => '',
        'interpretation4_2017' => '',
        'interpretation5_2017' => '',
        'interpretation6_2017' => '',
        'interpretation7_2017' => '',
        'interpretation8_2017' => '',
        'interpretation9_2017' => '',
        'interpretation10_2017' => '',
        'interpretation11_2017' => '',
        'interpretation12_2017' => '',
        'interpretation13_2017' => '',
        'interpretation14_2017' => '',
        'interpretation15_2017' => '',
        'interpretation16_2017' => '',
        'interpretation17_2017' => '',
        'interpretation18_2017' => '',
        'interpretation19_2017' => '',
        'interpretation20_2017' => '',
        'interpretation21_2017' => '',
        'interpretation22_2017' => '',
        'interpretation23_2017' => '',
        'interpretation24_2017' => '',
        'interpretation25_2017' => '',
        'interpretation26_2017' => '',
        'interpretation27_2017' => '',
        'interpretation28_2017' => '',
        'interpretation29_2017' => '',
        'interpretation30_2017' => '',
        'interpretation31_2017' => '',
        'interpretation32_2017' => '',
        'interpretation33_2017' => '',
        'interpretation34_2017' => '',
        'interpretation35_2017' => '',
        'interpretation36_2017' => '',

        'interpretation1_2019' => '',
        'interpretation2_2019' => '',
        'interpretation3_2019' => '',
        'interpretation4_2019' => '',
        'interpretation5_2019' => '',
        'interpretation6_2019' => '',
        'interpretation7_2019' => '',
        'interpretation8_2019' => '',
        'interpretation9_2019' => '',
        'interpretation10_2019' => '',
        'interpretation11_2019' => '',
        'interpretation12_2019' => '',
        'interpretation13_2019' => '',
        'interpretation14_2019' => '',
        'interpretation15_2019' => '',
        'interpretation16_2019' => '',
        'interpretation17_2019' => '',
        'interpretation18_2019' => '',
        'interpretation19_2019' => '',
        'interpretation20_2019' => '',
        'interpretation21_2019' => '',
        'interpretation22_2019' => '',
        'interpretation23_2019' => '',
        'interpretation24_2019' => '',
        'interpretation25_2019' => '',
        'interpretation26_2019' => '',
        'interpretation27_2019' => '',
        'interpretation28_2019' => '',
        'interpretation29_2019' => '',
        'interpretation30_2019' => '',
        'interpretation31_2019' => '',
        'interpretation32_2019' => '',
        'interpretation33_2019' => '',
        'interpretation34_2019' => '',
        'interpretation35_2019' => '',
        'interpretation36_2019' => '',

        'interpretation1_2020' => '',
        'interpretation2_2020' => '',
        'interpretation3_2020' => '',
        'interpretation4_2020' => '',
        'interpretation5_2020' => '',
        'interpretation6_2020' => '',
        'interpretation7_2020' => '',
        'interpretation8_2020' => '',
        'interpretation9_2020' => '',
        'interpretation10_2020' => '',
        'interpretation11_2020' => '',
        'interpretation12_2020' => '',
        'interpretation13_2020' => '',
        'interpretation14_2020' => '',
        'interpretation15_2020' => '',
        'interpretation16_2020' => '',
        'interpretation17_2020' => '',
        'interpretation18_2020' => '',
        'interpretation19_2020' => '',
        'interpretation20_2020' => '',
        'interpretation21_2020' => '',
        'interpretation22_2020' => '',
        'interpretation23_2020' => '',
        'interpretation24_2020' => '',
        'interpretation25_2020' => '',
        'interpretation26_2020' => '',
        'interpretation27_2020' => '',
        'interpretation28_2020' => '',
        'interpretation29_2020' => '',
        'interpretation30_2020' => '',
        'interpretation31_2020' => '',
        'interpretation32_2020' => '',
        'interpretation33_2020' => '',
        'interpretation34_2020' => '',
        'interpretation35_2020' => '',
        'interpretation36_2020' => '',

        'created_at' => $intepretation->created_at,
        'updated_at' => $intepretation->updated_at,
      ];

      $intepretation->data =json_encode($data);
      $intepretation->save();
      DB::commit();
      return response()->json(($intepretation));
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
    }

  }

  public function fixedIndicatorsRoundTwo($id)
  {
    try {
      DB::beginTransaction();

      $data = [
        'id' => $id,//$id
        'state_id' => $id,
        'interpretation37_2018' => '',
        'interpretation38_2018' => '',
        'interpretation39_2018' => '',
        'interpretation40_2018' => '',
        'interpretation41_2018' => '',
        'interpretation42_2018' => '',
        'interpretation43_2018' => '',
        'interpretation44_2018' => '',
        'interpretation45_2018' => '',
        'interpretation46_2018' => '',
        'interpretation47_2018' => '',
        'interpretation48_2018' => '',
        'interpretation49_2018' => '',
        'interpretation50_2018' => '',
        'interpretation51_2018' => '',
        'interpretation52_2018' => '',
        'interpretation53_2018' => '',
        'interpretation54_2018' => '',
        'interpretation55_2018' => '',
        'interpretation56_2018' => '',
        'interpretation57_2018' => '',
        'interpretation58_2018' => '',
        'interpretation59_2018' => '',
        'interpretation60_2018' => '',
        'interpretation61_2018' => '',
        'interpretation62_2018' => '',
        'interpretation63_2018' => '',
        'interpretation64_2018' => '',
        'interpretation65_2018' => '',
        'interpretation66_2018' => '',
        'interpretation67_2018' => '',
        'interpretation68_2018' => '',
        'interpretation69_2018' => '',
        'interpretation70_2018' => '',
        'interpretation71_2018' => '',
        'interpretation72_2018' => '',
        'interpretation73_2018' => '',
        'interpretation74_2018' => '',
        'interpretation75_2018' => '',

        'interpretation37_2017' => '',
        'interpretation38_2017' => '',
        'interpretation39_2017' => '',
        'interpretation40_2017' => '',
        'interpretation41_2017' => '',
        'interpretation42_2017' => '',
        'interpretation43_2017' => '',
        'interpretation44_2017' => '',
        'interpretation45_2017' => '',
        'interpretation46_2017' => '',
        'interpretation47_2017' => '',
        'interpretation48_2017' => '',
        'interpretation49_2017' => '',
        'interpretation50_2017' => '',
        'interpretation51_2017' => '',
        'interpretation52_2017' => '',
        'interpretation53_2017' => '',
        'interpretation54_2017' => '',
        'interpretation55_2017' => '',
        'interpretation56_2017' => '',
        'interpretation57_2017' => '',
        'interpretation58_2017' => '',
        'interpretation59_2017' => '',
        'interpretation60_2017' => '',
        'interpretation61_2017' => '',
        'interpretation62_2017' => '',
        'interpretation63_2017' => '',
        'interpretation64_2017' => '',
        'interpretation65_2017' => '',
        'interpretation66_2017' => '',
        'interpretation67_2017' => '',
        'interpretation68_2017' => '',
        'interpretation69_2017' => '',
        'interpretation70_2017' => '',
        'interpretation71_2017' => '',
        'interpretation72_2017' => '',
        'interpretation73_2017' => '',
        'interpretation74_2017' => '',
        'interpretation75_2017' => '',

        'interpretation37_2019' => '',
        'interpretation38_2019' => '',
        'interpretation39_2019' => '',
        'interpretation40_2019' => '',
        'interpretation41_2019' => '',
        'interpretation42_2019' => '',
        'interpretation43_2019' => '',
        'interpretation44_2019' => '',
        'interpretation45_2019' => '',
        'interpretation46_2019' => '',
        'interpretation47_2019' => '',
        'interpretation48_2019' => '',
        'interpretation49_2019' => '',
        'interpretation50_2019' => '',
        'interpretation51_2019' => '',
        'interpretation52_2019' => '',
        'interpretation53_2019' => '',
        'interpretation54_2019' => '',
        'interpretation55_2019' => '',
        'interpretation56_2019' => '',
        'interpretation57_2019' => '',
        'interpretation58_2019' => '',
        'interpretation59_2019' => '',
        'interpretation60_2019' => '',
        'interpretation61_2019' => '',
        'interpretation62_2019' => '',
        'interpretation63_2019' => '',
        'interpretation64_2019' => '',
        'interpretation65_2019' => '',
        'interpretation66_2019' => '',
        'interpretation67_2019' => '',
        'interpretation68_2019' => '',
        'interpretation69_2019' => '',
        'interpretation70_2019' => '',
        'interpretation71_2019' => '',
        'interpretation72_2019' => '',
        'interpretation73_2019' => '',
        'interpretation74_2019' => '',
        'interpretation75_2019' => '',

        'interpretation37_2020' => '',
        'interpretation38_2020' => '',
        'interpretation39_2020' => '',
        'interpretation40_2020' => '',
        'interpretation41_2020' => '',
        'interpretation42_2020' => '',
        'interpretation43_2020' => '',
        'interpretation44_2020' => '',
        'interpretation45_2020' => '',
        'interpretation46_2020' => '',
        'interpretation47_2020' => '',
        'interpretation48_2020' => '',
        'interpretation49_2020' => '',
        'interpretation50_2020' => '',
        'interpretation51_2020' => '',
        'interpretation52_2020' => '',
        'interpretation53_2020' => '',
        'interpretation54_2020' => '',
        'interpretation55_2020' => '',
        'interpretation56_2020' => '',
        'interpretation57_2020' => '',
        'interpretation58_2020' => '',
        'interpretation59_2020' => '',
        'interpretation60_2020' => '',
        'interpretation61_2020' => '',
        'interpretation62_2020' => '',
        'interpretation63_2020' => '',
        'interpretation64_2020' => '',
        'interpretation65_2020' => '',
        'interpretation66_2020' => '',
        'interpretation67_2020' => '',
        'interpretation68_2020' => '',
        'interpretation69_2020' => '',
        'interpretation70_2020' => '',
        'interpretation71_2020' => '',
        'interpretation72_2020' => '',
        'interpretation73_2020' => '',
        'interpretation74_2020' => '',
        'interpretation75_2020' => ''
      ];

      $intepretation_find = Interpretation::where('state_id',$id)->first();

      if (isset($intepretation_find) == false) {
        $intepretation_new = new Interpretation();
        $intepretation_new->state_id = $id;
        $intepretation_new->data =json_encode($data);
        $intepretation_new->save();
      }else {
        $intepretation_find->state_id = $id;
        $intepretation_find->data =json_encode($data);
        $intepretation_find->save();
      }

      DB::commit();
      return response()->json(['status' => true]);
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
    }

  }

  public function CriterionConclusionsRoundTwo()
  {
    try {
      DB::beginTransaction();
      $subsections = Subsection::where('round_two','1')
      ->select('decision_id','ambit_id','criterion_id')
      ->groupBy('decision_id','ambit_id','criterion_id')
      ->get();

      for ($i=37; $i <= 67 ; $i++) {
        foreach ($subsections as $key => $value) {
          $cc = new CriterionConclusions();
          $cc->ambit_id = $value->ambit_id;
          $cc->decision_id = $value->decision_id;
          $cc->criterion_id = $value->criterion_id;
          $cc->state_id = $i;
          $cc->save();
        }
      }
      DB::commit();
      return response()->json(['status' => true]);
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
    }


  }

  public function saveLoadedDataOne()
  {
    try {
      DB::beginTransaction();
      // DataLoaded
      // NOTE: 1.- MAP, 2.- ORG, 3.-Headquarter.

      $data_delete = DataLoaded::whereIn('type',['map','org','head'])->delete();

      $states = State::get();

      foreach ($states as $key_s => $value_s) {
        $per_map = 0; $per_org = 0; $per_hea = 0;
        $map = DB::table('documents')->where('type','LIKE','map')->where('state_id',$value_s->id)->count();
        $organization = DB::table('documents')->where('type','LIKE','organization')->where('state_id',$value_s->id)->count();
        $headquarter = DB::table('all_headquarters')->where('state_id',$value_s->id)->count();

        if ($map > 0) {
          $per_map = 100;
        }
        $dataLoadedm = new DataLoaded();
        $dataLoadedm->state_id = $value_s->id;
        $dataLoadedm->percentage = $per_map;
        $dataLoadedm->total_amount = 1;
        $dataLoadedm->registered_amount = $map;
        $dataLoadedm->type = 'map';
        $dataLoadedm->save();

        if ($organization > 0) {
          $per_org = 100;
        }
        $dataLoadedo = new DataLoaded();
        $dataLoadedo->state_id = $value_s->id;
        $dataLoadedo->percentage = $per_org;
        $dataLoadedo->total_amount = 1;
        $dataLoadedo->registered_amount = $organization;
        $dataLoadedo->type = 'org';
        $dataLoadedo->save();

        if ($headquarter > 0) {
          $per_hea = 100;
        }
        $dataLoadedh = new DataLoaded();
        $dataLoadedh->state_id = $value_s->id;
        $dataLoadedh->percentage = $per_hea;
        $dataLoadedh->total_amount = 1;
        $dataLoadedh->registered_amount = $headquarter;
        $dataLoadedh->type = 'head';
        $dataLoadedh->save();
      }

      DB::commit();
      return response()->json(['status' => true]);
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
    }
  }

  public function saveLoadedDataTwo()
  {
    try {
      $data_delete = DataLoaded::where('type','cuanti')->delete();

        $arreglo = [];
      $states = State::get();
      foreach ($states as $key => $value_s) {
        $qs = DB::table('quantitative_sources')->where('state_id',$value_s->id)->first();
        $data_c_2017 = 0;
        $data_c_2018 = 0;
        $json = json_decode($qs->data);
        foreach ($json as $key => $value) {
          for ($i=1; $i < 36 ; $i++) {
            if ($key == 'checked'.$i.'_2017' && $value != 0) {
              $data_c_2017 += 1;
            }
            if ($key == 'variable'.$i.'_2017' && !is_null($value)) {
              $data_c_2017 += 1;
            }
            if ($key == 'checked'.$i.'_2018' && $value != 0) {
              $data_c_2018 += 1;
            }
            if ($key == 'variable'.$i.'_2018' && !is_null($value)) {
              $data_c_2018 += 1;
            }

          }
        }
        //
        $vd = 0;
        if ($value_s->round == 1) {
          $vd = 33 * 2;
        }elseif ($value_s->round == 2) {
          $vd = 43 * 4;
        }

        $progress = (( ($data_c_2017 + $data_c_2018) * 100) / $vd);

        $dataLoadedh = new DataLoaded();
        $dataLoadedh->state_id = $value_s->id;
        $dataLoadedh->percentage = $progress;
        $dataLoadedh->total_amount = $vd;
        $dataLoadedh->registered_amount = ($data_c_2017 + $data_c_2018);
        $dataLoadedh->type = 'cuanti';
        $dataLoadedh->save();

      }
        return response()->json(['status' => true]);
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
    }
  }

  public function saveLoadedDataThree()
  {
    try {
      $data_delete = DataLoaded::whereIn('type',['conclusions','problematics','observations','criterion_conclusion'])->delete();

      $states = State::get();

      foreach ($states as $key_state => $value_state) {

        $t_con = 39;
        $t_pro = 39;

        $conclusion = DB::table('conclusions')->where('state_id',$value_state->id)->first();
        $a = 0;
        foreach ($conclusion as $key => $value) {
          for ($i=1; $i < 4 ; $i++) {
            for ($j=1; $j < 14 ; $j++) {
              if ($key == 'conclusion-'.$j.'-'.$i) {
                if ($value != '' || !is_null($value)) {
                  $a += 1;
                }
              }
            }
          }
        }
        $porcertage_conclusions = round(($a/$t_con) * 100);//conclusions

        $dataLoadec = new DataLoaded();
        $dataLoadec->state_id = $value_state->id;
        $dataLoadec->percentage = $porcertage_conclusions;
        $dataLoadec->total_amount = $t_con;
        $dataLoadec->registered_amount = $a;
        $dataLoadec->type = 'conclusions';
        $dataLoadec->save();

        $problematic = DB::table('problematics')->where('state_id',$value_state->id)->first();
        $a_p = 0;
        foreach ($problematic as $key_p => $value_p) {
          for ($k=1; $k < 4 ; $k++) {
            for ($l=1; $l < 14 ; $l++) {
              if ($key_p == 'problematic-'.$l.'-'.$k) {
                if ($value_p != '' || !is_null($value_p)) {
                  $a_p += 1;
                }
              }
            }
          }
        }

        $porcertage_problematics = round(($a_p/$t_pro) * 100);//problematics

        $dataLoadec = new DataLoaded();
        $dataLoadec->state_id = $value_state->id;
        $dataLoadec->percentage = $porcertage_problematics;
        $dataLoadec->total_amount = $t_pro;
        $dataLoadec->registered_amount = $a_p;
        $dataLoadec->type = 'problematics';
        $dataLoadec->save();

        $observation = DB::table('observations')->where('state_id',$value_state->id)->get();
        $t_obs = count($observation);
        $a_o = 0;
        foreach ($observation as $key => $value) {
          if ($value->observation != '' ||!is_null($value->observation)) {
            $a_o += 1;
          }
        }

        $porcertage_observations = round(($a_o/$t_obs) * 100);//observations

        $dataLoadec = new DataLoaded();
        $dataLoadec->state_id = $value_state->id;
        $dataLoadec->percentage = $porcertage_observations;
        $dataLoadec->total_amount = $t_obs;
        $dataLoadec->registered_amount = $a_o;
        $dataLoadec->type = 'observations';
        $dataLoadec->save();

        $criterion_conclusion = DB::table('criterion_conclusions')->where('state_id',$value_state->id)->get();
        if (count($criterion_conclusion) > 0) {
          $t_cc = 0;
          // if ($value_state->round == 2) {
          //   $t_cc = count($criterion_conclusion) * 3;
          // }else {
            $t_cc = count($criterion_conclusion);
          // }
          $a_cc = 0;

          foreach ($criterion_conclusion as $key_cc => $value_cc) {
            if ($value_cc->conclusion != '' || !is_null($value_cc->conclusion)) {
              $a_cc += 1;
            }
            // if ($value_state->round == 2) {
            //   if ($value_cc->conclusion_problematica != '' || !is_null($value_cc->conclusion_problematica)) {
            //     $a_cc += 1;
            //   }
            //   if ($value_cc->problematica_conclusion != '' || !is_null($value_cc->problematica_conclusion)) {
            //     $a_cc += 1;
            //   }
            // }
          }
          $porcertage_criterion_conclusion = round(($a_cc/$t_cc) * 100);//criterion_conclusion

          $dataLoadec = new DataLoaded();
          $dataLoadec->state_id = $value_state->id;
          $dataLoadec->percentage = $porcertage_criterion_conclusion;
          $dataLoadec->total_amount = $t_cc;
          $dataLoadec->registered_amount = $a_cc;
          $dataLoadec->type = 'criterion_conclusion';
          $dataLoadec->save();
        }else {
          $dataLoadec = new DataLoaded();
          $dataLoadec->state_id = $value_state->id;
          $dataLoadec->percentage = 0;
          $dataLoadec->total_amount = 167;
          $dataLoadec->registered_amount = 0;
          $dataLoadec->type = 'criterion_conclusion';
          $dataLoadec->save();
        }

      }

      return response()->json(['status' => true]);

    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
    }
  }

  public function fixedcriterionconcusion()
  {
    // use App\CriterionConclusions;
    $cc = CriterionConclusions::where('state_id','>','36')->where('conclusion_problematica','!=','')->get();
    foreach ($cc as $key => $value) {
      $cd = Conclusion::updateOrCreate(
        ['state_id' => $value->state_id],
        ['conclusion-'.$value->decision_id.'-'.$value->ambit_id => $value->conclusion_problematica]
      );
      // ->where('id',$value->id);
        // $cc_save = Conclusion::where('id',$value->id)->first();
      // $cc_save->conclusion = $value->conclusion_problematica;
      // $cc_save->save();
    }

    return response()->json($cc);
  }

  public function convertJsonCriterionConclusion()
  {
    $cc = CriterionConclusions::whereNotNull('conclusion_ambit')->orWhereNotNull('problematic_ambit')->get();
    foreach ($cc as $key => $value) {
      $cpa = new ConclusionProblematicAmbit();
      $cpa->criterion_conclusions_id = $value->id;
      $cpa->conclusion_ambit = $value->conclusion_ambit;
      $cpa->problematic_ambit = $value->problematic_ambit;
      $cpa->save();

      $cc_r = CriterionConclusions::where('id',$value->id)->first();
      $cc_r->conclusion_ambit = '-';
      $cc_r->problematic_ambit = '-';
      $cc_r->save();

    }

    return response()->json($cc);
  }

}
