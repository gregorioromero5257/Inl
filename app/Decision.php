<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Decision extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name' , 'num', 'collapsed', 'observations_collapsed','round'
    ];

    public function subsections() {
        return $this->hasMany(Subsection::class);
    }

    public function indicators() {
        return $this->hasMany(Indicator::class)->with('interpretation_guides');
    }
}
