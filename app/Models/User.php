<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;


class User extends Authenticatable implements Auditable
{
    use HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;

    protected $auditInclude = [
        'person_id',
        'email',
        'password',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'name',
        'person_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function person(){
        return $this->belongsTo('App\Models\Person');
    }

    public function rules($options = []) {

        $rules = [
            'person_id' => 'required|exists:people,id',
            'email' => 'required|email|unique:users,email,'.$this->id.'',
            'password' => 'required|min:8'
        ];

        if( isset($options['password']) && $options['password'] === false){
            unset($rules['password']);
        }

        return $rules;
    }

    public function feedback() {
        return [
            //genericos
            'required' => 'O campo é obrigatório.',
            'min' => 'O campo deve possuir pelo menos :min caracteres.',
            'unique' => 'O valor já existe no banco de dados.',
            'email' => 'O campo deve ser um e-mail.',
            'exists' => 'O valor não existe no banco de dados.',
            //especificos
            'person_id.exists' => 'O colaborador não existe no banco de dados.',
            'email.unique' => 'O email já existe no banco de dados.',
            'password.min' => 'A senha deve possuir pelo menos :min caracteres.'
        ];
    }
}
