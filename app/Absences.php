<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absences extends Model
{
    protected $fillable = ['cin' , 'name' , 'email' , 'absenter' , 'jusqua' , 'certificat'];
}
