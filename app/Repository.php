<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Repository extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'state_id', 
        'name', 
        'type', 
        'document',
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
