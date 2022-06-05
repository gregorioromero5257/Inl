<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Support\Str as Str;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\FinalReports;
use App\Http\Helpers\Utilidades;
use Illuminate\Support\Facades\DB;

class FinalReportsController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
      try {
        if ($request->edit == 'true') {
          DB::beginTransaction();

          $report_system = FinalReports::where('id',$request->id)->first();
          $report_system->active = 0;
          Utilidades::auditar($report_system, $report_system->id);
          $report_system->save();


          $state = State::findOrFail($request->state_id);
          $docName = $state->key.'-'.Str::slug($request['name']).'-'.($report_system->id + 1).'.'.$request->document->getClientOriginalExtension();

          $report = new FinalReports();
          $report->name = $request->name;
          $report->type = $request->type;
          $report->document = $docName;
          $report->state_id = $request->state_id;
          $report->languaje = $request->languaje;
          $report->type_report = $request->type_report;
          Utilidades::auditar($report, $report->id);
          $report->save();


          $dir = '/';
              $recursive = false; // Get subdirectories also?



        $fileData = File::get($request->document);


          if ($request->languaje == 'Español') {
              if ($request->type_report == 'Detallado') {
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', 'FilesEspDet')
                ->first(); // There could be duplicate directory names!

                if ( ! $dir) {
                  return 'Directory does not exist!';
                } else {
                  Storage::cloud()->put($dir['path'].'/'.$docName, $fileData);
                }
              }else{
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', 'FilesEspEje')
                ->first(); // There could be duplicate directory names!

                if ( ! $dir) {
                  return 'Directory does not exist!';
                } else {
                  Storage::cloud()->put($dir['path'].'/'.$docName, $fileData);
                }
              }
          }else{
              if ($request->type_report == 'Detallado') {
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', 'FilesEnDet')
                ->first(); // There could be duplicate directory names!

                if ( ! $dir) {
                  return 'Directory does not exist!';
                } else {
                  Storage::cloud()->put($dir['path'].'/'.$docName, $fileData);
                }
              }else{
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', 'FilesEnEje')
                ->first(); // There could be duplicate directory names!

                if ( ! $dir) {
                  return 'Directory does not exist!';
                } else {
                  Storage::cloud()->put($dir['path'].'/'.$docName, $fileData);
                }
              }
          }


          DB::commit();
          return response()->json(['status' => true]);
        }else {
          DB::beginTransaction();
          $docName = '';
          $state = State::findOrFail($request->state_id);
          $report = new FinalReports();
          $report->name = $request->name;
          $report->type = $request->type;
          $report->document = $docName;
          $report->state_id = $request->state_id;
          $report->languaje = $request->languaje;
          $report->type_report = $request->type_report;
          Utilidades::auditar($report, $report->id);
          $report->save();

          $docName = $state->key.'-'.Str::slug($request['name']).'-'.$report->id.'.'.$request->document->getClientOriginalExtension();
          $report->document = $docName;
          Utilidades::auditar($report, $report->id);
          $report->save();

          $dir = '/';
          $recursive = false; // Get subdirectories also?
          $fileData = File::get($request->document);

          if ($request->languaje == 'Español') {
              if ($request->type_report == 'Detallado') {
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', 'FilesEspDet')
                ->first(); // There could be duplicate directory names!

                if ( ! $dir) {
                  return 'Directory does not exist!';
                } else {
                  Storage::cloud()->put($dir['path'].'/'.$docName, $fileData);
                }
              }else{
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', 'FilesEspEje')
                ->first(); // There could be duplicate directory names!

                if ( ! $dir) {
                  return 'Directory does not exist!';
                } else {
                  Storage::cloud()->put($dir['path'].'/'.$docName, $fileData);
                }
              }
          }else{
              if ($request->type_report == 'Detallado') {
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', 'FilesEnDet')
                ->first(); // There could be duplicate directory names!

                if ( ! $dir) {
                  return 'Directory does not exist!';
                } else {
                  Storage::cloud()->put($dir['path'].'/'.$docName, $fileData);
                }
              }else{
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', 'FilesEnEje')
                ->first(); // There could be duplicate directory names!

                if ( ! $dir) {
                  return 'Directory does not exist!';
                } else {
                  Storage::cloud()->put($dir['path'].'/'.$docName, $fileData);
                }
              }
          }

          DB::commit();
          return response()->json(['status' => true]);
        }
      } catch (\Throwable $e) {
        DB::rollBack();
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }



    }
    /**
     * download file from repository.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadFile($id)
    {
      // $resource = Resource::findOrFail($id);
      $resource = FinalReports::findOrFail($id);

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


        // $file = FinalReports::findOrFail($id);
        //
        // $state = State::findOrFail($file->state_id);
        //
        // if ($file->languaje=='Español') {
        //    $languaje = 'es';
        // }else{
        //     $languaje = 'en';
        // }
        // $ruta = 'finalReports/'.$languaje.('/').$file->type_report.('/').$state->key.('/');
        // $archivo = Storage::disk('local')->get($ruta.$file->document);
        // // Se coloca el archivo en una ruta local
        // Storage::disk('descarga')->put($file->document, $archivo);
        // //--Devuelve la respuesta y descarga el archivo--//
        // return response()->download(storage_path().'/app/descargas/'.$file->document);
        // // return Response::download(public_path('finalReports/').$languaje.('/').$file->type_report.('/').$state->key.('/').$file->document, $file->document);

    }


    public function deletetemporal($id)
    {
      //elimina de la ruta local el archivo descargado
      Storage::disk('descarga')->delete($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return FinalReports::with('states')->where('state_id','=',$id)->where('active','1')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        dump($request->all());

    }

    public function updateReport(Request $request,$id){
      try {



        $this->validate($request,[
            'name' => 'required|string',
            'type' => 'required'
        ]);

        $report = FinalReports::findOrFail($id);
        $state = State::findOrFail($report->state_id);
        $languaje = $report->languaje;
        $type = $report->type_report;

        if ($report->languaje=='Español') {
            $languaje = 'es';
         }else{
             $languaje = 'en';
         }

        $file = public_path('finalReports/').$languaje.('/').$report->type_report.('/').$state->key.('/').$report->document;
        // if(file_exists($file)){
        //     @unlink($file);
        // }
        $docName = $state->key.'-'.Str::slug($request['name']).'.'.$request->document->getClientOriginalExtension();

        if ($report->languaje == 'Español') {
            if ($report->type_report == 'Detallado') {
            Storage::putFile('finalReports/es/Detallado/'.$state->key.'/'.$docName, $request->file('document'));
                // $request->document->move(public_path('finalReports/es/Detallado/').$state->key, $docName);
            }else{
                $request->document->move(public_path('finalReports/es/Ejecutivo/').$state->key, $docName);
            }
        }else{
            if ($report->type_report == 'Detallado') {
                $request->document->move(public_path('finalReports/en/Detallado/').$state->key, $docName);
            }else{
                $request->document->move(public_path('finalReports/en/Ejecutivo/').$state->key, $docName);
            }
        }

        $updateReport = FinalReports::find($id);
        $updateReport->name = $request->name;
        $updateReport->type = $request->type;
        $updateReport->document = $docName;
        Utilidades::auditar($updateReport, $updateReport->id);
        $updateReport->save();

        return ['message' => 'report updated'];
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

    public function dowloadMap(Request $request){
        $filepath = public_path('myFiles/').$request->data;
        if ( $filepath ) {
            return Response::download($filepath);
        }

    }
    public function dowloadOrganization(Request $request){
        $filepath = public_path('myFiles/').$request->data;
        if ( $filepath ) {
            return Response::download($filepath);
        }
    }
}
