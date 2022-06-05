<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Problematic extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'problematic-1-1', 
        'problematic-2-1', 
        'problematic-3-1', 
        'problematic-4-1', 
        'problematic-5-1', 
        'problematic-6-1', 
        'problematic-7-1', 
        'problematic-8-1', 
        'problematic-9-1', 
        'problematic-10-1', 
        'problematic-11-1', 
        'problematic-12-1', 
        'problematic-13-1', 

        'problematic-1-2', 
        'problematic-2-2', 
        'problematic-3-2', 
        'problematic-4-2', 
        'problematic-5-2', 
        'problematic-6-2', 
        'problematic-7-2', 
        'problematic-8-2', 
        'problematic-9-2', 
        'problematic-10-2', 
        'problematic-11-2', 
        'problematic-12-2', 
        'problematic-13-2', 

        'problematic-1-3', 
        'problematic-2-3', 
        'problematic-3-3', 
        'problematic-4-3', 
        'problematic-5-3', 
        'problematic-6-3', 
        'problematic-7-3', 
        'problematic-8-3', 
        'problematic-9-3', 
        'problematic-10-3', 
        'problematic-11-3', 
        'problematic-12-3', 
        'problematic-13-3', 
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
