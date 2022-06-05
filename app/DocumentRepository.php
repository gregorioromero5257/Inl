<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
class DocumentRepository extends Model
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'name', 
        'type', 
        'document',
    ];

    
}
