<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Conclusion;
use App\Http\Helpers\Utilidades;
use Illuminate\Support\Facades\DB;
use App\State;

class ConclusionController extends Controller
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
        //
        $this->validate($request,[

        ]);

        return Conclusion::create([
            'state_id' => $request['state_id'],
            'conclusion-1-1' => $request['conclusion-1-1'],
            'conclusion-2-1' => $request['conclusion-2-1'],
            'conclusion-3-1' => $request['conclusion-3-1'],
            'conclusion-4-1' => $request['conclusion-4-1'],
            'conclusion-5-1' => $request['conclusion-5-1'],
            'conclusion-6-1' => $request['conclusion-6-1'],
            'conclusion-7-1' => $request['conclusion-7-1'],
            'conclusion-8-1' => $request['conclusion-8-1'],
            'conclusion-9-1' => $request['conclusion-9-1'],
            'conclusion-10-1' => $request['conclusion-10-1'],
            'conclusion-11-1' => $request['conclusion-11-1'],
            'conclusion-12-1' => $request['conclusion-12-1'],
            'conclusion-13-1' => $request['conclusion-13-1'],
            'conclusion-1-2' => $request['conclusion-1-2'],
            'conclusion-2-2' => $request['conclusion-2-2'],
            'conclusion-3-2' => $request['conclusion-3-2'],
            'conclusion-4-2' => $request['conclusion-4-2'],
            'conclusion-5-2' => $request['conclusion-5-2'],
            'conclusion-6-2' => $request['conclusion-6-2'],
            'conclusion-7-2' => $request['conclusion-7-2'],
            'conclusion-8-2' => $request['conclusion-8-2'],
            'conclusion-9-2' => $request['conclusion-9-2'],
            'conclusion-10-2' => $request['conclusion-10-2'],
            'conclusion-11-2' => $request['conclusion-11-2'],
            'conclusion-12-2' => $request['conclusion-12-2'],
            'conclusion-13-2' => $request['conclusion-13-2'],
            'conclusion-1-3' => $request['conclusion-1-3'],
            'conclusion-2-3' => $request['conclusion-3-3'],
            'conclusion-3-3' => $request['conclusion-3-3'],
            'conclusion-4-3' => $request['conclusion-4-3'],
            'conclusion-5-3' => $request['conclusion-5-3'],
            'conclusion-6-3' => $request['conclusion-6-3'],
            'conclusion-7-3' => $request['conclusion-17-3'],
            'conclusion-8-3' => $request['conclusion-8-3'],
            'conclusion-9-3' => $request['conclusion-9-3'],
            'conclusion-10-3' => $request['conclusion-10-3'],
            'conclusion-11-3' => $request['conclusion-11-3'],
            'conclusion-12-3' => $request['conclusion-12-3'],
            'conclusion-13-3' => $request['conclusion-13-3'],
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
          $this->validate($request,[
            'state_id' => 'required',
          ]);


          $conclusion = Conclusion::findOrFail($id);
          $conclusion->fill($request->all());
          Utilidades::auditar($conclusion, $conclusion->id);
          $conclusion->update();

          $conclusions = DB::table('conclusions')->where('state_id',$conclusion->state_id)->first();
          $a = 0;
          foreach ($conclusions as $key => $value) {
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
          $states = State::where('id', $conclusion->state_id)->first();
          if ($states->round == 1) {
            Utilidades::LoadedData($a,'conclusions',$conclusion->state_id, 'sum');
          }

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
}
