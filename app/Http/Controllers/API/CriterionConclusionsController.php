<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CriterionConclusions;
use App\Http\Helpers\Utilidades;
use Illuminate\Support\Facades\DB;
use App\DataLoaded;
use App\ConclusionProblematicAmbit;
use App\State;

class CriterionConclusionsController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

        ]);

        $dataLoadec_busqueda = DataLoaded::where('state_id',$request['state_id'])->where('type','criterion_conclusion')->first();

        if ($request['conclusion'] != '' || !is_null($request['conclusion'])) {
          if (($dataLoadec_busqueda->registered_amount + 1) > $dataLoadec_busqueda->total_amount) {
            $porcertage_criterion_conclusion = round((($dataLoadec_busqueda->registered_amount + 1)/($dataLoadec_busqueda->total_amount + 1)) * 100);//criterion_conclusion
            $dataLoadec_busqueda->total_amount = $dataLoadec_busqueda->total_amount + 1;
            $dataLoadec_busqueda->percentage = $porcertage_criterion_conclusion;
            $dataLoadec_busqueda->registered_amount = $dataLoadec_busqueda->registered_amount + 1;
            $dataLoadec_busqueda->save();
          }else {
            $porcertage_criterion_conclusion = round((($dataLoadec_busqueda->registered_amount + 1)/($dataLoadec_busqueda->total_amount)) * 100);//criterion_conclusion
            $dataLoadec_busqueda->percentage = $porcertage_criterion_conclusion;
            $dataLoadec_busqueda->registered_amount = $dataLoadec_busqueda->registered_amount + 1;
            $dataLoadec_busqueda->save();
          }
        }

        return CriterionConclusions::create([
            'state_id' => $request['state_id'],
            'ambit_id' => $request['ambit_id'],
            'decision_id' => $request['decision_id'],
            'criterion_id' => $request['criterion_id'],
            'conclusion' => $request['conclusion'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
          $criterionconclusions = CriterionConclusions::findOrFail($id);
          if ($criterionconclusions->conclusion != $request['conclusion']) {
            $dataLoadec_busqueda = DataLoaded::where('state_id',$request['state_id'])->where('type','criterion_conclusion')->first();

            if ($request['conclusion'] != '' || !is_null($request['conclusion'])) {
              if (($dataLoadec_busqueda->registered_amount + 1) > $dataLoadec_busqueda->total_amount) {
                $porcertage_criterion_conclusion = round((($dataLoadec_busqueda->registered_amount + 1)/($dataLoadec_busqueda->total_amount + 1)) * 100);//criterion_conclusion
                $dataLoadec_busqueda->total_amount = $dataLoadec_busqueda->total_amount + 1;
                $dataLoadec_busqueda->percentage = $porcertage_criterion_conclusion;
                $dataLoadec_busqueda->registered_amount = $dataLoadec_busqueda->registered_amount + 1;
                $dataLoadec_busqueda->save();
              }else {
                $porcertage_criterion_conclusion = round((($dataLoadec_busqueda->registered_amount + 1)/($dataLoadec_busqueda->total_amount)) * 100);//criterion_conclusion
                $dataLoadec_busqueda->percentage = $porcertage_criterion_conclusion;
                $dataLoadec_busqueda->registered_amount = $dataLoadec_busqueda->registered_amount + 1;
                $dataLoadec_busqueda->save();
              }
            }else {
              $porcertage_criterion_conclusion = round((($dataLoadec_busqueda->registered_amount - 1)/($dataLoadec_busqueda->total_amount)) * 100);//criterion_conclusion
              $dataLoadec_busqueda->percentage = $porcertage_criterion_conclusion;
              $dataLoadec_busqueda->registered_amount = $dataLoadec_busqueda->registered_amount - 1;
              $dataLoadec_busqueda->save();
            }
          }

          $criterionconclusions->fill($request->all());
          Utilidades::auditar($criterionconclusions, $criterionconclusions->id);
          $criterionconclusions->update();



          return ['message' => 'Conclusion Updated'];

        } catch (\Throwable $e) {
          Utilidades::errors($e);
          return response()->json(['error' => 'Error.'],400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveCP(Request $request)
    {
      try {
        DB::beginTransaction();

        $state_id = $request->data[0]['state_id'];
        $states = State::where('id', $state_id)->first();
        $contador = 0;
        if ($states->round == 2) {
        for ($i=0; $i < 150 ; $i++) {
          if ($request->data[$i]['conclusion_probletic_ambit'] != null) {
            $contador ++;
          }elseif ($request->data[$i]['conclusion_probletic_ambit'] == null && $request->data[$i]['conclusion'] != null )  {
            $contador ++;
          }
        }
        Utilidades::LoadedData($contador,'conclusions',$state_id, 'sum');
        Utilidades::LoadedData($contador,'problematics',$state_id, 'sum');
        }


        foreach ($request->data as $key => $value) {
          $criterionconclusions = CriterionConclusions::where('id',$value['id'])->first();
          $criterionconclusions->conclusion_ambit = $value['conclusion_ambit'];
          // $criterionconclusions->conclusion_ambit = '-';
          // $criterionconclusions->problematic_ambit = '-';
          $criterionconclusions->problematic_ambit = $value['problematic_ambit'];
          Utilidades::auditar($criterionconclusions, $criterionconclusions->id);
          $criterionconclusions->save();
        }
        DB::commit();

        return response()->json(['status' => true]);

      } catch (\Throwable $e) {
        DB::rollBack();
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }

    }

    public function savePC(Request $request)
    {

      try {

        DB::beginTransaction();
        foreach ($request->data as $key => $value) {
          $criterionconclusions = CriterionConclusions::where('id',$value['id'])->first();
          $criterionconclusions->problematica_conclusion = $value['problematica_conclusion'];
          Utilidades::auditar($criterionconclusions, $criterionconclusions->id);
          $criterionconclusions->save();
        }
        DB::commit();

        return response()->json(['status' => true]);

      } catch (\Throwable $e) {
        DB::rollBack();
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }


    }

    public function saveCPA(Request $request)
    {
      try {

        DB::beginTransaction();

        $cpa = new ConclusionProblematicAmbit();
        $cpa->criterion_conclusions_id = $request->criterion_conclusions_id;
        $cpa->conclusion_ambit = $request->conclusion_ambit;
        $cpa->problematic_ambit = $request->problematic_ambit;
        $cpa->save();

        DB::commit();

        return response()->json(['id' => $cpa->id]);

      } catch (\Throwable $e) {
        DB::rollBack();
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }
    }

    public function updateCPA(Request $request)
    {
      try {

        DB::beginTransaction();

        $cpa = ConclusionProblematicAmbit::where('id',$request->criterion_conclusions_id)->first();
        $cpa->conclusion_ambit = $request->conclusion_ambit;
        $cpa->problematic_ambit = $request->problematic_ambit;
        $cpa->save();

        DB::commit();

        return response()->json(['status' => true]);

      } catch (\Throwable $e) {
        DB::rollBack();
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }
    }

    public function deleteCPA($id)
    {
      try {

        DB::beginTransaction();

        $cpa = ConclusionProblematicAmbit::where('id',$id)->first();
        $cpa->old = $cpa->criterion_conclusions_id;
        $cpa->criterion_conclusions_id = null;
        $cpa->save();

        DB::commit();

        return response()->json(['status' => true]);

      } catch (\Throwable $e) {
        DB::rollBack();
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }
    }
}
