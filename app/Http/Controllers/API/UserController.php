<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App\Mail\UserUpdated;


class UserController extends Controller
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
    // $this->authorize('isAdmin');
    if (\Gate::allows('isDirector') || \Gate::allows('isFortisDirector')) {
      return User::with('states')->latest()->get();
    }

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

    $this->validate($request,[
      'name' => 'required|string|max:191',
      'username' => 'required|string|string|max:191|unique:users',
      'password' => 'required|string|min:6'
    ]);

    $name = $request['name'];
    $email = $request['email'];
    $password = $request['password'];
    Mail::to($email)->send(new UserCreated($name, $email, $password));

    return User::create([
      'name' => $request['name'],
      'username' => $request['username'],
      'domain' => $request['domain'],
      'email' => $request['email'],
      'type' => $request['type'],
      'bio' => $request['bio'],
      'photo' => $request['photo'],
      'password' => Hash::make($request['password']),
      'is_active' =>$request['is_active'],
    ]);


  }


  public function updateProfile(Request $request, $id = 0)
  {
    $user = User::with('states')->findOrFail($request->id);

    $this->validate($request,[
      'name' => 'required|string|max:191',
      // 'username' => 'required|string|string|max:191|unique:users,username,'.$user->id,
      'password' => 'sometimes|min:6'
    ]);


    $currentPhoto = $user->photo;


    if($request->photo != $currentPhoto){
      $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

      \Image::make($request->photo)->save(public_path('img/profile/').$name);
      $request->merge(['photo' => $name]);

      $userPhoto = public_path('img/profile/').$currentPhoto;
      if(file_exists($userPhoto)){
        @unlink($userPhoto);
      }

    }


    if(!empty($request->password)){
      $name_updated = $request['name'];
      $email_updated = $request['email'];
      $password_updated = $request['password'];
      // Mail::to($email_updated)->send(new UserUpdated($name_updated, $email_updated, $password_updated));

      $request->merge(['password' => Hash::make($request['password'])]);
    }

    $user->update($request->all());
    return ['message' => 'Updated the user info'];
  }


  public function profile()
  {
    return auth('api')->user();
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $user = User::with('states')->findOrFail($id);

    return $user;
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

    $user = User::findOrFail($id);

    $this->validate($request,[
      'name' => 'required|string|max:191',
      // 'username' => 'required|string|string|max:191|unique:users,username,'.$user->id,
      'password' => 'sometimes|min:6'
    ]);

    if(!empty($request->password)){
      $name_updated = $request['name'];
      $email_updated = $request['email'];
      $password_updated = $request['password'];
      // Mail::to($email_updated)->send(new UserUpdated($name_updated, $email_updated, $password_updated));

      $request->merge(['password' => Hash::make($request['password'])]);
    }

    $user->update($request->all());
    return ['message' => 'Updated the user info'];
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $this->authorize('isDirector');
    $user = User::findOrFail($id);
    // delete the user
    $user->delete();
    return ['message' => 'User Deleted'];
  }

  public function search(){
    if ($search = \Request::get('q')) {
      $users = User::where(function($query) use ($search){
        $query->where('name','LIKE',"%$search%")
        ->orWhere('username','LIKE',"%$search%");
      })->paginate(20);
    }else{
      $users = User::latest()->paginate(5);
    }
    return $users;
  }

  public function export()
  {
    return Excel::download(new UsersExport, 'users.xlsx');
  }

  public function import()
  {
    Excel::import(new UsersImport, 'users.xlsx', 'my_files', \Maatwebsite\Excel\Excel::XLSX);

    return ['message' => 'Users imported!'];
  }

  public function addStates(Request $request, $id)
  {
    $user = User::findOrFail($id);

    $user->states()->detach();

    $states = $request['states'];

    $user->states()->attach($states);

    return ['message' => 'States attached to user!'];
  }

  public function userActiveDesactive(Request $request)
  {
    $user = User::findOrFail($request->id);
    $user->is_active = $request->is_active;
    $user->save();

    return ['message' => 'Updated the user info'];
  }
}
