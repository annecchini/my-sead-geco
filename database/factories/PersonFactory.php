<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'cpf' => $this->faker->cpf(),
            'mother_name' => rand(1, 100) > 30 ? $this->faker->firstName('female') . ' ' . $this->faker->lastName() : null
        ];
    }
}
