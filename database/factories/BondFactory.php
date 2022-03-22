<?php

namespace Database\Factories;

use App\Models\Bond;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use App\Models\Ocupation;
use App\Models\Course;
use App\Models\Pole;

class BondFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bond::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $begin = $this->faker->dateTimeBetween('-3 years', 'now');
        $end = $this->faker->dateTimeBetween($begin, $begin->format('Y-m-d H:i:s') . sprintf('+%d days', $this->faker->numberBetween(1, 730)));

        return [
            'person_id' =>   Person::all()->random()->id,
            'ocupation_id' => Ocupation::all()->random()->id,
            'course_id' => rand(1, 100) > 30 ? Course::all()->random()->id : null, //30% será null
            'pole_id' => rand(1, 100) > 30 ?  Pole::all()->random()->id : null, //30% será null
            'begin' => $begin,
            'end' => $end,
            'notes' => $this->faker->sentence(10, True),
        ];
    }
}
