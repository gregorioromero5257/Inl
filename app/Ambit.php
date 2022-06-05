<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Ambit extends Model
{
    //
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'num',
    ];

    public function subsections() {
       return $this->hasMany(Subsection::class);
    }
}
