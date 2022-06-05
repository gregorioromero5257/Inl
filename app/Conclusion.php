<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Conclusion extends Model
{
    use HasApiTokens;

        /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'conclusion-1-1', 
        'conclusion-2-1', 
        'conclusion-3-1', 
        'conclusion-4-1', 
        'conclusion-5-1', 
        'conclusion-6-1', 
        'conclusion-7-1', 
        'conclusion-8-1', 
        'conclusion-9-1', 
        'conclusion-10-1', 
        'conclusion-11-1', 
        'conclusion-12-1', 
        'conclusion-13-1', 

        'conclusion-1-2', 
        'conclusion-2-2', 
        'conclusion-3-2', 
        'conclusion-4-2', 
        'conclusion-5-2', 
        'conclusion-6-2', 
        'conclusion-7-2', 
        'conclusion-8-2', 
        'conclusion-9-2', 
        'conclusion-10-2', 
        'conclusion-11-2', 
        'conclusion-12-2', 
        'conclusion-13-2', 

        'conclusion-1-3', 
        'conclusion-2-3', 
        'conclusion-3-3', 
        'conclusion-4-3', 
        'conclusion-5-3', 
        'conclusion-6-3', 
        'conclusion-7-3', 
        'conclusion-8-3', 
        'conclusion-9-3', 
        'conclusion-10-3', 
        'conclusion-11-3', 
        'conclusion-12-3', 
        'conclusion-13-3', 
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
