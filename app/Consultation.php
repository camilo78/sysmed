<?php

namespace App;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;

class Consultation extends Model
{
    use Eloquence;
    use FormAccessible;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'date', 'setting_id','patient_id','user_id','insurace','company','policy','relation','height','height_unit','weight','weight_unit',
        'temp','temp_unit','cranial','cranial_unit','waist','waist_unit','pressure','cardiac','breathing'
        ,'measurements_note',
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function setting()
    {
        return $this->belongsTo('App\Setting');
    }

    public function medicine(){
        return $this->belongsToMany(Medicine::class);
    }
}
