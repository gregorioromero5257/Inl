<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuantitativeSource;
use App\Http\Helpers\Utilidades;
use App\State;

class QuantitativeSourceController extends Controller
{
    /**
     * Create a new controller instance.
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
        return QuantitativeSource::with('state')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $quantitativesource = QuantitativeSource::findOrFail($id);
        $states = State::where('id', $quantitativesource->state_id)->first();


        $quantitativesource->update($request->all());

        $quantitativesource_data = QuantitativeSource::findOrFail($id);
        $quantitativesource_data->data = json_encode($request->all());
        Utilidades::auditar($quantitativesource_data, $quantitativesource_data->id);
        $quantitativesource_data->save();

        $data_c_2017 = 0;
        $data_c_2018 = 0;
        $json = json_decode($quantitativesource_data->data);

        if ($states->round == 2) {
          foreach ($json as $key => $value) {
            // $a []= $value;
            for ($i=1; $i < 44 ; $i++) {
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
              if ($key == 'checked'.$i.'_2019' && $value != 0) {
                $data_c_2018 += 1;
              }
              if ($key == 'variable'.$i.'_2019' && !is_null($value)) {
                $data_c_2018 += 1;
              }
              if ($key == 'checked'.$i.'_2020' && $value != 0) {
                $data_c_2018 += 1;
              }
              if ($key == 'variable'.$i.'_2020' && !is_null($value)) {
                $data_c_2018 += 1;
              }
            }
          }
        }elseif ($states->round == 1) {
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
        }



        $progress = $data_c_2017 + $data_c_2018;


        Utilidades::LoadedData($progress,'cuanti',$quantitativesource_data->state_id, 'sum');

        return ['message' => 'Updated the quantitative source info'];

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
