<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;

class DataLoaded extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'state_id',
        'percentage',
        'type',
    ];
    protected $table = 'data_loaded';
}
