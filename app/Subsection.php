<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Subsection extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'decision_id', 
        'ambit_id',
        'criterion_id',
        'source_id',
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

    public function source()
    {
        return $this->belongsTo('App\Source');
    }
}
