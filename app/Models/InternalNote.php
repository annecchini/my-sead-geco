<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class InternalNote extends Model
{
    use HasFactory;

    protected $fillable = ['last_up_person_id', 'model_name', 'model_id', 'content'];

    static protected $allowedModels = [
        'App\Models\User',
        'App\Models\Person',
        'App\Models\Bond'
    ];

    public function lastUpdatePerson()
    {
        return $this->belongsTo('App\Models\Person', 'last_up_person_id');
    }

    public function getNoteTarget()
    {
        $model = app($this->model_name)->findOrFail($this->model_id);
        return $model;
    }

    public function rules($data = [])
    {
        //model_name rules
        $model_name_rules = ['required', Rule::in($this::$allowedModels)];

        //model_id rules
        $model_id_rules = ['required'];
        if (
            isset($data['model_name'])
            && in_array($data['model_name'], $this::$allowedModels)
        ) {
            $model = app($data['model_name']);
            array_push($model_id_rules, 'exists:' . $model->getTable() . ',id');
        }

        $rules = [
            'model_name' => $model_name_rules,
            'model_id' =>  $model_id_rules,
            'last_up_person_id' => 'required|exists:people,id',
            'content' => 'required'
        ];

        return $rules;
    }

    public function feedback()
    {
        $feedback = [
            //genericos
            'required' => 'O campo é obrigatório.',
            //especificos
            'model_name.in' => 'Modelo não permitido.',
            'model_id.exists' =>  'O elemento não existe no banco de dados.',
            'last_up_person_id' => 'O colaborador não existe no banco de dados.'
        ];

        return $feedback;
    }
}
