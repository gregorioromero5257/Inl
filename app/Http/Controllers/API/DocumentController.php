<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Document;
use App\Http\Helpers\Utilidades;
use App\State;

class DocumentController extends Controller
{
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
        $valores = explode('&', $id);
        $document_id = $valores[0];
        $state_key = $valores[1];
        $type = $valores[2];
        $state = State::where('key', $state_key)->first();

        if ($type == 'org') {
          Utilidades::LoadedData(1,'org',$state->id, 'res');
        }elseif ($type == 'map') {
          Utilidades::LoadedData(1,'map',$state->id, 'res');
        }

        $document = Document::findOrFail($id);
        // delete the user
        $document->delete();
        return ['message' => 'Document Deleted'];
    }
}
