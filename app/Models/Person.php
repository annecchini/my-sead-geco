<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $fillable = ['person_id', 'name', 'cpf'];

    public function user(){
        return $this->hasOne('App\Models\User');
    }

    public function rules() {
        return [
            'name' => 'required|min:3',
            'cpf' => 'required|cpf|unique:people,cpf,'.$this->id.''
        ];
    }

    public function feedback() {
        return [
            //genericos
            'required' => 'O campo é obrigatório.',
            'min' => 'O campo deve possuir no mínimo 3 caracteres.',
            'unique' => 'O valor já existe no banco de dados.',
            //especificos
            'name.min' => 'O campo nome deve possuir no mínimo 3 caracteres.',
            'cpf.cpf' => 'O cpf informado é inválido.',
            'cpf.unique' => 'O cpf já existe no banco de dados.'
        ];
    }
}
