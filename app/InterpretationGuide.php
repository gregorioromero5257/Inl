<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class InterpretationGuide extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'id',
        'indicator_id', 
        'type',
        'text',
    ];

    public function indicator()
    {
        return $this->belongsTo('App\Indicator');
    }
}
