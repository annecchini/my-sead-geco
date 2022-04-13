<?php

namespace Database\Factories;

use App\Models\InternalNote;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;

class InternalNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InternalNote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        //$model_name = get_class($model); //Para pegar o nome completo de um modelo instanciado.
        $model_name = $this->faker->randomElement(['App\Models\User', 'App\Models\Person', 'App\Models\Bond']);
        $model_id = $model_name::all()->random()->id;

        return [
            'last_up_person_id' => Person::all()->random()->id,
            'model_name' => $model_name,
            'model_id' => $model_id,
            'content' => $this->faker->text()
        ];
    }
}
