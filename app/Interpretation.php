<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Interpretation extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'state_id',
        'interpretation1',
        'interpretation2',
        'interpretation3',
        'interpretation4',
        'interpretation5',
        'interpretation6',
        'interpretation7',
        'interpretation8',
        'interpretation9',
        'interpretation10',
        'interpretation11',
        'interpretation12',
        'interpretation13',
        'interpretation14',
        'interpretation15',
        'interpretation16',
        'interpretation17',
        'interpretation18',
        'interpretation19',
        'interpretation20',
        'interpretation21',
        'interpretation22',
        'interpretation23',
        'interpretation24',
        'interpretation25',
        'interpretation26',
        'interpretation27',
        'interpretation28',
        'interpretation29',
        'interpretation30',
        'interpretation31',
        'interpretation32',
        'interpretation33',
        'interpretation34',
        'interpretation35',
        'interpretation36',
        'data',
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
