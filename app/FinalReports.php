<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class FinalReports extends Model
{
    use HasApiTokens;
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'state_id',
        'name',
        'type',
        'document',
        'languaje',
        'type_report',
        'active'
    ];
    public function states()
    {
        return $this->belongsTo('App\State','state_id');
    }
}
