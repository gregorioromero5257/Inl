<?php

namespace App\Http\Controllers\API;

use App\Library\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QualitativeSourceController extends Controller
{
    public function storeFile(Request $request, $stateRef) {
        return (new Document($request, $stateRef))->excel();
    }

    public function delete($id) {
        return Document::deleteById($id);
    }
}
