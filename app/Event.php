<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

   

    protected $fillable = [
        'title',
        'start',
        'end',
    ]; 
    
}
