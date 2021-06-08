<?php

namespace Database\Factories;

use App\Models\Empleado;
use Faker\Provider\es_ES\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empleado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $estudios = ['Sin Estudios', 'E.S.O.', 'Bachillerato', 'Universitario', 'Grado Medio', 'Grado Superior'];
        return [
            "dni" => $this->faker->dni,
            "nombre" => $this->faker->name,
            "apellidos" => $this->faker->lastName,
            "direccion" => $this->faker->address,
            "telefono" => $this->faker->phoneNumber,
            "estudios" => $this->faker->randomElement($estudios),
        ];
    }
}
