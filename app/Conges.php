<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conges extends Model
{
    protected $fillable = ['employer_id' , 'starting_day' , 'date_fin' , 'nom' ];
}
