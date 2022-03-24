<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bond extends Model
{
    use HasFactory;

    public function status()
    {
        $now = Carbon::now();
        $start = Carbon::createFromFormat('Y-m-d H:i:s', $this->begin);
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $this->end);

        //começou e não tem data para terminar. 
        if (($start <= $now) && ($this->end == null)) return 1;

        //começou e ainda não terminou.
        if (($start <= $now) && ($end >= $now)) return 1;

        // outros casos
        return 0;
    }


    public function ocupation()
    {
        return $this->belongsTo('App\Models\Ocupation', 'ocupation_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Pole', 'pole_id');
    }
}
