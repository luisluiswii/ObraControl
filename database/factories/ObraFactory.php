<?php

namespace Database\Factories;

use App\Models\Obra;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObraFactory extends Factory
{
    protected $model = Obra::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->company . ' ' . $this->faker->word,
            'direccion' => $this->faker->address,
            'fecha_inicio' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'fecha_fin' => $this->faker->optional()->dateTimeBetween('now', '+1 years'),
            'estado' => $this->faker->randomElement(['en curso', 'finalizada', 'pausada']),
        ];
    }
}
