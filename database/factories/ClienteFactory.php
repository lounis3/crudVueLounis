<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "dni" => $this->faker->dni,
            "nombre" => $this->faker->name,
            "apellidos" => $this->faker->lastName,
            "direccion" => $this->faker->address,
            "telefono" => $this->faker->phoneNumber,
            "pais" => $this->faker->country,
        ];
    }
}
