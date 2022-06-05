<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Decision;
use App\Indicator;
use App\State;

class DecisionController extends Controller
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
        return Decision::with('indicators')->orderBy('num', 'asc')->get();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try {
        $valores = explode('&',$id);
        $state = State::where('key',$valores[1])->first();
        $decision = Decision::where('id',$valores[0])->first();
        $indicators = Indicator::where('decision_id',$valores[0])->where('round',$state->round)->get();
        // return Decision::with('indicators')
        // ->where('round',$valores[1])
        // ->where('id',$valores[0])->first();
        $result = [$decision, 'indicators' => $indicators];


        return response()->json($result);

      } catch (\Exception $e) {
        dd($e);
      }
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
        //
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
