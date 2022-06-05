<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Criterionproblematic;
use App\Http\Helpers\Utilidades;

class CriterionproblematicController extends Controller
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

        return Criterionproblematic::create([
            'state_id' => $request['state_id'],
            'problematicbycriterion1' => $request['problematicbycriterion1'],
            'problematicbycriterion2' => $request['problematicbycriterion2'],
            'problematicbycriterion3' => $request['problematicbycriterion3'],
            'problematicbycriterion4' => $request['problematicbycriterion4'],
            'problematicbycriterion5' => $request['problematicbycriterion5'],
            'problematicbycriterion6' => $request['problematicbycriterion6'],
            'problematicbycriterion7' => $request['problematicbycriterion7'],
            'problematicbycriterion8' => $request['problematicbycriterion8'],
            'problematicbycriterion9' => $request['problematicbycriterion9'],
            'problematicbycriterion10' => $request['problematicbycriterion10'],
            'problematicbycriterion11' => $request['problematicbycriterion11'],
            'problematicbycriterion12' => $request['problematicbycriterion12'],
            'problematicbycriterion13' => $request['problematicbycriterion13'],
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

          $problematic = Criterionproblematic::findOrFail($id);
          $problematic->fill($request->all());
          Utilidades::auditar($problematic, $problematic->id);
          $problematic->update();

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
