<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subsection;
use App\Ambit;
use App\State;

class SubsectionController extends Controller
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
        return Subsection::with('decision')->with('ambit')->with('criterion')->with('source')->get();
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

    public function subsectionsbydecisionambit($decision, $ambit, $key)
    {
        $ambitSelected = Ambit::where('slug', $ambit)->first();
        $state = State::where('key',$key)->first();

        if ($state->round == 1) {
          $subsections = Subsection::with('decision')
                          ->with('ambit')->with('source')
                          ->with('criterion')
                          ->where('decision_id', '=', $decision)
                          ->where('ambit_id', '=', $ambitSelected->id)
                          ->where('round_one','1')
                          ->orderBy('criterion_id', 'ASC')->get();

        }elseif ($state->round == 2) {
          $subsections = Subsection::with('decision')
                          ->with('ambit')->with('source')
                          ->with('criterion')
                          ->where('decision_id', '=', $decision)
                          ->where('ambit_id', '=', $ambitSelected->id)
                          ->where('round_two','1')
                          ->orderBy('criterion_id', 'ASC')->get();
        }

        return $subsections;
    }

    public function subsectionByDecisionambitAll(){
        $subsections = Subsection::with('decision')->with('ambit')->with('source')->with('criterion')->get();
        return $subsections;
    }

    public function subsectionbyambit($ambit)
    {
        $ambitSelected = Ambit::where('slug', $ambit)->first();
        $subsections = Subsection::with('decision')->with('ambit')->with('source')->with('criterion')->where('ambit_id', '=', $ambitSelected->id)->get();

        return $subsections;
    }
}
