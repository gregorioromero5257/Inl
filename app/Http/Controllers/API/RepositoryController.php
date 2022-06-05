<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository;
use App\State;
Use App\DocumentRepository;
use Illuminate\Support\Str as Str;
use Response;
use Zip;
use App\Http\Helpers\Utilidades;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RepositoryController extends Controller
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
        return Repository::with('states')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        $this->validate($request,[
            'name' => 'required|string|unique:repositories',
            'type' => 'required'
        ]);

        $state = State::findOrFail($request->state_id);



          // $request->document->move(public_path('myFiles/').$state->key, $docName);
          $docName = '';
         $repository = new Repository();
         $repository->name = $request['name'];
         $repository->type = $request['type'];
         $repository->document = $docName;
         $repository->state_id = $request['state_id'];
         Utilidades::auditar($repository, $repository->id);
         $repository->save();
         $docName = $state->key.'-'.Str::slug($request['name']).'-'.$repository->id.'.'.$request->document->getClientOriginalExtension();
         $repository->document = $docName;
         Utilidades::auditar($repository, $repository->id);
         $repository->save();

         $dir = '/';
         $recursive = false; // Get subdirectories also?
         $fileData = File::get($request->document);

         $contents = collect(Storage::cloud()->listContents($dir, $recursive));
         $dir = $contents->where('type', '=', 'dir')
         ->where('filename', '=', 'Repository')
         ->first(); // There could be duplicate directory names!

         if ( ! $dir) {
           return 'Directory does not exist!';
         } else {
           Storage::cloud()->put($dir['path'].'/'.$docName, $fileData);
         }

         return $repository;

      } catch (\Throwable $e) {
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }

    }
    public function importDocumentRepository(Request $request)
    {
      try {
        $query = DocumentRepository::where('document','Plan_de_recuperacion_desastres.pdf')->get();
        if (count($query) == 0) {
            $docName = 'Plan_de_recuperacion_desastres.'.$request->document->getClientOriginalExtension();

            $request->document->move(public_path('myFiles/repositoryDocuments'), $docName);

            // return DocumentRepository::create([
            //     'name' =>'Pan de recuperacion de desastres',
            //     'type' => 'pdf',
            //     'document' => $docName,
            // ]);
            $dr = new DocumentRepository();
            $dr->name = 'Pan de recuperacion de desastres';
            $dr->type = 'pdf';
            $dr->document = $docName;
            Utilidades::auditar($dr, $dr->id);
            $dr->save();

            return $dr;
        } else {
            $docName = 'Plan_de_recuperacion_desastres.'.$request->document->getClientOriginalExtension();
            $request->document->move(public_path('myFiles/repositoryDocuments'), $docName);
        }
      } catch (\Throwable $e) {
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }
    }

    public function importDocumentRepositoryAll(Request $request)
    {
      try {
        $this->validate($request,[
            'name' => 'required|string',
            'type' => 'required'
        ]);


        $query = DocumentRepository::where('document',$request->name)->get();

        if (count($query) == 0) {
            $docName = 'Formatos_'.Str::slug($request['name']).'.'.$request->document->getClientOriginalExtension();

            $request->document->move(public_path('myFiles/repositoryDocuments'), $docName);

            // return DocumentRepository::create([
            //     'name' => $request['name'],
            //     'type' => $request['type'],
            //     'document' => $docName,
            // ]);

            $dr = new DocumentRepository();
            $dr->name = $request['name'];
            $dr->type = $request['type'];
            $dr->document = $docName;
            Utilidades::auditar($dr, $dr->id);
            $dr->save();

            return $dr;

        } else {
            $docName = 'Formatos_'.Str::slug($request['name']).'.'.$request->document->getClientOriginalExtension();

            $request->document->move(public_path('myFiles/repositoryDocuments'), $docName);
        }
      } catch (\Throwable $e) {
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }
    }

    public function getDocumentaryRepositoryData(){
        return DocumentRepository::all();
    }
    public function dowloadRepository($id){
        $file = DocumentRepository::findOrFail($id);

        /* $state = State::findOrFail($file->state_id) */

        return Response::download(public_path('myFiles/repositoryDocuments/').$file->document, $file->document);
    }
    public function deletedDocumentaryRepository($id){
        $repository = DocumentRepository::findOrFail($id);

        //$state = State::findOrFail($repository->state_id);

        $file = public_path('myFiles/repositoryDocuments/').$repository->document;
        if(file_exists($file)){
            @unlink($file);
        }
        $repository->delete();

        return ['message' => 'User Deleted'];
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
        $repository = Repository::findOrFail($id);

        $state = State::findOrFail($repository->state_id);

        // $file = public_path('myFiles/').$state->key.('/').$repository->document;
        // if(file_exists($file)){
        //     @unlink($file);
        // }

        $repository->delete();

        return ['message' => 'User Deleted'];
    }

    /**
     * download file from repository.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadFile($id)
    {
        // $file = Repository::findOrFail($id);
        //
        // $state = State::findOrFail($file->state_id);
        //
        // return Response::download(public_path('myFiles/').$state->key.('/').$file->document, $file->document);

        $resource = Repository::findOrFail($id);

    $filename = $resource->document;

    $dir = '/';
    $recursive = true; // Get subdirectories also?
    $contents = collect(Storage::cloud()->listContents($dir, $recursive));

    $file = $contents
    ->where('type', '=', 'file')
    ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
    ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
    ->first(); // there can be duplicate file names!
    //return $file; // array with file info
    $rawData = Storage::cloud()->get($file['path']);
    return response($rawData, 200)
    ->header('ContentType', $file['mimetype'])
    ->header('Content-Disposition', "attachment; filename='$filename'");
    }

    public function downloadZip($state)
    {
        $state_selected = State::findOrFail($state);

        $files = Repository::where('state_id', $state_selected->id)->get();

        $zipname = public_path('myFiles/').$state_selected->key.('/').$state_selected->key.'_'.'repository'.'.zip';

        // Initializing PHP class
        $zip = new \ZipArchive();

        $zip->open($zipname, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        foreach ($files as $file) {
          //
          $filename = $file->document;

          if (!Storage::disk('my_files')->exists($state_selected->key.('/').$filename)) {
            //
            $dir = '/';
            $recursive = true; // Get subdirectories also?
            $contents = collect(Storage::cloud()->listContents($dir, $recursive));

            $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!
            //return $file; // array with file info
            $rawData = Storage::cloud()->get($file['path']);
            Storage::disk('my_files')->put($state_selected->key.('/').$filename, $rawData);
            //
          }
            $zip->addFile(public_path('myFiles/').$state_selected->key.('/').$filename);
        }

        $zip->close();

        return response()->download(public_path('myFiles/').$state_selected->key.('/').$state_selected->key.'_'.'repository'.'.zip', 'repository.zip');
    }
}
