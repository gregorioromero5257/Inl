<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class CriterionConclusions extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'state_id',
        'decision_id',
        'ambit_id',
        'criterion_id',
        'conclusion'
    ];

    public function decision()
    {
        return $this->belongsTo('App\Decision');
    }

    public function ambit()
    {
        return $this->belongsTo('App\Ambit');
    }

    public function criterion()
    {
        return $this->belongsTo('App\Criterion');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function conclusion_probletic_ambit()
    {
        return $this->hasMany('App\ConclusionProblematicAmbit');
    }
}
