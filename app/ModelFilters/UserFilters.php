<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;
use App\Custom\ModelFilterHelpers;

trait UserFilters
{
    public function email_like(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::contains($builder, 'email', $values);
        return $builder;
    }

    public function person_like(Builder $builder, $value)
    {
        $values = ModelFilterHelpers::inputToArray($value);
        $builder = ModelFilterHelpers::relationContains($builder, 'person', 'name', $values);
        return $builder;
    }
}
