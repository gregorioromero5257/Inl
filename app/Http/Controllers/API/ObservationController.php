<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Observation;
use App\State;
use App\Imports\ObservationsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Helpers\Utilidades;
use Illuminate\Support\Facades\DB;

class ObservationController extends Controller
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
        return Observation::with('decision')->with('ambit')->with('criterion')->with('source')->with('state')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

          $observation = new Observation();
          $observation->state_id = $request['state_id'];
          $observation->headquarter_id = $request['headquarter_id'];
          $observation->decision_id = $request['decision_id'];
          $observation->ambit_id = $request['ambit_id'];
          $observation->criterion_id = $request['criterion_id'];
          $observation->source_id = $request['source_id'];
          $observation->observation = $request['observation'];
          Utilidades::auditar($observation, $observation->id);
          $observation->save();

          Utilidades::LoadedData(1,'observations',$request['state_id'], 'sum');

          return $observation;

        } catch (\Throwable $e) {
          Utilidades::errors($e);
          return response()->json(['error' => 'Error.'],400);
        }
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

        $observation = Observation::findOrFail($id);
        if ($observation->observation != $request['observation']) {
          if (is_null($request['observation']) || $request['observation'] == '' ) {
            Utilidades::LoadedData(1,'observations',$request['state_id'], 'res');
          }else {
            if (is_null($observation->observation) || $observation->observation == '' ) {
              Utilidades::LoadedData(1,'observations',$request['state_id'], 'sum');
            }
          }
        }

        $observation->fill($request->all());
        Utilidades::auditar($observation, $observation->id);
        $observation->save();


        return ['message' => 'Updated the observation info'];

      } catch (\Exception $e) {
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
        $observation = Observation::findOrFail($id);

        $observation->delete();
        return ['message' => 'observation deleted'];
    }

    public function import(Request $request)
    {
        $state = State::findOrFail($request->state_selected);

        $imageName = $state->key.'.'.$request->image->getClientOriginalExtension();

        $stateFile = public_path('myFiles/').$state->key.('/').$imageName;
        if(file_exists($stateFile)){
            @unlink($stateFile);
        }

        $state_observations = Observation::where('state_id', '=', $request->state_selected);

        $state_observations->delete();

        $request->image->move(public_path('myFiles/').$state->key, $imageName);

        Excel::import(new ObservationsImport, $state->key.('/').$imageName, 'my_files', \Maatwebsite\Excel\Excel::XLSX);

    	return ['message' => 'observations saved'];
    }

    public function observationsbydecisionambit($decision, $ambit)
    {
        $observations = Observation::with('state')->with('decision')->with('headquarter')->with('ambit')->with('source')->with('criterion')->where('decision_id', '=', $decision)->where('ambit_id', '=', $ambit)->orderBy('headquarter_id', 'ASC')->orderBy('criterion_id', 'ASC')->get();

        return $observations;
    }

    public function observationbyvariables($state,$headquarter,$decision,$ambit,$criterion,$source)
    {
        $observation = Observation::where('state_id', '=', $state)->where('headquarter_id', '=', $headquarter)->where('decision_id', '=', $decision)->where('ambit_id', '=', $ambit)->where('criterion_id', '=', $criterion)->where('source_id', '=', $source)->first();

        if ($observation){
            return $observation;
        } else {
            return ['message' => 'No se agregó esta observación'];
        }

    }
}
