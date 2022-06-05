<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AllHeadquarters;
use App\State;
use App\Http\Helpers\Utilidades;  


class AllHeadquartersController extends Controller
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
    public function index(Request $request)
    {
        $state = $request->state;
        return AllHeadquarters::whereIn('state_id', function($query) use($state) {
            $query->select('id')
                ->from((new State)->getTable())
                ->where('key', $state);
        })->get();
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

        $state_f = State::where('key', $request->state)->first();
        $state = new AllHeadquarters();
        $state->state_id = $state_f->id;
        $state->name = $request->name;
        $state->city_halls = $request->city_halls;
        $state->agents = $request->agents;
        Utilidades::auditar($state, $state->id);
        $state->save();

        Utilidades::LoadedData(1,'head',$state_f->id, 'sum');

        return response()->json(['status' => true]);

      } catch (\Throwable $e) {
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);

        // return response()->json(false);
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

        $all_headquarters = AllHeadquarters::findOrFail($id);
        $all_headquarters->fill($request->all());
        Utilidades::auditar($all_headquarters, $all_headquarters->id);
        $all_headquarters->save();
        return $all_headquarters;

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
        $all_headquarters = AllHeadquarters::findOrFail($id);
        Utilidades::LoadedData(1,'head',$all_headquarters->state_id, 'res');
        $all_headquarters->delete();


        return $all_headquarters;
    }
}
