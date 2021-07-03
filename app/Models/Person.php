<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Person extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['person_id', 'name', 'cpf'];
    protected $auditInclude = ['person_id', 'name', 'cpf'];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document');
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'cpf' => 'required|cpf|unique:people,cpf,' . $this->id . '',
        ];
    }

    public function feedback()
    {
        return [
            //genericos
            'required' => 'O campo é obrigatório.',
            'min' => 'O campo deve possuir no mínimo 3 caracteres.',
            'unique' => 'O valor já existe no banco de dados.',
            //especificos
            'name.min' => 'O campo nome deve possuir no mínimo 3 caracteres.',
            'cpf.cpf' => 'O cpf informado é inválido.',
            'cpf.unique' => 'O cpf já existe no banco de dados.',
        ];
    }
}
