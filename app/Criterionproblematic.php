<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Criterionproblematic extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'problematicbycriterion1', 
        'problematicbycriterion2', 
        'problematicbycriterion3', 
        'problematicbycriterion4', 
        'problematicbycriterion5', 
        'problematicbycriterion6', 
        'problematicbycriterion7', 
        'problematicbycriterion8', 
        'problematicbycriterion9', 
        'problematicbycriterion10', 
        'problematicbycriterion11', 
        'problematicbycriterion12', 
        'problematicbycriterion13', 
        'problematicbycriterion14', 
        'problematicbycriterion15', 
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
