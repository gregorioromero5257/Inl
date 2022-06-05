<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class CrimeContext extends Model
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
        'variable10',
        'variable11',
        'variable12',
        'variable13',
        'variable14',
        'variable15',
        'variable16',
        'variable17',
        'variable18',
        'variable19',
        'clasification1',
        'clasification2',
        'clasification3',
        'clasification4',
        'clasification5',
        'clasification6',
        'clasification7',
        'clasification8',
        'clasification9',
        'clasification10',
        'clasification11',
        'clasification12',
        'clasification13',
        'clasification14',
        'clasification15',
        'clasification16',
        'clasification17',
        'clasification18',
        'clasification19',
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
