<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;

class AllHeadquarters extends Model
{
    use HasApiTokens;

    protected $fillable = ['name', 'city_halls', 'agents', 'state_id','evaluate'];
}
