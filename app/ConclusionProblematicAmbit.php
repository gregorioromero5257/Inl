<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class ConclusionProblematicAmbit extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'criterion_conclusion_id',
        'conclusion_ambit',
        'problematic_ambit',
        'old'
    ];

    public function criterion_conclusions()
    {
        return $this->belongsTo('App\CriterionConclusions');
    }


}
