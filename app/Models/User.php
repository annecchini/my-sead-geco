<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Kyslik\ColumnSortable\Sortable;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\ModelFilters\UserFilters;
use Illuminate\Support\Str;

class User extends Authenticatable implements Auditable
{
    use HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;
    use Filterable, UserFilters;
    use Sortable;

    protected $auditInclude = [
        'person_id',
        'email',
        'password',
    ];

    public $sortable = ['id', 'email', 'created_at', 'updated_at'];

    public static $accepted_filters = [
        'email_like',
        'person_like'
    ];
    private static $whiteListFilter = ['*'];

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

    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function rules($options = [])
    {

        $rules = [
            'person_id' => 'required|exists:people,id',
            'email' => 'required|email|unique:users,email,' . $this->id . '',
            'password' => 'required|min:8'
        ];

        if (isset($options['password']) && $options['password'] === false) unset($rules['password']);

        return $rules;
    }

    public function feedback()
    {
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

    //Function to generate api_token used by API.
    public function generateToken()
    {
        $this->api_token = Str::random(60);
        $this->save();
        return $this->api_token;
    }
}
