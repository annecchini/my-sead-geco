<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;
use App\Custom\ModelFilterHelpers;
use Illuminate\Support\Facades\DB;

trait BondFilters
{
    public function status_is(Builder $builder, $value)
    {

        $values = ModelFilterHelpers::inputToArray($value);

        foreach ($values as $key => $value) {
            if (in_array(strtolower($value), ['sim', '1', 'true'])) {
                $values[$key] = 1;
            } else if (in_array(strtolower($value), ['não', 'nao', '0', 'false'])) {
                $values[$key] = 0;
            } else {
                $values[$key] = null;
            }
        }

        $status_table = DB::table('bonds')->selectRaw("id as filter_status_id, (begin <= NOW() AND end >= NOW()) OR (begin <= NOW() AND end IS NULL) as filter_status");

        $builder = $builder->joinSub($status_table, 'status_table', function ($join) {
            $join->on('bonds.id', '=', 'status_table.filter_status_id');
        });

        $builder = ModelFilterHelpers::simpleOperation($builder, 'filter_status', '=', $values);
        return $builder;
    }


    public function person_like(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::relationContains($builder, 'person', 'name', $values);
        return $builder;
    }

    public function ocupation_like(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::relationContains($builder, 'ocupation', 'name', $values);
        return $builder;
    }

    public function begin_gte(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::simpleOperation($builder, 'begin', '>=', $values);
        return $builder;
    }

    public function begin_lte(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::simpleOperation($builder, 'begin', '<=', $values);
        return $builder;
    }

    public function end_gte(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::simpleOperation($builder, 'end', '>=', $values);
        return $builder;
    }

    public function end_lte(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::simpleOperation($builder, 'end', '<=', $values);
        return $builder;
    }

    public function course_like(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::relationContains($builder, 'course', 'name', $values);
        return $builder;
    }

    public function pole_like(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::relationContains($builder, 'location', 'name', $values);
        return $builder;
    }
}
