<?php

namespace Database\Factories;
use App\Models\Ville;

use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'etudiant_nom' => $this->faker->name,
			'etudiant_adresse' => $this->faker->address,
			'etudiant_telephone' => $this->faker->phoneNumber,
			'etudiant_courriel' => $this->faker->email,
			'etudiant_date_naissance' => $this->faker->date,
			'etudiant_ville_id' => rand(1, Ville::count())
        ];
    }
}