<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Problematic;
use App\Http\Helpers\Utilidades;
use Illuminate\Support\Facades\DB;
use App\State;

class ProblematicController extends Controller
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
        //
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

        return Problematic::create([
            'state_id' => $request['state_id'],
            'problematic-1-1' => $request['problematic-1-1'],
            'problematic-2-1' => $request['problematic-2-1'],
            'problematic-3-1' => $request['problematic-3-1'],
            'problematic-4-1' => $request['problematic-4-1'],
            'problematic-5-1' => $request['problematic-5-1'],
            'problematic-6-1' => $request['problematic-6-1'],
            'problematic-7-1' => $request['problematic-7-1'],
            'problematic-8-1' => $request['problematic-8-1'],
            'problematic-9-1' => $request['problematic-9-1'],
            'problematic-10-1' => $request['problematic-10-1'],
            'problematic-11-1' => $request['problematic-11-1'],
            'problematic-12-1' => $request['problematic-12-1'],
            'problematic-13-1' => $request['problematic-13-1'],
            'problematic-1-2' => $request['problematic-1-2'],
            'problematic-2-2' => $request['problematic-2-2'],
            'problematic-3-2' => $request['problematic-3-2'],
            'problematic-4-2' => $request['problematic-4-2'],
            'problematic-5-2' => $request['problematic-5-2'],
            'problematic-6-2' => $request['problematic-6-2'],
            'problematic-7-2' => $request['problematic-7-2'],
            'problematic-8-2' => $request['problematic-8-2'],
            'problematic-9-2' => $request['problematic-9-2'],
            'problematic-10-2' => $request['problematic-10-2'],
            'problematic-11-2' => $request['problematic-11-2'],
            'problematic-12-2' => $request['problematic-12-2'],
            'problematic-13-2' => $request['problematic-13-2'],
            'problematic-1-3' => $request['problematic-1-3'],
            'problematic-2-3' => $request['problematic-3-3'],
            'problematic-3-3' => $request['problematic-3-3'],
            'problematic-4-3' => $request['problematic-4-3'],
            'problematic-5-3' => $request['problematic-5-3'],
            'problematic-6-3' => $request['problematic-6-3'],
            'problematic-7-3' => $request['problematic-17-3'],
            'problematic-8-3' => $request['problematic-8-3'],
            'problematic-9-3' => $request['problematic-9-3'],
            'problematic-10-3' => $request['problematic-10-3'],
            'problematic-11-3' => $request['problematic-11-3'],
            'problematic-12-3' => $request['problematic-12-3'],
            'problematic-13-3' => $request['problematic-13-3'],
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

          $problematic = Problematic::findOrFail($id);
          $problematic->fill($request->all());
          Utilidades::auditar($problematic, $problematic->id);
          $problematic->update();

          $problematics = DB::table('problematics')->where('state_id',$problematic->state_id)->first();
          $a_p = 0;
          foreach ($problematics as $key_p => $value_p) {
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
          $states = State::where('id', $problematic->state_id)->first();
          if ($states->round == 1) {
            Utilidades::LoadedData($a_p,'problematics',$problematic->state_id, 'sum');
          }

          return ['message' => 'problematic Updated'];

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
}
