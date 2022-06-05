<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class State extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'key', 'name'
    ];

    public function quantitative_source()
    {
        return $this->hasOne('App\QuantitativeSource');
    }

    public function problematic()
    {
        return $this->hasOne('App\Problematic');
    }

    public function criterion_problematic()
    {
        return $this->hasOne('App\Criterionproblematic');
    }

    public function conclusion()
    {
        return $this->hasOne('App\Conclusion');
    }

    public function interpretation()
    {
        return $this->hasOne('App\Interpretation');
    }

    public function documents() {
        return $this->hasMany(Document::class);
    }

    public function headquarters() {
        return $this->hasMany(Headquarter::class);
    }

    public function all_headquarters() {
        return $this->hasMany(AllHeadquarters::class);
    }

    public function observations() {
        return $this->hasMany(Observation::class);
    }

    public function criterion_conclusions() {
        return $this->hasMany(CriterionConclusions::class)->with('criterion')->with('decision')->with('conclusion_probletic_ambit');
    }

    public function subsections() {
        return $this->hasMany(Subsection::class);
    }

    public function crime_contexts() {
        return $this->hasOne(CrimeContext::class);
    }

    public function sociodemographic_contexts() {
        return $this->hasOne(SociodemographicContext::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function repositories()
    {
        return $this->hasMany(Repository::class);
    }
}
