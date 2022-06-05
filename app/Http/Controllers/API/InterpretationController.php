<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interpretation;
use App\Http\Helpers\Utilidades;

class InterpretationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Interpretation::with('state')->get();
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

        return Interpretation::create([
            'state_id' => $request['state_id'],
            'interpretation1' => $request['interpretation1'],
            'interpretation2' => $request['interpretation2'],
            'interpretation3' => $request['interpretation3'],
            'interpretation4' => $request['interpretation4'],
            'interpretation5' => $request['interpretation5'],
            'interpretation6' => $request['interpretation6'],
            'interpretation7' => $request['interpretation7'],
            'interpretation8' => $request['interpretation8'],
            'interpretation9' => $request['interpretation9'],
            'interpretation10' => $request['interpretation10'],
            'interpretation11' => $request['interpretation11'],
            'interpretation12' => $request['interpretation12'],
            'interpretation13' => $request['interpretation13'],
            'interpretation14' => $request['interpretation14'],
            'interpretation15' => $request['interpretation15'],
            'interpretation16' => $request['interpretation16'],
            'interpretation17' => $request['interpretation17'],
            'interpretation18' => $request['interpretation18'],
            'interpretation19' => $request['interpretation19'],
            'interpretation20' => $request['interpretation20'],
            'interpretation21' => $request['interpretation21'],
            'interpretation22' => $request['interpretation22'],
            'interpretation23' => $request['interpretation23'],
            'interpretation24' => $request['interpretation24'],
            'interpretation25' => $request['interpretation25'],
            'interpretation26' => $request['interpretation26'],
            'interpretation27' => $request['interpretation27'],
            'interpretation28' => $request['interpretation28'],
            'interpretation29' => $request['interpretation29'],
            'interpretation30' => $request['interpretation30'],
            'interpretation31' => $request['interpretation31'],
            'interpretation32' => $request['interpretation32'],
            'interpretation33' => $request['interpretation33'],
            'interpretation34' => $request['interpretation34'],
            'interpretation35' => $request['interpretation35'],
            'interpretation36' => $request['interpretation36'],
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
        // return response()->json($request);
        $interpretation = Interpretation::findOrFail($id);
        $interpretation->state_id = $request->data['state_id'];
        $interpretation->data = json_encode($request->data);
        Utilidades::auditar($interpretation, $interpretation->id);
        $interpretation->save();
        // $interpretation->update($request->all());
        return ['message' => 'Updated the interpretations info'];

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
