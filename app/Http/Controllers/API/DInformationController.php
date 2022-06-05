<?php

namespace App\Http\Controllers\API;

use App\Library\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\State;
use App\Http\Helpers\Utilidades;
use App\DataLoaded;

class DInformationController extends Controller
{
    /**
     * @param Request $request
     * @param $stateRef
     * @return \App\Document
     */
    public function organizationChart(Request $request, $stateRef) {
        return (new Document($request, $stateRef))->organization();
    }

    /**
     * @param Request $request
     * @param $stateRef
     * @return \App\Document
     */
    public function map(Request $request, $stateRef) {
        return (new Document($request, $stateRef))->map();
    }

    public function mapna($data)
    {
      try {

        $state = State::where('key', $data)->first();

        $document = new \App\Document();
        $document->state_id = $state->id;
        $document->path = 'N/A';
        $document->url = 'N/A';
        $document->file_name = 'N/A';
        $document->type = 'map';
        Utilidades::auditar($document, $document->id);
        $document->save();

        Utilidades::LoadedData(1,'map',$state->id, 'sum');

        return response()->json(['status' => true]);

      } catch (\Throwable $e) {
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }
    }

    public function orgchartna($data)
    {
      try {

        $state = State::where('key', $data)->first();

        $document = new \App\Document();
        $document->state_id = $state->id;
        $document->path = 'N/A';
        $document->url = 'N/A';
        $document->file_name = 'N/A';
        $document->type = 'organization';
        Utilidades::auditar($document, $document->id);
        $document->save();

        Utilidades::LoadedData(1,'org',$state->id, 'sum');

        return response()->json(['status' => true]);

      } catch (\Throwable $e) {
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }
    }

    public function mapnadelete($data)
    {
      $state = State::where('key', $data)->first();

      $document = \App\Document::where('state_id',$state->id)
      ->where('type','map')->where('file_name','N/A')->delete();

      Utilidades::LoadedData(1,'map',$state->id, 'res');

      return response()->json(['status' => true]);
    }

    public function orgchartnadelete($data)
    {
      $state = State::where('key', $data)->first();

      $document = \App\Document::where('state_id',$state->id)
      ->where('type','organization')->where('file_name','N/A')->delete();

      Utilidades::LoadedData(1,'org',$state->id, 'res');

      return response()->json(['status' => true]);
    }
}
