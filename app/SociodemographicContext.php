<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class SociodemographicContext extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'state_id',
        'variable1',
        'variable2',
        'variable3',
        'variable4',
        'variable5',
        'variable6',
        'variable7',
        'variable8',
        'variable9',
        'variable9_s1',
        'clasification1',
        'clasification2',
        'clasification3',
        'clasification4',
        'clasification5',
        'clasification6',
        'clasification7',
        'clasification8',
        'clasification9',
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
