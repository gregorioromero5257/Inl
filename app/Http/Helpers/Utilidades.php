<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\DataLoaded;

class Utilidades
{

  /**
   * Metodo para auditar los cambios de valores de las propiedades de los objetos.
   * Se comparan los valores de los atributos con sus valores originales
   * Los campos que tiene un nuevo valor se registrar en el Log auditoria
   * @param objeto extiende de la clase Model
   * @param var el identificador de la entidad fuerte
   */

  public static function auditar($objeto, $id)
  {


    $modelo =  substr(strrchr(get_class($objeto), "\\"), 1);
    $tabla = $objeto->getTable();

      $nombre = Auth::user();
    $resultado = array_diff_assoc($objeto->getAttributes(), $objeto->getoriginal());
    foreach ($resultado as $key => $item)
    {
      Log::channel('auditoria')->debug(json_encode([
        'id' => $id,
        'u' => $nombre,
        'm' => $modelo,
        'c' => $key,
        'o' => $objeto->getOriginal($key) . '',
        'n' => $item . ''
      ]));
    }
  }



  public static function errors($e)
  {

    $nombre =  Auth::user();
    // dd(Auth::user()->name);
    $m = $e->getMessage();
    $f = $e->getFile();
    $l = $e->getLine();
    Log::channel('errors')->debug(json_encode([
      'mensaje' => $m,
      'file' => $f,
      'line' => $l,
      'user' => $nombre,
    ]));
  }

  public static function LoadedData($c, $type, $state, $method){
    if ($method == 'sum') {

      switch ($type) {

        case 'map':
          $map_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
          if (isset($map_loaded_data)) {
              $map_loaded_data->percentage = 100;
              $map_loaded_data->registered_amount = $map_loaded_data->registered_amount + 1;
              $map_loaded_data->save();
          }else {
            $dataLoadedm = new DataLoaded();
            $dataLoadedm->state_id = $state;
            $dataLoadedm->percentage = 100;
            $dataLoadedm->total_amount = 1;
            $dataLoadedm->registered_amount = 1;
            $dataLoadedm->type = 'map';
            $dataLoadedm->save();
          }
          break;

        case 'org':
          $org_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
          if (isset($org_loaded_data)) {
              $org_loaded_data->percentage = 100;
              $org_loaded_data->registered_amount = $org_loaded_data->registered_amount + 1;
              $org_loaded_data->save();
          }else {
            $dataLoadedo = new DataLoaded();
            $dataLoadedo->state_id = $state;
            $dataLoadedo->percentage = 100;
            $dataLoadedo->total_amount = 1;
            $dataLoadedo->registered_amount = 1;
            $dataLoadedo->type = 'org';
            $dataLoadedo->save();
          }
          break;

          case 'head':
            $head_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
            if (isset($head_loaded_data)) {
                $head_loaded_data->percentage = 100;
                $head_loaded_data->registered_amount = $head_loaded_data->registered_amount + 1;
                $head_loaded_data->save();
            }else {
              $dataLoadedh = new DataLoaded();
              $dataLoadedh->state_id = $state;
              $dataLoadedh->percentage = 100;
              $dataLoadedh->total_amount = 1;
              $dataLoadedh->registered_amount = 1;
              $dataLoadedh->type = 'head';
              $dataLoadedh->save();
            }
            break;

            case 'cuanti':
            $cuanti_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
              $progress = (( $c * 100) / $cuanti_loaded_data->total_amount);
              $cuanti_loaded_data->percentage = $progress;
              $cuanti_loaded_data->registered_amount = $c;
              // $this->auditar($cuanti_loaded_data, $cuanti_loaded_data->id);



              $cuanti_loaded_data->save();
            break;

            case 'conclusions':
            $conclusion_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
            $porcertage_conclusions = round(($c/$conclusion_loaded_data->total_amount) * 100);//conclusions
            $conclusion_loaded_data->percentage = $porcertage_conclusions > 100 ? 100 : $porcertage_conclusions;
            $conclusion_loaded_data->registered_amount = $c;
            $conclusion_loaded_data->save();
            break;

            case 'problematics':
            $problematics_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
            $porcertage_conclusions = round(($c/$problematics_loaded_data->total_amount) * 100);//conclusions
            $problematics_loaded_data->percentage = $porcertage_conclusions > 100 ? 100 : $porcertage_conclusions;
            $problematics_loaded_data->registered_amount = $c;
            $problematics_loaded_data->save();
            break;

            case 'observations':

            $observations_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
            $observations_loaded_data->registered_amount = $observations_loaded_data->registered_amount + 1;
            $observations_loaded_data->save();

            $porcertage_observations = round(($observations_loaded_data->registered_amount/$observations_loaded_data->total_amount) * 100);//observations

            $observations_loaded_data->percentage = $porcertage_observations;
            $observations_loaded_data->save();
            break;

      }

    }elseif ($method == 'res') {

      switch ($type) {

        case 'map':
        $map_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
        $map_loaded_data->registered_amount = $map_loaded_data->registered_amount - 1;
        $map_loaded_data->save();
        if ($map_loaded_data->registered_amount == 0) {
          $map_loaded_data->percentage = 0;
          $map_loaded_data->save();
        }
        break;

        case 'org':
        $org_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
        $org_loaded_data->registered_amount = $org_loaded_data->registered_amount - 1;
        $org_loaded_data->save();
        if ($org_loaded_data->registered_amount == 0) {
          $org_loaded_data->percentage = 0;
          $org_loaded_data->save();
        }
        break;

        case 'head':
        $head_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
        $head_loaded_data->registered_amount = $head_loaded_data->registered_amount - 1;
        $head_loaded_data->save();
        if ($head_loaded_data->registered_amount == 0) {
          $head_loaded_data->percentage = 0;
          $head_loaded_datas->save();
        }
        break;
        case 'observations':

        $observations_loaded_data = DataLoaded::where('state_id',$state)->where('type',$type)->first();
        $observations_loaded_data->registered_amount = $observations_loaded_data->registered_amount - 1;
        $observations_loaded_data->save();

        $porcertage_observations = round(($observations_loaded_data->registered_amount/$observations_loaded_data->total_amount) * 100);//observations

        $observations_loaded_data->percentage = $porcertage_observations;
        $observations_loaded_data->save();
        break;
      }

    }
  }
}
