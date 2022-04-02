<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\ModelFilters\BondFilters;


class Bond extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use Filterable, BondFilters;
    use Sortable;

    protected $fillable = ['person_id', 'ocupation_id', 'begin', 'end', 'course_id', 'pole_id'];
    protected $auditInclude = ['id', 'person_id', 'ocupation_id', 'begin', 'end', 'course_id', 'pole_id'];
    public $sortable = ['id', 'status', 'begin', 'end', 'created_at', 'updated_at'];
    public static $accepted_filters = [
        'status_is',
        'person_like',
        'ocupation_like',
        'begin_gte',
        'begin_lte',
        'end_gte',
        'end_lte',
        'course_like',
        'pole_like'
    ];
    private static $whiteListFilter = ['*'];

    public function scopeAddStatusColumn($query)
    {
        $previous_columns = $query->getQuery()->columns;
        $status_column = DB::raw('(begin <= NOW() AND end >= NOW()) OR (begin <= NOW() AND end IS NULL) as status');
        $new_columns = $previous_columns == null ? ['*', $status_column] : [$previous_columns] + [$status_column];
        $query = $query->select($new_columns);
        return $query;
    }

    //metodo de ordenação para (bond_status) no sortable
    public function statusSortable($query, $direction)
    {
        $query = $query
            ->select('*', DB::raw('(begin <= NOW() AND end >= NOW()) OR (begin <= NOW() AND end IS NULL) as bond_status'))
            ->orderBy('bond_status', $direction);
        return $query;
    }

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

    public function person()
    {
        return $this->belongsTo('App\Models\Person', 'person_id');
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
            'end-date' => 'required|date_format:Y-m-d|after_or_equal:begin-date',
            'end-time' => 'required|date_format:H:i:s',
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
