<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Indicator extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'id',
        'name', 
        'desirable_range', 
        'decision_id', 
        'num',
        'dividend',
        'divider',
        'collapsed',
    ];

    public function decision()
    {
        return $this->belongsTo('App\Decision');
    }

    public function interpretation_guides()
    {
        return $this->hasMany('App\InterpretationGuide');
    }
}
