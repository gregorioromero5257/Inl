<?php

namespace App\Listeners\Users;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UpdateLastLoggedInAt
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

      if ($event->user->is_active == 1) {
        // code...
        return ['status' => 'kkde'];
      }else {
        // code...
        return ['status' => 'olo'];
      }
        // $user=Auth::User()->is_active;
        // if($user=="0"){
            // return Redirect::route('/login');
            // return redirect('/login')->withErrors(array('error' => 'Your account has been disabled because of too many wrong attempts'));
            // return redirect()->route('login');
        // }
        // elseif($user == "1" ){
          // $event->user->last_login_at = Carbon::now();
          // $event->user->save();
        // }
    }
}
