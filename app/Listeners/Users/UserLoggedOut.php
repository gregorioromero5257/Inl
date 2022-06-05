<?php

namespace App\Listeners\Users;

use Illuminate\Queue\SerializesModels;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class UserLoggedOut
{
  use SerializesModels;

  /**
  * The authentication guard name.
  *
  * @var string
  */
  public $guard;

  /**
  * The authenticated user.
  *
  * @var \Illuminate\Contracts\Auth\Authenticatable
  */
  public $user;

  /**
  * Create a new event instance.
  *
  * @param  string $guard
  * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
  * @return void
  */
  public function __construct()
  {

  }

  public function handle(Logout $event)
  {

    $event->user->is_active = 0;
    $event->user->save();

  }
}
