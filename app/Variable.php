<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Variable extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'name', 
        'num',
        'source',
        'slug_2018',
        'check_slug_2018',
        'slug_2017',
        'check_slug_2017',
    ];

    public function interpretation_guides() {
        return $this->hasMany(InterpretationGuide::class);
    }
}
