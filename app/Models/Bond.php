<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bond extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'ocupation_id', 'begin', 'end', 'course_id', 'pole_id'];

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

    public function rules()
    {

        $rules = [
            'person_id' => 'required|exists:people,id',
            'ocupation_id' => 'required|exists:ocupations,id',
            'begin-date' => 'required|date_format:Y-m-d',
            'begin-time' => 'required|date_format:H:i:s',
            'end-date' => 'nullable|date_format:Y-m-d|after_or_equal:begin-date',
            'end-time' => 'required_with:end-date|date_format:H:i:s',
            'course_id' => 'nullable|exists:courses,id',
            'pole_id' => 'nullable|exists:poles,id'
        ];

        return $rules;
    }

    public function feedback()
    {
        return [
            //genericos
            'required' => 'O campo é obrigatório.',
            //especificos
            'person_id.exists' => 'O colaborador não existe no banco de dados.',
            'ocupation_id.exists' => 'A ocupação não existe no banco de dados.',

            'begin-date.date_format' => 'O campo deve ser no formato DD/MM/AAAA.',

            'begin-time.date_format' => 'O campo deve ser no formato HH:MM:SS.',

            'end-date.date_format' => 'O campo deve ser no formato DD/MM/AAAA.',
            'end-date.after_or_equal' => 'O campo deve ser menor que data de início.',

            'end-time.required_with' => 'O campo é obrigatório se data é declarada.',
            'end-time.date_format' => 'O campo deve ser no formato HH:MM:SS.',
            'end-time.after_or_equal' => 'O campo deve ser menor que tempo de início.',

            'course_id.exists' => 'O curso não existe no banco de dados.',
            'pole_id.exists' => 'O local não existe no banco de dados.',
        ];
    }
}
