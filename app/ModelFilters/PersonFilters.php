<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;
use App\Custom\ModelFilterHelpers;

trait PersonFilters
{
    public function cpf_like(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::contains($builder, 'cpf', $values);
        return $builder;
    }

    public function name_like(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::contains($builder, 'name', $values);
        return $builder;
    }
}
