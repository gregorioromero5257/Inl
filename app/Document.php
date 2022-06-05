<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;

class Document extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'path',
        'url',
        'file_name',
        'type',
    ];
}
