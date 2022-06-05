<?php
/**
 * Created by PhpStorm.
 * User: cpt_n3m0
 * Date: 5/3/19
 * Time: 8:32 PM
 */

namespace App\Library;


use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Document as File;
use App\Http\Helpers\Utilidades;

class Document
{
    protected $request;

    protected $stateKey;

    protected $disk = 'my_files';

    /**
     * SaveDocument constructor.
     * @param Request $request
     * @param $state
     */
    public function __construct(Request $request, $state) {
        $this->request = $request;
        $this->stateKey = $state;
    }

    public function map() {
        return $this->saveFile('map');
    }

    public function excel() {
        return $this->saveFile('excel');
    }

    public function organization() {
        return $this->saveFile('organization');
    }

    private function saveFile($type) {
        $state = State::where('key', $this->stateKey)->first();
        if (!$state)
            return abort(404);
        $pathSaved = $this->request->file('file')->store($this->stateKey, $this->disk);
        Storage::disk($this->disk)->setVisibility($pathSaved, "public");
        $url = Storage::disk($this->disk)->url($pathSaved);
        $document = $state->documents()->create([
            'path' => $pathSaved,
            'url' => $url,
            'file_name' => $this->request->file('file')->getFilename(),
            'type' => $type,
        ]);
        //Version corta Pendiente
        if ($type === 'map') {
          Utilidades::LoadedData(1,'map',$state->id, 'sum');
        }elseif ($type === 'organization') {
          Utilidades::LoadedData(1,'org',$state->id, 'sum');
        }
        //
        return $document;
    }

    public static function deleteById($id) {
        $document = File::findOrFail($id);
        unlink(public_path($document->path));
        $document->delete();
        return $document;
    }
}
