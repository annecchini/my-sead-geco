<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cpf'];

    public function me(){
        return $this;
    }

    public function rules() {
        return [
            'nome' => 'required|min:3',
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
            'nome.min' => 'O campo nome deve possuir no mínimo 3 caracteres.',
            'cpf.cpf' => 'O cpf informado é inválido.',
            'cpf.unique' => 'O cpf já existe no banco de dados.'
        ];
    }
}
