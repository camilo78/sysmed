<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'consultations_id','medicines_id',
    ];
    public function consultations(){
        return $this->belongsToMany(Consultations::class);
    }
}
