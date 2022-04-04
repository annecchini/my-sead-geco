<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\ModelFilters\PersonFilters;

class Person extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use Filterable, PersonFilters;
    use Sortable;

    protected $fillable = ['name', 'cpf', 'mother_name'];
    protected $auditInclude = ['id', 'name', 'cpf'];
    public $sortable = ['id', 'name', 'cpf', 'mother_name',  'created_at', 'updated_at'];
    public static $accepted_filters = [
        'cpf_like',
        'name_like',
        'mother_name_like'
    ];
    private static $whiteListFilter = ['*'];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document');
    }

    public function bonds()
    {
        $resultQuery =    $this
            ->hasMany('App\Models\Bond')
            ->select('*', DB::raw('(begin <= NOW() AND end >= NOW()) OR (begin <= NOW() AND end IS NULL) as status'))
            ->orderBy('status', 'DESC')
            ->orderBy('begin', 'DESC')
            ->orderBy('end', 'DESC');
        return  $resultQuery;
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
