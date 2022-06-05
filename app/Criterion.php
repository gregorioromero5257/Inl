<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Criterion extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'collapsed'
    ];

    public function subsections() {
        return $this->hasMany(Subsection::class);
    }
}
