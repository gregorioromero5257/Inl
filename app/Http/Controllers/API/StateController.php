<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\State;
use App\DataLoaded;
use App\User;
use Illuminate\Support\Facades\DB;
use Mail;

class StateController extends Controller
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
        // show all states in DB
        return State::query()->orderBy('name','asc')->where('round','1')->get();
    }

    public function statetwo()
    {
        // show all states in DB
        return State::query()->orderBy('name','asc')->where('round','2')->get();
    }

    public function stateall()
    {
      return State::query()->orderBy('name','asc')->get();
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
        // get single state
        return State::with('observations')->with('quantitative_source')->with('repositories')->with('problematic')->with('criterion_problematic')->with('criterion_conclusions')->with('conclusion')->with('interpretation')->with('headquarters')->with('all_headquarters')->with('documents')->with('crime_contexts')->with('sociodemographic_contexts')->find($id);
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

    public function statebykey($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();
        if (!$stateSelected)
            return abort(404);
        return State::with('observations')->with('quantitative_source')->with('repositories')
        ->with('problematic')->with('criterion_problematic')->with('criterion_conclusions')->with('conclusion')
        ->with('interpretation')->with('headquarters')->with('all_headquarters')->with('documents')
        ->with('crime_contexts')->with('sociodemographic_contexts')->find($stateSelected->id);
    }

    public function statedocumentaryinformation($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();
        if (!$stateSelected)
            return abort(404);

        $result =  State::with('documents')->find($stateSelected->id);

        return $result;
    }

    public function statequantitativesource($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();
        if (!$stateSelected)
            return abort(404);

        $result =  State::with('quantitative_source')->find($stateSelected->id);

        return $result;
    }

    public function indicatorsbydecision($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();
        if (!$stateSelected)
            return abort(404);

        $result =  State::with('quantitative_source')->with('interpretation')->find($stateSelected->id);

        return $result;
    }

    public function statedata($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();

        return $stateSelected;
    }

    public function observationssourcecriterion($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();
        if (!$stateSelected)
            return abort(404);

        $result =  State::with('criterion_conclusions')->with('observations')->with('headquarters')->find($stateSelected->id);

        return $result;
    }

    public function observationsbyambit($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();
        if (!$stateSelected)
            return abort(404);

        $result =  State::with('problematic')->with('conclusion')->with('criterion_conclusions')->find($stateSelected->id);

        return $result;
    }

    public function problematicbycriterion($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();
        if (!$stateSelected)
            return abort(404);

        $result =  State::with('criterion_conclusions')->with('criterion_problematic')->find($stateSelected->id);

        return $result;
    }

    public function statebykeysingle($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();
        $dataLoadeP = DataLoaded::where('state_id',$stateSelected->id)
        ->select(DB::raw("SUM(percentage) AS percentage_cantidad"))
        ->first();

        $total =  DataLoaded::where('state_id',$stateSelected->id)->count();

        $avance = (($dataLoadeP->percentage_cantidad * 100) / ($total * 100));

        if (!$stateSelected)
            return abort(404);
        return ['data' => $stateSelected,'percentage' => $avance];
    }

    public function getcpoc($state)
    {
        // get state by key
        $stateSelected = State::where('key', $state)->first();
        if (!$stateSelected)
            return abort(404);
            $stateSelected = DataLoaded::where('state_id', $stateSelected->id)
            ->whereIn('type',['conclusions','problematics','observations','criterion_conclusion'])->get();

        return $stateSelected;
    }

    public function getdocumentstate($state)
    {
      $state_f = State::where('key', $state)->select('id')->first();
      $stateSelected = DataLoaded::where('state_id', $state_f->id)->orderBy('type')->get();

      return $stateSelected;
    }

    public function getquantitativesource($state)
    {
      $stateSelected = State::where('key', $state)->first();
      if (!$stateSelected)
          return abort(404);
          return DataLoaded::where('state_id',$stateSelected->id)->where('type','cuanti')->first();
    }

    public function sendendstate(Request $request)
    {
      $stateSelected = State::where('id', $request->state_id)->first();
      $stateSelected->end = $request->check;
      $stateSelected->save();
      // DataLoaded
      $dataLoade = DataLoaded::where('state_id',$request->state_id)->get();
      foreach ($dataLoade as $key_dl => $value_dl) {
        if ($value_dl->percentage < 100) {
          $dataLoade_edit = DataLoaded::where('id',$value_dl->id)->first();
          $dataLoade_edit->percentage = 100;
          $dataLoade_edit->save();
        }
      }
      //send email
      if ($request->check) {

        $users = User::where('is_active',1)
        ->where('type','LIKE','director')
        ->orWhere('type','LIKE','fortis_director')
        ->orWhere('type','LIKE','coordinator')
        ->get();

        foreach ($users as $key_user => $user) {
          $mensaje = 'Estatus '.$stateSelected->name.' INL';
          $data = [
            'nombre' => $user->name,
            'email' => $user->email,
            'estado' => $stateSelected->name,
            'ronda' => $stateSelected->round
          ];
          Mail::send('emails.end', $data, function ($message) use ($data, $mensaje, $user){
            $core = $user->email;
            // $core = 'romerovelascogregorio@gmail.com';
            // $core = 'jcastillo@c-230.com';
            $message->to($core, $mensaje)
            ->subject($mensaje);
            $message->from('soluciones.digitales.c230@gmail.com', 'INL');
            $message->attach(public_path().'/herramientalogo_dark_big.png');
          });
        }

      }

      return ['status' => true];
    }
}
