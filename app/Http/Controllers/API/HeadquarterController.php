<?php

namespace App\Http\Controllers\API;

use App\Headquarter;
use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Utilidades;

class HeadquarterController extends Controller
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

    public function index(Request $request) {
        $state = $request->state;
        return Headquarter::whereIn('state_id', function($query) use($state) {
            $query->select('id')
                ->from((new State)->getTable())
                ->where('key', $state);
        })->get();
    }

    public function store(Request $request) {
        $state = State::where('key', $request->state)->first();

        return $state->headquarters()->create([
            'name' => $request->name,
            'city_halls' => $request->city_halls,
            'agents' => $request->agents
        ]);
    }

    public function update(Request $request, $id) {
      try {

        $headquarter = Headquarter::findOrFail($id);
        $headquarter->fill($request->all());
        Utilidades::auditar($headquarter, $headquarter->id);
        $headquarter->save();
        return $headquarter;

      } catch (\Throwable $e) {
        Utilidades::errors($e);
        return response()->json(['error' => 'Error.'],400);
      }
    }

    public function destroy($id) {
        $headquarter = Headquarter::findOrFail($id);
        $headquarter->delete();
        return $headquarter;
    }

      public function getbystate($id)
    {
      $state = State::where('key',$id)->first();

      $headquarter = Headquarter::where('state_id',$state->id)->first();
      return $headquarter;
    }

    public function deleteheadquarters($id)
    {
      $headquarter = Headquarter::where('id',$id)->delete();
      return response()->json(['status' => true]);
    }
}
