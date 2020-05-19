<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Sofa\Eloquence\Eloquence;


class Setting extends Model
{

	use FormAccessible;
	use Eloquence;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','name', 'image', 'address','phone','web'
    ];

    public function consultations()
    {
        return $this->hasMany('App\Consultation');
    }}
